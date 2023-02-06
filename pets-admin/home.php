<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
?>
<?php if (!empty($_SESSION['admin_is_login'])){ ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div> -->

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <!-- <p>Skote Dashboard</p> -->
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                <?php if(isset($_SESSION['admin_is_login_id']) && !empty($_SESSION['admin_is_login_id'])) {
                                        $id=$_SESSION['admin_is_login_id']; } ?>
                                <?php
                                    $stmt_post_author = $conn->prepare("SELECT count(*) FROM `product`");
                                    $stmt_post_author->execute();
                                    $total_rows_post = $stmt_post_author->fetchColumn();

                                  


?>
                                </div>

                               

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <?php
                                            $stmt_total = $conn->prepare("SELECT count(*) FROM `product`");
                                            $stmt_total->execute();
                                            $total_rows = $stmt_total->fetchColumn();
                                            ?>
                                            <p class="text-muted fw-medium"><strong>Total Product</strong></p>
                                            <h4 class="mb-0"><?php echo $total_rows ?></h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium"><strong>Total Category</strong></p>
                                            <?php
                                            $stmt_total = $conn->prepare("SELECT count(*) FROM `categories`");
                                            $stmt_total->execute();
                                            $total_rows_cat = $stmt_total->fetchColumn();
                                            ?>
                                            <h4 class="mb-0"><?php echo $total_rows_cat ?></h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                        <?php
                                            $stmt_total_author = $conn->prepare("SELECT count(*) FROM `user`");
                                            $stmt_total_author->execute();
                                            $total_rows_author = $stmt_total_author->fetchColumn();
                                            ?>
                                            <p class="text-muted fw-medium"><strong>Users</strong></p>
                                        
                                            <h4 class="mb-0"><?php echo $total_rows_author ?></h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                      
        <!-- container-fluid -->
    </div>

    <?php
    include('include/footer.php');
                                }else{
        echo "<script>window.location='http://localhost/pets-admin/index.php'</script>";
        }
    ?>