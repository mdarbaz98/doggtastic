<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
ini_set('display_errors', 1);
?>
<?php if (!empty ($_SESSION['admin_is_login'])){ ?>   
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<!--     start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between mx-4">
							<h4 class="mb-sm-0 font-size-18">Add Category</h4>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
									<li class="breadcrumb-item active">Add Category</li>
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
								<form id="add_category">
									<div class="row">
									    
									<div class="col-lg-6">
									     <div class="form-group mt-1">
										<label for="cat">Add Category</label>
										<input type="text" class="form-control add_cat_inputs" id="cat" name="cat_name" placeholder="Enter Category" onkeyup="copytext_cat()"> 
                                        </div>
                                        
                                     
                					 <div class="form-group">
                                 <label class="form-label">Description</label>
                                     <textarea class="form-control" rows="6" id="description" name="cat_description" placeholder="Type a description here..."></textarea>
                                </div>
                                        
                                    </div>
                                    
                                    <div class="mb-3 col-lg-6">
                                        <div class="form-group">
                                        <label for="cat_slug">Category Slug</label>
										<input type="text" class="form-control add_cat_inputs" id="cat_slug" name="cat_slug" placeholder="Category Slug">   </div>
									
										<div class="form-group">
                                        <label for="cat_slug">Add Title</label>
										<input type="text" class="form-control add_cat_inputs" id="cat_title" name="cat_title" placeholder="Category Title">   </div>
										
										<div class="blog-img-box mt-5" data-toggle="modal" data-target="#exampleModal"> <img src="https://spruko.com/demo/sash/sash/assets/plugins/fancyuploder/fancy_upload.png" alt="feature click image">
										<h5>Set Feature Image</h5> </div>
										<input type="hidden" class="image_id" name="img_id" /> </div>
										<div class="float-right">
											<div class="customefeature_image"> <img src="" alt="" class="image_path"> </div>
										</div>
										
                                     </div>
                                     
								</div>
                                     
									 
					
									<div class="submit-btns justify-content-end">
										<input type="hidden" name="btn" value="addCategory">
										<input type="submit" class="post-btn float-right justify-content-center" name="category_add" value="Add">
                                     </div>
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