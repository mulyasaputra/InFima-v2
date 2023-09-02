<?php

class ActivityModel
{
   private $table = 'activity';
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }
   public function getActivity($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date("m", strtotime($month));

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $allData = $this->db->resultSet();
      $filterData = $this->get->thisViews($allData, $month, $year);
      $filterYears = $this->get->getYears($allData);
      return [$filterData, $filterYears];
   }

   public function addActivities($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, :date, :activity, :nominal)";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('date', $data['date']);
      $this->db->bind('activity', $data['activities']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));

      $this->db->execute();
      return $this->db->rowCount();
   }
   public function deleteActivity($id)
   {
      $query = "DELETE FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);

      $this->db->execute();
      return $this->db->rowCount();
   }

   public function editActivity($id)
   {
      $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
      return $this->db->single();
   }

   public function updateActivity($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "UPDATE " . $this->table . " SET id_user = :id_user, date = :date, activity = :activity, nominal = :nominal WHERE id = :id";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('date', $data['date']);
      $this->db->bind('activity', $data['activities']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
      $this->db->bind('id', $data['id']);

      $this->db->execute();
      return $this->db->rowCount();
   }


   public function cuteoff($months, $year)
   {
      $auth = $_SESSION['user']["key"];
      $datas = date("Y-m-t", strtotime("$year-$months"));
      $month = date_parse($months)['month'];
      $last = $this->get->previousMonth($month, $year);

      // Menggunakan parameter binding untuk menghindari SQL injection
      $query = 'SELECT SUM(nominal) AS blance FROM activity WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $this->processQuery($query, $auth, $month, $year, $blance1);

      $query = 'SELECT SUM(nominal) AS blance FROM savings WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year AND type = true';
      $this->processQuery($query, $auth, $month, $year, $blance2);

      $query = 'SELECT SUM(nominal) AS blance FROM wallets WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $this->processQuery($query, $auth, $month, $year, $blance3);

      $query = 'SELECT * FROM record WHERE id_user = :user';
      $this->db->query($query);
      $this->db->bind('user', $auth);

      $getBalance = 0;
      $record = 0;
      foreach ($this->db->resultSet() as $item) {
         $a = substr($item["date"], 0, 4);
         $b = substr($item["date"], 5, 2);
         if ($a == $year && $b == $month) {
            $getBalance = $item["blance"];
         }
         if ($a == $last[1] && $b == $last[0]) {
            $record = $item["blance"];
         }
      }

      $nominal = ($record + $blance3['blance']) - ($blance1['blance'] + $blance2['blance']);
      // Update $_SESSION[Record]
      $monthsTimestamp = strtotime($months . ' ' . $year);
      $lastMonthTimestamp = strtotime('-1 month', strtotime(date('F Y')));
      if ($monthsTimestamp == $lastMonthTimestamp) {
         $_SESSION['Record'] = $nominal;
      }

      // Update Data || Add Data
      if ($getBalance != 0) {
         $update_query = 'UPDATE record SET blance = :blance WHERE  id_user = :user AND YEAR(date) = :year AND MONTH(date) = :month';
         $this->db->query($update_query);
         $this->db->bind('user', $auth);
         $this->db->bind('month', $month);
         $this->db->bind('year', $year);
         $this->db->bind('blance', $nominal);

         $this->db->execute();
         return true;
      } else {
         $add_query = "INSERT INTO record VALUES ('', :id_user, :date, :blance)";
         $this->db->query($add_query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('date', $datas);
         $this->db->bind('blance', preg_replace("/[^0-9-]/", "", $nominal));
         $this->db->execute();
         return $this->db->rowCount();
      }
   }

   private function processQuery($query, $user, $month, $year, &$result)
   {
      $this->db->query($query);
      $this->db->bind('user', $user);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $result = $this->db->single();
   }
}
