<?php include('./include/header.php');
$userid = $_COOKIE['userid']; ?>
        <!-- Start Page Title Area -->
        <div class="container">
            <div class="thank-you-section d-flex gap-4 justify-content-center align-items-center flex-column my-5">
                <img class="thank-img" src="assets/img/checked.png" alt="checked">
                <div class="main-heading">
                    Thank You For Your Purchase
                </div>
                <p>Thank you for placing the order.Order Id is <strong>
                    <span class="text-success">#<?php echo $_GET['inv_id']; ?></span></strong> We will be sending an confirmation mail to you. Meanwhile we would request your patience.</p>
    <?php if(isset($_SESSION['user_name'])){?><p>You can check your order detail here <a href="order_detail.php">Order Details</a></p><?php }else{ ?>
        <p>You Can Login Here For Tracking Your<a href="#" style="text-decoration:underline;color:#0089ff;font-size:17px">Order Detail</a><a href="user.php" style="text-decoration:underline;color:#0089ff;font-size:17px">Login Here
        </a></p>
        <?php } ?>

                <a href="category/pet-food-" class="continue-btn">Continue Shopping</a>
            </div>
        </div>
        <?php include('./include/footer.php') ?>        