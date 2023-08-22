<?php
class WalletsModel
{
   private $table = 'wallets';
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }

   public function getDataRS() // RECORD & SAVINGS
   {
      $auth = $_SESSION['user']["key"];
      $savings = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as blance FROM savings WHERE id_user= :user AND YEAR(date) = :year AND MONTH(date) = :month ';
      $activity = 'SELECT SUM(nominal) AS blance FROM activity WHERE id_user = :user AND MONTH(date) = :month AND YEAR(date) = :year';

      $this->db->query($savings);
      $this->db->bind('user', $auth);
      $this->db->bind('month', date('n'));
      $this->db->bind('year', date('Y'));
      $xsavings = $this->db->fetchColumn();

      $this->db->query($activity);
      $this->db->bind('user', $auth);
      $this->db->bind('month', date('n'));
      $this->db->bind('year', date('Y'));
      $xactivity = $this->db->fetchColumn();

      return [
         'savings' => $xsavings,
         'activity' => $xactivity,
      ];
   }

   public function getWallets($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date("m", strtotime($month));

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      $allData = $this->db->resultSet();
      $filterData = $this->get->thisViews($allData, $month, $year);
      $filterYears = $this->get->getYears($allData);
      $nominalThisYear = $this->get->getNomilanYears($allData);
      return [$filterData, $filterYears, $nominalThisYear];
   }

   public function deleteWallets($id)
   {
      $query = "DELETE FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);

      $this->db->execute();
      return $this->db->rowCount();
   }

   public function addIncome($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "INSERT INTO " . $this->table . " VALUES ('', :id_user, '', :activite, :date, :nominal)";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('activite', $data['activities']);
      $this->db->bind('date', $data['date']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));

      $this->db->execute();
      return $this->db->rowCount();
   }

   public function edit($id)
   {
      $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
      $this->db->query($query);
      $this->db->bind('id', $id);
      $this->db->execute();
      return $this->db->single();
   }

   public function updateWallets($data)
   {
      $auth = $_SESSION['user']["key"];
      $query = "UPDATE " . $this->table . " SET id_user = :id_user, key_spending = :key_spending, activities = :activities, date = :date, nominal = :nominal WHERE id = :id";

      $this->db->query($query);
      $this->db->bind('id_user', $auth);
      $this->db->bind('key_spending', $data['key_spending']);
      $this->db->bind('activities', $data['activities']);
      $this->db->bind('date', $data['date']);
      $this->db->bind('nominal', preg_replace("/[^0-9]/", "", $data['nominal']));
      $this->db->bind('id', $data['id']);

      $this->db->execute();
      return $this->db->rowCount();
   }
}
