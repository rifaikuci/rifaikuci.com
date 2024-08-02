<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function logError($message)
{
    error_log($message . "\n", 3, './php_script_errors.log');
}

function logInfo($message)
{
    error_log($message. " \n", 3, './php_script_info.log');
}

function getDbConnection()
{
    $host = 'localhost';
    $user = 'rifaikuc';
    $password = 'Gt36wwY2x7';
    $dbname = 'rifaikuc_rifaikuci';

    $db = new mysqli($host, $user, $password, $dbname);

    if ($db->connect_error) {
        $hata = $db->connect_error;
        logError("Bağlantı hatası: " . $hata);
        die("Bağlantı başarısız: " . $db->connect_error);
    }

    return $db;
}

function ensureDbConnection($db)
{
    try {
        if (!($db instanceof mysqli) || !$db->ping()) {
            // $db geçerli bir mysqli nesnesi değilse veya bağlantısı aktif değilse, yeni bir bağlantı oluşturuyoruz
            $db = getDbConnection();
        }
    } catch (Exception $ex) {
        $hata  = $ex->getMessage();
        logError("db coonnection kontrolü: " . $hata);
    }

    return $db;
}

function isHoliday($date, $db)
{
    $sql = "SELECT COUNT(*) FROM holidays WHERE date = '$date'";
    $result = mysqli_query($db, $sql);
    if (!$result) {
        logError("isHoliday error: " . mysqli_error($db));
        return false;
    }
    $row = mysqli_fetch_array($result);
    return $row[0] > 0;
}

function getSleepDuration($hour, $day, $isHoliday)
{
    if ($isHoliday) {
        return 60 * 30; // 30 dakika
    }

    if ($day >= 1 && $day <= 5) { // Pazartesi-Cuma
        if ($hour >= 9 && $hour <= 19) {
            return 60 * 15; // 10 dakika
        }
    } elseif ($day == 6) { // Cumartesi
        if ($hour >= 9 && $hour <= 14) {
            return 60 * 15; // 10 dakika
        }
    } else {
        return 60 * 30; // 30 dakika
    }

    // Default sleep duration if none of the conditions are met
    return 60 * 30; // 30 dakika
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

function getActiveGoldPrices($db)
{
    $sql = "SELECT * FROM currency WHERE isActive = 1";
    $result = $db->query($sql);

    $goldPrices = [];
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if (strlen($row['code']) != 3) {
            $goldPrices[] = [
                'code' => $row['code'],
                'id' => $row['id']
            ];
        }
    }
    return $goldPrices;
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
    if (curl_errno($curl)) {
        logError('Curl error: ' . curl_error($curl));
    }
    curl_close($curl);

    return $response;
}

function fetchGoldPricesDataFromApi($apiKey)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.collectapi.com/economy/goldPrice",
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
    if (curl_errno($curl)) {
        logError('Curl error: ' . curl_error($curl));
    }
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

    foreach ($filteredCurrencies as $row) {
        $curCode = $row['id'];
        $selling = $row['selling'];
        $buying = $row['buying'];
        $datetime = $row['datetime'];
        $rate = $row['rate'];

        try {
            $sql = "INSERT INTO currencyReponse (currencyCode, selling, buying, transactionDate, rate, apiKey)
            VALUES ('$curCode', '$selling', '$buying', '$datetime','$rate', '$dollarApiKey')";
            $result = mysqli_query($db, $sql);
        } catch (Exception $e) {
            logError($e->getMessage());
        }
    }

}

function processAndInsertGold($currencies, $activeCurrency, $db, $dollarApiKey)
{
    $filteredCurrencies = array_map(function ($currency) use ($activeCurrency) {
        $activeCodes = array_column($activeCurrency, 'code');
        $activeIds = array_column($activeCurrency, 'id', 'code');
        if (in_array($currency['name'], $activeCodes)) {
            $currency['id'] = $activeIds[$currency['name']];
            $currency['datetime'] = $currency['date'] . ' ' . $currency['time'];
            unset($currency['date'], $currency['time']);
            return $currency;
        }
        return null;
    }, $currencies);

    $filteredCurrencies = array_filter($filteredCurrencies);

    foreach ($filteredCurrencies as $row) {
        $curCode = $row['id'];
        $selling = $row['selling'];
        $buying = $row['buying'];
        $datetime = $row['datetime'];
        $rate = $row['rate'];

        try {
            $sql = "INSERT INTO currencyReponse (currencyCode, selling, buying, transactionDate, rate, apiKey)
            VALUES ('$curCode', '$selling', '$buying', '$datetime','$rate', '$dollarApiKey')";
            $result = mysqli_query($db, $sql);
        } catch (Exception $e) {
            logError($e->getMessage());
        }
    }

}

function getDataRow2($id, $table, $db)
{
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    try {
        $result =  mysqli_query($db, $sql);
    }catch (Exception $e) {
        logError($e->getMessage());
    }


    return mysqli_fetch_assoc($result);
}

$dollarApiKey = 1;
$goldApiKey = 1;

$db = getDbConnection(); // Bağlantıyı başta aç

$sumSecond = 0;

while ($sumSecond < 3600) {
    try {

        $currentHour = (int)date('G'); // Şu anki saat (0-23)
        $currentDay = (int)date('N'); // Şu anki gün (1=Monday, 7=Sunday)
        $currentDate = date('Y-m-d'); // Şu anki tarih

        $db = ensureDbConnection($db); // Bağlantıyı kontrol et ve gerekirse yeniden bağlan

        $isHoliday = isHoliday($currentDate, $db);
        $dataFetched = false;
        $dataFetchedGold = false;

        while (!$dataFetched) {
            $dollarRow = getDataRow2($dollarApiKey, 'collectionApi', $db);

            if ($dollarRow) {
                $apiKey = $dollarRow['apiKey'];

                $apiResponse = fetchCurrencyDataFromApi($apiKey);

                $response = json_decode($apiResponse, true);

                if ($response && $response['success']) {
                    processAndInsertCurrencies($response['result'], getActiveCurrencies($db), $db, $dollarApiKey);
                    $dataFetched = true; // Veri başarıyla alındı, döngüyü kır
                } else {
                    $dollarApiKey += 1; // API anahtarını arttır
                }
            } else {
                $dollarApiKey = 1;
            }
        }

        while (!$dataFetchedGold) {
            $goldRow = getDataRow2($goldApiKey, 'collectionApi', $db);

            if ($goldRow) {
                $goldKey = $goldRow['apiKey'];

                $apiResponseGold = fetchGoldPricesDataFromApi($goldKey);

                $responsegGold = json_decode($apiResponseGold, true);

                if ($responsegGold && $responsegGold['success']) {
                    processAndInsertGold($responsegGold['result'], getActiveGoldPrices($db), $db, $goldApiKey);
                    $dataFetchedGold = true; // Veri başarıyla alındı, döngüyü kır
                } else {
                    $dataFetchedGold += 1; // API anahtarını arttır
                }
            } else {
                $goldApiKey = 1;
            }
        }



        $sleepDuration = getSleepDuration($currentHour, $currentDay, $isHoliday);
        $sumSecond = $sumSecond + $sleepDuration;
        sleep($sleepDuration);
    } catch (Exception $e) {
    } finally {
    }
}

// Betik sona ermeden önce bağlantıyı kapat
?>
