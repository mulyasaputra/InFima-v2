<?php

class SavingsModel
{
   private $table = 'savings';
   private $db;
   private $db2;

   public function __construct()
   {
      $this->db = new Database;
      $this->db2 = new Database;
   }

   public function getSavings($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date_parse($month)['month'];

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user AND type = :type AND MONTH(date) = :month AND YEAR(date) = :year';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $this->db->bind('type', true);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $results1 = $this->db->resultSet();
      $this->db->bind('type', false);
      $results2 = $this->db->resultSet();
      $results = [$results1, $results2];
      return $results;
   }

   public function getNominal($year)
   {
      $auth = $_SESSION['user']["key"];
      $query2 = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) -
               SUM(CASE WHEN type = false THEN nominal ELSE 0 END) as selisih
               FROM ' . $this->table . ' WHERE id_user= :user';
      $this->db->query($query2);
      $this->db->bind('user', $auth);
      $results1 =  $this->db->single();


      $query1 = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as Income,
               SUM(CASE WHEN type = false THEN nominal ELSE 0 END) as Spending
               FROM ' . $this->table . ' WHERE id_user= :user AND YEAR(date) = :year';
      $this->db->query($query1);
      $this->db->bind('user', $auth);
      $this->db->bind('year', $year);
      $results2 =  $this->db->single();


      $data = [$results1, $results2];
      return $data;
   }

   public function deleteSavings($id, $key)
   {
      if ($key == 1) {
         $query = "DELETE FROM wallets WHERE key_spending = :id";
         $this->db2->query($query);
         $this->db2->bind('id', $id);
         $this->db2->execute();

         $query = "DELETE FROM " . $this->table . " WHERE id = :id";
         $this->db->query($query);
         $this->db->bind('id', $id);
         $this->db->execute();
         return $this->db->rowCount();
      } else {
         $query = "DELETE FROM " . $this->table . " WHERE id = :id";
         $this->db->query($query);
         $this->db->bind('id', $id);

         $this->db->execute();
         return $this->db->rowCount();
      }
   }

   public function addIncome($data)
   {
      $auth = $_SESSION['user']["key"];
      $type = true;
      $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, '', :type, :activite, :nominal, :date)";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('type', $type);
      $this->db->bind('activite', $data['activities']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
      $this->db->bind('date', $data['date']);

      $this->db->execute();
      return $this->db->rowCount();
   }
   public function addSpending($data)
   {
      $auth = $_SESSION['user']["key"];
      $type = false;
      $date = date('Y-m-d');

      if (isset($data["checkbox"])) {
         $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, :key_spending, :type, :activite, :nominal, :date)";

         $this->db->query($query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('key_spending', true);
         $this->db->bind('type', $type);
         $this->db->bind('activite', $data['activities']);
         $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db->bind('date', $date);
         $this->db->execute();

         $key_spending = $this->db->getLastInsertId();
         $query = "INSERT INTO wallets VALUES ('', :id_user, :key_spending, :activite, :date, :nominal)";
         $this->db2->query($query);
         $this->db2->bind('id_user', $auth);
         $this->db2->bind('key_spending', $key_spending);
         $this->db2->bind('activite', $data['activities']);
         $this->db2->bind('date', $date);
         $this->db2->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db2->execute();

         return $this->db->rowCount();
      } else {
         $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, '', :type, :activite, :nominal, :date)";

         $this->db->query($query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('type', $type);
         $this->db->bind('activite', $data['activities']);
         $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db->bind('date', $date);
         $this->db->execute();
         return $this->db->rowCount();
      }
   }


   public function editSpending($id)
   {
      $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
      return $this->db->single();
   }

   public function updateSavings($data)
   {
      $auth = $_SESSION['user']["key"];
      $id = $data['id'];

      if ($data["checkboxValue"] == true) {
         $query = "UPDATE wallets  SET id_user = :id_user, activities = :activities, date = :date, nominal = :nominal WHERE key_spending = :id";
         $this->db->query($query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('activities', $data['activities']);
         $this->db->bind('date', $data['date']);
         $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db->bind('id', $id);
         $this->db->execute();

         $query = "UPDATE " . $this->table . " SET id_user = :id_user, type = :type, activities = :activities, nominal = :nominal, date = :date WHERE id = :id";
         $this->db->query($query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('type', $data['type']);
         $this->db->bind('activities', $data['activities']);
         $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db->bind('date', $data['date']);
         $this->db->bind('id', $id);

         $this->db->execute();

         return $this->db->rowCount();
      } else {
         $query = "UPDATE " . $this->table . " SET id_user = :id_user, type = :type, activities = :activities, nominal = :nominal, date = :date WHERE id = :id";

         $this->db->query($query);
         $this->db->bind('id_user', $auth);
         $this->db->bind('type', $data['type']);
         $this->db->bind('activities', $data['activities']);
         $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
         $this->db->bind('date', $data['date']);
         $this->db->bind('id', $id);

         $this->db->execute();
         return $this->db->rowCount();
      }
   }
}
