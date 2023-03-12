<?php

class About extends Controller
{
   public function index()
   {
      $data['user'] = $this->model('UsersModel')->getAllUsers();
      $this->view('about', $data);
   }

   public function page()
   {
      $this->view('page');
   }
}
