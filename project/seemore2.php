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
      $net_exp=array();

      $hitsbyexp=array_fill(0,5,'0');
      $mediumspeedbyexp=array_fill(0,5,'0');
     

      while(! feof($file))
      {
        $line= fgets($file);
        array_push($lines, $line);
      }

      foreach($lines as $hourminute){

        $firstelement=explode(" ", $hourminute);
        array_push($net_exp, array("experience"=>$firstelement[2],"netspeed"=>$firstelement[4]));
      }

      for($i=0; $i<=4; $i++){

        foreach($net_exp as $entry){
            if (intval($entry['experience'])== $i){

                $hitsbyexp[$i]+=1;
            }
        }
      }

      for($i=0; $i<=4; $i++){

        foreach($net_exp as $entry){
            if (intval($entry['experience'])== $i){

                $mediumspeedbyexp[$i]+=$entry['netspeed'];
            }
        }
        if($hitsbyexp[$i]=='0'){
            $mediumspeedbyexp[$i]='0';
        }
       
        $mediumspeedbyexp[$i]=$mediumspeedbyexp[$i]/$hitsbyexp[$i];  
      }

      $myfile = fopen('txtfiles_todisplay/mediumspeed_by_exp.txt', 'w+') or die("Unable to open file!");
      foreach($mediumspeedbyexp as $item){
        fwrite($myfile, $item."\n");
      }
  
      fclose($file);
      fclose($file1);
      fclose($file2);


    ?>
    
    <div class="container">
        <canvas id="myChart"></canvas>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file - MEDIUM
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/mediumspeed_by_exp.txt", false); // using synchronous call
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

        var experience =['User Experience - 0', 'User Experience - 1', 'User Experience - 2','User Experience - 3','User Experience - 4'];
        let massPopChart = new Chart(myChart, {
          type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data:{
            labels: experience,
            datasets:[
            {
                label:'Network speed - medium',
                data: [res[0],
                    res[1],
                    res[2],
                    res[3],
                    res[4]  
              ],
              backgroundColor:'rgba(255, 0, 0, 0.5)',
              borderWidth:2,
              borderColor:'#8b0000',
              hoverBorderWidth:3,
              hoverBorderColor:'#000'
            } 
            ]
          },
          options:{
            title:{
              display:true,
              text:'FEUP Eduroam - Network Speed (in Mbps) vs User Experience',
              fontSize:30
            },
            legend:{
              display:true,
              position:'right',
              labels:{
                fontColor:'#000',
                fontSize:20
              }
            },
            layout:{
              padding:{
                left:60,
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