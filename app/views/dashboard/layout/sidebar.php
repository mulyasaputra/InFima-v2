<nav id="sidebar" class="d-block">
   <div class="logo">
      <div class="logo-image"><img src="<?= BASEURL; ?>public/assets/logo.png" alt="logo-image"></div>
      <span class="logo-name">InFima</span>
   </div>
   <div class="menu-items">
      <ul class="nav-links">
         <li class="<?= $data['dashboard'] ?? '' ?>"><a href="<?= BASEURL . $Dashboard['link']; ?>"><i class="uil uil-<?= $Dashboard['icon']; ?>"></i><span class="link-name"><?= $Dashboard['name']; ?></span></a></li>
         <li class="<?= $data['activities'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Activities['link']; ?>"><i class="uil uil-<?= $Activities['icon']; ?>"></i><span class="link-name"><?= $Activities['name']; ?></span></a></li>
         <li class="<?= $data['savings'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Savings['link']; ?>"><i class="uil uil-<?= $Savings['icon']; ?>"></i><span class="link-name"><?= $Savings['name']; ?></span></a></li>
         <li class="<?= $data['analytics'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Analytics['link']; ?>"><i class="uil uil-<?= $Analytics['icon']; ?>"></i><span class="link-name"><?= $Analytics['name']; ?></span></a></li>
         <li class="<?= $data['wallets'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Wallets['link']; ?>"><i class="uil uil-<?= $Wallets['icon']; ?>"></i><span class="link-name"><?= $Wallets['name']; ?></span></a></li>
         <li class="<?= $data['setting'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Setting['link']; ?>"><i class="uil uil-<?= $Setting['icon']; ?>"></i><span class="link-name"><?= $Setting['name']; ?></span></a></li>
      </ul>
      <ul class="logout-mode">
         <li class="user-select-none">
            <div class="d-flex" data-bs-toggle="modal" data-bs-target="#Logout"><i class="uil uil-signout"></i><span class="link-name">Logout</span></div>
         </li>
         <li class="mode user-select-none">
            <div class="d-flex"><i class="uil uil-moon thames-icon"></i><span class="link-name thames-name">Dark Mode</span></div>
            <div class="mode-toggle"><span class="switch"></span></div>
         </li>
      </ul>
   </div>
</nav>