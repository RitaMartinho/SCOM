<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluate Eduroam</title>
    <link href="index.css" rel="stylesheet">
    <script
			  src="https://code.jquery.com/jquery-3.5.1.js"
			  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
			  crossorigin="anonymous"></script>
 </head>
 <body>

    <div class="containertotal">
        <img src="feup.png" alt="feup logo" width="250" height="100"> 
        <h1>Evaluating FEUP's Eduroam</h1>

       
        <div class="container">
            <form action="store_experience.php" method="POST" id="form1">
                <p>How would you evaluate your current experience (0 being horrible and 4 incredible) ?</p>
                <input type="radio" id="input1" name="user_experience" value=0>
                <label for="input1">0</label><br>
                <input type="radio" id="input2" name="user_experience" value=1>
                <label for="input2">1</label><br>
                <input type="radio" id="input3" name="user_experience" value=2>
                <label for="input3">2</label><br>
                <input type="radio" id="input4" name="user_experience" value=3>
                <label for="input4">3</label><br>
                <input type="radio" id="input5" name="user_experience" value=4>
                <label for="input5">4</label><br>
                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="container">
            <form action="store_lostconnection.php" method="POST" id = "form2">
                <p>Did you lost connection in the last 10 minutes?</p>
                <input type="submit" value="Report Lost">
            </form>
        </div>

        <div id="warning">
            <h4 class="warn">This website measures your current network speed and also retrieves your location within FEUP</h4>
            <h5>On the next page, please accept access to your location</h5>
        </div>

        <img class= "ex" src="exclamacao.png" alt="feup logo" width="45" height="45"> 

        <div class="container_button">
                <p>Click on "See More" to know more about our collected data</p>
                <button onclick="window.location.href='seemore.php'" id= "button">See More</button>            </form>
        </div>


    </div>
    
 </body>
</html>