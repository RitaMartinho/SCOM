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
      $file = fopen("lostconnection.txt", "r");
      $lines = array();
      $firstelement =array();
      $hourminutearray= array();
      $hour = array();
      $hitsbyhour = array();
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
            //alert("I am here");
            if(rawFile.readyState === 4)
            {
                if(rawFile.status === 200 || rawFile.status == 0)
                {
                    allText = rawFile.responseText;
                }
            }
        }
        rawFile.send(null);    
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
              data: [allText[0], //we have to go 2 by 2 because of the \n char
                    allText[2],
                    allText[4],
                    allText[6],
                    allText[8],
                    allText[10],
                    allText[12],
                    allText[14],
                    allText[16],
                    allText[18],
                    allText[20],
                    allText[22],
                    allText[24],
                    allText[26],
                    allText[28],
                    allText[30],
                    allText[32],
                    allText[34],
                    allText[36],
                    allText[38],
                    allText[40],
                    allText[42],
                    allText[44],
                    allText[46]
              ],//backgroundColor:'green',
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
              text:'Number of lost connections per hour',
              fontSize:25
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
                top:0
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