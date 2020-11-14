<?php
    $speed = array();
    $speed= $_POST;

    foreach ($speed as $value){
        $towrite=$value;
    }
    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    

    fwrite($myfile, " ".$towrite." ");
    fclose($myfile);
?>