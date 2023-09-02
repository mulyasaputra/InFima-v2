<?php

class Dashboard extends Controller
{
   public function index()
   {
      if (!isset($_SESSION['Record'])) {
         $_SESSION['Record'] = $this->model('DashboardModel')->getRecord();
      }

      $this->view('dashboard/layout/header', ['title' => 'Dashboard', 'dashboard' => 'active']);
      $this->view('dashboard/index', [
         'Expenditure' => $this->model('DashboardModel')->getExpenditure(),
         'Revenue' => $this->model('DashboardModel')->getRevenue(),
         'Savings' => $this->model('DashboardModel')->getSavings(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function activities($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Activities', 'activities' => 'active']);
      $this->view('dashboard/activities', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('ActivityModel')->getActivity($month, $year),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function savings($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Savings', 'savings' => 'active']);
      $this->view('dashboard/savings', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('SavingsModel')->getSavings($month, $year),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function analytics()
   {
      $this->view('dashboard/layout/header', ['title' => 'Analytics', 'analytics' => 'active']);
      $this->view('dashboard/analytics', [
         'data' => $this->model('AnalyticsModel')->getAnalytics(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function wallets($month = null, $year = null)
   {
      $month = $month ?? date('F');
      $year = $year ?? date('Y');
      $this->view('dashboard/layout/header', ['title' => 'Wallets', 'wallets' => 'active']);
      $this->view('dashboard/wallets', [
         'month' => $month,
         'year' => $year,
         'data' => $this->model('WalletsModel')->getWallets($month, $year),
         'data2' => $this->model('WalletsModel')->getDataRS(),
      ]);
      $this->view('dashboard/layout/footer');
   }
   public function setting($val = 'account')
   {
      $this->view('dashboard/layout/header', ['title' => 'Setting', 'setting' => 'active']);
      $this->view('dashboard/setting', [
         'select' => $val,
         'data' => $this->model('SettingModel')->getDataaaa(),
      ]);
      $this->view('dashboard/layout/footer');
   }
}
