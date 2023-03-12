<?php

class UsersModel
{
   private $table = 'Users';
   private $db;

   public function __construct()
   {
      $this->db = new Database;
   }

   public function getAllUsers()
   {
      $this->db->query('SELECT * FROM ' . $this->table);
      return $this->db->resultSet();
   }
}
