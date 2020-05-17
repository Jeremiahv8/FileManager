<link href="../css-circular-prog-bar.css" media="all" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../statistics-ui.css"/>


<script src="../statistics.js"></script>

<style>
body,html {
   font-size: 12px;
}
</style>



<div>
    <h2>Storage Statistics</h2> 
    <label class="switch">
        <input id="StorageStatistics_isENabled" type="checkbox">
        <span>
            <em></em>
            <strong></strong>
        </span>
    </label>
</div>

<div id="Statistics_Container">
    <div id="StorageStatistics_Base"  class="Statistics_Container_Item">
        <span class="DiskSpace">
            <h3>Disk Space</h3>
            <span class="DiskSpace_Raw"></span>
            <br>
            <span class="DiskSpace_Percentage"></span>
            <br>
            <span class="DiskSpace_Remaining"></span>
        </span>    
    </div>

    <div id="BandwidthStatistics_Base" class="Statistics_Container_Item">
        <span class="Bandwidth">
            <h3>Bandwidth Usage</h3>
            <span class="DiskSpace_Raw"></span>
            <br>
            <span class="DiskSpace_Percentage"></span>
            <br>
            <span class="DiskSpace_Remaining"></span>
        </span>    
    </div>

    <div id="UserStatsStatistics_Base" class="Statistics_Container_Item">
        <span class="UserStats">
            <h3>User Stats</h3>
            <span class="DiskSpace_Raw"></span>
            <br>
            <span class="DiskSpace_Percentage"></span>
            <br>
            <span class="DiskSpace_Remaining"></span>
        </span>    
    </div>
</div>

<div id="Idle_Base">
    <div class="container">
        <span>
            <h3>Hi, It seems kind of quiet on your end so we've pause FileManager to save resources.</h3>
            <h4>Move your cursor when you're ready to continue working.</h4>
        </span>
    </div>
</div>

<?php
    $folder_name = "./public//";

    //$public_Storage = 100000;
    //$current_public_Storage = folderSize($folder_name);
    //$current_public_percentage_Storage = round($current_public_Storage / $public_Storage * 100, 2);

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