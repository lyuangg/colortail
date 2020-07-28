<?php
// test.emergency: message
// test.alert: message
// test.critical: message
// test.error: message
// test.warning: message
// test.notice: message
// test.info: message
// test.debug: message
$fp = fopen("php://stdin", "r");
while (!feof($fp)) {
    $s = fgets($fp);
    $s = preg_replace('/(^.*?)(\s\w*?\.emergency:)(.*?)(.{20}$)/i', "\e[41m$1$2\e[0m$3\e[41m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.alert:)(.*?)(.{20}$)/i', "\e[45m$1$2\e[0m$3\e[45m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.critical:)(.*?)(.{20}$)/i', "\e[95m$1$2\e[0m$3\e[95m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.error:)(.*?)(.{20}$)/i', "\e[31m$1$2\e[0m$3\e[31m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.warning:)(.*?)(.{20}$)/i', "\e[35m$1$2\e[0m$3\e[35m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.notice:)(.*?)(.{20}$)/i', "\e[34m$1$2\e[0m$3\e[34m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.info:)(.*?)(.{20}$)/i', "\e[32m$1$2\e[0m$3\e[32m$4\e[0m", $s);
    $s = preg_replace('/(^.*?)(\s\w*?\.debug:)(.*?)(.{20}$)/i', "\e[33m$1$2\e[0m$3\e[33m$4\e[0m", $s);

    $s = preg_replace('/(^.*?)(HTTP\/1\.1")(\s2[0-9]{2}\s)/i', "\e[32m$1$2$3\e[0m", $s);
    $s = preg_replace('/(^.*?)(HTTP\/1\.1")(\s3[0-9]{2}\s)/i', "\e[33m$1$2$3\e[0m", $s);
    $s = preg_replace('/(^.*?)(HTTP\/1\.1")(\s4[0-9]{2}\s)/i', "\e[35m$1$2$3\e[0m", $s);
    $s = preg_replace('/(^.*?)(HTTP\/1\.1")(\s5[0-9]{2}\s)/i', "\e[31m$1$2$3\e[0m", $s);

    echo $s;
}
fclose($fp);
