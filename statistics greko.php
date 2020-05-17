
<?php

    $Statistic = $_POST["Statistic"];
    

    
    $folder_name = "./public/";
    $public_Storage = 10737418240;
    $current_public_Storage = folderSize($folder_name);
    $current_public_percentage_Storage = round($current_public_Storage / $public_Storage * 100, 2);
    $current_public_remaining_Storage = round($public_Storage - $current_public_Storage, 2);

    function folderSize($dir){
        $count_size = 0;
        $count = 0;
        $dir_array = scandir($dir);
        foreach($dir_array as $key=>$filename){
            if($filename!=".." && $filename!="."){
                if(is_dir($dir."/".$filename)){
                    $new_foldersize = foldersize($dir."/".$filename);
                    $count_size = $count_size+ $new_foldersize;
                }else if(is_file($dir."/".$filename)){
                    $count_size = $count_size + filesize($dir."/".$filename);
                    $count++;
                }
            }
        }
        return $count_size;
    }



   

    function debug_to_console($data) {
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);
		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    //  Bandwidth
    $public_Bandwidth = 0;
    $current_public_Bandwidth = 0;
    $current_public_percentage_Bandwidth = 0;
    $current_public_remaining_Bandwidth = 0;

    //Decode the JSON data into a PHP array.
    $contents = file_get_contents('bandwidth-usage.json');
    $contentsDecoded = json_decode($contents, true);
    $public_Bandwidth = $contentsDecoded['public_Bandwidth'];
    $current_public_Bandwidth = $contentsDecoded['current_public_Bandwidth'];
    $current_public_percentage_Bandwidth = round(($current_public_Bandwidth / $public_Bandwidth) *100, 2);
    $current_public_remaining_Bandwidth = ($public_Bandwidth - $current_public_Bandwidth);


    $data = array(
        'public_Storage' => $public_Storage,
        'current_public_percentage_Storage' => $current_public_percentage_Storage,
        'current_public_Storage' => $current_public_Storage,
        'current_public_remaining_Storage' => $current_public_remaining_Storage,

        'public_Bandwidth' => $public_Bandwidth,
        'current_public_Bandwidth' => $current_public_Bandwidth,
        'current_public_percentage_Bandwidth' => $current_public_percentage_Bandwidth,
        'current_public_remaining_Bandwidth' => $current_public_remaining_Bandwidth
    );
    $data_JSON = json_encode($data);
    if($Statistic == "Storage"){
        echo $data_JSON;
    }


    
    if($Statistic == "Bandwidth"){
        
    }
?>