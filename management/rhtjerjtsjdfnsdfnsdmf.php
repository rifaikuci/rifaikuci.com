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
echo "durd";

exit();

$activeCurrency = getActiveCurrencies($db);

function isHoliday($date, $db) {
    $sql = "SELECT COUNT(*) FROM holidays WHERE date = '$date'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    return $row[0] > 0;
}

function shouldRunScript($hour, $day, $isHoliday) {
    if ($isHoliday) {
        return true; // Tatil günlerinde 3 saatte bir çalışacak
    }
    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        return ($hour >= 9 && $hour <= 19);
    } elseif ($day == 6) { // Cumartesi
        return ($hour >= 9 && $hour <= 14);
    } else {
        return true;
    }
}

// Scriptin bekleme süresini belirleyen fonksiyon
function getSleepDuration($hour, $day, $isHoliday) {
    if ($isHoliday) {
        return 10800; // Tatil günlerinde 3 saatte bir
    }
    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        if ($hour >= 9 && $hour <= 19) {
            return 3600; // 1 saat
        }
    } elseif ($day == 6) { // Cumartesi
        if ($hour >= 9 && $hour <= 14) {
            return 3600; // 1 saat
        }
    }
    return 10800; // Diğer zaman dilimlerinde: 3 saat
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

    $sql = "INSERT INTO currencyReponse (currencyCode, selling, buying, transactionDate, rate, apiKey)
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

    $isHoliday = isHoliday($currentDate, $db);



    if (shouldRunScript($currentHour, $currentDay, $isHoliday)) {
        echo "asdasd";
        exit();
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
    }


    $sleepDuration = getSleepDuration($currentHour, $currentDay, $isHoliday);
    sleep($sleepDuration);
}

?>
