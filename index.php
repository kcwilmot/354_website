<?php

   include_once("index.html");

   $files = scandir('img/');
   foreach($files as $file) {
     ?> <div id="home-gallery"> 
        <?php echo $file; ?>
        <img src="<?php $file ?>"
        <?php
   }

   include_once("footer.php");