<?php include 'parts/shared/html-header.php'; ?>
<?php include 'parts/shared/header.php'; ?>




<section class="contact-form section-gap bg-grey-light-three ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="axil-contact-form-block m-b-xs-30">
                    <div class="section-title d-block">
                        <h2 class="h3 axil-title">
                            Send Us a Message
                        </h2>
                    </div>
                    <!-- End of .section-title -->

                    <div class="axil-contact-form-wrapper p-t-xs-10">
                        <form class="axil-contact-form row no-gutters">

                            <div class="form-group col-12">
                                <label for="contact-name">Name</label>
                                <input type="text" name="contact-name" id="contact-name">
                            </div>

                            <div class="form-group col-12">
                                <label for="contact-phone">Phone</label>
                                <input type="text" name="contact-phone" id="contact-phone">
                            </div>

                            <div class="form-group col-12">
                                <label for="contact-email">Email</label>
                                <input type="email" name="contact-email" id="contact-email">
                            </div>

                            <div class="form-group col-12">
                                <label for="contact-message">Message</label>
                                <textarea name="contact-message" id="contact-message"></textarea>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary m-t-xs-0 m-t-lg-20">SUBMIT</button>
                            </div>
                        </form>
                        <!-- End of .axil-contact-form -->
                    </div>
                    <!-- End of .axil-contact-form-wrapper -->
                </div>
                <!-- End of .axil-contact-form-block -->
            </div>
            <!-- End of .col-lg-6 -->

            <div class="col-lg-5">
                <div class="axil-contact-info-wrapper p-l-md-45 m-b-xs-30">
                    <div class="axil-contact-info-inner">
                        <h2 class="h4 m-b-xs-10">
                            Contact Information
                        </h2>
                        <div class="axil-contact-info">
                            <address class="address">
                                <p class="mid m-b-xs-30">Byline Gulf FZE,<br>Dubai, UAE</p>

                                <div class="h5 m-b-xs-10">For inquiries and collaborations, contact us.</div>
                                <div>
                                    <a class="tel" href="tel:+971521142984"><i class="fas fa-phone"></i>+971 521142984</a>
                                </div>
                                <div>
                                    <a class="tel" href="tel:+971581786840"><i class="fas fa-phone"></i>+971 581786840</a>
                                </div>
                                <div>
                                    <a class="tel" href="mailto:bylinegulf@gmail.com"><i class="fas fa-envelope"></i>bylinegulf@gmail.com</a>
                                </div>
                            </address>
                            <div class="contact-social-share m-t-xs-30">
                                <div class="axil-social-title h5">Follow Us</div>
                                <ul class="social-share social-share__with-bg">
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of .row -->
    </div>
    <!-- End of .container -->
</section>
<!-- End of .contact-form -->

<section>
    <div class="container">
        <div class="section-title m-b-xs-20">
            <h2 class="axil-title">
                Our Location
            </h2>
        </div>
        <!-- End of .section-title -->

        <div class="axil-map-wrapper m-b-xs-30">
            <iframe
                src="https://maps.google.com/maps?q=Dubai%2C%20UAE&t=&z=12&ie=UTF8&iwloc=&output=embed"
                width="600" height="450" class="iframe-no-border" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- End of .axil-map-wrapper -->
    </div>
    <!-- End of .container -->
</section>
<!-- End of .our-location -->

<?php include 'parts/shared/footer.php'; ?>
<?php include 'parts/shared/html-footer.php'; ?>