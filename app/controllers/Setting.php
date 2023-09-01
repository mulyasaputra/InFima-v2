<?php

class Setting extends Controller
{
   public function index()
   {
      header('Location: ' . BASEURL . 'dashboard/setting');
   }

   public function updatePrint()
   {
      if ($this->model('SettingModel')->updatePrint($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'success');
         header('Location: ' . BASEURL . 'dashboard/setting/output');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'diubah', 'danger');
         header('Location: ' . BASEURL . 'dashboard/setting/output');
         exit;
      }
   }
   public function updateProfile()
   {
      // var_dump($_FILES);
      // var_dump($this->model('SettingModel')->updateProfile($_POST));
      if ($this->model('SettingModel')->updateProfile($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'success');
         header('Location: ' . BASEURL . 'dashboard/setting/profile');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'diubah', 'danger');
         header('Location: ' . BASEURL . 'dashboard/setting/profile');
         exit;
      }
   }
}
