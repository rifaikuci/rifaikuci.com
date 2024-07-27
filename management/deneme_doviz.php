<?php

function getDbConnection()
{
    $host = 'localhost';
    $user = 'rifaikuc';
    $password = 'Gt36wwY2x7';
    $dbname = 'rifaikuc_rifaikuci';

    $db = new mysqli($host, $user, $password, $dbname);

    if ($db->connect_error) {
        die("Bağlantı başarısız: " . $db->connect_error);
    }

    return $db;
}

function ensureDbConnection($db) {
    if (!$db->ping()) {
        $db = getDbConnection();
    }

    return $db;
}

$db = getDbConnection();



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
        return false;
    }
}

function getSleepDuration($hour, $day, $isHoliday) {

    if ($isHoliday) {
        return 60*60*4; // 1 saat
    }

    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        if ($hour >= 9 && $hour <= 19) {
            return 60*60*2; // 1 saat
        }
    } elseif ($day == 6) { // Cumartesi
        if ($hour >= 9 && $hour <= 14) {
            return 60*60*2; // 1 saat
        }
    }
    return 60*60*4; // 1 saat
}

function getActiveCurrencies($db) {
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

function fetchCurrencyDataFromApi($apiKey) {
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

function processAndInsertCurrencies($currencies, $activeCurrency, $db, $dollarApiKey) {
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

    $sql = "INSERT INTO currencyReponse3 (currencyCode, selling, buying, transactionDate, rate, apiKey)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);

    foreach ($filteredCurrencies as $row) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $row['id'], $row['selling'], $row['buying'], $row['datetime'], $row['rate'], $dollarApiKey);
        mysqli_stmt_execute($stmt);
    }
}

function getDataRow2($id, $table, $db) {
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    $result = [];
    $meta = $stmt->result_metadata();
    $fields = $meta->fetch_fields();
    $params = [];
    foreach ($fields as $field) {
        $params[] = &$result[$field->name];
    }

    call_user_func_array([$stmt, 'bind_result'], $params);
    mysqli_stmt_fetch($stmt);

    return $result;
}

$dollarApiKey = 1;

while (true) {
    $db = ensureDbConnection($db);  // Ensure the connection is alive

    $currentHour = (int)date('G'); // Şu anki saat (0-23)
    $currentDay = (int)date('N'); // Şu anki gün (1=Monday, 7=Sunday)
    $currentDate = date('Y-m-d'); // Şu anki tarih

    $isHoliday = isHoliday($currentDate, $db);


    if (shouldRunScript($currentHour, $currentDay)) {
        $dollarRow = getDataRow2($dollarApiKey, 'collectionApi', $db);
        $apiKey = $dollarRow ? $dollarRow['apiKey'] : "";

        $apiResponse = fetchCurrencyDataFromApi($apiKey);
        $response = json_decode($apiResponse, true);

        if ($response['success']) {
            processAndInsertCurrencies($response['result'], $activeCurrency, $db, $dollarApiKey);
        } else {
            $dollarApiKey += 1;
            $dollarRow = getDataRow2($dollarApiKey, 'collectionApi', $db);
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

    $sleepDuration = getSleepDuration($currentHour, $currentDay, $isHoliday);
    sleep($sleepDuration);
}
?>
