<?php

class AnalyticsModel
{
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }
   public function getAnalytics()
   {
      // Query
      $activity = 'SELECT * FROM activity WHERE id_user= :user';
      $record = 'SELECT * FROM record WHERE id_user= :user';
      $saving = 'SELECT * FROM savings WHERE id_user= :user';
      $wallet = 'SELECT * FROM wallets WHERE id_user= :user';

      // Variable
      $auth = $_SESSION['user']["key"];

      // Execution
      $this->db->query($activity);
      $this->db->bind('user', $auth);
      $activitys = $this->db->resultSet();

      $this->db->query($record);
      $this->db->bind('user', $auth);
      $records = $this->db->resultSet();

      $this->db->query($saving);
      $this->db->bind('user', $auth);
      $savings = $this->db->resultSet();

      $this->db->query($wallet);
      $this->db->bind('user', $auth);
      $wallets = $this->db->resultSet();

      return [
         'activitys' => $activitys,
         'records' => $records,
         'savings' => $savings,
         'wallets' => $wallets
      ];
   }
}
