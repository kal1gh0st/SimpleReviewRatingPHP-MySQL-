<div id="demo"><?php
// (A) CORE LIBRARY + USER ID
require "2-core.php";
// FIXED TO 901 FOR DEMO, SHOULD BE SESSION USER ID IN YOUR PROJECT
$uid = 901;
 
// (B) UPDATE STAR RATINGS
if (isset($_POST['pid'])) {
  if (!$_STARS->save($_POST['pid'], $uid, $_POST['stars'])) {
    echo "<div>$_STARS->error</div>";
  }
}
 
// (C) GET RATINGS
$average = $_STARS->avg(); // AVERAGE RATINGS
$ratings = $_STARS->get($uid); // RATINGS BY CURRENT USER
 
// (D) OUTPUT DUMMY PRODUCTS
$products = [
  "1" => ["name" => "Foo Bar", "price" => 123.45],
  "2" => ["name" => "Fork Bar", "price" => 24.56],
  "3" => ["name" => "Goo Bar", "price" => 8.76],
  "4" => ["name" => "Joo Bar", "price" => 2.57]
]; 
foreach ($products as $pid=>$pdt) { ?>
<div class="pdt">
  <div class="pname">Name: <?=$pdt['name']?></div>
  <div class="pprice">Price: $<?=$pdt['price']?></div>
  <div class="prate">Rating: <?=$average[$pid]?></div>
  <div class="pstar" data-pid="<?=$pid?>">
    Your rating: <?php
    $rate = isset($ratings[$pid]) ? $ratings[$pid] : 0 ;
    for ($i=1; $i<=5; $i++) {
      $img = $i<=$rate ? "star" : "star-blank" ;
      echo "<img src='$img.png' data-set='$i'>";
    }
  ?></div>
</div>
<?php }
?></div>
 
<!-- (E) HIDDEN FORM TO UPDATE STAR RATING -->
<form id="ninForm" method="post" target="_self">
  <input id="ninPdt" type="hidden" name="pid"/>
  <input id="ninStar" type="hidden" name="stars"/>
</form>
