$( document ).ready(function() {

   // he idle
   var idleInterval = setInterval(timerIncrement, 1000); 
   var isIdle = false;
   var idleTime = 0;
   //Zero the idle timer on mouse movement.
   $(this).mousemove(function (e) {
      idleTime = 0;
   });
   $(this).keypress(function (e) {
      idleTime = 0;
   });
   function timerIncrement() {
      idleTime = idleTime + 1;
      if (idleTime > 60) { 
         isIdle = true;
         $("#Idle_Base").addClass("enable");
      }else{
         isIdle = false;
         $("#Idle_Base").removeClass("enable");
      }
   }



   // he protec
   var url = window.location.href;
   var baseurl = location.hostname;
   if(!url.includes("#public")){
      //window.location.href = "https://"+ baseurl + "#public";
   }
   $( window ).on( 'hashchange', function( e ) {
      console.log( 'hash changed' );

      // he protec
      var url = window.location.href;
      var baseurl = location.hostname;
      if(!url.includes("#public")){
         //window.location.href = "https://"+ baseurl + "#public";
      }

  } );

   var isStorageStatistics_Enabled = true;//$("#StorageStatistics_isENabled")[0].checked;
   $("#StorageStatistics_isENabled")[0].checked = true;
   $(".Statistics_Container_Item").addClass("enabled");

   $('#StorageStatistics_isENabled').change(function () {
      isStorageStatistics_Enabled = $("#StorageStatistics_isENabled")[0].checked;
      if(isStorageStatistics_Enabled){
         $(".Statistics_Container_Item").addClass("enabled");
      }else{
         $(".Statistics_Container_Item").removeClass("enabled");
      }
   });

   var current_public_percentage_Storage = 0;

   $("#file_drop_target").click(function(){
      var allowFileUpload = true;
      if(!isStorageStatistics_Enabled) allowFileUpload = false;
      if(current_public_percentage_Storage >= 100){
         allowFileUpload = false;
         alert("You are out of storage space. To free up space delete old or unecesssery files");
      } 
      if(!allowFileUpload) event.preventDefault();
      console.log(isStorageStatistics_Enabled);
   });

   var isUpdatingStatistics = false;
   window.setInterval(function(){
      if(!isUpdatingStatistics && isStorageStatistics_Enabled && !isIdle){
         UpdateStatistics();

         //console.log("Updating...");

      }
   }, 1000);
   

   function UpdateStatistics(){
      isUpdatingStatistics = true;
      var data = {Statistic: "Storage"};
      $.post("../statistics greko.php", data, function(result, status){
         //console.log(result);
         $(".DiskSpace .DiskSpace_Raw").text(
            "Used: "+
            formatBytes(result.current_public_Storage) +" / "+
            formatBytes(result.public_Storage));
         $(".DiskSpace .DiskSpace_Percentage").text(
            "Percentage: "+
            result.current_public_percentage_Storage +"%"
            );
         $(".DiskSpace .DiskSpace_Remaining").text(
            "Remaining: "+
            formatBytes(result.current_public_remaining_Storage));

         current_public_percentage_Storage = result.current_public_percentage_Storage;


         $(".Bandwidth .DiskSpace_Raw").text(
            "Used: "+
            formatBytes(result.current_public_Bandwidth) +" / "+
            formatBytes(result.public_Bandwidth));
         $(".Bandwidth .DiskSpace_Percentage").text(
            "Percentage: "+
            result.current_public_percentage_Bandwidth +"%"
            );
         $(".Bandwidth .DiskSpace_Remaining").text(
            "Remaining: "+
            formatBytes(result.current_public_remaining_Bandwidth));
   

         isUpdatingStatistics = false;
      }, "json");
   }


   function formatBytes(bytes, decimals = 2) {
      if (bytes === 0) return '0 Bytes';
      const k = 1024;
      const dm = decimals < 0 ? 0 : decimals;
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
      const i = Math.floor(Math.log(bytes) / Math.log(k));
      return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
  }

});