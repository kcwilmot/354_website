<?php

   include_once("index.html");

   $files = scandir('./img');
   foreach($files as $file) {
     ?> <div id="home-gallery"> 
        <?php $file ?> </div><?php 
   }

   include_once("footer.php");