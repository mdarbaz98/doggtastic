<?php
ob_start();

session_start();
include('pets-admin/include/config.php');
$cookie_name = "userid";
if(!isset($_COOKIE[$cookie_name])) {
    $userid = uniqid();
    setcookie($cookie_name, $userid, time() + 3600, '/'); // 86400 = 1 day
    echo "<script>location.reload()</script>";
} else {
    setcookie($cookie_name, $_COOKIE['userid'], time() + 3600, '/'); // 86400 = 1 day
}
$stmt = $conn->prepare("SELECT name,slug FROM `product`");
$stmt->execute();
while ($pro_data = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    file_put_contents('product.js', json_encode($pro_data));
}
?>
<!doctype html>
<html lang="eng">
<head>
    <base href="https://doggtasticadventures.com/">
    <!-- <base href="http://192.168.2.112/Pets/"> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Link of CSS files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rangeSlider.min.css">
    <link rel="stylesheet" href="assets/css/odometer.min.css">
    <link rel="stylesheet" href="assets/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/slick.min.css">
    <link rel="stylesheet" href="assets/css/countrySelect.min.css">
    <link rel="stylesheet" href="assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <title>Doggtasticadvemtures</title>

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!--tel-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.0/css/intlTelInput.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <!--tel-->
    <style>
    .hello{
        background:pink;
    }
    #Cardpayment .error{
        color:red !important;
    }
          .loader-input:before {
    font-family: FontAwesome;
    content: "\f110";
    display: inline-block;
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    z-index: 8;
    right: 16px;
    margin-right: 7px;
    height: fit-content;
    width: fit-content;
    padding: 0;
    color: blue;
    font-size: 19px;

    -webkit-animation: rotating 2s linear infinite;
    -moz-animation: rotating 2s linear infinite;
    -ms-animation: rotating 2s linear infinite;
    -o-animation: rotating 2s linear infinite;
    animation: rotating 2s linear infinite;
  }
  .addressSearch .loader-input:before {
    bottom: 40px !important;
  }
  
  @-webkit-keyframes rotating /* Safari and Chrome */ {
    from {
      -webkit-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    to {
      -webkit-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes rotating {
    from {
      -ms-transform: rotate(0deg);
      -moz-transform: rotate(0deg);
      -webkit-transform: rotate(0deg);
      -o-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    to {
      -ms-transform: rotate(360deg);
      -moz-transform: rotate(360deg);
      -webkit-transform: rotate(360deg);
      -o-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
    </style>
</head>

<body>

    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="patoi-responsive-nav">
            <div class="container">
                <div class="patoi-responsive-menu">
                    <div class="logo">
                        <a href="/"><img class="logoimg" src="assets/img/logo/LOGO.svg"></img></a>
                    </div>
                    <div class="quick-links">
                        <ul class="gap-4 mobile-quick-links-ul">
                            <li><a href="/">Home</a></li>
                            <li><a href="about">About</a></li>
                            <li class="position-relative" id="categoryBtn"><a>Category<i class="fa-solid fa-caret-down ms-2"></i></a>
                        <div class="category-wrapper" id="category-wrapper">
                        <?php
                                          $stmt = $conn->prepare("SELECT * FROM `categories`");
                                          $stmt->execute();
                                          while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                            <div class="category-list"><a href="category/<?php echo $user_data['cat_slug'] ?>" class="nav-link"><?php echo $user_data['cat_name'] ?></a></div>
                            <?php } ?>  
                        </div>
                        </li>
                            <li><a href="contact">Contact</a></li>
                        </ul>
                    </div>
                    <span class="empty-div"></span>
                    <div class="others-option">
                        <?php
                        $product = $conn->prepare("SELECT count(*) FROM `cart` where userid=? AND status='cart'");
                        $product->execute([$_COOKIE[$cookie_name]]);
                        $product_row = $product->fetchColumn();

                        $product_wish = $conn->prepare("SELECT count(*) FROM `cart` where userid=? AND status=?");
                        $product_wish->execute([$_COOKIE[$cookie_name], 'wishlist']);
                        $product_row_wish = $product_wish->fetchColumn();
                        ?>
                        <ul>


                                <li>
                                <a class="user d-flex justify-content-center align-items-center"><i class='bx bx-user-circle'></i><?php if(isset($_SESSION['user_name'])){?><?php echo $_SESSION['user_name']; ?><?php } ?></a>

                                <ul class="userDetails ps-0" id="userDetails">
                                <?php if(isset($_SESSION['user_name'])){ ?>
                                <li><a class="" href="order_detail.php">Order Detail</a></li>
                                <li><a class="" href="logout.php">Log Out</a></li>   
                                <?php }else{ ?>
                                <li><a class="" href="user">Login</a></li>
                                <li><a class="" href="user">Register</a></li>
                                <?php } ?>   
                                </ul>      
                                </li>   
                            


                            <?php if(isset($_SESSION['user_name'])){?>
                                <li class="position-relative"><span id="total_wish_count"><?php echo $product_row_wish ?></span><a href="wishlist.php"><i class='fa-regular fa-heart'></i></a></li>
                                <?php }else{ ?>
                                    <li class="position-relative"><span id="total_wish_count"></span><a href="user"><i class='bx bx-heart'></i></a></li>
                                <?php } ?>  
                            <!-- <li><a href="cart.html"><i class="fa-regular fa-heart"></i></a></li> -->
                            <li class="position-relative"><span id="total_product_count"><?php echo $product_row ?></span><a href="cart"><i class='bx bx-cart'></i></a></li>

                            <!-- <li><a href="cart.html"><i class='bx bx-cart'></i></a></li> -->
                            <li class="mobile-search-btn"><i class="bx bx-search"></i></li>
                            <li class="menu-btn d-block d-md-none"><i class="bx bx-menu"></i></li>
                            <input class="mobile-search-input" placeholder="Search for brands & products" />
                        </ul>
                        <ul class="search-list">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->