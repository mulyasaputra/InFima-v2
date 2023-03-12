<?php $money = $data['money'];
$expenditures = filterBased($money["expenditure"], 'dates');
$revenues = filterBased($money["wallet"]);
$savings = getDataSaving($money["saving"]);
$monthlyIncome = array_reduce($revenues, function ($carry, $row) {
   return $carry + $row['nominal'];
}, 0);
$monthlyExpenses = array_reduce($expenditures, function ($carry, $row) {
   return $carry + $row['nominal'];
}, 0);
?>
<style>
   .shadow {
      box-shadow: 0 0.15rem 1.75rem 0 rgb(58 59 69 / 15%) !important;
   }

   .card-body.table * {
      color: var(--text-color) !important;
   }
</style>
<div class="dash-content">
   <h2 class="mt-4 mb-3" style="color: var(--black-light-color);">Dashboard</h2>
   <div class="rows-cols-1 rows-cols-sm-2 rows-cols-xl-4">
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #e74a3b; background-color: var(--second-color); color: var(--black-light-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">Total revenue</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($money['records'] + $monthlyIncome - ($monthlyExpenses + $savings[0])); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-credit-card"></i>
         </div>
      </div>
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #1cc88a; background-color: var(--second-color); color: var(--black-light-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">TOTAL Savings</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($savings[1]); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-bullseye"></i>
         </div>
      </div>
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #4e73df; background-color: var(--second-color); color: var(--black-light-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">RECORD (<?= date('F', strtotime('previous month')); ?>)</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($money['records']); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-chart-pie-alt"></i>
         </div>
      </div>
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #f6c23e; background-color: var(--second-color); color: var(--black-light-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">Expenditure</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($monthlyExpenses); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-calendar-alt"></i>
         </div>
      </div>
   </div>
   <div class="chart-data mt-4 overflow-hidden">
      <div class="d-flex gap-4 flex-wrap">
         <div class="classLineChart">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Earnings Overview</div>
               <div class="card-body" style="height: 20rem;">
                  <canvas class="w-100" id="lineChart"></canvas>
               </div>
            </div>
         </div>
         <div class="classDoughnutChart">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Total Withdrawals</div>
               <div class="card-body position-relative" style="height: 20rem;">
                  <h3 class="position-absolute top-50 start-50 translate-middle z-0"><?= date("Y"); ?></h3>
                  <canvas id="chartDoughnut" class="z-1 position-relative"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="mt-4 overflow-hidden">
      <div class="row">
         <div class="col-12 col-lg-6">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Expenditure in <?= date('F'); ?></div>
               <table class="card-body table mb-0 table-striped">
                  <?php $s = 1; ?>
                  <?php foreach ($expenditures as $expenditure) : ?>
                     <tr>
                        <th class="border-end px-3"><?= $s++; ?></th>
                        <td class="w-100"><?= toDays($expenditure['dates']); ?> money of <?= toCurrency($expenditure['nominal']); ?> was used to <?= $expenditure['activity']; ?></td>
                     </tr>
                  <?php endforeach ?>
               </table>
            </div>
         </div>
         <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="card mb-3" style="background-color: var(--second-color); color: var(--black-light-color);">
               <div class="card-header text-primary fs-6">Revenue in <?= date('F'); ?></div>
               <table class="card-body table mb-0 table-striped">
                  <?php $s = 1; ?>
                  <?php foreach ($revenues as $revenue) : ?>
                     <tr>
                        <th class="border-end px-3"><?= $s++; ?></th>
                        <td class="w-100">you added <?= toCurrency($revenue['nominal']); ?> from <?= $revenue['activities']; ?> in <?= toDays($revenue['date']); ?></td>
                     </tr>
                  <?php endforeach ?>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?= BASEURL ?>public/js/Chart.min.js"></script>
<script src="<?= BASEURL ?>public/js/toCurrency.js"></script>
<script>
   const color = ["#3983eb", "#91D8E4", "#BFEAF5", "#FFC6D3", "#FEA1BF", "#E98EAD", "#EB455F", "#B3005E", "#FF5F9E", "#865DFF", "#E384FF", "#FFA3FD"];
   const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
   const chartDoughnut = document.getElementById('chartDoughnut');
   const lineChart = document.getElementById('lineChart');

   var myChartDoughnut = new Chart(chartDoughnut, {
      type: "doughnut",
      data: {
         labels: labels,
         datasets: [{
            data: <?= getDataEveryMonth($money["expenditure"], 'dates'); ?>,
            backgroundColor: color,
         }, ],
      },
      options: {
         maintainAspectRatio: false,
         tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            caretPadding: 10,
         },
         legend: {
            display: false,
         },
         cutoutPercentage: 70,
      },
   });

   let lineDataSet = <?= getNominalEveryYear($money["expenditure"], 'dates'); ?>;
   var myLineChart = new Chart(lineChart, {
      type: 'line',
      data: {
         labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
         datasets: [{
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: lineDataSet,
         }],
      },
      options: {
         maintainAspectRatio: false,
         layout: {
            padding: {
               left: 10,
               right: 25,
               top: 25,
               bottom: 0
            }
         },
         scales: {
            xAxes: [{
               time: {
                  unit: 'date'
               },
               gridLines: {
                  display: false,
                  drawBorder: false
               },
               ticks: {
                  maxTicksLimit: 7
               }
            }],
            yAxes: [{
               ticks: {
                  maxTicksLimit: 5,
                  padding: 10,
                  callback: function(value, index, values) {
                     return formatRupiah(value);
                  }
               },
               gridLines: {
                  color: "rgb(234, 236, 244)",
                  zeroLineColor: "rgb(234, 236, 244)",
                  drawBorder: false,
                  borderDash: [2],
                  zeroLineBorderDash: [2]
               }
            }],
         },
         legend: {
            display: false
         },
         tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            callbacks: {
               label: function(tooltipItem, chart) {
                  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                  return datasetLabel + ': Rp. ' + formatRupiah(tooltipItem.yLabel);
               }
            }
         }
      }
   });
</script>