<?php
    $measurements = array();
    $measurements= $_GET;

    foreach ($measurements as $value){
        $towrite=$value;
    }
    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    

    fwrite($myfile, " ".$towrite." ");
    fclose($myfile);
?>