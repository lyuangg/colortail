<?php
$tail_cmd   = 'tail';
$color_cmd  = __FILE__;
$simple_cmd = true;

if (strpos($color_cmd, 'phar://') === 0) {
    $color_cmd = substr(dirname($color_cmd), strlen('phar://'));
} else {
    $color_cmd = 'php ' . $color_cmd;
}

$log_color = __DIR__ . DIRECTORY_SEPARATOR . 'logcolor.php';

if (count($argv) == 1) {
    include $log_color;
    die;
}

$tail_args = '';
foreach ($argv as $key => $val) {
    if ($key != 0) {
        if (strtolower($val) == '-f') {
            $simple_cmd = false;
        }
        $tail_args .= ' ' . $val;
    }
}
$tail_cmd .= $tail_args;

if ($simple_cmd) {
    echo exec($tail_cmd . ' | ' . $color_cmd);

} else {
    $descs = [
        0 => array('pipe', 'r'),
        1 => array('pipe', 'w'),
        2 => array('pipe', 'w'),
    ];
    $process  = proc_open($tail_cmd, $descs, $pipes);
    $process2 = proc_open($color_cmd, $descs, $pipes2);

    if (is_resource($process) && is_resource($process2)) {
        while ($ret = fgets($pipes[1])) {
            fwrite($pipes2[0], $ret);
            echo fgets($pipes2[1]);
        }

        proc_close($process);
        proc_close($process2);
    }
}
