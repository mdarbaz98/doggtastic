<?php include('./include/header.php') ?>

        <!-- Start Profile Authentication Area -->
        <div class="profile-authentication-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="login-form">
                            <h2>Login</h2>
                            <form id="userLogin">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 remember-me-wrap">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-me">
                                            <label class="form-check-label" for="remember-me">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 lost-your-password-wrap">
                                        <a href="#" class="lost-your-password">Lost your password?</a>
                                    </div>
                                </div>
                                <input type="hidden" name="btn" value="userlogin"/>
                                <button type="submit">Log In</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="register-form">
                            <h2>Register</h2>
                            <form id="userRegistration">
                                
                            <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" id="email_validate">
                                                                                <div class="validate_email"></div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <!--<input type="text" name="phone" class="form-control" placeholder="Enter Phone">-->
                                    <input class="form-control tel mobile_verify numberonly" maxlength="10" type="tel" name="leyka_donor_phone" inputmode="tel" value="" id="telephone">
                                            <div class="validate_phone"></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Password">
                                </div>
                                <input type="hidden" name="btn" value="addRegisteruser"/>
                                <button type="submit">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Profile Authentication Area -->

        <?php include('./include/footer.php') ?>