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
      $auth = $_SESSION['user']["key"];

      // Query untuk menggabungkan semua data dari tabel
      $activity = 'SELECT * FROM activity WHERE id_user= :user';
      $this->processQuery($activity, $auth, $activitys);
      $record = 'SELECT * FROM record WHERE id_user= :user';
      $this->processQuery($record, $auth, $records);
      $saving = 'SELECT * FROM savings WHERE id_user= :user';
      $this->processQuery($saving, $auth, $savings);
      $wallet = 'SELECT * FROM wallets WHERE id_user= :user';
      $this->processQuery($wallet, $auth, $wallets);

      return [
         'activitys' => $activitys,
         'records' => $records,
         'savings' => $savings,
         'wallets' => $wallets
      ];
   }

   private function processQuery($query, $user, &$result)
   {
      $this->db->query($query);
      $this->db->bind('user', $user);
      $result = $this->db->resultSet();
   }
}
