<?php
   include_once("header.php");
   
   echo '<h1>Items For Sale</h1>';

   $dirname = "img/";
   $images = glob($dirname."*.jpg");

   foreach($images as $image) {
       echo '<img class="home-gallery-img" src="'.$image.'" />';
   }


   include_once("footer.php");