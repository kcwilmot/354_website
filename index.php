<?php
   include_once("/header.php");
   include_once("/index.html");

   $dirname = "img/";
   $images = glob($dirname."*.jpg");

   foreach($images as $image) {
       echo '<img class="home-gallery-img" src="'.$image.'" />';
   }


   include_once("footer.php");