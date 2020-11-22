<?php


    //$bw= $_GET["bw"];

    #foreach ($measurements as $value){
    #    $towrite=$value;
    #}
    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    
    $bw=intval($_GET['bw'])/1024;
    $bw_confidence= intval($_GET['bw_err'])/intval($_GET['bw'])*100;

    $lat=intval($_GET['lat']);
    $lat_err=intval($_GET['lat_err']);

    $tdone=intval($_GET['t_done']);

    if (flock($myfile, LOCK_EX)) {

        fwrite($myfile, " ".$bw." ".$bw_confidence." ".$tdone." ".$lat." ".$lat_err);
        flock($myfile, LOCK_UN);
    }
    fclose($myfile);
?>