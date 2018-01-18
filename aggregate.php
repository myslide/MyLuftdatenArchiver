<?php
/**
 * This is the main script to aquire archived data of specific sensors of "luftdaten.info" 
 * Set your individual sensor and target directory within the config.ini .
 * @author mysli
 * @version 20180118
 */
include 'BME280Aggregator.php';
include 'SDS011Aggregator.php';
const WEBPAGE = "http://archive.luftdaten.info/";

$config = parse_ini_file("config.ini");

function getTargetDirectory($config)
{
    $dir = $config['targetDir'];
    if (! file_exists($dir)) {
        mkdir($dir);
    }
    return $dir;
}

$targetDir = getTargetDirectory($config);
$UTC = new DateTimeZone("UTC");
$startDate = new DateTime($config['startDate'], $UTC);
$today = new DateTime("now", $UTC);

$bme = new BME280Aggregator(WEBPAGE, $config['IDbme280']);
$bme->aggregate(clone $startDate, $today, $targetDir);
// $bme->getPulledFileNames();
$sds = new SDS011Aggregator(WEBPAGE, $config['IDsds011']);
$sds->aggregate($startDate, $today, $targetDir);

?>
