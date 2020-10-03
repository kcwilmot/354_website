<?php
  include_once("header.php");
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
      <input type="number" name="item-image"><br>
      <label for="item-category">Category</label>
      <input type="number" name="item-category"><br>
      <label for="submit-new-item">Submit</label>
      <input type="button" name="submit-new-item"><br>
</form>
  </div>


<?php
  include_once("footer.php");