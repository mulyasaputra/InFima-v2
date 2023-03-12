<?php

class AuthModel
{
   private $table = 'users';
   private $db;

   public function __construct()
   {
      $this->db = new Database;
   }
   public function register($data)
   {
      $check = "SELECT * FROM " . $this->table . " WHERE username = :username OR email = :email";
      $this->db->query($check);
      $this->db->bind('username', $data['username']);
      $this->db->bind('email', $data['email']);
      $this->db->execute();
      if ($this->db->rowCount() == 0) {
         if ($data['password'] === $data['password2']) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this->table . " VALUES ('', '', :username, :name, :email, :password)";

            $this->db->query($query);
            $this->db->bind('username', $data['username']);
            $this->db->bind('name', $data['Name']);
            $this->db->bind('email', $data['email']);
            $this->db->bind('password', $password);
            $this->db->execute();


            $id_user = $this->db->getLastInsertId();
            $account = mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999);
            $query1 = "INSERT INTO profile VALUES ('', :user_id, '', :lokasi, :account)";
            $this->db->query($query1);
            $this->db->bind('user_id', $id_user);
            $this->db->bind('lokasi', 'Pati');
            $this->db->bind('account', $account);
            $this->db->execute();

            return $this->db->rowCount();
         }
      } else {
         return 0;
         exit;
      }
   }

   public function login($data)
   {
      $password = $data['password'];

      $this->db->query("SELECT * FROM " . $this->table . " WHERE email = :email");
      $this->db->bind('email', $data['email']);
      $hash = $this->db->single();

      if (password_verify($password, $hash["password"] ?? false)) {
         $_SESSION['user'] = [
            'key' => $hash["id"],
            'username' => $hash["username"],
            'name' => $hash["name"]
         ];
         return true;
         exit;
      } else {
         return false;
         exit;
      }
   }
}
