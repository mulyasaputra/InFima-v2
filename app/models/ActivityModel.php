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
      $month = date_parse($month)['month'];

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user AND MONTH(dates) = :month AND YEAR(dates) = :year';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      return $this->db->resultSet();
   }
   public function getYears()
   {
      $auth = $_SESSION['user']["key"];
      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $aset = $this->db->resultSet();
      return $this->get->UniqueArray($aset, 'dates');
   }

   public function addactivity($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, :dates, :activity, :nominal)";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('dates', $data['date']);
      $this->db->bind('activity', $data['activities']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));

      $this->db->execute();
      return $this->db->rowCount();
   }
   public function deleteactivity($id)
   {
      $query = "DELETE FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);

      $this->db->execute();
      return $this->db->rowCount();
   }

   public function editactivity($id)
   {
      $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
      return $this->db->single();
   }

   public function updateactivity($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "UPDATE " . $this->table . " SET id_user = :id_user, dates = :dates, activity = :activity, nominal = :nominal WHERE id = :id";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('dates', $data['date']);
      $this->db->bind('activity', $data['activities']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
      $this->db->bind('id', $data['id']);

      $this->db->execute();
      return $this->db->rowCount();
   }


   public function cuteoff($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $data = date("Y-m-t", strtotime("$year-$month"));
      $month = date_parse($month)['month'];

      $activity = 'SELECT SUM(nominal) AS blance FROM activity WHERE id_user = :user AND MONTH(dates) = :month AND YEAR(dates) = :year';
      $this->db->query($activity);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $blance1 = $this->db->single();

      $savings = 'SELECT SUM(nominal) AS blance FROM savings WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year AND type = true';
      $this->db->query($savings);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $blance2 = $this->db->single();

      $wallets = 'SELECT SUM(nominal) AS blance FROM wallets WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $this->db->query($wallets);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $blance3 = $this->db->single();

      $nominal = $blance3['blance'] - ($blance1['blance'] + $blance2['blance']);


      $query = 'SELECT * FROM record WHERE id_user = :user AND YEAR(date) = :year AND MONTH(date) = :month';
      $this->db->query($query);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $this->db->execute();
      $count =  $this->db->rowCount();
      if ($count > 0) {
         // jika data sudah ada, lakukan update
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
         $this->db->bind('date', $data);
         $this->db->bind('blance', preg_replace("/[^0-9-]/", "", $nominal));

         $this->db->execute();
         return $this->db->rowCount();
      }
   }
}
