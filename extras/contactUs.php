<!DOCTYPE html>
<html lang="en">
<?php
include '../components/header.php';
?>
<body>
<div id="content">
    <?php
    include '../components/navbar.php';
    ?>
    <div id="contactBox" class="container col-8 pt-5">
    
        <section class="mb-4">

            <h2 class="h1-responsive font-weight-bold text-center text-warning pacifico my-4">Contact us</h2>
            <hr>

            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
            a matter of hours to help you.</p>

            <div class="row">

                <div class="col-md-9 mb-md-0 mb-5">
                    <form id="contact-form" name="contact-form" action="mail.php" autocomplete="off" method="POST">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="md-form mb-5">
                                    <label for="name" class="">Your name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                    
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="md-form mb-5">
                                    <label for="email" class="">Your email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                    
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-5">
                                    <label for="subject" class="">Subject</label>
                                    <input type="text" id="subject" name="subject" class="form-control">
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">

                            <div class="col-md-12">

                                <div class="md-form mb-5">
                                    <label for="message">Your message</label>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                
                    </form>

                    <div class="text-center text-md-left d-flex justify-content-center">
                        <a href="successContact.php" class="btn btn-warning text-dark">Send</a>
                    </div>
                    <div class="status"></div>
                </div>

                <div class="col-md-3 text-center">
                    <ul class="list-unstyled mb-0">
                        <li><i class="fas fa-map-marker-alt fa-2x"></i>
                            <p>Riesenradplatz 1,<br> 1020 Vienna,<br> Austria</p>
                        </li>

                        <li><i class="fas fa-phone mt-4 fa-2x"></i>
                            <p>+ 01 234 567 89</p>
                        </li>

                        <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                            <p>shopology@lcd_team.com</p>
                        </li>
                    </ul>
                </div>

            </div>

        </section>
    </div>
</div>
<?php
include '../components/footer.php';
?>
</body>
</html>
