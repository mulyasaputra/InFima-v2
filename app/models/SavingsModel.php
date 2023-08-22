<?php

class SavingsModel
{
   private $table = 'savings';
   private $db;
   private $db2;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->db2 = new Database;
      $this->get = new helpers;
   }

   public function getSavings($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date("m", strtotime($month));

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);

      // Ambil Semua Data
      $allData = $this->db->resultSet();
      // Ambil data berdasar bulan dan tahun tertentu
      $filterData = $this->get->thisViews($allData, $month, $year);
      // Ambil Semua data di tahun sekarang
      $filterDataYears = $this->get->thisViews($allData, 0, date("Y"));
      // Ambil data tahun untuk Dropdown
      $filterYears = $this->get->getYears($allData);
      // Ambil data bertipe True/False dari filterData
      $filterType = $this->get->getType($filterData);
      // Ambil data Nominal bertipe True/False dari allData
      $allDataTypeYears = $this->get->getNominalByType($allData);
      $allDataTypeYears = $allDataTypeYears[0] - $allDataTypeYears[1];
      // Ambil data Nominal bertipe True/False dari sekarang
      $filterTypeYears = $this->get->getNominalByType($filterDataYears);

      // Print
      return [
         'mainData' => $filterType,
         'Years' => $filterYears,
         'totalSavings' => $allDataTypeYears,
         'SavingsYears' => $filterTypeYears,
      ];
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
