<?php
$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$years = ['2022', '2023'];
$urls = $_SERVER['REQUEST_URI'];
$numList = 1;
?>
<link rel="stylesheet" href="<?= BASEURL ?>public/css/activities.css">
<link rel="stylesheet" href="<?= BASEURL ?>public/Vendor/DataTables/dataTables.bootstrap5.min.css">

<div class="dash-content">
   <h2 class="mt-4 mb-3" style="color: var(--black-light-color);">Activities</h2>
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
         <div class="d-flex gap-3 flex-wrap">
            <a href="<?= BASEURL ?>activities/cuteoff/<?= $data['month'] . "/" . $data['year']; ?>" class="btn btn-warning"><i class="uil uil-dollar-alt me-2"></i> Cut off</a>
            <div class="d-flex gap-3">
               <a href="<?= BASEURL ?>activities/print/<?= $data['month'] . "/" . $data['year']; ?>" class="btn btn-success"><i class="uil uil-print me-2"></i> Print</a>
               <button data-id="" data-bs-toggle="modal" data-bs-target="#addActivities" class="btn btn-danger"><i class="uil uil-plus me-2"></i> Add</button>
            </div>
         </div>
      </div>
   </div>
   <div class="position-relative box-tabel">
      <div class="scrol-bottom table-responsive-xl">
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
               <?php foreach ($data['data'] as $value) : ?>
                  <tr>
                     <td class="align-middle ms-3"><?= $numList++; ?></td>
                     <td class="align-middle"><?= $value['dates']; ?></td>
                     <td class="align-middle"><?= $value['activity']; ?></td>
                     <td class="align-middle"><?= toCurrency($value['nominal']); ?></td>
                     <td>
                        <button data-id="<?= $value['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateActivities" class="ButtonUpdate btn btn-warning btn-sm">Update</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteAlert('<?= $value['id']; ?>')">Delete</button>
                     </td>
                  </tr>
               <?php endforeach ?>
            </tbody>
         </table>
      </div>
   </div>
</div>

<script src="<?= BASEURL ?>public/Vendor/jQuery/jquery-3.6.4.js"></script>
<script src="<?= BASEURL ?>public/Vendor/DataTables/dataTables.jquery.min.js"></script>
<script src="<?= BASEURL ?>public/Vendor/DataTables/dataTables.bootstrap5.min.js"></script>
<script>
   // Option
   month.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL; ?>dashboard/activities/${month.value}/<?= $data['year']; ?>`);
   });
   year.addEventListener("change", function() {
      window.location.replace(`<?= BASEURL . 'dashboard/activities/' . $data['month']; ?>/${year.value}`);
   });

   // jQuery DataTable
   $(document).ready(function() {
      $('#activities').DataTable({
         "pageLength": 25,
      });
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
            window.location.replace(`<?= BASEURL; ?>activities/deleteactivity/${data}`);
         }
      })
   }

   // button edit Data
   $(function() {
      $('.ButtonUpdate').on('click', function() {
         const id = $(this).data('id');
         $.ajax({
            url: '<?= BASEURL; ?>activities/editactivitys',
            data: {
               id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
               $('#Activities').val(data.activity)
               $('#nominal').val(toRupiah(data.nominal, "Rp. "))
               $('#date').val(data.dates)
               $('#id').val(data.id)
            }
         })
      })
   });
</script>

<!-- Notyvication -->
<div class="position-absolute bottom-0" style="right: 1em;">
   <?php Flasher::flash(); ?>
</div>
<!-- Update Modal -->
<div class="modal fade" id="updateActivities" tabindex="-1" aria-labelledby="updateActivitiesLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="updateActivitiesLabel">Update Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="updateUser" action="<?= BASEURL; ?>activities/updateactivity" method="post">
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
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
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-warning">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="addActivities" tabindex="-1" aria-labelledby="addActivitiesLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="addActivitiesLabel">Add User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="addUser" action="<?= BASEURL; ?>activities/addactivity" method="post">
            <div class="modal-body">
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
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
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