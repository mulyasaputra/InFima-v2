<?php
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$numList = 1;
?>

<!-- html Section -->
<link rel="stylesheet" href="<?= BASEURL ?>public/Vendor/DataTables/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>public/css/dashboard/wallets.css">
<!-- Credit Cards -->
<div class="cc-container">
   <div class="cc-card">
      <div class="cc-card-inner">
         <div class="cc-front">
            <img src="https://i.ibb.co/PYss3yv/map.png" class="cc-map-img">
            <div class="cc-row">
               <img src="https://i.ibb.co/G9pDnYJ/chip.png" width="60px">
               <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="60px">
            </div>
            <div class="cc-row cc-card-no">
               <?php foreach (explode(" ", $_SESSION['user']["account"]) as $num) : ?>
                  <p><?= $num; ?></p>
               <?php endforeach ?>
            </div>
            <div class="cc-row cc-card-holder">
               <p>CARD HPLDER</p>
               <p>VALID TILL</p>
            </div>
            <div class="cc-row cc-name">
               <p><?= $_SESSION["user"]["name"]; ?></p>
               <?php $dateParts = explode("-", $_SESSION["user"]["date"]); ?>
               <p><?= $dateParts[1]; ?> / <?= substr($dateParts[0], 2, 4) + 5; ?></p>
            </div>
         </div>
         <div class="cc-back">
            <img src="https://i.ibb.co/PYss3yv/map.png" class="cc-map-img">
            <div class="cc-row cc-card-cvv">
               <span>Total balance</span>
               <h2><?= toCurrency($data['data'][2] + $_SESSION['Record'] - $data['data2']['savings'] - $data['data2']['activity']) ?></h2>
            </div>
            <div class="cc-row cc-card-text">
               <p>this is a virtual card design using HTML and CSS. You can aslo design something like this.</p>
            </div>
            <div class="cc-row cc-signature">
               <p>CUSTOMER SIGNATURE</p>
               <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="80px">
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Main Menu -->
<div class="mb-4" id="action">
   <div class="d-flex justify-content-between gap-3 flex-wrap-reverse" id="action">
      <!-- Dropdown Month & Years -->
      <div class="d-flex gap-3 w-100 sm-fit-content">
         <select class="form-select w-100 sm-fit-content" id="month">
            <?php foreach ($months as $month) : ?>
               <?php if (strtolower($data['month']) === strtolower($month)) : ?>
                  <option value="<?= $month; ?>" selected><?= $month; ?></option>
               <?php else : ?>
                  <option value="<?= $month; ?>"><?= $month; ?></option>
               <?php endif ?>
            <?php endforeach ?>
         </select>
         <select class="form-select w-100 sm-fit-content" id="year">
            <?php foreach ($data['data'][1] as $year) : ?>
               <?php if (strtolower($data['year']) === strtolower($year)) : ?>
                  <option value="<?= $year; ?>" selected><?= $year; ?></option>
               <?php else : ?>
                  <option value="<?= $year; ?>"><?= $year; ?></option>
               <?php endif ?>
            <?php endforeach ?>
         </select>
      </div>
      <!-- Action Button -->
      <button data-id="" data-bs-toggle="modal" data-bs-target="#addWallets" class="btn btn-success w-100 sm-fit-content btn_addWallets"><i class="uil uil-plus me-2"></i> Add</button>
   </div>
</div>
<!-- Data Tabel -->
<div class="position-relative box-tabel">
   <table id="activities" class="table table-striped table-bordered">
      <thead>
         <tr>
            <th style="min-width: 10px">No</th>
            <th style="min-width: 116px">Date</th>
            <th style="width: 100%; min-width: 300px">Activities</th>
            <th style="min-width: 160px">Nominal</th>
            <th style="min-width: 130px;">Action</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($data['data'][0] as $value) : ?>
            <tr>
               <td class="align-middle ms-3"><?= $numList++; ?></td>
               <td class="align-middle"><?= $value['date']; ?></td>
               <td class="align-middle"><?= $value['activities']; ?></td>
               <td class="align-middle"><?= toCurrency($value['nominal']); ?></td>
               <td>
                  <?php if ($value['key_spending'] == 0) : ?>
                     <button data-id="<?= $value['id']; ?>" data-bs-toggle="modal" data-bs-target="#addWallets" class="ButtonUpdate btn btn-warning btn-sm btn_addUpdate">Update</button>
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

<!-- ModalBox -->
<div class="modal fade" id="addWallets" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addWalletsLabel" aria-hidden="true">
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
               <button type="button" class="btn btn-secondary btnModal-Close" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>


<script src="<?= BASEURL ?>public/Vendor/SweetAlert2/sweetalert2.all.min.js"></script>
<script src="<?= BASEURL ?>public/Vendor/jQuery/jquery-3.6.4.js"></script>
<script src="<?= BASEURL ?>public/Vendor/DataTables/dataTables.jquery.min.js"></script>
<script src="<?= BASEURL ?>public/Vendor/DataTables/dataTables.bootstrap5.min.js"></script>
<script>
   // Option
   month.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL; ?>dashboard/wallets/${month.value}/<?= $data['year']; ?>`);
   });
   year.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL . 'dashboard/wallets/' . $data['month']; ?>/${year.value}`);
   });

   // Validate Data Money
   var validates = document.querySelectorAll("#nominal");
   validates.forEach(validate => {
      validate.addEventListener("keyup", function(e) {
         validate.value = toRupiah(this.value, "Rp. ");
      });
   });
   // Sweet alert
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
            window.location.replace(`<?= BASEURL; ?>wallets/deleteWallets/${data}`);
         }
      })
   }
   // jQuery DataTable
   $(document).ready(function() {
      $('#activities').DataTable({
         "pageLength": 50,
      });
   });

   // button edit Data
   $(function() {
      $('.modal-header button, .modal-footer .btnModal-Close').on('click', function() {
         $('#Activities').val('');
         $('#nominal').val('');
         $('#date').val('');
      });
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