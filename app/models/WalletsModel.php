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

   public function getdata($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date_parse($month)['month'];
      $last = $this->get->previousMonth($month, $year);
      $activity = 'SELECT SUM(nominal) AS blance FROM activity WHERE id_user = :user AND MONTH(dates) = :month AND YEAR(dates) = :year';
      $record = 'SELECT SUM(blance) AS blance FROM record WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';
      $savings = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as blance FROM savings WHERE id_user= :user AND YEAR(date) = :year AND MONTH(date) = :month ';

      $this->db->query($activity);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $blance1 = $this->db->fetchColumn();

      $this->db->query($record);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $last[0]);
      $this->db->bind('year', $last[1]);
      $blance2 = $this->db->fetchColumn();

      $this->db->query($savings);
      $this->db->bind('user', $auth);
      $this->db->bind('month', $month);
      $this->db->bind('year', $year);
      $blance3 = $this->db->fetchColumn();

      return $blance2 - ($blance1 + $blance3);
   }
   public function getWallets($month, $year)
   {
      $auth = $_SESSION['user']["key"];
      $month = date_parse($month)['month'];

      $query = 'SELECT * FROM ' . $this->table . ' WHERE id_user= :user AND MONTH(date) = :month AND YEAR(date) = :year';

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
      return $this->get->UniqueArray($aset);
   }

   // public function getNominal($year)
   // {
   //    $auth = $_SESSION['user']["key"];
   //    $query2 = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) -
   //             SUM(CASE WHEN type = false THEN nominal ELSE 0 END) as selisih
   //             FROM ' . $this->table . ' WHERE id_user= :user';
   //    $this->db->query($query2);
   //    $this->db->bind('user', $auth);
   //    $results1 =  $this->db->single();


   //    $query1 = 'SELECT SUM(CASE WHEN type = true THEN nominal ELSE 0 END) as Income,
   //             SUM(CASE WHEN type = false THEN nominal ELSE 0 END) as Spending
   //             FROM ' . $this->table . ' WHERE id_user= :user AND YEAR(date) = :year';
   //    $this->db->query($query1);
   //    $this->db->bind('user', $auth);
   //    $this->db->bind('year', $year);
   //    $results2 =  $this->db->single();


   //    $data = [$results1, $results2];
   //    return $data;
   // }

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
