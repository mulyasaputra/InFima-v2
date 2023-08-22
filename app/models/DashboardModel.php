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
   public function getExpenditure()
   {
      $auth = $_SESSION['user']["key"];
      $query = 'SELECT * FROM activity WHERE id_user= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $allData = $this->db->resultSet();
      $thisData = $this->get->thisViews($allData, date('m'), date('Y'));
      $thisYears = $this->get->thisViews($allData, 0, date('Y'));
      return [$thisYears, $thisData];
   }
   public function getRevenue()
   {
      $auth = $_SESSION['user']["key"];
      $query = 'SELECT * FROM wallets WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $this->db->bind('month', date('n'));
      $this->db->bind('year', date('Y'));
      return $this->db->resultSet();
   }
   public function getSavings()
   {
      $auth = $_SESSION['user']["key"];
      // $query = 'SELECT * FROM savings WHERE id_user= :user';
      $query = 'SELECT SUM(CASE WHEN type = 1 THEN nominal ELSE 0 END) - SUM(CASE WHEN type = 0 THEN nominal ELSE 0 END) AS blance FROM savings WHERE id_user= :user';
      $savings = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as results FROM savings WHERE id_user= :user AND YEAR(date) = :year AND MONTH(date) = :month ';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $blance = $this->db->single();

      $this->db->query($savings);
      $this->db->bind('user', $auth);
      $this->db->bind('month', date('n'));
      $this->db->bind('year', date('Y'));
      $results = $this->db->single();

      return [$blance, $results];
   }
   public function getRecord()
   {
      $auth = $_SESSION['user']["key"];
      $last = $this->get->previousMonth(date('n'), date('Y'));
      $record = 'SELECT SUM(blance) AS blance FROM record WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';

      $this->db->query($record);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $last[0]);
      $this->db->bind('year', $last[1]);
      return $this->db->fetchColumn();
   }
}
