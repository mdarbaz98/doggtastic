<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
?>
<?php if (!empty ($_SESSION['admin_is_login'])){ ?>
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid product_page">
				<!--     start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<div>
								<h4 class="mb-sm-0 font-size-18">Add Product</h4></div>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript: void(0);">Blog</a></li>
									<li class="breadcrumb-item active">Add Product</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end page title -->
				<form id="updateProduct">
				<?php 
                $stmt= $conn->prepare("SELECT * FROM `product` WHERE id=?");                               
                $stmt->execute([$_GET['id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                { ?>
					<div class="row">
						<div class="card">
							<!-- <div class="header">
								<h4 class="card-title mb-4">Features</h4> </div> -->
							<div class="card-body">
								<div class="d-flex  my-4">
									<div class="form-group mx-3  w-100">
										<label for="Title" class="form-label"> Product Name</label>
										<input type="text" class="form-control " id="pro_name"  name="pro_name" value="<?php echo $row['name'] ?>" > </div>
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input">Product Slug</label>
										<input type="text" class="form-control" id="slug" name="slug" value="<?php echo $row['slug'] ?>"> </div>
									</div>
								<div class="d-flex my-4">
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Price</label>
										<input type="text" class="form-control" id="prc" name="prc" value="<?php echo $row['price'] ?>">
									</div>
									<div class="form-group ml-3 w-100">
										<label class="form-label"> Select Category </label>
										<?php $stmt = $conn->prepare("SELECT * FROM `categories`");
            							$stmt->execute();
            							$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        									?>
											<select class="form-control sel_cat" id="category" name="category" title="Please select Category">
												<option value="">Pick a Category... </option>
												<?php foreach ($data as $data) {
            									?>
													<option value="<?php echo $data['cat_slug']; ?>" <?php if ($data['cat_slug']==$row['category']) echo ' selected="selected"'; ?> >
														          <?php echo $data['cat_name']; ?>
													</option>
													<?php } ?>
											</select>
									</div>
									
								</div>
								
								<div class="d-flex mt-4">
								
							<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Description</label>
										<textarea class="form-control" id="" name="discription" cols="15" rows="5"><?php echo $row['description'] ?></textarea>
							  		</div>
									<div class="form-group w-100 m-5">
										<label for="horizontal-firstname-input" class="col-form-label">Image Link</label>
										<input type="text" class="form-control" id="image_link" name="image_link" value="<?php echo $row['image'] ?>">
										<img src="<?php echo $row['image'] ?>" class="custome_img">
									</div>
							</div>
						
									
				<div class="submit-btns clearfix d-flex">           
				<input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="btn" value="updateProduct">
                <input type="submit" class="post-btn float-left ml-4" name="blog_publish" value="Publish">
                <!-- <button class="discard-btn" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i>Discard</button> -->
                </div>
				
     
							</div>
						</div>
					</div>
					<!-- end card body -->
					<?php } ?>
				</form>
			</div>
			<!-- end card -->
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->
	</div>
	<!-- container-fluid -->
	</div>
	<!-- End Page-content -->
	<script>
	function blog_img_pathUrl(input) {
		$('#blog-img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
	}
	</script>
	<?php
    include('include/footer.php');
						}else{
	echo "<script>window.location='http://localhost/admin/index.php'</script>";
	}
 ?>