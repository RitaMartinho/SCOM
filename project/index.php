<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
    <title>Evaluate Eduroam</title>
    <link href="index.css" rel="stylesheet">
 </head>
 <body>
    <img src="feup.png" alt="feup logo" width="250" height="100"> 
    <h1>Evaluating FEUP's Eduroam</h1>

    <div id="warning">
        <h4 class="warn">This website measures your current network speed and also retrieves your current local IP</h4>
    </div>

    <img class= "ex" src="exclamacao.png" alt="feup logo" width="45" height="45"> 

    <div class="container">
        <form action="store_experience.php" method="POST" id="form1">
            <p>How would you evaluate your current experience (1 being horrible and 5 incredible) ?</p>
            <input type="radio" id="input1" name="user_experience" value=1>
            <label for="user_experience1">1</label><br>
            <input type="radio" id="input2" name="user_experience" value=2>
            <label for="user_experience2">2</label><br>
            <input type="radio" id="input3" name="user_experience" value=3>
            <label for="user_experience3">3</label><br>
            <input type="radio" id="input4" name="user_experience" value=4>
            <label for="user_experience4">4</label><br>
            <input type="radio" id="input5" name="user_experience" value=5>
            <label for="user_experience5">5</label><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="container">
        <form action="store_lostconnection.php" method="POST" id = "form2">
            <p>Did you lost connection in the previous 30min?</p>
            <input type="submit" value="Report Lost">
        </form>
    </div>   

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
                var timeDuration = (end_time - time_start) / 10; 
                var loadedBits = downloadSize * 8; 
                var netspeed = {};                
                /* Converts a number into string 
                   using toFixed(2) rounding to 2 */
                var bps = (loadedBits / timeDuration).toFixed(2); 
                var speedInKbps = (bps / 1024).toFixed(2); 
                var speedInMbps = (speedInKbps / 1024).toFixed(2); 
                alert("Your internet connection speed is: \n" 
                      + bps + " bps\n" + speedInKbps  
                      + " kbps\n" + speedInMbps + " Mbps\n"); 

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