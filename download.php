<?php
/***************************************************************************
 * 
 * Copyright (c) 2017 hanyan.com, Inc. All Rights Reserved
 * 
 **************************************************************************/
 
 
 
/**
 * @file download.php
 * @author hanyan04
 * @date 2017/06/02 17:26:17
 * @brief 
 *  
 **/

function downfile($fileurl)
{
    ob_start(); 
    $filename=$fileurl;
    $date=date("Ymd-H:i:m");
    header( "Content-type:  application/force-download "); 
    header( "Accept-Ranges:  bytes "); 
    header( "Content-Disposition:  attachment;  filename= {$date}.doc"); 
    readfile($filename); 
 //   header( "Accept-Length: " .$size);
   // echo $size;
}

function downfile1($fileurl)
{
    $filename=$fileurl;
    $file  =  fopen($filename, "r"); 
   // Header( "Content-type:  application/octet-stream "); 
   // Header( "Accept-Ranges:  bytes "); 
   // Header( "Content-Disposition:  attachment;  filename= 4.doc"); 
    $contents = "";
    while (!feof($file)) {
         $contents .= fread($file, 8192);
    }
    $pos = strripos($fileurl,'/');
    $file_name = substr($fileurl,$pos+1);
    //echo $file_name;
    $fw = fopen($file_name,'w');
    fwrite($fw,$contents);
    //echo $contents;
    fclose($fw);
    fclose($file); 

    return $file_name;
}


function create_zip($files = array(),$destination = '',$overwrite = false) {        
    //如果zip文件已经存在并且设置为不重写返回false    
    if(file_exists($destination) && !$overwrite) { return false; }    
    $valid_files = array();    
    //获取到真实有效的文件名    
    if(is_array($files)) {    
        //cycle through each file    
        foreach($files as $file) {    
        //make sure the file exists    
            if(file_exists($file)) {    
            $valid_files[] = $file;    
            }    
        }    
    }    
    //如果存在真实有效的文件    
    if(count($valid_files)) {      
        $zip = new ZipArchive();    
        //打开文件       如果文件已经存在则覆盖，如果没有则创建    
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {    
            return false;    
        }    
        //向压缩文件中添加文件    
        foreach($valid_files as $file) {   
            $file_info_arr= pathinfo($file);  
        $filename =$file_info_arr['basename'];   
                $zip->addFile($file,$filename);    
        }    
        //关闭文件    
        $zip->close();    
        //检测文件是否存在    
        return file_exists($destination);    
    }else{    
        //如果没有真实有效的文件返回false    
        return false;    
    }    
}  

function addFileToZip($path,$zip){
    $handler=opendir($path); //打开当前文件夹由$path指定。
    while(($filename=readdir($handler))!==false){
        if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作
            if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                addFileToZip($path."/".$filename, $zip);
            }else{ //将文件加入zip对象
                $zip->addFile($path."/".$filename);
            }
        }
    }
    @closedir($path);
}

function create_zip1($files = array(),$destination = '',$overwrite = false) {        
    //如果zip文件已经存在并且设置为不重写返回false    
    if(file_exists($destination) && !$overwrite) { return false; }    
    //如果存在真实有效的文件    
    if(count($files)) {      
        $zip = new ZipArchive();    
        //打开文件       如果文件已经存在则覆盖，如果没有则创建    
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {    
            return false;    
        }    
        //向压缩文件中添加文件    
        foreach($files as $file) { 
            if(is_dir($file)){
                addFileToZip($file,$zip);
            }else{
                $zip->addFile($file);
            }
        }    
        //关闭文件    
        $zip->close();    
        //检测文件是否存在    
        return file_exists($destination);    
    }else{    
        //如果没有真实有效的文件返回false    
        return false;    
    }    
}


$file = array();

$url = "http://ip:8868/uploads/input_16k_answer.txt";
$url1 = "http://ip:8868/uploads/license.txt";
$file[] = downfile1($url);
$file[] = downfile1($url1);

print_r($file);

$zip = time() . "hh.zip";

echo create_zip($file,$zip);

exec("mv $zip hy_download/");

file_dir[]="han"; //文件夹和文件名 都行
file_dir[]="hypot"; // 文件夹和文件名 都行
$zip_name = time() . "hh.zip";

echo create_zip1($file,$zip_name); 



/* vim: set expandtab ts=4 sw=4 sts=4 tw=100: */
?>
