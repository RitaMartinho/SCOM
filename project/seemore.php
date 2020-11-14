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
      $file = fopen("lostconnection.txt", "r");
      $lines = array();
      $firstelement =array();
      $hourminutearray= array();
      $hour = array();
      $hitsbyhour=array_fill(0,24, '0');
      while(! feof($file))
      {
        $line= fgets($file). "<br />";
        array_push($lines, $line);
      }

      foreach($lines as $hourminute){

        $firstelement=explode(" ", $hourminute);
        array_push($hourminutearray, $firstelement[1]);
      }

      foreach($hourminutearray as $hours){
        $firstelementaux=explode(":", $hours);
        array_push($hour, $firstelementaux[0]);
      }

      for($i=0; $i<=23; $i++){

        foreach($hour as $entry){
          if (intval($entry)== $i){
            $hitsbyhour[$i]+=1;
          }
        }
      }
      $myfile = fopen('txtfiles_todisplay/hitsbyhour_.txt', 'w+') or die("Unable to open file!");
      
      foreach($hitsbyhour as $item){
        fwrite($myfile, $item."\n");
      }
      fclose($file);
    ?>
    
    <!---<iframe id='iframe' src = 'hitsbyhour.txt' onload='readfile()'style="width:0;height:0;border:0; border:none;"> </iframe>-->
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file 
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/hitsbyhour_.txt", false); // using synchronous call
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
        // Global Options
        Chart.defaults.global.defaultFontFamily = 'Lato';
        Chart.defaults.global.defaultFontSize = 18;
        Chart.defaults.global.defaultFontColor = '#777';

        var hours =['00h', '01h', '02h','03h','04h','05h', '06h','07h','08h','09h','10h','11h','12h','13h','14h','15h','16h','17h','18h','19h','20h','21h','22h','23h'];

        let massPopChart = new Chart(myChart, {
          type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data:{
            labels: hours,
            datasets:[{
                label:'nº',
              data:[res[0],
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
              backgroundColor:'lightblue',
              borderWidth:1,
              borderColor:'#777',
              hoverBorderWidth:3,
              hoverBorderColor:'#000'
            }]
          },
          options:{
            title:{
              display:true,
              text:'FEUP Eduroam - Number of lost connections per hour',
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

    <div class="buttoncontainer">
      <button onclick="window.location.href='seemore1.php'">Next</button>
    </div>

</body>
</html>