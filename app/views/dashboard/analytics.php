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