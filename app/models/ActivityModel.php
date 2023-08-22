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
   }
}
