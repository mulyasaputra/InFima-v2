<?php
if (isset($_SESSION["user"])) {
   header('Location: ' . BASEURL . 'dashboard');
   exit;
} ?>
<section class="vh-100 d-flex flex-column">
   <div class="container-fluid flex-grow-1">
      <div class="row d-flex justify-content-center align-items-center h-100">
         <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form action="" method="post">
               <!-- Name input -->
               <div class="form-outline mb-4">
                  <label class="form-label" for="Name">Name</label>
                  <input type="text" id="Name" name="Name" class="form-control form-control-lg" placeholder="Your name" required />
               </div>
               <!-- Username input -->
               <div class="form-outline mb-4">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Enter a username" required />
               </div>
               <!-- Email input -->
               <div class="form-outline mb-4">
                  <label class="form-label" for="email">Email address</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Enter a valid email address" required />
               </div>
               <!-- Password input -->
               <div class="row row-cols-2">
                  <div class="form-outline mb-3">
                     <label class="form-label" for="password">Password</label>
                     <input type="password" id="password" name="password" class="form-control form-control-lg" min="6" placeholder="Enter password" required />
                  </div>
                  <div class="form-outline mb-3">
                     <label class="form-label" for="password2">Password confirmation</label>
                     <input type="password" id="password2" name="password2" class="form-control form-control-lg" min="6" placeholder="Confirmation" required />
                  </div>
               </div>
               <div class="text-center text-lg-start mt-4 pt-2">
                  <button name="register" type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Have an account? <a href="<?= BASEURL; ?>admin" class="link-danger">Login</a></p>
               </div>

            </form>
         </div>
         <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="<?= BASEURL; ?>public/assets/draw2.webp" class="img-fluid" alt="Sample image">
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