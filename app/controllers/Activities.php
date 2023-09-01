<?php

class activities extends Controller
{
   public function index()
   {
      header('Location: ' . BASEURL . 'dashboard/activities');
   }
   public function addactivity()
   {
      if ($this->model('ActivityModel')->addActivities($_POST) > 0) {
         header('Location: ' . BASEURL . 'dashboard/activities');
         Flasher::setFlash('Berhasil', 'ditambahkan', 'success');
         exit;
      } else {
         Flasher::setFlash('Gagal', 'ditambahkan', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities');
         exit;
      }
   }
   public function deleteactivity($id)
   {
      if ($this->model('ActivityModel')->deleteActivity($id) > 0) {
         Flasher::setFlash('Berhasil', 'dihapus dari database', 'warning');
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
      echo json_encode($this->model('ActivityModel')->editActivity($_POST['id']));
   }
   public function updateactivity()
   {
      if ($this->model('ActivityModel')->updateActivity($_POST) > 0) {
         Flasher::setFlash('Berhasil', 'diubah', 'primary');
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
      $months = $month ?? date('F');
      $year = $year ?? date('Y');
      if ($this->model('ActivityModel')->cuteoff($months, $year) > 0) {
         Flasher::setFlash('Cute Off', 'succeed', 'success');
         header('Location: ' . BASEURL . 'dashboard/activities/' . $month . '/' . $year);
         exit;
      } else {
         Flasher::setFlash('Cute Off', 'fail', 'danger');
         header('Location: ' . BASEURL . 'dashboard/activities' . $month . '/' . $year);
         exit;
      }
   }
}
