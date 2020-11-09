<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
 </head>
 <body>

    <h1>Thank you!</h1>

    <script type="text/javascript"> 
            var userImageLink = "50mb.jpg";
            var time_start, end_time; 
            
            // The size in bytes 
            var downloadSize = 41026764; 
            var downloadImgSrc = new Image(); 
  
            downloadImgSrc.onload = function () { 
                end_time = new Date().getTime(); 
                displaySpeed(); 
            }; 
            time_start = new Date().getTime(); 
            downloadImgSrc.src = userImageLink; 
  
            function displaySpeed() { 
                var timeDuration = (end_time - time_start) / 1000 +0.001; 
                var loadedBits = downloadSize * 8; 
                
                /* Converts a number into string 
                   using toFixed(2) rounding to 2 */
                var bps = (loadedBits / timeDuration).toFixed(2); 
                var speedInKbps = (bps / 1024).toFixed(2); 
                var speedInMbps = (speedInKbps / 1024).toFixed(2); 
                alert("Your internet connection speed is: \n" 
                      + bps + " bps\n" + speedInKbps  
                      + " kbps\n" + speedInMbps + " Mbps\n"); 
            } 
        </script> 
    <?php
        if("" == trim($_POST['user_experience'])){
           die("You didn't fulfill the form. Please go back.");
        }      
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        echo "i'm here\n";
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        echo "i'm here1\n";
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        echo "i'm here2\n";
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    echo "Today is: " . date("d-m-Y") . "<br>";
    echo "The time is: " . date("H:i"). "<br>";
    echo "User experience:".$_POST["user_experience"];

    $date=date("d-m-Y")." ";
    $hour=date("H:i")." ";
    $userlevel=$_POST["user_experience"]." ";

    $towrite = $date.$hour.$userlevel.$ip;

    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    fwrite($myfile, "\n".$towrite);
    fclose($myfile);

    ?>
 </body>
</html>