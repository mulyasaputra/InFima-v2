<div class="mt-5 pt-5">
   <?php
   $month = 1;
   $year = date('Y');
   function previousMonth($month, $year)
   {
      $previous_month = $month - 1;
      if ($previous_month == 0) {
         $year -= 1;
         $previous_month = 12;
      }
      return [$previous_month, $year];
   }
   var_dump(previousMonth($month, $year));
   ?>
</div>