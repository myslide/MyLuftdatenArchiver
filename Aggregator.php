<?php

/**
 * The Base class to pull data from archive.luftdaten.info.
 * It stores the date specific csv-files into a given directory.
 * @author mysli
 * @version 20231031
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
    {           //all previous years are in a archived folder. \YYYY\YYYY-mm-dd\..

                $currentYear = date("Y");
                $startYear=$nstartYear=$startdate->format("Y");
                $yearSpan= $currentYear-$startYear;
                $archiveFolder=$yearSpan>0 ? $startYear . "/":"";
                //files from 2 years before are zipped
                $gz= $yearSpan>1 ? ".gz":"";
                $end = $enddate->diff($startdate)->days;
        for ($i = 0; $i < $end; $i ++) {
            try {
                $aggregateDate = $startdate->add($this->interval)->format(Aggregator::DatePattern);
                $csvfile = $aggregateDate . $this->filebody;

                $url = $this->webPage . $archiveFolder . $aggregateDate . "/" . $csvfile.$gz;
                
                $targetFile = $targetDirectory . $csvfile;
                if (file_exists($targetFile)) {
                    echo $targetFile . " already exist.\n";
                } else if (@copy($url, $targetFile)) { // the '@' supresses the warnings
                    $this->files[] = $csvfile;
                    echo "Got file " . $csvfile . $gz."\n";
                } else {
                    echo $url . " does not exist in archive.\n";
                    $nstartYear=$nstartYear+1;
                    $yearSpan= $currentYear-$nstartYear;
                    $narchiveFolder = $yearSpan>0 ? $nstartYear . "/":"";
                    $ngz= $yearSpan>1 ? ".gz":"";
                    //check
                    $nurl = $this->webPage . $narchiveFolder . $aggregateDate . "/" . $csvfile. $ngz;
                    if (@copy($nurl, $targetFile)){
                         $archiveFolder = $narchiveFolder;
                         $gz=$ngz;
                         $this->files[] = $csvfile;
                    echo "Got file " . $csvfile . $gz . "\n";
                    } else {                     
                    $nstartYear=$startYear;   
                    $this->badFiles[] = $csvfile;
                    echo $nurl . " does not exist in archive also. Check the sensor ID.\n";}
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
