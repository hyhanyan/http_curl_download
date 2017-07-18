<?php

$name ='<script type="text/javascript">document.write("Hello World!")</script>';

if (isset($name)){  
    $str = trim($name);  //清理空格  
    $str = strip_tags($str);   //过滤html标签  
    $str = htmlspecialchars($str);   //将字符内容转化为html实体  
    $str = addslashes($str);  
    echo $str;  
}
?>
