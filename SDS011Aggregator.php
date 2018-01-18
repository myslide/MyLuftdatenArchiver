<?php
include_once 'Aggregator.php';

/**
 * Responsible to set the file configuration of the SDS011 sensor type only.
 * 
 * @author mysli
 * @version 20180118
 */
class SDS011Aggregator extends Aggregator
{

    const SDS = "_sds011_sensor_";

    public function __construct($webPage, $sensorID)
    {
        $this->webPage = $webPage;
        $this->sensorID = $sensorID;
        $this->filebody = SDS011Aggregator::SDS . $sensorID . SDS011Aggregator::EXT;
        $this->interval = new DateInterval('P1D');
        $this->files = array();
        $this->badFiles = array();
    }
}
?>
