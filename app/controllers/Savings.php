<?php

class Savings extends Controller
{
   public function index()
   {
      header('Location: ' . BASEURL . 'Dashboard/savings');
   }

   public function editSpending()
   {
      echo json_encode($this->model('SavingsModel')->editSpending($_POST['id']));
   }

   public function updateSavings()
   {
      // var_dump($_POST);
      if ($this->model('SavingsModel')->updateSavings($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'success');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'diubah', 'danger');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      }
   }

   public function addSpending()
   {
      if ($this->model('SavingsModel')->addSpending($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'ditambahkan', 'success');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'ditambahkan', 'danger');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      }
   }

   public function addIncome()
   {
      if ($this->model('SavingsModel')->addIncome($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'ditambahkan', 'success');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'ditambahkan', 'danger');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      }
   }

   public function deleteSavings($id, $key)
   {
      if ($this->model('SavingsModel')->deleteSavings($id, $key) > 0) {
         Flasher::setFlash('Berhasil', 'dihapus dari database', 'warning');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'dihapus dari database', 'danger');
         header('Location: ' . BASEURL . 'Dashboard/savings');
         exit;
      }
   }
}
