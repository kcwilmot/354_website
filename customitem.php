<!--header, words, form, "find file" and "upload" buttons, footer-->
<?php
  include_once("../header.php");
?>
<h1 id="custom-item-header">Custom Items!</h1><br>
Have an idea? <br> 
Contact us for an estimate!<br>
biteycatcustoms@email.com<br>
<div id="custom-item-page-spacer"> </div>
Have something designed?<br>
Upload and .svg file!<br>
<form id="custom-item-file-upload">
  <input type="file" id="custom-item-file-upload" name="custom-item-file">
  <input type="submit">
</form>

<?php
  include_once("../footer.php");