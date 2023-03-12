<?php
if (isset($_SESSION["user"])) {
   header('Location: ' . BASEURL . 'dashboard');
   exit;
} ?>
<section class="vh-100 d-flex flex-column">
   <div class="container-fluid flex-grow-1">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="<?= BASEURL; ?>public/assets/draw2.webp" class="img-fluid" alt="Sample image">
         </div>
         <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="" method="post">
               <!-- Email input -->
               <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />
               </div>

               <!-- Password input -->
               <div class="form-outline mb-3">
                  <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" />
               </div>

               <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <span></span>
                  <a href="#" class="text-body">Forgot password?</a>
               </div>

               <div class="text-center text-lg-start mt-4 pt-2">
                  <button type="submit" name="login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="<?= BASEURL; ?>admin/register" class="link-danger">Register</a></p>
               </div>

            </form>
         </div>
      </div>
   </div>
   <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-3 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white text-center">&copy; 2023 InFima. All rights reserved. | <a class="text-white text-decoration-none" target="_blank" href="http://insketch.rf.gd">Insketch</a></div>
      <!-- Copyright -->

      <!-- Right -->
      <div>
         <a href="#!" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
         </a>
         <a href="#!" class="text-white me-4">
            <i class="fab fa-twitter"></i>
         </a>
         <a href="#!" class="text-white me-4">
            <i class="fab fa-google"></i>
         </a>
         <a href="#!" class="text-white">
            <i class="fab fa-linkedin-in"></i>
         </a>
      </div>
      <!-- Right -->
   </div>
</section>
<div class="position-absolute" style="right: 1em; top: 1em;">
   <?php Flasher::flash(); ?>
</div>