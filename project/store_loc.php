<?php

   $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");

   
    
    $lat=floatval($_POST["lat"]);
    $long=floatval($_POST["lng"]);
    $long=abs($long);

    $loc=0;

    //TEM DE SE USAR IF E NÃO ELSEIF QUE ELE ÀS VEZES ENTRA NO IF MAIS EXTERIOR

    //CIVIL NORTE
    if($lat < 41.179227 and $lat < 41.179165 and $lat > 41.178664 and $lat > 41.178603)
    {   
        if($long < 8.596069 and $long > 8.595395 and $long < 8.596130 and $long > 8.595467 ){
            print_r("civil norte\n");
            $loc=1;
        }
    }

    //ELETROTECNICA NORTE
    if($lat < 41.178892 and $lat < 41.178876 and $lat > 41.178583 and $lat >41.178553 ){

        if($long < 8.595421 and $long > 8.595000 and $long < 8.595469 and $long > 8.595034){
            print_r("eletrotecnica norte\n");
            $loc=2;
        }
    }

    //MECANICA NORTE
    if($lat < 41.179070 and $lat < 41.179050 and $lat > 41.178529 and $lat > 41.178501 ){

        if($long < 8.594777 and $long > 8.594332 and $long < 8.594826 and $long > 8.594394){
            print_r("mecanica norte\n");
            $loc=3;
        }
    }

    //MECANICA SUL
    if($lat < 41.178424 and $lat < 41.178418 and $lat > 41.177915 and $lat > 41.177913 ){

        if($long < 8.594634 and $long > 8.594395 and $long < 8.594695 and $long > 8.594448){
            print_r("mecanica sul\n");
            $loc=4;
        }
    }

    //BIBLIOTECA
    if($lat < 41.177628 and $lat < 41.177541 and $lat > 41.177388 and $lat > 41.177285 ){

        if($long < 8.594794 and $long > 8.594418 and $long < 8.594922 and $long > 8.594563){
            print_r("biblioteca\n");
            $loc=5;
        }
    }

    //ELETROTECNICA/INFO
    if($lat < 41.178485 and $lat < 41.178446 and $lat > 41.177994 and $lat > 41.177958 ){

        if($long < 8.595568 and $long > 8.594836 and $long < 8.595614 and $long > 8.594876){
            print_r("eletro/info\n");
            $loc=6;
        }
    }

    //CICA
    if($lat < 41.177958 and $lat < 41.177950 and $lat > 41.177696 and $lat > 41.177678 ){

        if($long < 8.595128 and $long > 8.594833 and $long < 8.595168 and $long > 8.594884){
            print_r("cica\n");
            $loc=7;
        }
    }

    //CIVIL
    if($lat < 41.178526 and $lat < 41.178492 and $lat > 41.178072 and $lat > 41.178032 ){

        if($long < 8.596239 and $long > 8.595633 and $long < 8.596298 and $long > 8.595660){
            print_r("civil\n");
            $loc=8;
        }
    }

    //QUÍMICA/METAL
    if($lat < 41.178581 and $lat < 41.178541 and $lat > 41.178083 and $lat > 41.178031 ){

        if($long < 8.597119 and $long > 8.596341 and $long < 8.597172 and $long > 8.596405){
            print_r("quimica/metal\n");
            $loc=9;
        }
    }

    //BAR DE MINAS
    if($lat < 41.178623 and $lat < 41.178593 and $lat > 41.178448 and $lat > 41.178424 ){

        if($long < 8.597738 and $long > 8.597183 and $long < 8.597744 and $long > 8.597208){
            print_r("bar de minas\n");
            $loc=10;
        }
    }

    //DIREÇÃO
    if($lat < 41.178420 and $lat < 41.178396 and $lat > 41.177893 and $lat > 41.177790 ){

        if($long < 8.598029 and $long > 8.597404 and $long < 8.598067 and $long > 8.597496){
            print_r("Direção/adminstração\n");
            $loc=11;
        }
    }

    //B(1)
    if($lat < 41.177968 and $lat < 41.177760 and $lat > 41.177637 and $lat > 41.177377 ){

        if($long < 8.597347 and $long > 8.595848 and $long < 8.597463 and $long > 8.595940){
            print_r("B\n");
            $loc=12;
        }
    }

    //QUEIJOS == B
    if($lat < 41.177908 and $lat < 41.177862 and $lat > 41.177715 and $lat > 41.177610 ){

        if($long < 8.595849 and $long > 8.595361 and $long < 8.595879 and $long > 8.595466){
            print_r("B\n");
            $loc=12;
        }
    }

    //B(2)
    if($lat < 41.177642 and $lat < 41.177490 and $lat > 41.177329 and $lat > 41.177161 ){

        if($long < 8.595611 and $long > 8.595009 and $long < 8.595769  and $long > 8.595167){
            print_r("B\n");
            $loc=12;
        }
    }


   
    $local= $_POST["lat"]." ".$_POST["lng"];

    fwrite($myfile, $loc." ".$local);
    fclose($myfile);
?>