<?php
class Flasher
{
   public static function setFlash($message, $action, $type)
   {
      $_SESSION['flash'] = [
         'message' => $message,
         'action' => $action,
         'type' => $type
      ];
   }
   public static function setInfo($message, $action, $type)
   {
      $_SESSION['info'] = [
         'message' => $message,
         'action' => $action,
         'type' => $type
      ];
   }

   public static function flash()
   {
      if (isset($_SESSION['flash'])) {
         echo '<div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show" role="alert">
                  Data <strong>' . $_SESSION['flash']['message'] . '</strong> ' . $_SESSION['flash']['action'] . '.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';

         unset($_SESSION['flash']);
      } elseif (isset($_SESSION['info'])) {
         echo '<div class="alert alert-' . $_SESSION['info']['type'] . ' alert-dismissible fade show" role="alert">
                  User baru <strong>' . $_SESSION['info']['message'] . '</strong> ' . $_SESSION['info']['action'] . '.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';

         unset($_SESSION['info']);
      } elseif (isset($_SESSION['login'])) {
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Login <strong>gagal</strong>  silahkan coba kembali.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';

         unset($_SESSION['login']);
      }
   }
}
