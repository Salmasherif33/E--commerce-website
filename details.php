<?php

include ("includes/prodFun.php");
 Session::init();

 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <!--BOOTSTRAP meta-->
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <!--BOOTSTRAP stylesheet-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" type="text/css" href="css/Description Page.css?<?php echo time();?>">
   <!--navbar style sheet-->
   <link rel="stylesheet" href="css/Header.css?<?php echo time();?>">
   <?php if(Session::get('seller_id')){?>
   <link rel="stylesheet" href="css/Seller Header.css?<?php echo time();?>"><?php } ?>

   <title>Description Page</title>
 </head>
 <body>

<body>
  <!--BOOTSTRAP -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <?php if(Session::get('seller_id')){
    include ("Seller_Header.php");}
    else {
      include ("Header.php");
    }
     ?>

  <!-------------------------------------------------------------------------------------------------------------------------------------------------------------->

  <?php
  $pid = $_GET['id'];
  $product = Controller::getProductBy('id',$pid);


  ?>
  <div class="content">

    <div class="product-image">
    <?php echo '<img src="images/'.$product->getImage().'" />'; ?>
    </div>
    <div class="product-desc">
      <!-------------Title--------------->
      <h3 class="product-title"><?php echo ($product->getName())?></h3>
      <!-------------Category------------>
      <div class="categ">
        <p><?php echo ($product->getCategory())?></p>
      </div>
      <!-------------Price--------------->
      <p class="price"><?php echo ($product->getPrice())?> LE</p>
      <!-------------Description--------->
      <div class="description">
        <p><?php echo ($product->getDescription())?></p>
      </div>
      <div>
          <p class="available">Available in stock: </p>
          <p class="items-no"><?php echo($product->getCount())?></p>
          <br>
          <?php $avg = Controller::avgRate($pid);
            if($avg ==0)
            $p = "No rating yet";
            else {
              $p = $avg . " / 5";
            }
           ?>
          <p class="items-no">Average rating: <?php echo($p)?></p>
      </div>
      <?php if(Session::get('customer_id')){ ?>
      <div class="txt-center">
        <form class="stars" method="post" action="includes/prodFun.php">
          <div class="rating">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
            <label for="star5">☆</label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
            <label for="star4">☆</label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
            <label for="star3">☆</label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
            <label for="star2">☆</label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
            <label for="star1">☆</label>
            <input type="hidden" name="id" value="<?=$pid?>">
            <input type="hidden" name="cust" value="<?=Session::get('customer_id')?>">
            <div class="clear"></div>
          </div>
          <div class="rate">
            <button class="rate-btn" type="submit" name="rate">
              <svg id="svg1" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
              <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
              </svg>
            </button>
          </div>
        </form>
      </div>
      <?php

       displayCartButton($product); ?>
      <?php
      if(Session::logged()){
      $arr = Customer::get_search_history_array(Session::get('customer_id'));

      if(count($arr)!=1){
       ?>
  <div class="rec-section">
    <p>Recommended For You</p>
  </div>

<!------------------------------------Recommended products--------------------------------------->
   <div class="cards-center">
  <div class="total">
  <?php displayRecommended(1); ?>
  </div>
  </div>

<!----------------------------------------------------------------------------------------------->
<?php } }}?>
</div>
</div>
<div class="footer">
    <br>
    <p>Shoppera is an online store where you can get anything you imagine. While using Shoppera, you agree to have read and accepted our terms of use, cookie and privacy policy.</p>
    <br>
    <p>All rights reserved.</p>
  </div>



</body>
</html>
