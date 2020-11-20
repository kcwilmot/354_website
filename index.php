<?php
   include_once("header.php");
   
   echo '<h1>Items For Sale</h1>';

   //Get all images in the img folder.
   $dirname = "img/";
   $images = glob($dirname."*.jpg");

   //Display all images in a gallery.
   foreach($images as $image) {
       echo '<img class="home-gallery-img" src="'.$image.'" />';
   }


   include_once("footer.php");