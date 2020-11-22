<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
  <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
              <script src="boomerang.js" type="text/javascript"></script>
    <script src="plugins/bw.js" type="text/javascript"></script>
    <script src="plugins/rt.js" type="text/javascript"></script>

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
		});
        BOOMR.subscribe('before_beacon', function(o) {
            var html = "";
            if(o.t_done) { html += "This page took " + o.t_done + "ms to load<br>"; }
            if(o.bw) { html += "Your bandwidth to this server is " + parseInt(o.bw/1024) + "kbps (&#x00b1;" + parseInt(o.bw_err*100/o.bw) + "%)<br>"; }
            if(o.lat) { html += "Your latency to this server is " + parseInt(o.lat) + "&#x00b1;" + o.lat_err + "ms<br>"; }
            
            document.getElementById('results').innerHTML = html;
        });

    </script>
 </head>
 
 <body>

    <div class="container">
        <h1>Thank you! </h1>
        <h4>(Please WAIT until you accept location permissions and you see here some info about network status)</h4>
        <p id="results"></p>
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
        $.post('store_loc.php',{'lat':pos.coords.latitude,'lng':pos.coords.longitude},function(res){
            console.log(res);
        });
        }

    </script>
       
    </body>
</html>