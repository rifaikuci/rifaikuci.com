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
        logError("Connection error: " . $db->connect_error);
        die("Connection failed: " . $db->connect_error);
    }
    $db->set_charset("utf8");


    return $db;
}

function ensureDbConnection($db)
{
    if (!($db instanceof mysqli) || !$db->ping()) {
        $db = getDbConnection();
    }

    return $db;
}

function isHoliday($date, $db)
{
    $sql = "SELECT COUNT(*) FROM holidays WHERE date = '$date'";
    $result = $db->query($sql);
    if (!$result) {
        logError("isHoliday error: " . $db->error);
        return false;
    }
    $row = $result->fetch_array();
    return $row[0] > 0;
}

function getSleepDuration($hour, $day, $isHoliday)
{
    if ($isHoliday || $day == 7) { // Holiday or Sunday
        return 1800; // 30 minutes
    }

    if ($day >= 1 && $day <= 5 && $hour >= 9 && $hour <= 19) { // Monday-Friday 9-19
        return 900; // 15 minutes
    } elseif ($day == 6 && $hour >= 9 && $hour <= 14) { // Saturday 9-14
        return 900; // 15 minutes
    }

    return 1800; // Default 30 minutes
}

function getActiveCurrencies($db)
{
    $sql = "SELECT * FROM currency WHERE isActive = 1";
    $result = $db->query($sql);

    $activeCurrency = [];
    while ($row = $result->fetch_assoc()) {
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
    while ($row = $result->fetch_assoc()) {
        if (strlen($row['code']) != 3) {
            $goldPrices[] = [
                'code' => $row['code'],
                'id' => $row['id']
            ];
        }
    }
    return $goldPrices;
}

function fetchDataFromApi($url, $apiKey)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
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

function processAndInsertData($data, $activeItems, $db, $apiKey, $table)
{
    $filteredItems = array_filter(array_map(function ($item) use ($activeItems) {

        $activeCodes = array_column($activeItems, 'code');
        $activeIds = array_column($activeItems, 'id', 'code');


        if (isset($item['code'])) {
            $codeOrName = strlen($item['code']) == 3 ? $item['code'] : $item['name'];
        } else {
            $codeOrName = $item['name'];
        }

        if (in_array($codeOrName, $activeCodes)) {
            $item['id'] = $activeIds[isset($item['code']) && strlen($item['code']) == 3 ? $item['code'] : $item['name']];
            $item['datetime'] = $item['date'] . ' ' . $item['time'];
            unset($item['date'], $item['time']);
            return $item;
        }
        return null;
    }, $data));

    foreach ($filteredItems as $row) {
        try {
            $sql = "INSERT INTO $table (currencyCode, selling, buying, transactionDate, rate, apiKey)
                    VALUES ('{$row['id']}', '{$row['selling']}', '{$row['buying']}', '{$row['datetime']}', '{$row['rate']}', '$apiKey')";
            $db->query($sql);
        } catch (Exception $e) {
            logError($e->getMessage());
        }
    }
}

function getDataRow($id, $table, $db)
{
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    return $db->query($sql)->fetch_assoc();
}

$dollarApiKey = 1;
$goldApiKey = 1;
$db = getDbConnection();
$sumSecond = 0;

while ($sumSecond < 3600) {
    try {
        $currentHour = (int)date('G');
        $currentDay = (int)date('N');
        $currentDate = date('Y-m-d');

        $db = ensureDbConnection($db);

        $isHoliday = isHoliday($currentDate, $db);
        $dataFetched = $dataFetchedGold = false;

        while (!$dataFetched) {
            $dollarRow = getDataRow($dollarApiKey, 'collectionApi', $db);
            if ($dollarRow) {
                $apiResponse = fetchDataFromApi("https://api.collectapi.com/economy/allCurrency", $dollarRow['apiKey']);
                $response = json_decode($apiResponse, true);
                if ($response && $response['success']) {
                    processAndInsertData($response['result'], getActiveCurrencies($db), $db, $dollarApiKey, 'currencyReponse');
                    $dataFetched = true;
                } else {
                    $dollarApiKey++;
                }
            } else {
                $dollarApiKey = 1;
            }
        }

        while (!$dataFetchedGold) {
            $goldRow = getDataRow($goldApiKey, 'collectionApi', $db);
            if ($goldRow) {
                $apiResponseGold = fetchDataFromApi("https://api.collectapi.com/economy/goldPrice", $goldRow['apiKey']);
                $responseGold = json_decode($apiResponseGold, true);
                if ($responseGold && $responseGold['success']) {
                    processAndInsertData($responseGold['result'], getActiveGoldPrices($db), $db, $goldApiKey, 'currencyReponse');
                    $dataFetchedGold = true;
                } else {
                    $goldApiKey++;
                }
            } else {
                $goldApiKey = 1;
            }
        }

        $sleepDuration = getSleepDuration($currentHour, $currentDay, $isHoliday);
        $sumSecond += $sleepDuration;
        sleep($sleepDuration);
    } catch (Exception $e) {
        logError($e->getMessage());
    }
}

$db->close();

?>
