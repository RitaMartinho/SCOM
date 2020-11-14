<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
  <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
 </head>
 <body>

    <div class="container">
        <h1>Thank you! </h1>
        <h5>(Please wait until you accept location permissions)</h5>
    </div>
    
    
    <?php
        if("" == trim($_POST['user_experience'])){
           die("You didn't fulfill the form. Please go back.");
        }      
    
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    /*-------------*/

    
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    function getBrowser() {

        global $user_agent;
    
        $browser        = "Unknown Browser";
    
        $browser_array = array(
                                '/msie/i'      => 'Internet Explorer',
                                '/firefox/i'   => 'Firefox',
                                '/safari/i'    => 'Safari',
                                '/chrome/i'    => 'Chrome',
                                '/edge/i'      => 'Edge',
                                '/opera/i'     => 'Opera',
                                '/mobile/i'    => 'Mobile'
                         );
    
        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;
    
        return $browser;
    }

   

    $date=date("d-m-Y")." ";
    $hour=date("H:i")." ";
    $userlevel=$_POST["user_experience"]." ";
    $towrite = $date.$hour.$userlevel.$ip." ".getBrowser();

    $myfile = fopen("userexperience.txt", "a")or die("Unable to open file!");
    fwrite($myfile, "\n".$towrite);
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
        $.post('store_loc.php',{'lat':pos.coords.latitude,'lng':pos.coords.longitude},function(res){
            console.log(res);
        });
        }

    </script>
    <script type="text/javascript"> 
            var userImageLink = "https://effigis.com/wp-content/uploads/2015/02/DigitalGlobe_WorldView2_50cm_8bit_Pansharpened_RGB_DRA_Rome_Italy_2009DEC10_8bits_sub_r_1.jpg";
            var time_start, end_time; 
            
            // The size in bytes 
            var downloadSize = 17878139; 
            var downloadImgSrc = new Image(); 
  
            downloadImgSrc.onload = function () { 
                end_time = new Date().getTime(); 
                displaySpeed(); 
            }; 

            time_start = new Date().getTime(); 
            downloadImgSrc.src = userImageLink; 
  
            function displaySpeed() { 
                var timeDuration = (end_time - time_start) / 1000; 
                var loadedBits = downloadSize * 8; 
                var netspeed = {};                
                /* Converts a number into string 
                   using toFixed(2) rounding to 2 */
                var bps = (loadedBits / timeDuration).toFixed(2); 
                var speedInKbps = (bps / 1024).toFixed(2); 
                var speedInMbps = (speedInKbps / 1024).toFixed(2); 
                /*alert("Your internet connection speed is: \n" 
                      + bps + " bps\n" + speedInKbps  
                      + " kbps\n" + speedInMbps + " Mbps\n"); */

                netspeed.name=speedInMbps;

                $.ajax({
                    url:"store_network_speed.php",
                    type:'POST',
                    data: netspeed,
                    success: function(res){
                        console.log(res);
                    }
                })
            } 
            
        </script>

       
    </body>
</html>