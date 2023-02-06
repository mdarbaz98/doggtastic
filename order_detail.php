<?php
include('pets-admin/include/config.php');
include('./include/header.php');
$userid = $_COOKIE['userid']; ?>
<!-- Start Page Title Area -->
<div class="page-title-area">
  <div class="container">
    <div class="page-title-content"></div>
  </div>
</div>
<?php  $stmt = $conn->prepare("SELECT * FROM `order_details` WHERE userid=?");
       $stmt->execute([$userid]);
       $proCount = $stmt->rowCount();
       if ($proCount > 0) {
        $user_data_order = $stmt->fetch(PDO::FETCH_ASSOC);
       $order_date = date('F d, Y', strtotime($user_data_order['order_date']));
       ?>
<!-- End Page Title Area -->
<!-- Start Wishlist Area -->

<div class="wishlist-area pt-5 pb-5">
  <div class="container">
    <form>
      <div class="wishlist-table table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Order Information</th>
            </tr>
          </thead>
          <tbody>
              <td>Order ID</td>
              <td><?php echo $user_data_order['invoice_id']; ?></td>
            </tr>
            <tr>
              <td>Order Date</td>
              <td><?php echo $order_date; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>

<div class="wishlist-area pt-5">
  <div class="container">
    <form>
      <div class="wishlist-table table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php         $stmt = $conn->prepare("SELECT * FROM `order_product` WHERE userid=?");
                            $stmt->execute([$userid]);
                            while($user_data = $stmt->fetch(PDO::FETCH_ASSOC)){
                               ?>
              <td>
                <a href="products-details.html">
                  <img src="<?php echo $user_data['pro_img'] ?>" alt="item">
                </a>
              </td>
              <td> <?php echo $user_data['pro_name'] ?> </td>
              <td class="product-price"><?php echo $user_data['pro_qty'] ?></td>
              <td> $<?php echo $user_data['pro_price'] ?> </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <div>
        <div class="cart-totals">
    <ul>
        <li>Subtotal<span>$<?php echo $user_data_order['sub_total'] ?></span></li>
        <li>Shipping<span>$<?php echo $user_data_order['shipping_charges'] ?></span></li>
        <li>Total <span>$<?php echo $user_data_order['total'] ?></span></li>
    </ul>
    </div>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="wishlist-area pt-5 pb-5">
  <div class="container">
    <form>
      <div class="wishlist-table table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Billing Information</th>
            </tr>
          </thead>
          <tbody>
          <tr>
              <td>Name</td>
              <td><?php echo $user_data_order['name']; ?></td>
            </tr>
            <tr>
              <td>Shipping Address</td>
              <td><?php echo $user_data_order['address']; ?></td>
            </tr>
            <tr>
              <td>City</td>
              <td><?php echo $user_data_order['city']; ?></td>
            </tr>
            <tr>
              <td>State</td>
              <td><?php echo $user_data_order['state']; ?>, <?php echo $user_data_order['country']; ?></td>
            </tr>
            <tr>
              <td>Pincode</td>
              <td><?php echo $user_data_order['pincode']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>
<?php }else{
  echo "<p classs='text-center' style='text-align: center;color: red;font-size: 20px;'>There is no product in your account</p>";
} ?>
<!-- End Wishlist Area --> <?php include('./include/footer.php') ?>