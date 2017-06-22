<?php
/***************************************************************************
 * 
 * 
 **************************************************************************/
 
 
 
/**
 * @file iconv.php
 * @date 2017/06/21 19:24:45
 * @brief 
 *  
 **/
function detect_encoding($file) {
    $list = array('GBK', 'UTF-8', 'UTF-16LE', 'UTF-16BE', 'ISO-8859-1');
    $str = file_get_contents($file);
    foreach ($list as $item) {
        $tmp = mb_convert_encoding($str, $item ,"auto");
        if (md5($tmp) == md5($str)) {
            return $item;
        }
    }
    return null;
}

$file = "/home/users/hanyan04/data0/work/odp/webroot/utf8.txt";
$code_format=detect_encoding($file);
$command='';

if (strcasecmp($code_format,"UTF-8") == 0){
    $file_temp="tmp_".$file;
    $command="iconv -f utf-8 -t gbk $file > $file_temp"; 
}
#$command = "iconv -f utf-8 -t gbk /home/users/hanyan04/data0/work/odp/webroot/utf8.txt > hh.txt";
#$command = "iconv -f utf-8 -t gbk hh.txt > hh1.txt";
if (!empty($command)){
    exec($command);
    exec("rm -rf $file");
    exec("mv $file_temp $file");
}








/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
?>
