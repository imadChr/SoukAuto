<section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="assets/img/signin-image.jpg" alt="sing up image"></figure>
                    <a href="index.php?action=signup" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">
                    <h2 class="form-title">Sign in تسجيل الدخول</h2>
                    <form method="POST" action='index.php?action=do_login' class="register-form" id="login-form">
                    <?php if (isset($vars['error_message'])){ ?><b style="color:red;"><?php echo $vars['error_message'] ?></b> <?php } ?>
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="your_name" placeholder="<?php echo LANG_EMAIL;?>"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="your_pass" placeholder="<?php echo LANG_PASSWORD;?>"/>
                        </div>
                       
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>