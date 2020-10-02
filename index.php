<?php

   include_once("index.html");

   $files = scandir('img/');
   foreach($files as $file) {
     ?> <div id="home-gallery"> 
        <?php echo $file;
   }

   include_once("footer.php");