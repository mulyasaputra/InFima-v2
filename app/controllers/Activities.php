<?php

class activities extends Controller
{
   public function index()
   {
      header('Location: ' . BASEURL . 'dashboard/activities');
   }

   public function addactivity()
   {
      if ($this->model('ActivityModel')->addactivity($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'ditambahkan', 'success');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'ditambahkan', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      }
   }
   public function deleteactivity($id)
   {
      if ($this->model('ActivityModel')->deleteactivity($id) > 0) {
         Flasher::setFlash('Berhasil', 'dihapus dari database', 'success');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'dihapus dari database', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      }
   }

   public function editactivitys()
   {
      echo json_encode($this->model('ActivityModel')->editactivity($_POST['id']));
   }

   public function updateactivity()
   {
      if ($this->model('ActivityModel')->updateactivity($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'success');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'diubah', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      }
   }


   public function cuteoff($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      if ($this->model('ActivityModel')->cuteoff($month, $year) > 0) {
         Flasher::setFlash('Cute Off', 'succeed', 'success');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      } else {
         Flasher::setFlash('Cute Off', 'fail', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      }
   }
}
