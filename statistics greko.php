
<?php

    $Statistic = $_POST["Statistic"];
    if($Statistic == "current_public_percentage_Storage"){
        echo "current_public_percentage_Storage";
    }

    die();
    
    $folder_name = "./public//";

    $public_Storage = 100;
    $current_public_Storage = formatBytes(folderSize($folder_name));

    echo "Raw: ". formatMB($current_public_Storage)." / ". formatMB($public_Storage);
    //echo "<br>Simple: ".$current_public_Storage ."/". $public_Storage;
    $current_public_percentage_Storage = round($current_public_Storage / $public_Storage * 100, 2);
    echo "<br>Percentage: ".$current_public_percentage_Storage ."%";


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

    function formatBytes($bytes) { 
        $value = "";
        $value = round($bytes * 0.00000095367432, 2);
        return $value;
    }

    function formatMB($MB) { 
        $value = $MB;
        $metric = "MB";
        $value = round($MB , 2);

        if($MB >= 1024){
            $value = round($MB / 1024, 2);
            $metric = "GB";
            
            if($value >= 1024){
                $value = round($value / 1024, 2);
                $metric = "TB";
            }
        }

        return $value . $metric;
    }

?>

<?php
	function debug_to_console($data) {
		$output = $data;
		if (is_array($output))
			$output = implode(',', $output);

		echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
	}
?>