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

      $file = fopen("userexperience.txt", "r");
      $lines = array();
      $element =array();
      $browser_speed=array();
      $browser_index_speed=array();
      $mediumbybrowser=array_fill(0,8,'0');
      $hitsbybrowser=array_fill(0,8,'0');
     

      while(! feof($file))
      {
        $line= fgets($file);
        array_push($lines, $line);
      }

      foreach($lines as $line){

        $element=explode(" ", $line);
        array_push($browser_speed, array("browser"=>$element[4],"netspeed"=>$element[8]));

      }

     
      foreach($browser_speed as $entry){

        if(strcmp($entry['browser'],"Firefox")==0){

          array_push($browser_index_speed, array("browser"=>'0',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Chrome")==0){

          array_push($browser_index_speed, array("browser"=>'1',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Internet Explorer")==0){

          array_push($browser_index_speed, array("browser"=>'2',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Safari")==0){

          array_push($browser_index_speed, array("browser"=>'3',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Edge")==0){

          array_push($browser_index_speed, array("browser"=>'4',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Opera")==0){

          array_push($browser_index_speed, array("browser"=>'5',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Mobile")==0){

          array_push($browser_index_speed, array("browser"=>'6',"netspeed"=>$entry['netspeed']));

        }
        if(strcmp($entry['browser'],"Unknown Browser")==0){

          array_push($browser_index_speed, array("browser"=>'7',"netspeed"=>$entry['netspeed']));

        }

      }


      for($i=0; $i<=7; $i++){

        foreach($browser_index_speed as $entry){
            if (intval($entry['browser'])== $i){

              $hitsbybrowser[$i]+=1;
            }
        }
      }
      

      for($i=0; $i<=7; $i++){

        foreach($browser_index_speed as $entry){
            if (intval($entry['browser'])== $i){

                $mediumbybrowser[$i]+=(float)$entry['netspeed'];

            }
        }

        if($hitsbybrowser[$i]=='0'){
          $mediumbybrowser[$i]='0';
        }
        else{
          $mediumbybrowser[$i]=$mediumbybrowser[$i]/$hitsbybrowser[$i];
        }
      }
      
      //var_dump($hitsbybrowser);
      //var_dump($mediumbybrowser);

      $myfile = fopen('txtfiles_todisplay/browser.txt', 'w+') or die("Unable to open file!");
      foreach($mediumbybrowser as $item){
         fwrite($myfile, $item."\n");
      }
  
      fclose($file);
      fclose($myfile);

    ?>
    
    <div class="container">
        <canvas id="myChart"></canvas>
        <div class="buttoncontainer">
          <button onclick="window.location.href='seemore2.php'">Previous</button>
          <button onclick="window.location.href='seemore6.php'" id= "button">Next</button>
        </div>
    </div>
    
    <script type="text/javascript"> //lost connections

        let myChart = document.getElementById('myChart').getContext('2d');

        //read from file - MEDIUM
        var rawFile = new XMLHttpRequest();
        rawFile.open("GET", "txtfiles_todisplay/browser.txt", false); // using synchronous call
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
        Chart.defaults.global.defaultFontSize = 14;
        Chart.defaults.global.defaultFontColor = '#777';

        var browser =['Firefox', 'Chrome', 'Internet Explorer', 'Safari','Edge', 'Opera', 'Mobile', 'Unknown'];
        let massPopChart = new Chart(myChart, {
          type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
          data:{
            labels: browser,
            datasets:[
            {
                label:'Network speed - medium',
                data: [res[0],
                    res[1],
                    res[2],
                    res[3],
                    res[4],
                    res[5],
                    res[6],
                    res[7]  
              ],
              backgroundColor:'rgba(94,33,41, 0.5)',
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
              text:'FEUP Eduroam - Network Speed (in Kbps) vs Used Browser',
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