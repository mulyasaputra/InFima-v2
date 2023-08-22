<?php

class Wallets extends Controller
{
   public function index()
   {
      header('Location: ' . BASEURL . 'dashboard/wallets');
   }
   public function deleteWallets($id)
   {
      if ($this->model('WalletsModel')->deleteWallets($id) > 0) {
         Flasher::setFlash('Berhasil', 'dihapus dari database', 'warning');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'dihapus dari database', 'danger');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      }
   }
   public function addWallets()
   {
      if ($this->model('WalletsModel')->addIncome($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'ditambahkan', 'success');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'ditambahkan', 'danger');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      }
   }
   public function edit()
   {
      echo json_encode($this->model('WalletsModel')->edit($_POST['id']));
   }
   public function updateWallets()
   {
      if ($this->model('WalletsModel')->updateWallets($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'success');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'diubah', 'danger');
         header('Location: ' . BASEURL . 'dashboard/Wallets');
         exit;
      }
   }
}
