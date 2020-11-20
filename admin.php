<?php

  include_once("header.php");
  
  //Make sure that only a logged in administrator can access the page.
  if ( (isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) || 
       (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] != 1) ||
       !isset($_SESSION['authenticated']) ) {
    header("Location: login.php");
    exit();
  }
?>

<body> 
  <div>Inventory</div>
  <div><h2 id="add-item-header">Add Item</h2>
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
  <div class="current-items">
    <img class="inventory-list-img" src="img/earring_paw.jpg">
    <div>
      <h1>Paw Earrings</h1><br>
      Wood Type: <br>
      <li class="wood-type">
        Cedar
      </li> 
      <li class="wood-type">
        Rosewood 
      </li><br>
      Finish: <br>
      <li class="finish-type">
        Satin Stain
      </li>
      <li class="finish-type">
        Raw Wood
      </li>
    </div>
    Price: $10.00 <br>
    <div class="item-description">
      These are earrings. They have a design on them. Plz buy.
    </div>
    <button class="delete-button" type="button">Delete</button>
  </div>
  <hr>
  <div class="current-items">
    <img class="inventory-list-img" src="img/wood_box.jpg">
    <div>
      <h1>A boxy box</h1><br>
      Wood Type: <br>
      <li class="wood-type">
        Cherry
      </li> 
      <li class="wood-type">
        Padauk
      </li><br>
      Finish: <br>
      <li class="finish-type">
        Pink Stain
      </li>
      <li class="finish-type">
        Yes a Stain
      </li>
    </div>
    Price: $68.70 <br>
    <div class="item-description">
      This is a box, you can put things in it. It has a design on them. Plz buy.
    </div>
    <button class="delete-button" type="button">Delete</button>

  </div>



</body>




<?php
  include_once("footer.php");
