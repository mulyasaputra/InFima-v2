<?php
$data = $data{
   'data'};
$activitys = [getYearlyData($data["activitys"], 'dates'), getDataEveryMonth($data["activitys"], 'dates')];
$records = getYearlyData($data["records"], 'date', 'blance');
$savings = getYearsavings($data["savings"]);
$wallets = [getYearlyData($data["wallets"]), getDataEveryMonth($data["wallets"])];
?>
<style>
   .classLine {
      min-width: 20rem;
      width: calc(100% - (20rem + 1.5rem));
   }

   .classDoughnut {
      width: 20rem;
   }

   @media (max-width:765px) {

      .classDoughnut,
      .classLine {
         width: 100%;
      }
   }

   .card-body {
      padding-top: 0 !important;
   }
</style>
<div class="dash-content">
   <h2 class="mt-4 mb-3" style="color: var(--black-light-color);">Analytics</h2>
   <div class="chart-data mt-4 overflow-hidden">
      <div class="d-flex gap-4 flex-wrap">
         <div class="classLine">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Activitys</div>
               <div class="card-body" style="height: 20rem;">
                  <canvas class="w-100" id="lineActivitys"></canvas>
               </div>
            </div>
         </div>
         <div class="classDoughnut">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Activitys</div>
               <div class="card-body position-relative" style="height: 20rem;">
                  <h3 class="position-absolute top-50 start-50 translate-middle z-0"><?= date("Y"); ?></h3>
                  <canvas id="ActivitysDoughnut" class="z-1 position-relative"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="chart-data mt-4 overflow-hidden">
      <div class="d-flex gap-4 flex-wrap">
         <div class="classLine">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Wallets</div>
               <div class="card-body" style="height: 20rem;">
                  <canvas class="w-100" id="lineWallets"></canvas>
               </div>
            </div>
         </div>
         <div class="classDoughnut">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Wallets</div>
               <div class="card-body position-relative" style="height: 20rem;">
                  <h3 class="position-absolute top-50 start-50 translate-middle z-0"><?= date("Y"); ?></h3>
                  <canvas id="WalletsDoughnut" class="z-1 position-relative"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="chart-data mt-4 overflow-hidden">
      <div class="w-100">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header text-primary fs-6">Savings</div>
            <div class="card-body" style="height: 20rem;">
               <canvas class="w-100" id="lineSavings"></canvas>
            </div>
         </div>
      </div>
   </div>
   <div class="chart-data mt-4 overflow-hidden">
      <div class="d-flex gap-4 flex-wrap">
         <div class="classLine">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Records</div>
               <div class="card-body" style="height: 20rem;">
                  <canvas class="w-100" id="lineRecords"></canvas>
               </div>
            </div>
         </div>
         <div class="classDoughnut">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Records</div>
               <div class="card-body position-relative" style="height: 20rem;">
                  <h3 class="position-absolute top-50 start-50 translate-middle z-0"><?= date("Y"); ?></h3>
                  <canvas id="RecordsDoughnut" class="z-1 position-relative"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Jumlah pengeluaran -->
<script src="<?= BASEURL ?>public/Vendor/Chart.js/chart.umd.js"></script>
<script>
   const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
   const colors = ["#FEA1BF", "#3983eb", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "#FFC6D3", "#E98EAD", "#EB455F", "#B3005E", "#FF5F9E", "#865DFF", "#E384FF", "#FFA3FD"];
   const thisYearActivitys = <?= $activitys[0]["last_year"]; ?>,
      lastYearActivitys = <?= $activitys[0]["this_year"]; ?>,
      thisYearWallets = <?= $wallets[0]["last_year"]; ?>,
      lastYearWallets = <?= $wallets[0]["this_year"]; ?>,
      thisYearRecords = <?= $records["last_year"]; ?>,
      lastYearRecords = <?= $records["this_year"]; ?>;
   const DoughnutActivitys = <?= $activitys[1]; ?>,
      DoughnutWallets = <?= $wallets[1]; ?>;
   const thisYear1 = <?= $savings["last_year"][1]; ?>,
      thisYear0 = <?= $savings["last_year"][0]; ?>,
      lastYear1 = <?= $savings["this_year"][1]; ?>,
      lastYear0 = <?= $savings["this_year"][0]; ?>;
</script>Earnings
<script src="<?= BASEURL ?>public/js/AnalyticsChart.js"></script>