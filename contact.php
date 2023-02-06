<?php include('./include/header.php') ?>
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">

                </div>
            </div>
        </div>
        <!-- End Page Title Area -->
        <!-- Start Contact Us Area -->
        <div class="contact-area pt-100 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="contact-form">
                            <h3>Get In Touch</h3>
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label>Your Name</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label>Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label>Subject</label>
                                            <input type="text" name="msg_subject" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group mb-3">
                                            <label>Message...</label>
                                            <textarea name="message" id="message" class="form-control" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input type="submit" name="btn" class="btn btn-success" value="submit" />
                                        <!--<button type="submit" class="default-btn"><span>Send Message</span></button>-->
                                        <input type="hidden" name="btn" value="add_inquery_details"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="contact-info">
                            <h3>Contact Information</h3>
                            <ul>
                                <li><span>Hotline:</span> <a href="tel:+1415-800-3867">+14158003867</a></li>
                                <li><span>Email:</span> <a href=" support@doggtasticadventures.com"> support@doggtasticadventures.com</a></li>
                                <li><span>Address:</span> 555 Eddy St, Apt 24, San Francisco CA 94109</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Us Area -->

    <?php include('./include/footer.php') ?>