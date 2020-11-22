<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="seemore.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
    <title>See More</title>
</head>
<body>
    <?php
      //RETRIEVE NUMBER OF LOST CONNECTIONS PER HOUR
      $file = fopen("userexperience.txt", "r");
      $lines = array();
      $firstelement =array();
      $netspeed= array();
      $net_hour=array();

      $hitsbyloc=array_fill(0,13, '0');
      $mediumbyloc=array_fill(0,13,'0');
      $maxbyhloc=array_fill(0,13,'0');
      $minbyloc=array_fill(0,13,'10000000000');

      while(! feof($file))
      {
        $line= fgets($file);
        array_push($lines, $line);
      }

      foreach($lines as $hourminute){

        $firstelement=explode(" ", $hourminute);
        array_push($net_hour, array("loc"=>$firstelement[5],"netspeed"=>$firstelement[11]));
      }

      for($i=0; $i<=12; $i++){

        foreach($net_hour as $entry){
            if (intval($entry['loc'])== $i){

                $hitsbyloc[$i]+=1;
            }
        }
      }

      for($i=0; $i<=12; $i++){

        foreach($net_hour as $entry){
            if (intval($entry['loc'])== $i){

                if(intval($maxbyloc[$i]) < intval($entry['netspeed'])){
                    $maxbyloc[$i]=(float)$entry['netspeed'];
                }
                if(intval($minbyloc[$i]) >= intval($entry['netspeed'])){
                    $minbyloc[$i]=(float)$entry['netspeed']/1;
                }

                $mediumbyloc[$i]+=$entry['netspeed'];
            }
        }

        if($minbyloc[$i]=='10000000000'){ //this is a fucking ugly solution 
            $minbyloc[$i]='0';
        }

        if($hitsbyloc[$i]=='0'){
            $mediumbyloc[$i]='0';
        }
        else{
            $mediumbyloc[$i]=$mediumbyloc[$i]/$hitsbyloc[$i];
        }

      }
      $myfile = fopen('txtfiles_todisplay/mediumlatency_by_loc.txt', 'w+') or die("Unable to open file!");
      foreach($mediumbyloc as $item){
        fwrite($myfile, $item."\n");
      }

      $myfile1 = fopen('txtfiles_todisplay/maxlatency_by_loc.txt', 'w+') or die("Unable to open file!");
      foreach($maxbyloc as $item1){
        fwrite($myfile1,$item1."\n");
      }

      $myfile2 = fopen('txtfiles_todisplay/minlatency_by_loc.txt', 'w+') or die("Unable to open file!");
      foreach($minbyloc as $item2){
        fwrite($myfile2, $item2."\n");
      }
  
      fclose($file);
      fclose($file1);
      fclose($file2);


    ?>
    
    <!---<iframe id='iframe' src = 'hitsbyhour.txt' onload='readfile()'style="width:0;height:0;border:0; border:none;"> </iframe>-->
    <div class="container">
        <canvas id="myChart"></canvas>
        <div class="buttoncontainer">
          <button onclick="window.location.href='seemore10.php'">Previous</button>
          <button onclick="window.location.href='seemore.php'" id= "button">Next</button>
        </div>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file - MEDIUM
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/mediumlatency_by_loc.txt", false); // using synchronous call
        var allText;
        //alert("Starting to read text");
        rawFile.onreadystatechange = function ()
        {   
            if(rawFile.readyState === 4)
            {
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    allText = rawFile.responseText;
                }
            }
        }
        rawFile.send(null);  
        var res = allText.split("\n");

        
        //read from file - MAX
        var rawFile1 = new XMLHttpRequest();
        rawFile1.open("GET", "txtfiles_todisplay/maxlatency_by_loc.txt", false); // using synchronous call
        var allText1;
        //alert("Starting to read text");
        rawFile1.onreadystatechange = function ()
        {   
            if(rawFile1.readyState === 4)
            {
                if(rawFile1.status === 200 || rawFile1.status == 0)
                {
                    allText1 = rawFile1.responseText;
                }
            }
        }
        rawFile1.send(null);  

        var res1 = allText1.split("\n");
 

        //read from file - MIN
        var rawFile2 = new XMLHttpRequest();
        rawFile2.open("GET", "txtfiles_todisplay/minlatency_by_loc.txt", false); // using synchronous call
        var allText2;
        //alert("Starting to read text");
        rawFile2.onreadystatechange = function ()
        {   
            if(rawFile2.readyState === 4)
            {
                if(rawFile2.status === 200 || rawFile2.status == 0)
                {
                    allText2 = rawFile2.responseText;
                }
            }
        }
        rawFile2.send(null);  

        var res2 = allText2.split("\n");

        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 17;
        Chart.defaults.global.defaultFontColor = '#777';

        var locs =['Unknown', 'Civil Norte', 'Eletro Norte','Mecanica Norte','Mecanica Sul','Biblioteca', 'Eletro/Info','CICA','Civil','Quimica/Metal','Bar de Minas','Direção','B'];
        let massPopChart = new Chart(myChart, {
          type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data:{
            labels: locs,
            datasets:[
            {
                label:'medium',
                data: [res[0],
                    res[1],
                    res[2],
                    res[3],
                    res[4],
                    res[5],
                    res[6],
                    res[7],
                    res[8],
                    res[9],
                    res[10],
                    res[11],
                    res[12]
              ],
              backgroundColor:'rgba(34, 169, 165, 0.1)',
              borderWidth:1,
              borderColor:'#777',
              hoverBorderWidth:3,
              hoverBorderColor:'#000'
            },
            {
                label:'max',
                data: [res1[0],
                    res1[1],
                    res1[2],
                    res1[3],
                    res1[4],
                    res1[5],
                    res1[6],
                    res1[7],
                    res1[8],
                    res1[9],
                    res1[10],
                    res1[11],
                    res1[12]
  
              ],//backgroundColor:'green',
              backgroundColor:'rgba(0, 0, 0, 0)',
              borderWidth:2,
              borderColor:'#FFBF00',
              hoverBorderWidth:3,
              hoverBorderColor:'#000',
              type:'line'

            },
            {
                label:'min',
                data: [res2[0],
                    res2[1],
                    res2[2],
                    res2[3],
                    res2[4],
                    res2[5],
                    res2[6],
                    res2[7],
                    res2[8],
                    res2[9],
                    res2[10],
                    res2[11],
                    res2[12]

              ],//backgroundColor:'green',
              backgroundColor:'rgba(155, 0, 0, 0)',
              borderWidth:2,
              borderColor:'#E83F6F',
              hoverBorderWidth:3,
              hoverBorderColor:'#000',
              type:'line'

            }
            ]
          },
          options:{
            title:{
              display:true,
              text:'FEUP Eduroam - Latency (in ms) per location',
              fontSize:30
            },
            legend:{
              display:true,
              position:'right',
              labels:{
                fontColor:'#000'
              }
            },
            layout:{
              padding:{
                left:50,
                right:0,
                bottom:0,
                top:50
              }
            },
            tooltips:{
              enabled:true
            },
            ticks: {
                autoSkip: false
            }
          }
        });
    </script>
</body>
</html>