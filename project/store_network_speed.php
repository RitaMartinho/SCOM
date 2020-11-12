<?php
    $speed = array();
    $speed= $_POST;

    foreach ($speed as $value){
        $towrite=$value;
    }
    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    
    $local= $_POST["lat"].$_POST["lng"];

    fwrite($myfile, " ".$towrite." ");
    fclose($myfile);
?>