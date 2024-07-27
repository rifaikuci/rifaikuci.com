<?php

if (file_exists("utils/index.php")) {
    require_once "utils/index.php";
} elseif (file_exists("../utils/index.php")) {
    require_once "../utils/index.php";
} elseif (file_exists("../../utils/index.php")) {
    require_once "../../utils/index.php";
} elseif (file_exists("../../../utils/index.php")) {
    require_once "../../../utils/index.php";
}

?>

<?php

$activeCurrency = getActiveCurrencies($db);



function shouldRunScript($hour, $day) {
    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        return ($hour >= 9 && $hour <= 19);
    } elseif ($day == 6) { // Cumartesi
        return ($hour >= 9 && $hour <= 14);
    } else {
        return true;
    }
}

// Scriptin bekleme süresini belirleyen fonksiyon
function getSleepDuration($hour, $day) {

    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        if ($hour >= 9 && $hour <= 19) {
            return 60; // 1 saat (3600 saniye)
        }
    } elseif ($day == 6) { // Cumartesi
        if ($hour >= 9 && $hour <= 14) {
            return 60; // 1 saat (3600 saniye)
        }
    }
    return 60; // 1 saat (3600 saniye)
}

function getActiveCurrencies($db)
{
    $sql = "SELECT * FROM currency WHERE isActive = 1";
    $result = $db->query($sql);

    $activeCurrency = [];
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if (strlen($row['code']) == 3) {
            $activeCurrency[] = [
                'code' => $row['code'],
                'id' => $row['id']
            ];
        }
    }
    return $activeCurrency;
}

function fetchCurrencyDataFromApi($apiKey)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.collectapi.com/economy/allCurrency",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "authorization: apikey " . $apiKey,
            "content-type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

function processAndInsertCurrencies($currencies, $activeCurrency, $db, $dollarApiKey)
{
    $filteredCurrencies = array_map(function ($currency) use ($activeCurrency) {
        $activeCodes = array_column($activeCurrency, 'code');
        $activeIds = array_column($activeCurrency, 'id', 'code');
        if (in_array($currency['code'], $activeCodes)) {
            $currency['id'] = $activeIds[$currency['code']];
            $currency['datetime'] = $currency['date'] . ' ' . $currency['time'];
            unset($currency['date'], $currency['time']);
            return $currency;
        }
        return null;
    }, $currencies);

    $filteredCurrencies = array_filter($filteredCurrencies);

    $sql = "INSERT INTO currencyReponse2 (currencyCode, selling, buying, transactionDate, rate, apiKey)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);

    foreach ($filteredCurrencies as $row) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $row['id'], $row['selling'], $row['buying'], $row['datetime'], $row['rate'], $dollarApiKey);
        mysqli_stmt_execute($stmt);
    }
}

$dollarApiKey = 1;


while (true) {
    $currentHour = (int)date('G'); // Şu anki saat (0-23)
    $currentDay = (int)date('N'); // Şu anki gün (1=Monday, 7=Sunday)
    $currentDate = date('Y-m-d'); // Şu anki tarih


    if (shouldRunScript($currentHour, $currentDay)) {
        $dollarRow = getDataRow($dollarApiKey, 'collectionApi', $db);
        $apiKey = $dollarRow ? $dollarRow['apiKey'] : "";

        $apiResponse = fetchCurrencyDataFromApi($apiKey);
        $response = json_decode($apiResponse, true);

        if ($response['success']) {
            processAndInsertCurrencies($response['result'], $activeCurrency, $db, $dollarApiKey);
        } else {
            $dollarApiKey += 1;
            $dollarRow = getDataRow($dollarApiKey, 'collectionApi', $db);
            $apiKey = $dollarRow ? $dollarRow['apiKey'] : "";

            $apiResponse = fetchCurrencyDataFromApi($apiKey);
            $response = json_decode($apiResponse, true);

            if ($response['success']) {
                processAndInsertCurrencies($response['result'], $activeCurrency, $db, $dollarApiKey);
            } else {
                echo "API'den veri alınamadı.";
            }
        }
    } else {
        echo "Script bu zaman aralığında çalışmayacak.";
    }

    $sleepDuration = getSleepDuration($currentHour, $currentDay);
    sleep($sleepDuration);
}

?>
