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
   }
}
