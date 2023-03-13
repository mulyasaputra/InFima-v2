 const lineActivitys = document.getElementById("lineActivitys"),
      lineSavings = document.getElementById("lineSavings"),
      lineWallets = document.getElementById("lineWallets"),
      lineRecords = document.getElementById("lineRecords");
const ActivitysDoughnut = document.getElementById("ActivitysDoughnut"),
      WalletsDoughnut = document.getElementById("WalletsDoughnut");
 var myLineChart1 = new Chart(lineActivitys, {
   type: "line",
   data: {
     labels: labels,
     datasets: [
       {
         label: new Date().getFullYear(),
         backgroundColor: "rgba(249, 19, 147, 0.2)",
         borderColor: "rgb(249, 19, 147)",
         data: thisYearActivitys,
       },
       {
         label: (Tahun = new Date().getFullYear() - 1),
         backgroundColor: "rgba(148, 0, 211, 0.2)",
         borderColor: "rgb(148, 0, 211)",
         data: lastYearActivitys,
       },
     ],
   },
   options: {
     maintainAspectRatio: false,
     layout: {
       padding: {
         left: 10,
         right: 25,
         top: 25,
         bottom: 0,
       },
     },
     legend: {
       display: false,
     },
     tooltips: {
       backgroundColor: "rgb(255,255,255)",
       bodyFontColor: "#858796",
       titleMarginBottom: 10,
       titleFontColor: "#6e707e",
       titleFontSize: 14,
       borderColor: "#dddfeb",
       borderWidth: 1,
       xPadding: 15,
       yPadding: 15,
       displayColors: false,
       intersect: false,
       mode: "index",
       caretPadding: 10,
       callbacks: {
         label: function (tooltipItem, chart) {
           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
           return datasetLabel + ": Rp. " + formatRupiah(tooltipItem.yLabel);
         },
       },
     },
   },
 });
 var myLineChart2 = new Chart(lineSavings, {
   type: "line",
   data: {
     labels: labels,
     datasets: [
       {
         label: "Income " +  new Date().getFullYear(),
         backgroundColor: "rgba(234, 4, 126, 0.2)",
         borderColor: "rgb(234, 4, 126)",
         data: thisYear1,
       },
       {
         label: "Spending " +  new Date().getFullYear(),
         backgroundColor: "rgba(255, 139, 19, 0.2)",
         borderColor: "rgb(255, 139, 19)",
         data: thisYear0,
       },
       {
         label: "Income " +  (new Date().getFullYear() - 1),
         backgroundColor: "rgba(25, 196, 10, 0.2)",
         borderColor: "rgb(25, 196, 10)",
         data: lastYear1,
       },
       {
         label: "Spending " +  (new Date().getFullYear() - 1),
         backgroundColor: "rgba(148, 0, 211, 0.2)",
         borderColor: "rgb(148, 0, 211)",
         data: lastYear0,
       },
     ],
   },
   options: {
     maintainAspectRatio: false,
     layout: {
       padding: {
         left: 10,
         right: 25,
         top: 25,
         bottom: 0,
       },
     },
     legend: {
       display: false,
     },
     tooltips: {
       backgroundColor: "rgb(255,255,255)",
       bodyFontColor: "#858796",
       titleMarginBottom: 10,
       titleFontColor: "#6e707e",
       titleFontSize: 14,
       borderColor: "#dddfeb",
       borderWidth: 1,
       xPadding: 15,
       yPadding: 15,
       displayColors: false,
       intersect: false,
       mode: "index",
       caretPadding: 10,
       callbacks: {
         label: function (tooltipItem, chart) {
           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
           return datasetLabel + ": Rp. " + formatRupiah(tooltipItem.yLabel);
         },
       },
     },
   },
 });
 var myLineChart3 = new Chart(lineWallets, {
   type: "line",
   data: {
     labels: labels,
     datasets: [
       {
         label: new Date().getFullYear(),
         backgroundColor: "rgba(249, 19, 147, 0.2)",
         borderColor: "rgb(249, 19, 147)",
         data: thisYearWallets,
       },
       {
         label: (Tahun = new Date().getFullYear() - 1),
         backgroundColor: "rgba(148, 0, 211, 0.2)",
         borderColor: "rgb(148, 0, 211)",
         data: lastYearWallets,
       },
     ],
   },
   options: {
     maintainAspectRatio: false,
     layout: {
       padding: {
         left: 10,
         right: 25,
         top: 25,
         bottom: 0,
       },
     },
     legend: {
       display: false,
     },
     tooltips: {
       backgroundColor: "rgb(255,255,255)",
       bodyFontColor: "#858796",
       titleMarginBottom: 10,
       titleFontColor: "#6e707e",
       titleFontSize: 14,
       borderColor: "#dddfeb",
       borderWidth: 1,
       xPadding: 15,
       yPadding: 15,
       displayColors: false,
       intersect: false,
       mode: "index",
       caretPadding: 10,
       callbacks: {
         label: function (tooltipItem, chart) {
           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
           return datasetLabel + ": Rp. " + formatRupiah(tooltipItem.yLabel);
         },
       },
     },
   },
 });
 var myLineChart4 = new Chart(lineRecords, {
   type: "line",
   data: {
     labels: labels,
     datasets: [
       {
         label: new Date().getFullYear(),
         backgroundColor: "rgba(249, 19, 147, 0.2)",
         borderColor: "rgb(249, 19, 147)",
         data: thisYearRecords,
       },
       {
         label: (Tahun = new Date().getFullYear() - 1),
         backgroundColor: "rgba(148, 0, 211, 0.2)",
         borderColor: "rgb(148, 0, 211)",
         data: lastYearRecords,
       },
     ],
   },
   options: {
     maintainAspectRatio: false,
     layout: {
       padding: {
         left: 10,
         right: 25,
         top: 25,
         bottom: 0,
       },
     },
     legend: {
       display: false,
     },
     tooltips: {
       backgroundColor: "rgb(255,255,255)",
       bodyFontColor: "#858796",
       titleMarginBottom: 10,
       titleFontColor: "#6e707e",
       titleFontSize: 14,
       borderColor: "#dddfeb",
       borderWidth: 1,
       xPadding: 15,
       yPadding: 15,
       displayColors: false,
       intersect: false,
       mode: "index",
       caretPadding: 10,
       callbacks: {
         label: function (tooltipItem, chart) {
           var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
           return datasetLabel + ": Rp. " + formatRupiah(tooltipItem.yLabel);
         },
       },
     },
   },
 });


 var myChartDoughnut1 = new Chart(ActivitysDoughnut, {
   type: "doughnut",
   data: {
      labels: labels,
      datasets: [{
         data: DoughnutActivitys,
         backgroundColor: colors,
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
      plugins: {
         legend: {
            display: false,
         },
      },
      cutoutPercentage: 70,
   },
});
 var myChartDoughnut2 = new Chart(WalletsDoughnut, {
   type: "doughnut",
   data: {
      labels: labels,
      datasets: [{
         data: DoughnutWallets,
         backgroundColor: colors,
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
      plugins: {
         legend: {
            display: false,
         },
      },
      cutoutPercentage: 70,
   },
});