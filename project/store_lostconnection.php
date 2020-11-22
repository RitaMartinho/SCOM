<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
  <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
              crossorigin="anonymous">
 </script>
 </head>
 <body>
     
    <div class="container">
        <h1>Thank you! </h1>
        <h5>(Please wait until you accept location permissions)</h5>
    </div>
    
    
    <?php if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $date=date("d-m-Y")." ";
    $hour=date("H:i")." ";

    $towrite = $date.$hour.$ip;

    $myfile = fopen("lostconnection.txt", "a")or die("Unable to open file!");

    if (flock($myfile, LOCK_EX)) {
        fwrite($myfile, "\n".$towrite);
        flock($myfile, LOCK_UN);
    }
    fclose($myfile);

    ?>

    <script>

        window.onload=function(){
        if(navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(showPosition);
        }
        else
        {
        alert("Geolocation is not supported by this browser.");
        }
        }
        function showPosition(pos){
        $.post('store_loc_lost.php',{'lat':pos.coords.latitude,'lng':pos.coords.longitude},function(res){
            console.log(res);
        });
        }

    </script>
 </body>
</html>