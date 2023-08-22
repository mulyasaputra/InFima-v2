<?php
function toDays($date)
{
   $timestamp = strtotime($date);
   $now = time();
   $diff_in_seconds = $timestamp - $now; // perbedaan dihitung dari tanggal target ke waktu sekarang
   $diff_in_days = ceil($diff_in_seconds / 86400); // pembulatan ke atas untuk menghindari hasil nol
   if ($diff_in_days == 0) {
      $text = 'Today';
   } else if ($diff_in_days == 1) {
      $text = 'Tomorrow';
   } else if ($diff_in_days > 1) {
      $text = $diff_in_days . ' more days';
   } else {
      $text = abs($diff_in_days) . ' days ago'; // jika tanggal target sudah lewat
   }
   echo $text;
}

function toCurrency($amount)
{
   $formattedAmount = number_format($amount, 0, ',', '.');
   return "Rp" . $formattedAmount . ",00";
}

function formatRupiah($angka)
{
   $suffixes = ["", "ribu", "juta", "milyar", "triliun", "kuadriliun", "kuintiliun"];
   $i = 0;
   while ($angka >= 1000) {
      $angka /= 1000;
      $i++;
   }
   $result = number_format($angka, 0, ',', '.');
   $result .= " " . $suffixes[$i];
   if ($i > 0) {
      $result .= " ";
   }
   $result .= "rupiah";
   return $result;
}

function filterBased($data, $row = 'date')
{
   $filteredData = array();
   foreach ($data as $item) {
      $parsedDate = date_parse_from_format("Y-m-d", $item[$row]);
      if ($parsedDate["month"] == date('n')) {
         $filteredData[] = $item;
      }
   }
   return $filteredData;
}

function getDataEveryMonth($data, $row = 'date')
{
   $counts = array_fill(1, 12, 0); // array untuk menyimpan jumlah data setiap bulan dengan nilai awal nol pada setiap indeks
   foreach ($data as $item) {
      $date = strtotime($item[$row]); // konversi string tanggal ke timestamp
      $month = date('n', $date); // ambil bulan dari tanggal (tanpa leading zero)
      $counts[$month]++; // tambahkan satu pada jumlah data bulan tersebut
   }


   return json_encode(array_values($counts));
}

// GDEMWhareYear
function getDataEveryMonthWhereYear($data, $row = 'date', $year)
{
   $data_bulanan = array_fill(0, 12, 0);

   // Iterasi pada array data untuk mengisi nilai bulanan
   foreach ($data as $item) {
      $bulan = date("n", strtotime($item[$row]));
      if (date("Y", strtotime($item[$row])) == $year) {
         $data_bulanan[$bulan - 1] += 1;
      }
   }
   return json_encode(array_values($data_bulanan));
}

function getNominalEveryYear($data, $date = 'date', $rows = 'nominal')
{
   $bulan = array_fill(0, 12, 0);
   foreach ($data as $row) {
      $month = date('n', strtotime($row[$date])) - 1;
      $bulan[$month] += $row[$rows];
   }
   return json_encode(array_values($bulan));
}

function getDataSaving($array)
{

   $total_type1_march = 0;
   $total_type1 = 0;
   $total_type0 = 0;
   $month = date('n');
   $year = date('Y');
   foreach ($array as $row) {
      if ($row['type'] == 1 && date('Y', strtotime($row['date'])) == $year && date('m', strtotime($row['date'])) == $month) {
         $total_type1_march += $row['nominal'];
      }
   }

   foreach ($array as $row) {
      if ($row['type'] == 1) {
         $total_type1 += $row['nominal'];
      } elseif ($row['type'] == 0) {
         $total_type0 += $row['nominal'];
      }
   }
   return [$total_type1_march, ($total_type1 - $total_type0)];
}


function getYearlyData($data, $date = 'date', $rows = 'nominal')
{
   $thisYear = date('Y');
   $lastYear = $thisYear - 1;

   $thisYearData = array_fill(0, 12, 0);
   $lastYearData = array_fill(0, 12, 0);


   foreach ($data as $row) {
      $month = date('n', strtotime($row[$date]));

      // Jika data di tahun ini, tambahkan ke data tahun ini
      if (date('Y', strtotime($row[$date])) == $thisYear) {
         $thisYearData[$month - 1] += $row[$rows];
      }
      // Jika data di tahun lalu, tambahkan ke data tahun lalu
      elseif (date('Y', strtotime($row[$date])) == $lastYear) {
         $lastYearData[$month - 1] += $row[$rows];
      }
   }

   // Kembalikan array dengan data untuk tahun ini dan tahun lalu
   // json_encode(array_values($bulan));
   return array(
      'last_year' => json_encode(array_values($lastYearData)),
      'this_year' => json_encode(array_values($thisYearData)),
   );
}
function getYearsavings($data)
{
   $thisYear = date('Y');
   $lastYear = $thisYear - 1;
   $thisYear1 = array_fill(0, 12, 0);
   $thisYear0 = array_fill(0, 12, 0);
   $lastYear1 = array_fill(0, 12, 0);
   $lastYear0 = array_fill(0, 12, 0);


   foreach ($data as $row) {
      $month = date('n', strtotime($row['date']));

      // Jika data di tahun ini, tambahkan ke data tahun ini
      if (date('Y', strtotime($row['date'])) == $thisYear) {
         if ($row['type'] == 1) {
            $thisYear1[$month - 1] += $row['nominal'];
         } elseif ($row['type'] == 0) {
            $thisYear0[$month - 1] += $row['nominal'];
         }
      }
      // Jika data di tahun lalu, tambahkan ke data tahun lalu
      elseif (date('Y', strtotime($row['date'])) == $lastYear) {
         if ($row['type'] == 1) {
            $lastYear1[$month - 1] += $row['nominal'];
         } elseif ($row['type'] == 0) {
            $lastYear0[$month - 1] += $row['nominal'];
         }
      }
   }

   $thisYearData = [json_encode(array_values($thisYear0)), json_encode(array_values($thisYear1))];
   $lastYearData = [json_encode(array_values($lastYear0)), json_encode(array_values($lastYear1))];
   return array(
      'last_year' => $lastYearData,
      'this_year' => $thisYearData,
   );
}

// Mengambil jumlah semua nominal
function getTotalNominal($data)
{
   $totalNominal = 0;
   foreach ($data as $item) {
      $nominal = intval($item['nominal']);
      $totalNominal += $nominal;
   }
   return $totalNominal;
}
