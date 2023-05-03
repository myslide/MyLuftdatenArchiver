![](https://img.shields.io/github/stars/myslide/MyLuftdatenArchiver?style=social)

Overview
========
If you contribute to the citizen science project of http://luftdaten.info/ you may analyse your sensor data for your own purpose. This tiny php program downloads all these individual files of a specific sensor from a given date until today onto your computer or any given directory. Feel free to improve it! 

Howto
-----
Use the config.ini to set up the individual data: 

* Your Sensor ID. Currently I implemented the Air quality sensor **SDS011** and the temperature/humidity/pressure sensor **BM280** specifics.

* The start date. When went the sensor online?

* The target directory. The download folder of the files. A relative pathname from the php files is possible.

Launch it in a proper php configuration: >php aggregate.php

Quick'n dirty run on Windows
----------------------------
* download php for Windows
* unzip the files into c:\php (to find the php_openssl.dll)
* rename the file php.ini-development into php.ini
* in file php.ini remove ";" in line "extension=openssl"
* download MyLuftdatenArchiver from Github https://github.com/myslide/MyLuftdatenArchiver/archive/master.zip
* unzip it (pathtoMyLuftdatenArchiver-master)
* Set up the sensorids in the MyLuftdatenArchiver\config.ini. You find sensor number i.e. in the details of sensor in https://maps.sensor.community . 
* Set up the start date and the target directory of the csv files  in the config.ini.
* open a commandline from the php directory and type: .\php &lsaquo;pathtoMyLuftdatenArchiver-master&rsaquo;\aggregate.php
