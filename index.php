<?php include('./include/header.php')
?>
<!-- Start Home Slides Area -->
<div class="home-slides owl-carousel owl-theme">
  <div class="banner-item bg1">
    <div class="container">
      <div class="banner-item-content"><span class="sub-title">Super Offer</span><h1>One Stop For All Your Pet Needs</h1><div class="price">
                            Price Only
                            <span>$95.00</span></div><a href="category/grooming" class="default-btn"><span>Shop Now</span></a></div>
    </div>
  </div>
  <div class="banner-item bg2">
    <div class="container">
      <div class="banner-item-content"><span class="sub-title">New Arrivals</span><h1>Help Your Dog Maintain A Healthier Weight</h1><div class="price">
                            Price Only
                            <span>$70.00</span></div><a href="category/pet-food-" class="default-btn"><span>Shop Now</span></a></div>
    </div>
  </div>
  <div class="banner-item bg3">
    <div class="container">
      <div class="banner-item-content"><span class="sub-title">Super Offer</span><h1>Why Should Hoomans Have All The Fun?</h1><div class="price">
                            Price Only
                            <span>$30.00</span></div><a href="category/toys" class="default-btn"><span>Shop Now</span></a></div>
    </div>
  </div>
</div>
<!-- End Home Slides Area -->
<!-- Start About Area -->
<!--<div class="about-area pt-100 pb-75">-->
<!--  <div class="container">-->
<!--    <div class="row align-items-center">-->
<!--      <div class="col-lg-3 col-md-12">-->
<!--        <div class="about-image">-->
<!--          <img class="rounded shadow" src="assets/img/about/DOG1.WEBP" alt="about-image">-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-lg-6 col-md-12">-->
<!--        <div class="about-content">-->
<!--          <h2>About Doggtastic Adventure</h2>-->
<!--          <p>We, the Doggtastic Adventure, promise to provide the ultimate shopping experience & best quality of pet supply to our customers. To ensure the healthy and happy life of your beloved pets we are committed to keep upgrading ourself and serve you better. </p>-->
<!--          <a href="category/pet-food-" class="default-btn">-->
<!--            <span>Shop Now</span>-->
<!--          </a>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="col-lg-3 col-md-12">-->
<!--        <div class="about-image">-->
<!--          <img class="rounded shadow" src="assets/img/about/DOG2.WEBP" alt="about-image">-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!-- End About Area -->
<!-- Start Categories Area -->
<div class="categories-area pb-75 pt-4">
  <div class="container">
    <div class="section-title">
      <h2>Shop by Categories</h2>
    </div>
    <div class="categories-slides owl-carousel owl-theme"> <?php
                    $stmt = $conn->prepare("SELECT * FROM `categories` order by id desc");
                    $stmt->execute();
                    while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        $product_count=$conn->prepare("SELECT COUNT(*) FROM product WHERE category=?");
                        $product_count->execute([$user_data['cat_slug']]);
                        $pro_row_count = $product_count->fetchColumn();

                        if(!empty($user_data['img_id'])){
                            $img_id=$user_data['img_id'];
                        }else{
                            $img_id=1;
                        }

                        $images=$conn->prepare("SELECT * FROM images WHERE id=?");
                        $images->execute([$img_id]);
                        $row = $images->fetch(PDO::FETCH_ASSOC);

                       
                    ?> <div class="categories-box">
        <a href="category/<?php echo $user_data['cat_slug'] ?>" class="d-block">
          <img src="pets-admin/<?php echo $row['path'] ?>" alt="categories-image">
          <h3> <?php echo $user_data['cat_name'] ?> </h3>
          <span> <?php echo $pro_row_count ?> items </span>
        </a>
      </div> <?php } ?> </div>
  </div>
</div>
<!-- End Categories Area -->               
<!-- grid -->
<h2 class="arrival text-center mb-5">New Arrivals</h2>
<div class="container">
<div class="grid-container owl-carousel" id="grid-section">
    <?php
    $i=1;
    $d_none="";
    $classname="";
    $stmt_pro = $conn->prepare("SELECT * FROM `product` order by id desc limit 5");
    $stmt_pro->execute();
    while($pro_data = $stmt_pro->fetch(PDO::FETCH_ASSOC)){
        if($i==2){
            $classname="offer-item";
            $d_none="d-none";
        }else{
            $classname="single-products-box";
            $d_none="d-block";
        }  
    ?>

   <div class="grid-item grid-item<?php echo $i ?>">
     <div class="<?php echo $classname ?>">
       <div class="image">
        <a href="<?php echo $pro_data['slug'] ?>" class="d-block">
          <img src="<?php echo $pro_data['image'] ?>" alt="products-image">
        </a>
        <ul class="products-button <?php echo $d_none ?>">
          <li>
            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $pro_data['id']; ?>" data-proimg="<?php echo $pro_data['image'] ?>" data-name="<?php echo $pro_data['name'] ?>" data-category="<?php echo $pro_data['category']; ?>" data-price="<?php echo $pro_data['price'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>">
              <i class='bx bx-cart-alt'></i>
            </a>
          </li>
          <?php if(isset($_SESSION['userid'])){?>       
          <li>
            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTowish(this)" data-proid="<?php echo $pro_data['id']; ?>" data-proimg="<?php echo $pro_data['image'] ?>" data-name="<?php echo $pro_data['name'] ?>" data-category="<?php echo $pro_data['category']; ?>" data-price="<?php echo $pro_data['price'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>">
              <i class='bx bx-heart'></i>
            </a>
          </li>
          <?php }else { ?>
            <li>
            <a href="user.php" data-toggle="tooltip" data-placement="left">
              <i class='bx bx-heart'></i>
            </a>
          </li>
          <?php } ?>
          <li>
            <a href="javascript:void(0)" data-pro_id="<?php echo $pro_data['id'] ?>" onclick="product_popup(this)">
              <i class='bx bx-show'></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="content">
        <h3>
          <a href="<?php echo $pro_data['slug'] ?>"><?php echo $pro_data['name'] ?></a>
        </h3>
        <div class="price">
          <span class="new-price">$<?php echo $pro_data['price'] ?></span>
        </div>
        <!--<div class="rating">-->
        <!--  <i class='bx bxs-star'></i>-->
        <!--  <i class='bx bxs-star'></i>-->
        <!--  <i class='bx bxs-star'></i>-->
        <!--  <i class='bx bxs-star'></i>-->
        <!--  <i class='bx bxs-star'></i>-->
        <!--</div>-->
        <a href="-dog-raincoats-with-hood-" class="default-btn">
        <span>Buy Now</span>
      </a>
        <?php if($i==2){ ?>
         <div class="hide-cont d-none d-lg-block">
        <h3>Place an order now</h3>
      <span class="discount">Enjoy 30% OFF</span>
      <div class="counter-class" data-date="2023-3-24 24:00:00">
        <div>
          <span class="counter-days"></span> Days
        </div>
        <div>
          <span class="counter-hours"></span> Hours
        </div>
        <div>
          <span class="counter-minutes"></span> Minutes
        </div>
        <div>
          <span class="counter-seconds"></span> Seconds
        </div>
      </div>
      <a href="<?php echo $pro_data['slug']  ?>" class="default-btn">
        <span>Shop Now</span>
      </a>
         </div>
      <?php } ?>  
      </div>
    </div>
 </div>
       <?php $i++; } ?> 
</div>
</div>
<!-- grid -->
<!-- Start Offer Area -->
<div class="offer-area pb-75">
  <div class="container">
    <div class="single-offer-box">
      <a href="category/pet-food-" class="d-block">
        <img src="assets/img/banner/CTA BANNER - 2022.WEBP" alt="offer-image">
      </a>
    </div>
  </div>
</div>
<!-- End Offer Area -->
<!-- Start Products Area -->
<div class="products-area pb-75">
  <div class="container">
    <div class="section-title">
      <h2>Best Sellers</h2>
    </div>
    <div class="products-slides owl-carousel owl-theme"> <?php
                        $stmt_pro = $conn->prepare("SELECT * FROM `product` order by id asc limit 10");
                        $stmt_pro->execute();
                        while($pro_data = $stmt_pro->fetch(PDO::FETCH_ASSOC)){
                            ?> <div class="single-products-box">
        <div class="image">
          <a href="<?php echo $pro_data['slug'] ?>" class="d-block">
            <img src="<?php echo $pro_data['image'] ?>" alt="products-image">
          </a>
          <ul class="products-button">
            <li>
              <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $pro_data['id']; ?>" data-proimg="<?php echo $pro_data['image'] ?>" data-name="<?php echo $pro_data['name'] ?>" data-category=<?php echo $pro_data['category']; ?> data-price="<?php echo $pro_data['price'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>">
                <i class='bx bx-cart-alt'></i>
              </a>
            </li>
            <?php if(isset($_SESSION['userid'])){?>       
          <li>
            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTowish(this)" data-proid="<?php echo $pro_data['id']; ?>" data-proimg="<?php echo $pro_data['image'] ?>" data-name="<?php echo $pro_data['name'] ?>" data-category=<?php echo $pro_data['category']; ?> data-price="<?php echo $pro_data['price'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>">
              <i class='bx bx-heart'></i>
            </a>
          </li>
          <?php }else { ?>
            <li>
            <a href="user.php" data-toggle="tooltip" data-placement="left">
              <i class='bx bx-heart'></i>
            </a>
          </li>
          <?php } ?>
            <li>
              <a href="javascript:void(0)" data-pro_id="<?php echo $pro_data['id'] ?>" onclick="product_popup(this)">
                <i class='bx bx-show'></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="content">
          <h3>
            <a href="<?php echo $pro_data['slug'] ?>"> <?php echo $pro_data['name'] ?> </a>
          </h3>
          <div class="price">
            <span class="new-price">$ <?php echo $pro_data['price'] ?></span>
          </div>
          <a href="-dog-raincoats-with-hood-" class="default-btn">
        <span>Buy Now</span>
      </a>
        </div>
      </div> <?php } ?> </div>
  </div>
</div>
<!-- End Products Area -->
<!-- Start Facility Area -->
<div class="facility-area pb-75">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="facility-box">
          <img src="assets/img/icon/GIFT.svg" width="100" alt="icon">
          <h3>Best collection</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="facility-box bg-fed3d1">
          <img src="assets/img/icon/FAST DELIVERY.svg" width="100" alt="icon">
          <h3>Fast delivery</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="facility-box bg-a9d4d9">
          <img src="assets/img/icon/24-7 CUSTOMER SUPPORT.svg" width="100" alt="icon">
          <h3>24/7 customer support</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-6">
        <div class="facility-box bg-fef2d1">
          <img src="assets/img/icon/SECURE PAYMENT.svg" width="100" alt="icon">
          <h3>Secured payment</h3>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Facility Area --> <?php include('./include/footer.php') ?>