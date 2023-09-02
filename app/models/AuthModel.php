<?php

class AuthModel
{
   private $table = 'users';
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }
   public function register($data)
   {
      $username = preg_replace('/[^0-9a-zA-Z_-]/', '', $data['username']);
      $check = "SELECT * FROM " . $this->table . " WHERE username = :username OR email = :email";
      $password = password_hash($data['password'], PASSWORD_DEFAULT);

      $this->db->query($check);
      $this->db->bind('username', $username);
      $this->db->bind('email', $data['email']);
      $this->db->execute();
      if ($this->db->rowCount() == 0) {
         if ($data['password'] === $data['password2']) {
            $insertUserQuery = "INSERT INTO " . $this->table . " VALUES ('', '', :username, :email, :password, :date)";
            $this->db->query($insertUserQuery);
            $this->db->bind('username', $username);
            $this->db->bind('email', $data['email']);
            $this->db->bind('password', $password);
            $this->db->bind('date', date('Y-m-d'));
            $this->db->execute();


            $id_user = $this->db->getLastInsertId();
            $account = mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999);
            $api_key = $this->get->keyRandom(40);
            $location = $this->get->getLocation();

            $insertProfileQuery = "INSERT INTO profile VALUES ('', :user_id, :api_key, :user, 'default.jpg', :lokasi, '', :account)";
            $this->db->query($insertProfileQuery);
            $this->db->bind('user_id', $id_user);
            $this->db->bind('api_key', $api_key);
            $this->db->bind('user', $data['Name']);
            $this->db->bind('lokasi', $location[0]);
            $this->db->bind('account', $account);
            $this->db->execute();

            $insertPrintOutQuery = "INSERT INTO print_out VALUES ('', :user_id, :type, :margin, :margin_units, :size, :size_units)";
            $this->db->query($insertPrintOutQuery);
            $this->db->bind('user_id', $id_user);
            $this->db->bind('type', 'F4');
            $this->db->bind('margin', '0,0,0,0');
            $this->db->bind('margin_units', 'mm');
            $this->db->bind('size', 'F4');
            $this->db->bind('size', '215,330');
            $this->db->bind('size_units', 'mm');
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

      $this->db->query("SELECT * FROM " . $this->table . " INNER JOIN profile ON users.id = profile.user_id WHERE users.email = :email");
      $this->db->bind('email', $data['email']);
      $hash = $this->db->single();

      if (password_verify($password, $hash["password"] ?? false)) {
         $_SESSION['user'] = [
            'key' => $hash["user_id"],
            'username' => $hash["username"],
            'profile' => $hash["profil"],
            'name' => $hash["name"],
            'account' => $hash["account"],
            'date' => $hash["date"]
         ];
         return true;
         exit;
      } else {
         return false;
         exit;
      }
   }
}
