<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
  <script src="boomerang.js" type="text/javascript"></script>
  <script src="plugins/bw.js" type="text/javascript"></script>
  <script type="text/javascript">
	BOOMR.init({
			user_ip: '10.0.0.1',
			beacon_url: "store_network_speed.php",
			BW: {
				// base_url: '../../images/',
				base_url: 'https://goncaloxavier.pt/SCOM/Project/images/',
				block_beacon: true,
				cookie: 'BW-COOKIE',
				cookie_exp: 5
			},
			RT: {
				cookie: 'HOWTO-RT'
			}
		});</script>

  <!-- <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script> -->
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
       
    </body>
</html>