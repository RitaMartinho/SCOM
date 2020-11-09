<html>
 <head>
  <title>Evaluate Eduroam</title>
  <link href="store.css" rel="stylesheet">
 </head>
 <body>
    <h1>Thank you!</h1>
    
    <?php if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    echo "Today is: " . date("d-m-Y") . "<br>";
    echo "The time is: " . date("H:i"). "<br>";

    $date=date("d-m-Y")." ";
    $hour=date("H:i")." ";

    $towrite = $date.$hour.$ip;

    $myfile = fopen("lostconnection.txt", "a")or die("Unable to open file!");
    fwrite($myfile, "\n".$towrite);
    fclose($myfile);

    ?>
 </body>
</html>