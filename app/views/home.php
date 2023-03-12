<!-- Navbar -->
<style>
   .navbar-brand {
      font-family: "Fugaz One", cursive;
   }

   .logo-brand-suport img {
      filter: grayscale(100%);
      transition: all .5s ease-in-out;
   }

   .logo-brand-suport img:hover {
      filter: grayscale(0);
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<nav class="bg-red-babbel position-sticky top-0 container-fluid z-1">
   <div class="container navbar ">
      <div class="navbar-brand text-white">InFima</div>
      <div>
         <ul class="nav justify-content-center">
            <li class="nav-item">
               <a class="nav-link text-white" href="#">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" href="#About">About</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" href="#">Link</a>
            </li>
         </ul>
      </div>
      <div class="nav-item">
         <a href="<?= BASEURL; ?>admin" class="text-decoration-none text-capitalize text-white">get started <i class="fa-solid fa-arrow-right"></i></i></a>
      </div>
   </div>
</nav>
<!-- Dashboard -->
<div class="container vh-xl-100 d-flex align-items-center">
   <div class="row py-5 mb-5 mt-md-5 flex-column-reverse flex-md-row">
      <div class="col-12 col-md-8 text-center text-md-start d-xl-flex justify-content-xl-center flex-xl-column">
         <h2>Welcome to <br />Insketch manager</h2>
         <p>Your best finance managing platform <br />
            Business financial bookkeeping will be easier only with InFima, InFima is an application that is suitable for
            those of you who want to know daily, monthly and even yearly financial spending activities.
         </p>
         <button class="btn bg-red-babbel mt-4 fit-content"><a class="text-white text-decoration-none text-capitalize" href="<?= BASEURL; ?>admin">get started now</a></button>
      </div>
      <div class="m-auto col-8 col-md-4 mb-5 m-md-0"><img width="100%" src="<?= BASEURL; ?>public/assets/home.webp" /></div>
   </div>
</div>
<!-- Brand -->
<section class="bg-dark">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
         <div class="col-12 col-sm-4 col-md-3 col-lg-2 logo-brand-suport"><img class="w-100" src="public/assets/babbel.png" alt="brand"></div>
      </div>
   </div>
</section>
<!-- about -->
<section class="container my-5" id="About">
   <div class="row py-5">
      <div class="d-none d-lg-inline col-lg-5">
         <div class="shadow rounded rounded-4"><img class="ratio ratio-1x1" src="public/assets/babbel.png" alt=""></div>
      </div>
      <div class="col-lg-7 ps-lg-5">
         <h5 class="mb-0">About Us</h5>
         <h2>InSketch Finance Managing</h2>
         <p class="fs-5">InFima is a website platform designed to assist you in easily and efficiently recording your financial income and expenses. With its comprehensive features, you can manage your personal or business finances better and more organized. InFima also provides clear and accurate financial reports, allowing you to make wiser financial decisions. Join InFima now to take better control of your finances and achieve greater financial success!</p>
      </div>
   </div>
</section>
<!-- Pricing -->
<section class="my-5 bg-light">
   <div class="container py-5">
      <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
         <h1 class="display-4 fw-normal">Pricing</h1>
         <p class="fs-5 text-muted">Just ignore this section, because this website is 100% free for everyone, but if curious can be read</p>
      </div>
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 mb-3 text-center justify-content-center">
         <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
               <div class="card-header py-3">
                  <h4 class="my-0 fw-normal">Free</h4>
               </div>
               <div class="card-body">
                  <h1 class="card-title pricing-card-title">$0</h1>
                  <ul class="list-unstyled mt-3 mb-4">
                     <li>Print to PDF & CSV</li>
                     <li>Change paper size</li>
                     <li>Automatic cut off</li>
                     <li>Color theme mode</li>
                  </ul>
                  <a href="admin" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</a>
               </div>
            </div>
         </div>
         <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
               <div class="card-header py-3">
                  <h4 class="my-0 fw-normal">Pro</h4>
               </div>
               <div class="card-body">
                  <h1 class="card-title pricing-card-title">$1</h1>
                  <ul class="list-unstyled mt-3 mb-4">
                     <li>There are no other features</li>
                     <li>Only to support me</li>
                     <li>to develop</li>
                     <li>other features</li>
                  </ul>
                  <a href="#" class="w-100 btn btn-lg btn-primary">Contact Me</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Contact & Addres -->
<section class="container my-5">
   <div class="row py-3">
      <div class="contact col-12 col-lg-6">
         <h5 class="mb-0">Contact Us</h5>
         <h2>Send us a email</h2>
         <form action="#" method="post" class="mt-4">
            <div class="row">
               <div class="mb-3 col-12 col-sm-6">
                  <label for="Name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="Name" placeholder="Your name">
               </div>
               <div class="mb-3 col-sm-6">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com">
               </div>
            </div>
            <div class="mb-3">
               <label for="body" class="form-label">Message</label>
               <textarea class="form-control" id="body" rows="3"></textarea>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mt-2 btn bg-red-babbel text-white px-5" style="font-size: 1.2em;">Send</button>
         </form>
      </div>
      <div class="address col-lg-6 mt-5 mt-lg-0">
         <h5 class="mb-0">Address</h5>
         <h2>Contact Info</h2>
         <p class="mt-4">If you have any questions, suggestions, or criticisms, please feel free to contact us via email at screative010@gmail.com. <br> Thank you.</p>
         <hr class="sidebar-divider">
         <div class="ds-main-contact">
            <div class="ds-left-col2">
               <h5 class="fs-6"><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;Address :</h5>
            </div>
            <div class="ds-right-col2">
               <p>Jalan Kolonel Sunandar Gang 5 Pati, Jawa Tengah - Indonesia 59112</p>
            </div>
         </div>
         <div class="ds-main-contact">
            <div class="ds-left-col2">
               <h5 class="fs-6"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;Phone :</h5>
            </div>
            <div class="ds-right-col2">
               <p>+62 815 1234 4321</p>
            </div>
         </div>
         <div class="ds-main-contact">
            <div class="ds-left-col2">
               <h5 class="fs-6"><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;Email :</h5>
            </div>
            <div class="ds-right-col2">
               <p>screative010@gmail.com</p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Footer -->
<footer>
   <div class="footer-top text-white text-center bg-dark py-5">
      <h2>InFima</h2>
      <p>Track every penny, plan for a better future with us.</p>
      <div class="d-flex w-100 gap-3 justify-content-center mt-4">
         <a class="text-white" target="_blank" href="https://www.instagram.com/appsventory/"><i class="fa-brands fa-instagram"></i></a>
         <a class="text-white" target="_blank" href="https://www.youtube.com/@Appsventory/"><i class="fa-brands fa-youtube"></i></a>
         <a class="text-white" target="_blank" href="mailto:screative010@gmail.com"><i class="fa-regular fa-envelope"></i></a>
         <a class="text-white" target="_blank" href="https://www.tiktok.com/@appsventory"><i class="fa-brands fa-tiktok"></i></a>
      </div>
   </div>
   <div class="footer-bottom text-white py-3 text-center" style="background-color: #111;">&copy; 2023 InFima. All rights reserved. | <a class="text-white text-decoration-none" target="_blank" href="http://insketch.rf.gd">Insketch</a></div>
</footer>

<!-- scroll-to-top -->
<div id="scroll-to-top" animate-show="bottom-right" animate-rotate="true" show="100"><i class="fa-solid fa-angle-up"></i></div>
<!-- ModalBox -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Message</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            This form still cannot be used by anyone including me
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>