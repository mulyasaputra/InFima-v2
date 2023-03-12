<?php
class helpers
{
   function UniqueArray($aset, $key = 'date')
   {
      $date = array();

      foreach ($aset as $data) {
         $date[] = date("Y", strtotime($data[$key]));
      }
      $unique = array_unique($date);
      sort($unique);
      return $unique;
   }
   function toCurrency($amount, $get = 'Rp')
   {
      $formattedAmount = number_format($amount, 0, ',', '.');
      return $get . $formattedAmount . ",00";
   }
   function previousMonth($month, $year)
   {
      $previous_month = $month - 1;
      if ($previous_month == 0) {
         $year -= 1;
         $previous_month = 12;
      }
      return [$previous_month, $year];
   }
}
