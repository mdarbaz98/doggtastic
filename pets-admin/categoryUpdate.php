<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
ini_set('display_errors', 1);
?><?php if (!empty ($_SESSION['admin_is_login'])){ ?>   
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<!--     start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between mx-4">
							<h4 class="mb-sm-0 font-size-18">Update Category</h4>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
									<li class="breadcrumb-item active">Update Category</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end page title -->
				<div class="row author-row">
					<div class="col-xl-12">
						<div class="card" style="box-shadow: rgba(17, 17, 26, 0.05) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 0px 8px;">
							<div class="card-body cat_body">
								<form id="update_category">
								    
								        <?php 
                if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM `categories` WHERE id = '$id'";   
                $stmt= $conn->prepare($sql);                               
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row_cat)
                {
					if(!empty($row_cat['img_id'])){
						$image_id=$row_cat['img_id'];
						//$post_image="https://druggist.b-cdn.net/".$post_data_image['path'];
					}else{
						  $image_id=1;
					}
					// for image get
					$select_stmtPost_img=$conn->prepare("SELECT * FROM images WHERE id='".$image_id."'");
					$select_stmtPost_img->execute();
					$post_data_image=$select_stmtPost_img->fetch(PDO::FETCH_ASSOC);
					if(!empty($post_data_image['path'])){
						$image=$post_data_image['path'];
						$alt=$post_data_image['alt'];
						}else{
						$image="https://i.ibb.co/4fz1F7f/Getty-Images-974371976.jpg";
						}
        ?>   
								    
									<div class="row">
									    
									<div class="col-lg-6">
									     <div class="form-group mt-1">
										<label for="cat">Category</label>
										<input type="text" class="form-control add_cat_inputs" id="cat" name="cat_name" value="<?php echo $row_cat['cat_name'] ?>" onkeyup="copytext_cat()"> 
                                        </div>
                                   
                					 <div class="form-group mt-4">
                                 <label class="form-label">Description</label>
                                     <textarea class="form-control" rows="6" id="description" name="cat_description"/><?php echo $row_cat['cat_desc'] ?></textarea>
                                </div>
                                        
                                    </div>
                                    
                                    <div class="mb-3 col-lg-6">
                                        <div class="form-group">
                                        <label for="cat_slug">Category Slug</label>
										<input type="text" class="form-control add_cat_inputs" id="cat_slug" name="cat_slug" value="<?php echo $row_cat['cat_slug'] ?>">   </div>
									
										<div class="form-group">
                                        <label for="cat_slug">Title</label>
										<input type="text" class="form-control add_cat_inputs" id="cat_title" name="cat_title" value="<?php echo $row_cat['cat_title'] ?>">   </div>
										
										<div class="blog-img-box mt-5" data-toggle="modal" data-target="#exampleModal"> <img src="https://spruko.com/demo/sash/sash/assets/plugins/fancyuploder/fancy_upload.png" alt="feature click image">
										<h5>Set Feature Image</h5></div>
										<input type="hidden" class="image_id" name="img_id" /> </div>
										<img src="<?php echo $image ?>" alt="" style="width:130px">
										<div class="float-right">
											<div class="customefeature_image"> <img src="" alt="" class="image_path" style="width:130px"> </div>
										</div>
										
                                     </div>
                                     
								</div>
                                     
									 
					
									<div class="submit-btns">
									
										<input type="hidden" name="old_img_id" value="<?php echo $image_id ?>">
										<input type="hidden" name="cat_id" value="<?php echo $id ?>">
										<input type="hidden" name="btn" value="updateCategory">
										<input type="submit" class="post-btn" name="category_add" value="Update">
                                     </div>
                    <?php  }	        
                        }
                    ?> 
                                     
								</form>
                            </div>
                        </div>
					</div>
							<!-- end card body -->
				</div>
						<!-- end card -->
			</div>
					<!-- end col -->
        </div>
				<!-- end card body -->
	</div>
<?php
    include('include/footer.php');
}else{
         echo "<script>window.location='https://practicalanxietysolutions.com/admin/index.php'</script>";
        }
 ?>