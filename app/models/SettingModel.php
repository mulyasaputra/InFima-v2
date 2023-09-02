<?php

class SettingModel
{
   private $db;
   private $get;

   public function __construct()
   {
      $this->db = new Database;
      $this->get = new helpers;
   }
   public function getDataaaa()
   {
      $auth = $_SESSION['user']["key"];

      $query = 'SELECT * FROM users
      INNER JOIN profile ON users.id = profile.user_id 
      INNER JOIN print_out ON users.id = print_out.user_id 
      WHERE users.id= :user';

      $this->db->query($query);
      $this->db->bind('user', $auth);
      return $this->db->resultSet();
   }
   public function updatePrint($data)
   {
      $auth = $_SESSION['user']["key"];
      $margin_units = $data["marginUnits"];
      $margin = $data["margin_Right"] . "," . $data["margin_Top"] . "," . $data["margin_Left"] . "," . $data["margin_Bottom"];
      $size_units = "mm";
      $paper_size_value = ",";
      $paper_size = $data["paperSize"];
      $size_units = $data["sizeUnits"];
      $paper_size_value = $data["size_width"] . "," . $data["size_height"];

      $query = "UPDATE print_out SET type = :type, margin = :margin, margin_units = :margin_units, size = :size, size_units = :size_units WHERE user_id = :user_id";

      $this->db->query($query);
      $this->db->bind('user_id', $auth);
      $this->db->bind('type', $paper_size);
      $this->db->bind('margin', $margin);
      $this->db->bind('margin_units', $margin_units);
      $this->db->bind('size', $paper_size_value);
      $this->db->bind('size_units', $size_units);
      // $this->db->bind('id', $data['id']);

      $this->db->execute();
      return $this->db->rowCount();
   }

   public function updateProfile($data)
   {
      $upload_folder = 'public/user_profile/';
      $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];
      $file =  $_FILES["userImage"];
      $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
      $new_filename = $_SESSION['user']["profile"];
      if (in_array($file_extension, $allowed_extensions)) {
         // Generate nama acak untuk gambar
         $new_filename = uniqid() . '.webp';
         $destination = $upload_folder . $new_filename;
         move_uploaded_file($file['tmp_name'], $destination);
         if ($file_extension == 'jpg' || $file_extension == 'jpeg') {
            $imagesPic = imagecreatefromjpeg($destination);
         } elseif ($file_extension == 'png') {
            $imagesPic = imagecreatefrompng($destination);
         } elseif ($file_extension == 'webp') {
            $imagesPic = imagecreatefromwebp($destination);
         }
         // Get the dimensions of the source image
         $source_width = imagesx($imagesPic);
         $source_height = imagesy($imagesPic);
         $crop_size = min($source_width, $source_height);
         $cropped_pic = imagecreatetruecolor($crop_size, $crop_size);
         imagecopy($cropped_pic, $imagesPic, 0, 0, ($source_width - $crop_size) / 2, ($source_height - $crop_size) / 2, $crop_size, $crop_size);
         imagewebp($cropped_pic, $destination, 80); // 80% quality
         imagedestroy($imagesPic);
         imagedestroy($cropped_pic);
      }
      $_SESSION['user']["profile"] = $new_filename;
      $_SESSION['user']["username"] = $data["username"];
      $_SESSION['user']["name"] = $data["name"];

      // Hapus Profile lama
      if ($data["profile"] != "default.jpg") {
         $gambar = $upload_folder . $data["profile"];
         if (file_exists($gambar)) {
            unlink($gambar);
         }
      }

      // // Enter data into the database
      $auth = $_SESSION['user']["key"];
      $query = "UPDATE users INNER JOIN profile ON users.id = profile.user_id
      SET users.email = :email, users.username = :username, profile.name = :name, profile.profil = :profil, profile.lokasi = :lokasi, profile.instansi = :instansi
      WHERE profile.user_id = :user_id";
      $this->db->query($query);
      $this->db->bind('user_id', $auth);
      $this->db->bind('email', $data["email"]);
      $this->db->bind('username', $data["username"]);
      $this->db->bind('name', $data["name"]);
      $this->db->bind('profil', $new_filename);
      $this->db->bind('lokasi', $data["location"]);
      $this->db->bind('instansi', $data["instansi"]);

      $this->db->execute();
      return $this->db->rowCount();
   }
}
