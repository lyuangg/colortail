<?php
$bin_file = __DIR__ . DIRECTORY_SEPARATOR . 'bin/ctail.phar';
$main_file = 'tail.php';
$dest_file = dirname($bin_file).DIRECTORY_SEPARATOR.pathinfo($bin_file, PATHINFO_FILENAME);
$shebang = "#!/usr/bin/env php";


//在bin目录下创建phar文件
$phar = new Phar($bin_file);

//从src目录构建phar包
$phar->buildFromDirectory('src');

//定义默认执行入口
$defStub = Phar::createDefaultStub($main_file);

//设置php解释器shell头，让phar可以自己执行
$phar->setStub($shebang."\n".$defStub);

$phar->compressFiles(Phar::BZ2);

rename($bin_file, $dest_file);

//授予phar包可执行权限
chmod($dest_file, 0755);

echo $dest_file;
