<?php
include_once 'Aggregator.php';

/**
 * Responsible to set the file configuration of the bme280 sensor type only.
 * 
 * @author mysli
 * @version 20180118
 */
class BME280Aggregator extends Aggregator
{

    const BME = "_bme280_sensor_";

    public function __construct($webPage, $sensorID)
    {
        $this->webPage = $webPage;
        $this->sensorID = $sensorID;
        $this->filebody = BME280Aggregator::BME . $sensorID . BME280Aggregator::EXT;
        $this->interval = new DateInterval('P1D');
        $this->files = array();
        $this->badFiles = array();
    }
}
?>
