<Style>
   #dataTable,
   .card {
      border: 1px solid var(--border-color) !important;
      color: var(--text-color);
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
</Style>
<div class="dash-content">
   <h2 class="mt-4 mb-3" style="color: var(--text-color);">Financial Backup Tube</h2>
   <div class="rows-cols-1 rows-cols-sm-2 rows-cols-xl-3">
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #e74a3b; background-color: var(--second-color); color: var(--text-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">TOTAL SAVINGS</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($data['nominal'][0]['selisih']); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-credit-card"></i>
         </div>
      </div>
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #1cc88a; background-color: var(--second-color); color: var(--text-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">Savings (<?= date("Y"); ?>)</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($data['nominal'][1]['Income']); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-bullseye"></i>
         </div>
      </div>
      <div class="main-boxs p-4 rounded shadow position-relative overflow-hidden" style="--boxs-color: #f6c23e; background-color: var(--second-color); color: var(--text-color);">
         <h6 class="text-uppercase heading-box" style="font-size: .9rem;">SAVING OUT (<?= date("Y"); ?>)</h6>
         <div class="box-desk flex">
            <span class="fs-4"><?= toCurrency($data['nominal'][1]['Spending']); ?></span>
            <i class="position-absolute top-50 translate-middle-y fs-1 uil uil-chart-pie-alt"></i>
         </div>
      </div>
   </div>
   <div class="rows-cols-1  rows-cols-lg-2 mt-4">
      <div class="rounded shadow">
         <div class="card h-100" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header text-primary fs-6 d-flex justify-content-between"><span>Income activity</span> <button data-id="" data-bs-toggle="modal" data-bs-target="#increaseSavings" class="btn btn-success btn-sm addIncome">Increase savings</button></div>
            <div class="card-body overflow-x-auto">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                     <?php $s = 1; ?>
                     <?php foreach ($data['data'][0] as $income) : ?>
                        <tr>
                           <td style="vertical-align: middle;"><?= $s++; ?></td>
                           <td style="vertical-align: middle;"><?= $income['date']; ?></td>
                           <td style="vertical-align: middle;"><?= $income['activities']; ?></td>
                           <td style="vertical-align: middle;"><?= toCurrency($income['nominal']); ?></td>
                           <td style="text-align: center;" class="d-flex gap-2">
                              <button class="btn btn-info updateIncome" data-id="<?= $income['id']; ?>" data-bs-toggle="modal" data-bs-target="#increaseSavings"><i class="uil uil-pen"></i></button>
                              <button class="btn btn-danger" onclick="deleteAlert('<?= $income['id']; ?>')"><i class="uil uil-trash-alt"></i></button>
                           </td>
                        </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="rounded shadow">
         <div class="card h-100" style="background-color: var(--second-color); color: var(--black-light-color);">
            <div class="card-header text-primary fs-6 d-flex justify-content-between"><span>Spending activity</span> <button data-id="" data-bs-toggle="modal" data-bs-target="#takeSavings" class="btn btn-warning text-white btn-sm addSpending">Take savings</button></div>
            <div class="card-body overflow-x-auto">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                     <?php $s = 1 ?>
                     <?php foreach ($data['data'][1] as $spending) : ?>
                        <tr>
                           <td style="vertical-align: middle;"><?= $s++; ?></td>
                           <td style="vertical-align: middle;"><?= $spending['date']; ?></td>
                           <td style="vertical-align: middle;"><?= $spending['activities']; ?></td>
                           <td style="vertical-align: middle;"><?= toCurrency($spending['nominal']); ?></td>
                           <td style="text-align: center;" class="d-flex gap-2">
                              <button class="btn btn-info updateSpending" data-id="<?= $spending['id']; ?>" data-bs-toggle="modal" data-bs-target="#takeSavings"><i class="uil uil-pen"></i></button>
                              <button class="btn btn-danger" onclick="deleteAlert('<?= $spending['id']; ?>','<?= $spending['key_spending']; ?>')"><i class="uil uil-trash-alt"></i></button>
                           </td>
                        </tr>
                     <?php endforeach ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   // alert
   function deleteAlert(id, key = '0') {
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
            window.location.replace(`<?= BASEURL; ?>savings/deleteSavings/${id}/${key}`);
         }
      })
   }
</script>
<!-- increaseSavings Modal -->
<div class="modal fade" id="increaseSavings" tabindex="-1" aria-labelledby="modalLabelIncrease" aria-hidden="true" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabelIncrease">Update Data</h5>
            <button type="button" class="btn-close buttonClose" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="postIncreaseSavings" action="" method="post">
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <input type="hidden" name="type" id="type">
               <div class="mb-3 row">
                  <label for="Activities" class="col-md-3 form-label">Activities</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="Activities" name="activities" required>
                  </div>
               </div>
               <div class="mb-3 row">
                  <label for="nominal" class="col-md-3 form-label">Nominal</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="nominal" name="nominal" required>
                  </div>
               </div>
               <div class="mb-3 row">
                  <label for="date" class="col-md-3 form-label">Date</label>
                  <div class="col-md-9">
                     <input type="date" class="form-control" id="date" name="date" required>
                  </div>
               </div>
            </div>
            <div class="modal-footer Income">
               <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- takeSavings Modal -->
<div class="modal fade" id="takeSavings" tabindex="-1" aria-labelledby="modalLabelTake" aria-hidden="true" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabelTake">Update Data</h5>
            <button type="button" class="btn-close buttonClose" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="postTakeSavings" action="" method="post">
            <div class="modal-body">
               <input type="hidden" name="id" id="idTake">
               <input type="hidden" name="type" id="typeTake">
               <input type="hidden" name="date" id="dateTake">
               <input id="checkboxValue" type="hidden" value="" name="checkboxValue">
               <div class="mb-3 row">
                  <label for="ActivitieTake" class="col-md-3 form-label">Activities</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="ActivitieTake" name="activities" required>
                  </div>
               </div>
               <div class="mb-3 row">
                  <label for="nominalTake" class="col-md-3 form-label">Nominal</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control" id="nominalTake" name="nominal" required>
                  </div>
               </div>
               <div class="form-check mt-4">
                  <input class="form-check-input" type="checkbox" value="" name="checkbox" id="flexCheckDefault">
                  <label class="form-check-label" for="flexCheckDefault">
                     Place it in the wallet.
                  </label>
               </div>
            </div>
            <div class="modal-footer Spending">
               <button type="button" class="btn btn-secondary buttonClose" data-bs-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-warning">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Notyvication -->
<div class="position-absolute bottom-0" style="right: 1em;">
   <?php Flasher::flash(); ?>
</div>

<script src="<?= BASEURL ?>public/js/toCurrency.js"></script>
<script>
   // Validate Data
   var validates = [document.querySelector("#nominal"),
      document.querySelector("#nominalTake")
   ];
   validates.forEach(validate => {
      validate.addEventListener("keyup", function(e) {
         validate.value = toRupiah(this.value, "Rp. ");
      });
   });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
   // button edit Data
   $(function() {
      $('.addIncome').on('click', function() {
         $('#modalLabelIncrease').html('Add Data Income activity')
         $('.modal-footer.Income button[type="submit"]').html('Add savings')
         $('#postIncreaseSavings').attr('action', '<?= BASEURL; ?>savings/addIncome')
      });
      $('.updateIncome').on('click', function() {
         $('#modalLabelIncrease').html('Update Data Income activity')
         $('.modal-footer.Income button[type="submit"]').html('Update savings')
         $('#postIncreaseSavings').attr('action', '<?= BASEURL; ?>savings/updateSavings')
         const id = $(this).data('id');
         $.ajax({
            url: '<?= BASEURL; ?>savings/editSpending',
            data: {
               id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
               $('#Activities').val(data.activities)
               $('#nominal').val(toRupiah(data.nominal, "Rp. "))
               $('#date').val(data.date)
               $('#type').val(data.type)
               $('#id').val(data.id)
            }
         })
      })

      $('.addSpending').on('click', function() {
         $('#modalLabelTake').html('Add spending activity')
         $('.modal-footer.Spending button[type="submit"]').html('Add spending')
         $('#postTakeSavings').attr('action', '<?= BASEURL; ?>savings/addSpending')
      });
      $('.updateSpending').on('click', function() {
         $('#modalLabelTake').html('Update spending activity')
         $('.modal-footer.Spending button[type="submit"]').html('Update spending')
         $('#postTakeSavings').attr('action', '<?= BASEURL; ?>savings/updateSavings')
         const id = $(this).data('id');
         $.ajax({
            url: '<?= BASEURL; ?>savings/editSpending',
            data: {
               id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
               $('#ActivitieTake').val(data.activities)
               $('#nominalTake').val(toRupiah(data.nominal, "Rp. "))
               $('#dateTake').val(data.date)
               $('#typeTake').val(data.type)
               $('#idTake').val(data.id)
               $('#checkboxValue').val(data.key_spending)
               $('.form-check').addClass("d-none");
            }
         })
      })
      $('.buttonClose').on('click', function() {
         $('#Activities').val('')
         $('#nominal').val('')
         $('#date').val('')
         $('#type').val('')
         $('#id').val('')
         $('#ActivitieTake').val('')
         $('#nominalTake').val('')
         $('#dateTake').val('')
         $('#typeTake').val('')
         $('#idTake').val('')
         $('#checkboxValue').val('')
         $('.form-check').removeClass("d-none");
      })
   });
</script>