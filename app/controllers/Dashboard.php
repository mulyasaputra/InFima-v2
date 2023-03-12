<?php

class Dashboard extends Controller
{
   public function index()
   {
      $this->view('dashboard/layout/header', ['title' => 'Dashboard']);
      $this->view('dashboard/layout/navbar', ['dashboard' => 'active']);
      $this->view('dashboard/index', [
         'money' => $this->model('DashboardModel')->getActivity(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function activities($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Activities']);
      $this->view('dashboard/layout/navbar', ['activities' => 'active']);
      $this->view('dashboard/activities', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('ActivityModel')->getActivity($month, $year),
         'getYears' => $this->model('ActivityModel')->getYears(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function savings($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Savings']);
      $this->view('dashboard/layout/navbar', ['savings' => 'active']);
      $this->view('dashboard/savings', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('SavingsModel')->getSavings($month, $year),
         'nominal' => $this->model('SavingsModel')->getNominal($year),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function analytics()
   {
      $this->view('dashboard/layout/header', ['title' => 'Analytics']);
      $this->view('dashboard/layout/navbar', ['analytics' => 'active']);
      $this->view('dashboard/analytics');
      $this->view('dashboard/layout/footer');
   }
   public function wallets($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Wallets']);
      $this->view('dashboard/layout/navbar', ['wallets' => 'active']);
      $this->view('dashboard/wallets', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('WalletsModel')->getWallets($month, $year),
         'data2' => $this->model('WalletsModel')->getdata($month, $year),
         'getYears' => $this->model('WalletsModel')->getYears(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function setting()
   {
      $this->view('dashboard/layout/header', ['title' => 'Setting']);
      $this->view('dashboard/layout/navbar', ['setting' => 'active']);
      $this->view('dashboard/setting');
      $this->view('dashboard/layout/footer');
   }
}
