==Overview==
If you contribute to the citizen science project of http://luftdaten.info/ you may analyse your sensor data for your own purpose. This tiny php program downloads all these individual files of a specific sensor from a given date until today onto your computer or any given directory. Feel free to improve it! 

==Howto==
Use the config.ini to set up the individual data: 
*Your Sensor ID. Currently I implemented the Air quality sensor SDS011 and the temperature/humidity/pressure sensor BM280 specifics.
*The start date. When went the sensor online?
*The target directory. The download folder of the files. A relative pathname from the php files is possible.

Launch it in a proper php configuration: >php aggregate.php


