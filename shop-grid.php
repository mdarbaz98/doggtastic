<?php
include('pets-admin/include/config.php');
$slug = $_GET['cat'];
$category_name = str_replace("-"," ",$slug);
$category = $conn->prepare('SELECT * FROM categories WHERE cat_slug=?');
$category->execute([$slug]);
$categoryCount = $category->rowCount();
if ($categoryCount > 0) {
    $page = "category";
    while ($row = $category->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $name = $row['cat_name'];
        $desc = $row['cat_desc'];
      }
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    include('./include/header.php') ?>
        <!-- Start Products Area -->
        <div class="products-area ptb-100">
            <div class="container">
                <div class="patoi-grid-sorting row align-items-center">
                    <div class="col-lg-6 col-md-6 result-count">
                        <div class="d-flex align-items-center">
                            <h3 class="text-center mb-5"><?php echo ucfirst($category_name) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                <?php
                $stmt_pro = $conn->prepare("SELECT * FROM `product` WHERE category=? order by id asc limit 10");
                $stmt_pro->execute([$slug]);
                $proCount = $stmt_pro->rowCount();
                if($proCount>0){
                while($pro_data = $stmt_pro->fetch(PDO::FETCH_ASSOC)){
                ?>    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-products-box">
                            <div class="image">
                                <a href="<?php echo $pro_data['slug'] ?>" class="d-block text-center">
                                    <img src="<?php echo $pro_data['image'] ?>" alt="products-image">
                                </a>
                                <ul class="products-button">
                                    <li><a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to Card" onclick="addTocart(this)" data-proid="<?php echo $pro_data['id']; ?>" data-proimg="<?php echo $pro_data['image'] ?>" data-name="<?php echo $pro_data['name'] ?>" data-category=<?php echo $pro_data['category']; ?> data-price="<?php echo $pro_data['price'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>"><i class='bx bx-cart-alt'></i></a></li>
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
          <li><a href="javascript:void(0)" data-pro_id="<?php echo $pro_data['id'] ?>" onclick="product_popup(this)"><i class='bx bx-show'></i></a></li>
                                </ul>
                            </div>
                            <div class="content">
                                <h3><a href="<?php echo $pro_data['slug'] ?>"><?php echo $pro_data['name'] ?></a></h3>
                                <div class="price">
                                    <span class="new-price">$<?php echo $pro_data['price'] ?></span>
                                </div>
                                <a href="<?php echo $pro_data['slug'] ?>" class="default-btn">
                                    <span>Buy Now</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } }else{
                        echo "There is no product in this category";
                    } ?>

                </div>
            </div>
        </div>
        <!-- End Products Area -->
        <?php include('./include/footer.php');
        }else{
        echo "not found";
        }
        ?>