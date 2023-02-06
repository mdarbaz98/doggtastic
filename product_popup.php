<?php
session_start();
include('pets-admin/include/config.php'); ?>
<?php 
    $userid = $_COOKIE['userid'];
    $pro_id = $_POST['pro_id'];
    $stmt = $conn->prepare("SELECT * FROM `product` WHERE id=?");
    $stmt->execute([$pro_id]);
    while($pro_data = $stmt->fetch(PDO::FETCH_ASSOC)){
        $image=$pro_data['image'];
        $name=$pro_data['name'];
        $slug=$pro_data['slug'];
        $decription=$pro_data['description'];
        $price=$pro_data['price'];
        $category=$pro_data['category'];    
    }
?>
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6">
                                <div class="image">
                                    <img src="<?php echo $image ?>" alt="image">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="content">
                                    <h3><a href="<?php echo $slug ?>"><?php echo $name ?></a></h3>
                                    <div class="price">
                                        <span class="new-price">$<?php echo $price ?></span>
                                    </div>
                                    <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <p><?php echo $decription ?></p>
                                    <div class="products-add-to-cart">
                                        <div class="input-counter">
                                            <span class="minus-btn" onclick="removeQuantity()"><i class='bx bx-minus'></i></span>
                                            <input type="text" value="1" id="pro_quantity" name="pro_quantity">
                                            <span class="plus-btn" onclick="addQuantity()"><i class='bx bx-plus'></i></span>
                                        </div>
                                    <button type="submit" class="default-btn addCartbtn" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $pro_id ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $name ?>" data-category=<?php echo $category ?> data-price="<?php echo $price ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $userid ?>"><a href="javascript:void(0)"><span>Add to Cart</span></a></button>
                                    <a href="checkout.php" class="default-btn success-btn checkOutbtn"><span>Check Out</span></a>    
                                </div>
                                    <?php if(isset($_SESSION['user_name'])){?>
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to wish" onclick="addTowish(this)" data-proid="<?php echo $pro_id; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $name ?>" data-category="<?php echo $category ?>" data-price="<?php echo $price ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $userid ?>" class="add-to-wishlist"><i class='bx bx-heart'></i> Add to wishlist</a>
                                    <?php }else{ ?>
                                        <a href="user.php" class="add-to-wishlist"><i class='bx bx-heart'></i> Add to wishlist</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>