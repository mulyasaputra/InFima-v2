<?php
$data = $data{
   'data'};
$activitys = [getYearlyData($data["activitys"], 'date'), getDataEveryMonthWhereYear($data["activitys"], 'date', date('Y'))];
$records = getYearlyData($data["records"], 'date', 'blance');
$savings = getYearsavings($data["savings"]);
$wallets = getYearlyData($data["wallets"]);
?>
<link rel="stylesheet" href="<?= BASEURL ?>public/css/dashboard/analytics.css">
<!-- Chart data Activitys -->
<div class="chart-data mt-4 overflow-hidden" style="--header-color: #e74a3b;">
   <div class="d-flex gap-4 flex-wrap">
      <div class="classLineChart">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">Activitys</div>
            <div class="card-body" style="height: 20rem;">
               <canvas class="w-100" id="lineActivitys" width="1378" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 689px;"></canvas>
            </div>
         </div>
      </div>
      <div class="classDoughnutChart">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">Activitys</div>
            <div class="card-body position-relative" style="height: 20rem;">
               <h3 class="position-absolute top-50 start-50 translate-middle z-0">2023</h3>
               <canvas id="ActivitysDoughnut" class="z-1 position-relative" width="572" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 286px;"></canvas>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Chart data Wallet -->
<div class="chart-data mt-4 overflow-hidden" style="--header-color: #f6c23e;">
   <div class="d-flex gap-4 flex-wrap">
      <div class="class-chart-Wallets">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">All Wallets</div>
            <div class="card-body" style="height: 20rem;">
               <canvas class="w-100" id="lineWallets" width="1378" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 689px;"></canvas>
            </div>
         </div>
      </div>
      <div class="classDoughnut1">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">From Salary</div>
            <div class="card-body position-relative" style="height: 20rem;">
               <h3 class="position-absolute top-50 start-50 translate-middle z-0">2023</h3>
               <canvas id="w-salary" class="z-1 position-relative" width="572" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 286px;"></canvas>
            </div>
         </div>
      </div>
      <div class="classDoughnut2">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">From Savings</div>
            <div class="card-body position-relative" style="height: 20rem;">
               <h3 class="position-absolute top-50 start-50 translate-middle z-0">2023</h3>
               <canvas id="w-savings" class="z-1 position-relative" width="572" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 286px;"></canvas>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Chart data Savings -->
<div class="chart-data mt-4 overflow-hidden" style="--header-color: #1cc88a;">
   <div class="w-100">
      <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
         <div class="card-header">Savings</div>
         <div class="card-body" style="height: 20rem;">
            <canvas class="w-100" id="lineSavings" width="2066" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 1033px;"></canvas>
         </div>
      </div>
   </div>
</div>
<!-- Chart data Records -->
<div class="chart-data mt-4 overflow-hidden" style="--header-color: #4e73df;">
   <div class="d-flex gap-4 flex-wrap ">
      <div class="classLine w-100">
         <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header">Records</div>
            <div class="card-body" style="height: 20rem;">
               <canvas class="w-100" id="lineRecords" width="2066" height="608" style="display: block; box-sizing: border-box; height: 304px; width: 1033px;"></canvas>
            </div>
         </div>
      </div>
      <!-- <div class="classDoughnut">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header">Records</div>
               <div class="card-body position-relative" style="height: 20rem;">
                  <h3 class="position-absolute top-50 start-50 translate-middle z-0">2023</h3>
                  <canvas id="RecordsDoughnut" class="z-1 position-relative"></canvas>
               </div>
            </div>
         </div> -->
   </div>
</div>

<script src="<?= BASEURL ?>public/Vendor/Chart.js/chart.umd.js"></script>
<script>
   const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
   const colors = ["#FEA1BF", "#3983eb", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "#FFC6D3", "#E98EAD", "#EB455F", "#B3005E", "#FF5F9E", "#865DFF", "#E384FF", "#FFA3FD"];
   const thisYearActivitys = <?= $activitys[0]["this_year"]; ?>,
      lastYearActivitys = <?= $activitys[0]["last_year"]; ?>,
      thisYearWallets = <?= $wallets["this_year"]; ?>,
      lastYearWallets = <?= $wallets["last_year"]; ?>,
      thisYearRecords = <?= $records["this_year"]; ?>,
      lastYearRecords = <?= $records["last_year"]; ?>;
   const DoughnutActivitys = <?= $activitys[1]; ?>,
      DoughnutWSaving = <?= getDataWalletWhereYear($data["wallets"], 'date', date('Y'))[0]; ?>,
      DoughnutWSalary = <?= getDataWalletWhereYear($data["wallets"], 'date', date('Y'))[1]; ?>;
   const thisYear1 = <?= $savings["this_year"][1]; ?>,
      thisYear0 = <?= $savings["this_year"][0]; ?>,
      lastYear1 = <?= $savings["last_year"][1]; ?>,
      lastYear0 = <?= $savings["last_year"][0]; ?>;
</script>
<script src="<?= BASEURL ?>public/js/dashboard/AnalyticsChart.js"></script>