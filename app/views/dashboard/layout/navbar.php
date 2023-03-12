<nav>
   <div class="logo-name">
      <div class="logo-image">
         <img src="<?= BASEURL; ?>public/assets/logo.png" alt="">
      </div>

      <span class="logo_name">InFima</span>
   </div>

   <div class="menu-items">
      <ul class="nav-links">
         <li class="<?= $data['dashboard'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard">
               <i class="uil uil-estate"></i>
               <span class="link-name">Dahsboard</span>
            </a></li>
         <li class="<?= $data['activities'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard/activities">
               <i class="uil uil-files-landscapes"></i>
               <span class="link-name">Activities</span>
            </a></li>
         <li class="<?= $data['savings'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard/savings">
               <i class="uil uil-credit-card"></i>
               <span class="link-name">Savings</span>
            </a></li>
         <li class="<?= $data['analytics'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard/analytics">
               <i class="uil uil-comparison"></i>
               <span class="link-name">Analytics</span>
            </a></li>
         <li class="<?= $data['wallets'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard/wallets">
               <i class="uil uil-wallet"></i>
               <span class="link-name">Wallets</span>
            </a></li>
         <li class="<?= $data['setting'] ?? '' ?>"><a href="<?= BASEURL; ?>dashboard/setting">
               <i class="uil uil-setting"></i>
               <span class="link-name">Setting</span>
            </a></li>
      </ul>

      <ul class="logout-mode">
         <li>
            <div class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#logout" style="cursor: pointer;">
               <i class="uil uil-signout"></i>
               <span class="link-name">Logout</span>
            </div>
         </li>

         <li class="mode">
            <a href="#">
               <i class="uil uil-moon"></i>
               <span class="link-name">Dark Mode</span>
            </a>

            <div class="mode-toggle">
               <span class="switch"></span>
            </div>
         </li>
      </ul>
   </div>
</nav>

<section class="dashboard">
   <div class="top">
      <i class="uil uil-bars sidebar-toggle"></i>

      <div class="search-box">
         <i class="uil uil-search"></i>
         <input type="text" placeholder="Search here...">
      </div>

      <div class="btn-group">
         <img data-bs-toggle="dropdown" aria-expanded="false" src="<?= BASEURL; ?>public/assets/profile.jpg" alt="">
         <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= BASEURL; ?>dashboard/profile">Profile</a></li>
            <li><a class="dropdown-item" href="<?= BASEURL; ?>dashboard/setting">Setting</a></li>
            <li><a class="dropdown-item" href="<?= BASEURL; ?>dashboard/wallets">Wallets</a></li>
            <li>
               <hr class="dropdown-divider">
            </li>
            <li>
               <div class="dropdown-item d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#logout" style="cursor: pointer;">
                  <i class="uil uil-signout"></i>
                  <span class="link-name">Logout</span>
               </div>
            </li>
         </ul>
      </div>
   </div>