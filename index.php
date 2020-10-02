<?php

   include_once("index.html");

   $dirname = "img/";
   $images = glob($dirname."*.jpg");

foreach($images as $image) {
    echo '<img src="'.$image.'" /><br />';
}


   include_once("footer.php");