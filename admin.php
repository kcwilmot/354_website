<?php
  include_once("header.php");
  /*echo "<style>"; 
    include_once("style.css"); 
  echo "</style>";
  */
?>

<body> 
  <div>Inventory</div>
  <div>Add Item
    <form id="add-item-form">
      <label for="item-name">Item Name</label>
      <input type="text" name="item-name"><br>
      <label for="item-price">Price</label>
      <input type="number" name="item-price"><br>
      <label for="item-image">Image</label>
      <input type="text" name="item-image"><br>
      <label for="item-category">Category</label>
      <input type="text" name="item-category"><br>
      <button name="submit-new-item" type="submit">Submit</button>
  </form>
  </div>
  <hr>
  <div class="">




<?php
  include_once("footer.php");