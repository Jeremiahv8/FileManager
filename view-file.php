<?php
    //die( $_GET["filename"] . "?access=". $Access );

    $Filename = $_GET["filename"];
    $Access = $_GET["access"];

    /*
    echo "Attempting to view: ". $Filename;
    echo "<br>Checking bandwith usage...";
    */

    $public_Bandwidth = 0;
    $current_public_Bandwidth = 0;
    $current_public_percentage_Bandwidth = 0;
    $current_public_remaining_Bandwidth = 0;
    $File_Size = 0;

    
    //Decode the JSON data into a PHP array.
    $contents = file_get_contents('bandwidth-usage.json');
    $contentsDecoded = json_decode($contents, true);
    $public_Bandwidth = $contentsDecoded['public_Bandwidth'];
    $current_public_Bandwidth = $contentsDecoded['current_public_Bandwidth'];
    
    
    $current_public_percentage_Bandwidth = ($current_public_Bandwidth / $public_Bandwidth) * 100;
    $current_public_remaining_Bandwidth =  $public_Bandwidth - $current_public_Bandwidth;
    
    /*
    echo "<br><br> Pre--";
    echo "<br>Totab Bandwidth: ". $public_Bandwidth;
    echo "<br>Current Used Bandwidth: ". $current_public_Bandwidth;
    echo "<br>Current Used Percentage Bandwidth: ". $current_public_percentage_Bandwidth;
    echo "<br>Current Used Remaining Bandwidth: ". $current_public_remaining_Bandwidth;
    */


    $File_Size = filesize($Filename);

    /*
    echo '<br><br>File Size: ' . formatBytes($File_Size);
    echo "<br><br> Access--";
    */

    if($current_public_remaining_Bandwidth >= $File_Size){
        //echo "Access Allowed";
    }else{
        die("Access Denies: Daily Bandwidth limit reached");
    }

    //Modify the bandwidth used.        
    $contentsDecoded['current_public_Bandwidth'] = $current_public_Bandwidth + $File_Size;
    $json = json_encode($contentsDecoded);
    //Save the file.
    file_put_contents('bandwidth-usage.json', $json);

    //echo "<br><br> Post--";
    $contents = file_get_contents('bandwidth-usage.json');
    //Decode the JSON data into a PHP array.
    $contentsDecoded = json_decode($contents, true);
    $public_Bandwidth = $contentsDecoded['public_Bandwidth'];
    $current_public_Bandwidth = $contentsDecoded['current_public_Bandwidth'];
    $current_public_percentage_Bandwidth = round(($current_public_Bandwidth / $public_Bandwidth) * 100, 2);
    $current_public_remaining_Bandwidth =  $public_Bandwidth - $current_public_Bandwidth;
    
    /*
    echo "<br>Totab Bandwidth: ". formatBytes($public_Bandwidth);
    echo "<br>Current Used Bandwidth: ". formatBytes($current_public_Bandwidth);
    echo "<br>Current Used Percentage Bandwidth: ". $current_public_percentage_Bandwidth . "%";


    echo "<br>Current Used Remaining Bandwidth: ". formatBytes($current_public_remaining_Bandwidth);
    echo '<br>File: pre ';
    echo '<br>'. 'https://filemanager.aegeantt.com/'. $Filename .'?access='. $Access;
    echo "<br>Hash: ". hash('ripemd160', $Access);
    */

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('bytes', 'KB', 'MB', 'GB', 'TB');   
        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

?>

<?php
    //sleep(3);
    //$url = "https://filemanager.aegeantt.com/". $Filename . "?access=". $Access;
    $url = "https://". $_SERVER['SERVER_NAME'] ."/". $Filename . "?access=". $Access;
    echo "<script>window.location.href='". $url ."';</script>";
    exit;
    
?>

