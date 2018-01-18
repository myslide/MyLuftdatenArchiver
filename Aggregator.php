<?php

/**
 * The Base class to pull data from archive.luftdaten.info.
 * It stores the date specific csv-files into a given directory.
 * @author mysli
 * @version 20180118
 */
class Aggregator
{
    const DatePattern = "Y-m-d";
    
    public const EXT = '.csv';

    protected $webPage;

    protected $sensorID;

    protected $filebody;

    protected $interval;

    protected $files;

    protected $badFiles;

    public function aggregate(DateTime $startdate, DateTime $enddate, $targetDirectory)
    {
        $end = $enddate->diff($startdate)->days;
        for ($i = 0; $i < $end; $i ++) {
            try {
                $aggregateDate = $startdate->add($this->interval)->format(Aggregator::DatePattern);
                $csvfile = $aggregateDate . $this->filebody;
                $url = $this->webPage . $aggregateDate . "/" . $csvfile;
                
                $targetFile = $targetDirectory . $csvfile;
                if (file_exists($targetFile)) {
                    echo $targetFile . " just exist.\n";
                } else if (@copy($url, $targetFile)) { // the '@' supresses the warnings
                    $this->files[] = $csvfile;
                    echo "Got file " . $csvfile . "\n";
                } else {
                    $this->badFiles[] = $csvfile;
                    echo $url . " does not exist in archive.\n";
                }
            } catch (Exception $ex) {}
        }
    }

    public function getPulledFileNames()
    {
        return $this->files;
    }

    public function getnotExistingFileNames()
    {
        return $this->badFiles;
    }
}
?>
