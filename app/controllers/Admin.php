<?php

class Admin extends Controller
{
   public function index()
   {

      if (isset($_POST["login"])) {
         if ($this->model('AuthModel')->login($_POST)) {
            header('Location: ' . BASEURL . 'dashboard');
            exit;
         } else {
            header('Location: ' . BASEURL . 'admin');
            $_SESSION['login'] = true;
            exit;
         }
      }
      $this->view('layout/header', ['title' => 'InFima | Login']);
      $this->view('auth/login');
      $this->view('layout/footer');
   }
   public function register()
   {
      if (isset($_POST["register"])) {
         if ($this->model('AuthModel')->register($_POST)) {
            Flasher::setInfo('Berhasil', 'dibuat', 'success');
            header('Location: ' . BASEURL . 'admin');
            exit;
         } else {
            Flasher::setInfo('Gagal', 'dibuat', 'danger');
            header('Location: ' . BASEURL . 'admin/register');
            exit;
         }
      }
      $this->view('layout/header', ['title' => 'InFima | Register']);
      $this->view('auth/register');
      $this->view('layout/footer');
   }
   public function logout()
   {
      session_start();
      session_unset();
      session_destroy();
      header("Location: " . BASEURL);
      exit;
   }
}
