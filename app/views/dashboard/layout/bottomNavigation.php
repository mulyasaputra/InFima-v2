<section id="BottomNavigation">
   <ul class="BottomNav-links">
      <li class="<?= $data['dashboard'] ?? '' ?>"><a href="<?= BASEURL . $Dashboard['link']; ?>"><i class="uil uil-<?= $Dashboard['icon']; ?>"></i><span class="BottomNav-link-name"><?= $Dashboard['name']; ?></span></a></li>
      <li class="<?= $data['analytics'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Analytics['link']; ?>"><i class="uil uil-<?= $Analytics['icon']; ?>"></i><span class="BottomNav-link-name"><?= $Analytics['name']; ?></span></a></li>
      <li class="<?= $data['activities'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Activities['link']; ?>"><i class="uil uil-<?= $Activities['icon']; ?>"></i><span class="BottomNav-link-name"><?= $Activities['name']; ?></span></a></li>
      <li class="<?= $data['wallets'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Wallets['link']; ?>"><i class="uil uil-<?= $Wallets['icon']; ?>"></i><span class="BottomNav-link-name"><?= $Wallets['name']; ?></span></a></li>
      <li class="<?= $data['savings'] ?? '' ?>"><a href="<?= BASEURL . 'Dashboard/' . $Savings['link']; ?>"><i class="uil uil-<?= $Savings['icon']; ?>"></i><span class="BottomNav-link-name"><?= $Savings['name']; ?></span></a></li>
   </ul>
</section>