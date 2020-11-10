<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
 </head>
 <body>

    <h1>Thank you!</h1>
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
    fwrite($myfile, " ".$towrite);
    fclose($myfile);

    ?>
 </body>
</html>