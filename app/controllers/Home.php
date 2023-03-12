<?php

class Home extends Controller
{
   public function index()
   {
      $this->view('layout/header', ['title' => 'InFima | Home']);
      $this->view('home');
      $this->view('layout/footer');
   }
}
