<?php
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$years = ['2022', '2023'];
$urls = $_SERVER['REQUEST_URI'];
$numList = 1;
$monthlyIncome = array_reduce($data['data'], function ($carry, $row) {
   return $carry + $row['nominal'];
}, 0);
?>
<style>
   #action div>select {
      border: 1px solid var(--border-color);
      background-color: var(--panel-color);
      color: var(--text-color);
   }

   #activities tbody tr>* {
      color: var(--text-color) !important;
   }

   .header-td2 {
      min-width: 120px;
   }

   .header-td3 {
      width: 100%;
      min-width: 324px;
   }

   .header-td4 {
      min-width: 146px;
   }

   .header-td5 {
      min-width: 10em;
   }

   /* card */
   .master_card {
      width: 29em;
      height: 18em;
   }

   .front {
      position: relative;
      border-radius: 15px;
      color: #fff;
      width: inherit;
      height: inherit;
      text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
      background-image: linear-gradient(to right, #111, #555);
      overflow: hidden;
      font-size: var(--font-size);
   }

   .strip-bottom,
   .strip-top {
      position: absolute;
      right: 0;
      height: inherit;
      background-image: linear-gradient(to bottom, #ff6767, #ff4545);
      box-shadow: 0 0 10px 0px rgba(0, 0, 0, 0.5);
   }

   .strip-bottom {
      width: 200px;
      transform: skewX(-15deg) translateX(50px);
   }

   .strip-top {
      width: 180px;
      transform: skewX(20deg) translateX(50px);
   }

   .logo {
      position: absolute;
      top: 30px;
      right: 25px;
   }

   .investor {
      position: relative;
      top: 30px;
      left: 25px;
   }

   .chip {
      position: relative;
      top: 60px;
      left: 25px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 40px;
      border-radius: 5px;
      background-image: linear-gradient(to bottom left, #ffecc7, #d0b978);
      overflow: hidden;
   }

   .chip .chip-line {
      position: absolute;
      width: 100%;
      height: 1px;
      background-color: #333;
   }

   .chip .chip-line:nth-child(1) {
      top: 13px;
   }

   .chip .chip-line:nth-child(2) {
      top: 20px;
   }

   .chip .chip-line:nth-child(3) {
      top: 28px;
   }

   .chip .chip-line:nth-child(4) {
      left: 25px;
      width: 1px;
      height: 50px;
   }

   .chip .chip-main {
      width: 20px;
      height: 25px;
      border: 1px solid #333;
      border-radius: 3px;
      background-image: linear-gradient(to bottom left, #efdbab, #e1cb94);
      z-index: 1;
   }

   .wave {
      position: relative;
      top: 20px;
      left: 100px;
   }

   .card-number {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 40px 25px 10px;
      font-size: calc(var(--font-size) + 5px);
      font-family: 'cc font', monospace;
   }

   .card-holder {
      margin: 10px 25px;
      text-transform: uppercase;
      font-family: 'cc font', monospace;
   }

   .master {
      position: absolute;
      right: 20px;
      bottom: 20px;
      display: flex;
   }

   .master .circle {
      width: 25px;
      height: 25px;
      border-radius: 50%;
   }

   .master .master-red {
      background-color: #eb001b;
   }

   .master .master-yellow {
      margin-left: -10px;
      background-color: rgba(255, 209, 0, 0.7);
   }

   @media (max-width:563px) {
      .master_card {
         width: 100%;
         height: 100%;
         --font-size: 17px !important;
      }
   }

   @media (max-width:400px) {
      .master_card {
         --font-size: 13px !important;
      }
   }
</style>
<div class="dash-content">
   <h2 class="mt-4 mb-3 text-thames">Wallets</h2>
   <div class="">
      <div class="mb-4">
         <div class="master_card" style="--font-size: 20px">
            <div class="front">
               <div class="strip-bottom"></div>
               <div class="strip-top"></div><svg class="logo" width="40" height="40" viewbox="0 0 17.5 16.2">
                  <path d="M3.2 0l5.4 5.6L14.3 0l3.2 3v9L13 16.2V7.8l-4.4 4.1L4.5 8v8.2L0 12V3l3.2-3z" fill="white"></path>
               </svg>
               <div class="investor mt-1"><?= toCurrency($monthlyIncome + $data['data2']); ?></div>
               <div class="chip">
                  <div class="chip-line"></div>
                  <div class="chip-line"></div>
                  <div class="chip-line"></div>
                  <div class="chip-line"></div>
                  <div class="chip-main"></div>
               </div><svg class="wave" viewBox="0 3.71 26.959 38.787" width="26.959" height="38.787" fill="white">
                  <path d="M19.709 3.719c.266.043.5.187.656.406 4.125 5.207 6.594 11.781 6.594 18.938 0 7.156-2.469 13.73-6.594 18.937-.195.336-.57.531-.957.492a.9946.9946 0 0 1-.851-.66c-.129-.367-.035-.777.246-1.051 3.855-4.867 6.156-11.023 6.156-17.718 0-6.696-2.301-12.852-6.156-17.719-.262-.317-.301-.762-.102-1.121.204-.36.602-.559 1.008-.504z"></path>
                  <path d="M13.74 7.563c.231.039.442.164.594.343 3.508 4.059 5.625 9.371 5.625 15.157 0 5.785-2.113 11.097-5.625 15.156-.363.422-1 .472-1.422.109-.422-.363-.472-1-.109-1.422 3.211-3.711 5.156-8.551 5.156-13.843 0-5.293-1.949-10.133-5.156-13.844-.27-.309-.324-.75-.141-1.114.188-.367.578-.582.985-.542h.093z"></path>
                  <path d="M7.584 11.438c.227.031.438.144.594.312 2.953 2.863 4.781 6.875 4.781 11.313 0 4.433-1.828 8.449-4.781 11.312-.398.387-1.035.383-1.422-.016-.387-.398-.383-1.035.016-1.421 2.582-2.504 4.187-5.993 4.187-9.875 0-3.883-1.605-7.372-4.187-9.875-.321-.282-.426-.739-.266-1.133.164-.395.559-.641.984-.617h.094zM1.178 15.531c.121.02.238.063.344.125 2.633 1.414 4.437 4.215 4.437 7.407 0 3.195-1.797 5.996-4.437 7.406-.492.258-1.102.07-1.36-.422-.257-.492-.07-1.102.422-1.359 2.012-1.075 3.375-3.176 3.375-5.625 0-2.446-1.371-4.551-3.375-5.625-.441-.204-.676-.692-.551-1.165.122-.468.567-.785 1.051-.742h.094z"></path>
               </svg>
               <div class="card-number">
                  <?php $account = mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999) . " " . mt_rand(1000, 9999); ?>
                  <?php foreach (explode(" ", $account) as $num) : ?>
                     <div class="section"><?= $num; ?></div>
                  <?php endforeach ?>
               </div>
               <div class="card-holder position-relative mt-4"><?= $_SESSION['user']["name"]; ?></div>
               <div class="master">
                  <div class="circle master-red"></div>
                  <div class="circle master-yellow"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="mb-3">
      <div class="d-flex justify-content-between gap-3 flex-wrap-reverse" id="action">
         <div class="d-flex gap-3">
            <select class="form-select width-fit" id="month">
               <?php foreach ($months as $month) : ?>
                  <?php if (strtolower($data['month']) === strtolower($month)) : ?>
                     <option value="<?= $month; ?>" selected><?= $month; ?></option>
                  <?php else : ?>
                     <option value="<?= $month; ?>"><?= $month; ?></option>
                  <?php endif ?>
               <?php endforeach ?>
            </select>
            <select class="form-select width-fit" id="year">
               <?php foreach ($data['getYears'] as $year) : ?>
                  <?php if (strtolower($data['year']) === strtolower($year)) : ?>
                     <option value="<?= $year; ?>" selected><?= $year; ?></option>
                  <?php else : ?>
                     <option value="<?= $year; ?>"><?= $year; ?></option>
                  <?php endif ?>
               <?php endforeach ?>
            </select>
         </div>
         <button data-bs-toggle="modal" data-bs-target="#addWallets" class="btn btn-success btn_addWallets"><i class="uil uil-plus me-2"></i> Add</button>
      </div>
   </div>
   <div class="position-relative box-tabel">
      <div class="scrol-bottom table-responsive-xl">
         <table id="activities" class="table table-striped table-bordered text-thames" style="border: 2px solid var(--border-color) !important;">
            <thead>
               <tr>
                  <th class="header-td1">No</th>
                  <th class="header-td2">Date</th>
                  <th class="header-td3">Activities</th>
                  <th class="header-td4">Nominal</th>
                  <th class="header-td5">Action</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($data['data'] as $value) : ?>
                  <tr>
                     <td class="align-middle ms-3"><?= $numList++; ?></td>
                     <td class="align-middle"><?= $value['date']; ?></td>
                     <td class="align-middle"><?= $value['activities']; ?></td>
                     <td class="align-middle"><?= toCurrency($value['nominal']); ?></td>
                     <td>
                        <?php if ($value['key_spending'] == 0) : ?>
                           <button data-id="<?= $value['id']; ?>" data-bs-toggle="modal" data-bs-target="#addWallets" class="btn_addUpdate btn btn-warning btn-sm">Update</button>
                           <button class="btn btn-danger btn-sm" onclick="deleteAlert('<?= $value['id']; ?>')">Delete</button>
                        <?php else : ?>
                           <a href="<?= BASEURL; ?>dashboard/savings" class="btn btn-success btn-sm">Edite on savings</a>
                        <?php endif ?>
                     </td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<script src="<?= BASEURL ?>public/Vendor/jQuery/jquery-3.6.4.js"></script>
<script>
   // Option
   month.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL; ?>dashboard/wallets/${month.value}/<?= $data['year']; ?>`);
   });
   year.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL . 'dashboard/wallets/' . $data['month']; ?>/${year.value}`);
   });

   // alert
   function deleteAlert(data) {
      Swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
         if (result.isConfirmed) {
            window.location.replace(`<?= BASEURL; ?>Wallets/deleteWallets/${data}`);
         }
      })
   }

   // button edit Data
   $(function() {
      $('.btn_addWallets').on('click', function() {
         $('#addWalletsLabel').html('Add Wallets')
         $('.modal-footer.Income button[type="submit"]').html('Add to wallets')
         $('#addWallet').attr('action', '<?= BASEURL; ?>wallets/addWallets')
      });
      $('.btn_addUpdate').on('click', function() {
         $('#addWalletsLabel').html('Update Data')
         $('.modal-footer.Income button[type="submit"]').html('Update')
         $('#addWallet').attr('action', '<?= BASEURL; ?>wallets/updateWallets')
         const id = $(this).data('id');
         $.ajax({
            url: '<?= BASEURL; ?>wallets/edit',
            data: {
               id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
               $('#Activities').val(data.activities)
               $('#nominal').val(toRupiah(data.nominal, "Rp. "))
               $('#key_spending').val(data.key_spending)
               $('#date').val(data.date)
               $('#id').val(data.id)
            }
         })
      })
   })
</script>

<!-- Notyvication -->
<div class="position-absolute bottom-0" style="right: 1em;">
   <?php Flasher::flash(); ?>
</div>
<!-- Update Modal -->
<div class="modal fade" id="addWallets" tabindex="-1" aria-labelledby="addWalletsLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addWalletsLabel">Add Wallets</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="addWallet" action="" method="post">
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <input type="hidden" name="key_spending" id="key_spending">
               <div class="mb-3 row">
                  <label for="Activities" class="col-md-3 form-label">Activities</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="Activities" name="activities">
                  </div>
               </div>
               <div class="mb-3 row">
                  <label for="nominal" class="col-md-3 form-label">Nominal</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="nominal" name="nominal">
                  </div>
               </div>
               <div class="mb-3 row">
                  <label for="date" class="col-md-3 form-label">Date</label>
                  <div class="col-md-9">
                     <input type="date" class="form-control" id="date" name="date">
                  </div>
               </div>
            </div>
            <div class="modal-footer Income">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   // Validate Data
   var validates = document.querySelectorAll("#nominal");
   validates.forEach(validate => {
      validate.addEventListener("keyup", function(e) {
         validate.value = toRupiah(this.value, "Rp. ");
      });
   });
</script>