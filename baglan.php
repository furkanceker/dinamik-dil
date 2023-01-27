<?php

session_start();
ob_start();
$db = new PDO("mysql:host=localhost;dbname=dinamikdil;","root","");

function sef_link($str){
    $preg = array("Ç","Ş","Ğ","Ü","İ","Ö","ç","ş","ğ","ü","ö","ı","+","#",".");
    $match = array("c","s","g","u","i","o","c","s","g","u","o","i","plus","sharp","");
    $perma = strtolower(str_replace($preg,$match,$str));
    $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i"," ",$perma);
    $perma = trim(preg_replace('/\s+/'," ",$perma));   
    $perma = str_replace(' ','-',$perma);
    return $perma;
}
?>