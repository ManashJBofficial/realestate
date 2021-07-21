<?php 
spl_autoload_register('myAutoloader');

function myAutoloader($className){
    $path = "../classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension ;

    $path2 = "myadmin/classes/";
    $extension2 = ".class.php";
    $fullPath2 = $path2 . $className . $extension2 ;
    
if (file_exists($fullPath)) {
    include_once $fullPath;
}
elseif(file_exists($fullPath2)){
    include_once $fullPath2; 
}
else{
    return false;
}
}

?>