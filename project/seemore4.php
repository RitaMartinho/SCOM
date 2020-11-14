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
      $local= array();
      $hitsbylocal=array_fill(0,12, '0');
      while(! feof($file))
      {
        $line= fgets($file). "<br />";
        array_push($lines, $line);
      }

      foreach($lines as $line){

        $firstelement=explode(" ", $line);
        array_push($local, $firstelement[3]);
      }

      for($i=0; $i<=12; $i++){

        foreach($local as $entry){
          if (intval($entry)== $i){
            $hitsbylocal[$i]+=1;
          }
        }
      }
      $myfile = fopen('txtfiles_todisplay/hitsbylocal.txt', 'w+') or die("Unable to open file!");
      
      foreach($hitsbylocal as $item){
        fwrite($myfile, $item."\n");
      }
      fclose($file);
    ?>
    
    <!---<iframe id='iframe' src = 'hitsbyhour.txt' onload='readfile()'style="width:0;height:0;border:0; border:none;"> </iframe>-->
    <div class="container">
        <canvas id="myChart"></canvas>
        <div class="buttoncontainer">
          <button onclick="window.location.href='seemore.php'">Previous</button>
          <button onclick="window.location.href='seemore1.php'" id= "button">Next</button>
        </div>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file 
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/hitsbylocal.txt", false); // using synchronous call
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

        var hours =['Unknown', 'Civil Norte', 'Eletro Norte','Mecanica Norte','Mecanica Sul','Biblioteca', 'Eletro/Info','CICA','Civil','Quimica/Metal','Bar de Minas','Direção','B'];

        let massPopChart = new Chart(myChart, {
          type:'pie', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
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
              ],
              backgroundColor:[
                'rgb(180,196,104, 0.8)',
                'rgb(237,85,85, 0.8)',
                'rgb(184,167,234, 0.8)',
                'rgb(0,174,219, 0.8)',
                'rgb(255,0,169, 0.8)',
                'rgb(251,159,159, 0.8)',
                'rgb(255,0,101, 0.8)',
                'rgb(212,255,234, 0.8)',
                'rgb(254,255,163, 0.8)',
                'rgb(142,193,39, 0.8)',
                'rgb(236,185,57, 0.8)',
                'rgb(131,3,3, 0.8)',
                'rgb(46,64,69, 0.8)',
              ],
              borderWidth:1,
              borderColor:'#777',
              hoverBorderWidth:3,
              hoverBorderColor:'#000'
            }]
          },
          options:{
            title:{
              display:true,
              text:'FEUP Eduroam - Number of lost connections per location',
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