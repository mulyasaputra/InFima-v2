<?php

class DashboardModel
{
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }
   public function getActivity()
   {
      $auth = $_SESSION['user']["key"];
      $month = date('n');
      $year = date('Y');
      $last = $this->get->previousMonth($month, $year);

      // $wallets = 'SELECT SUM(CASE WHEN id_user = :user THEN nominal ELSE 0 END) as wallet FROM wallets WHERE MONTH(date) = :month AND YEAR(date) = :year';
      // $activity = 'SELECT SUM(CASE WHEN id_user = :user THEN nominal ELSE 0 END) as expenditure FROM activity WHERE MONTH(dates) = :month AND YEAR(dates) = :year';
      // $query1 = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as Income, SUM(CASE WHEN type = false THEN nominal ELSE 0 END) as Spending FROM savings WHERE id_user= :user AND YEAR(date) = :year';
      $activity = 'SELECT * FROM activity WHERE id_user= :user AND YEAR(dates) = :year';
      $wallets = 'SELECT * FROM wallets WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $record = 'SELECT blance FROM record WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $savings = 'SELECT date, type, nominal FROM savings WHERE id_user= :user';

      // Expenditure
      $this->db->query($activity);
      $this->db->bind('user', $auth);
      $this->db->bind('year', $year);
      $expenditure = $this->db->resultSet();

      // Wallets
      $this->db->query($wallets);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $wallet = $this->db->resultSet();

      // Record
      $this->db->query($record);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $last[0]);
      $this->db->bind('year', $last[1]);
      $records = $this->db->fetchColumn();

      // Savings
      $this->db->query($savings);
      $this->db->bind('user', $auth);
      $saving = $this->db->resultSet();

      // Return
      return ['expenditure' => $expenditure, 'wallet' => $wallet, 'records' => $records, 'saving' => $saving];
   }
}
