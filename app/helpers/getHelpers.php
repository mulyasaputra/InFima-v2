<?php
class helpers
{
   // Format uang
   function toCurrency($amount, $get = 'Rp')
   {
      $formattedAmount = number_format($amount, 0, ',', '.');
      return $get . $formattedAmount . ",00";
   }

   // Ambil data 1 bulan sebelum bulan sekarang
   function previousMonth($month, $year)
   {
      $previous_month = $month - 1;
      if ($previous_month == 0) {
         $year -= 1;
         $previous_month = 12;
      }
      return [$previous_month, $year];
   }

   // Ambil data berdasar tahun dan bulan tertentu
   function thisViews($datas,  $currentMonth, $currentYear)
   {
      $result = [];
      foreach ($datas as $item) {
         $year = substr($item["date"], 0, 4); // Ambil tahun dari tanggal
         $month = substr($item["date"], 5, 2); // Ambil bulan dari tanggal
         if ($currentMonth > 0) {
            if ($year === $currentYear && $month === $currentMonth) {
               $result[] = $item;
            }
         } else {
            if ($year === $currentYear) {
               $result[] = $item;
            }
         }
      }
      return $result;
   }

   // Ambil tahun dari beberapa data untu Dropdown
   function getYears($datas)
   {
      $years = [];
      foreach ($datas as $item) {
         $year = substr($item["date"], 0, 4); // Ambil tahun dari tanggal
         if (!in_array($year, $years)) {
            $years[] = $year;
         }
      }
      sort($years);
      return $years;
   }

   // Ambil hanya Nominal dari data pertahun
   function getNomilanYears($datas)
   {
      $totalNominal = 0;
      foreach ($datas as $item) {
         $year = substr($item["date"], 0, 4); // Ambil tahun dari tanggal
         $month = substr($item["date"], 5, 2); // Ambil bulan dari tanggal

         if ($year === date("Y") && $month === date("m")) {
            $totalNominal += intval($item["nominal"]);
         }
      };
      return $totalNominal;
   }

   // Ambil data bertype tertentu
   function getType($data)
   {
      $type1 = [];
      $type0 = [];

      foreach ($data as $item) {
         if ($item['type'] === '1') {
            $type1[] = $item;
         } elseif ($item['type'] === '0') {
            $type0[] = $item;
         }
      }
      return [$type1, $type0];
   }

   function getNominalByType($data)
   {
      $totalType1 = 0;
      $totalType0 = 0;

      foreach ($data as $item) {
         $nominal = intval($item['nominal']);
         $type = intval($item['type']);

         if ($type === 1) {
            $totalType1 += $nominal;
         } elseif ($type === 0) {
            $totalType0 += $nominal;
         }
      }

      return [$totalType1, $totalType0];
   }

   // random Key
   function keyRandom($num)
   {
      $characters = 'abcdefghijklmnopqrstuvwxyz';
      $numbers = '0123456789';

      // Generate 48 random characters
      $random_characters = '';
      for ($i = 0; $i < $num; $i++) {
         if (rand(0, 100) < 60) {
            $random_characters .= $numbers[rand(0, strlen($numbers) - 1)];
         } else {
            $random_characters .= $characters[rand(0, strlen($characters) - 1)];
         }
      }

      // Print the random characters
      return $random_characters;
   }

   // get Location
   function getLocation()
   {
      $public_ip = file_get_contents('https://api.ipify.org?format=json');
      $ip_data = json_decode($public_ip);
      $ip_address = $ip_data->ip;

      $api_url = "http://ipinfo.io/{$ip_address}/json";
      $ip_info = file_get_contents($api_url);
      $location_data = json_decode($ip_info);

      $city = isset($location_data->city) ? $location_data->city : 'NULL';
      $region = isset($location_data->region) ? $location_data->region : 'NULL';
      $country = isset($location_data->country) ? $location_data->country : 'NULL';
      return [$city, $region, $country];
   }
}
