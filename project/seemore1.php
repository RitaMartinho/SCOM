<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
      $hourminutearray= array();
      $netspeed= array();
      $net_hour=array();

      $hitsbyhour=array_fill(0,24, '0');
      $mediumbyhour=array_fill(0,24,'0');
      $maxbyhour=array_fill(0,24,'0');
      $minbyhour=array_fill(0,24,'10000000000');

      while(! feof($file))
      {
        $line= fgets($file);
        array_push($lines, $line);
      }

      foreach($lines as $hourminute){

        $firstelement=explode(" ", $hourminute);
        $hour_without_minute= explode(":", $firstelement[1]);
        array_push($net_hour, array("hour"=>$hour_without_minute[0],"netspeed"=>$firstelement[4]));
      }

      for($i=0; $i<=23; $i++){

        foreach($net_hour as $entry){
            if (intval($entry['hour'])== $i){

                $hitsbyhour[$i]+=1;
            }
        }
      }

      for($i=0; $i<=23; $i++){

        foreach($net_hour as $entry){
            if (intval($entry['hour'])== $i){

                if(intval($maxbyhour[$i]) < intval($entry['netspeed'])){
                    $maxbyhour[$i]=(float)$entry['netspeed'];
                }
                if(intval($minbyhour[$i]) >= intval($entry['netspeed'])){
                    $minbyhour[$i]=(float)$entry['netspeed']/1;
                }

                $mediumbyhour[$i]+=$entry['netspeed'];
            }
        }

        if($minbyhour[$i]=='10000000000'){ //this is a fucking ugly solution 
            $minbyhour[$i]='0';
        }

        if($hitsbyhour[$i]=='0'){
            $mediumbyhour[$i]='0';
        }
        else{
            $mediumbyhour[$i]=$mediumbyhour[$i]/$hitsbyhour[$i];
        }

      }

      $myfile = fopen('txtfiles_todisplay/mediumspeed_by_hour.txt', 'w+') or die("Unable to open file!");
      foreach($mediumbyhour as $item){
        fwrite($myfile, $item."\n");
      }

      $myfile1 = fopen('txtfiles_todisplay/maxspeed_by_hour.txt', 'w+') or die("Unable to open file!");
      foreach($maxbyhour as $item1){
        fwrite($myfile1,$item1."\n");
      }

      $myfile2 = fopen('txtfiles_todisplay/minspeed_by_hour.txt', 'w+') or die("Unable to open file!");
      foreach($minbyhour as $item2){
        fwrite($myfile2, $item2."\n");
      }
  
      fclose($file);
      fclose($file1);
      fclose($file2);


    ?>
    
    <!---<iframe id='iframe' src = 'hitsbyhour.txt' onload='readfile()'style="width:0;height:0;border:0; border:none;"> </iframe>-->
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file - MEDIUM
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/mediumspeed_by_hour.txt", false); // using synchronous call
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
        rawFile1.open("GET", "txtfiles_todisplay/maxspeed_by_hour.txt", false); // using synchronous call
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
        rawFile2.open("GET", "txtfiles_todisplay/minspeed_by_hour.txt", false); // using synchronous call
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
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';

        var hours =['00h', '01h', '02h','03h','04h','05h', '06h','07h','08h','09h','10h','11h','12h','13h','14h','15h','16h','17h','18h','19h','20h','21h','22h','23h'];
        let massPopChart = new Chart(myChart, {
          type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data:{
            labels: hours,
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
                    res[12],
                    res[13],
                    res[14],
                    res[15],
                    res[16],
                    res[17],
                    res[18],
                    res[19],
                    res[20],
                    res[21],
                    res[22],
                    res[23]
              ],
              backgroundColor:'rgba(0, 255, 0, 0.1)',
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
                    res1[12],
                    res1[13],
                    res1[14],
                    res1[15],
                    res1[16],
                    res1[17],
                    res1[18],
                    res1[19],
                    res1[20],
                    res1[21],
                    res1[22],
                    res1[23]
              ],//backgroundColor:'green',
              backgroundColor:'rgba(0, 0, 0, 0)',
              borderWidth:2,
              borderColor:'#87CEEB',
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
                    res2[12],
                    res2[13],
                    res2[14],
                    res2[15],
                    res2[16],
                    res2[17],
                    res2[18],
                    res2[19],
                    res2[20],
                    res2[21],
                    res2[22],
                    res2[23]
              ],//backgroundColor:'green',
              backgroundColor:'rgba(155, 0, 0, 0)',
              borderWidth:2,
              borderColor:'#4B0082',
              hoverBorderWidth:3,
              hoverBorderColor:'#000',
              type:'line'

            }
            ]
          },
          options:{
            title:{
              display:true,
              text:'FEUP Eduroam - Network Speed (in Mpbs) per hour',
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
            }
          }
        });
    </script>
</body>
</html>