<div class="dash-content">
   <h2 class="mt-4 mb-3 text-thames">Seting</h2>
   <ul class="nav nav-tabs">
      <li class="nav-item">
         <a class="nav-link <?= ($data['val'] == 'profile') ? 'active' : ''; ?>" href="<?= BASEURL; ?>dashboard/setting/profile">Profile</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?= ($data['val'] == 'output') ? 'active' : ''; ?>" href="<?= BASEURL; ?>dashboard/setting/output">Print Settings</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?= ($data['val'] == 'account') ? 'active' : ''; ?>" href="<?= BASEURL; ?>dashboard/setting/account">Account</a>
      </li>
   </ul>
</div>
<section class="mt-3">
   <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 my-4">
      <div class="profile d-flex  align-items-center gap-3">
         <img class="rounded-circle img-thumbnail" width="90px" data-bs-toggle="dropdown" aria-expanded="false" src="<?= BASEURL; ?>public/assets/profile.jpg" alt="">
         <div>
            <h4 class="mb-0 fullName">Mulya Hadi Saputra</h4>
            <span class="username">@Saputra</span>
         </div>
      </div>
      <div class="action">
         <i class="bx-icon uil uil-pen editButton me-2"></i>
         <i onclick="deleteAlert('2')" class="bx-icon uil uil-trash" style="--bg-btn:#e74a3b; color: #fff;"></i>
      </div>
   </div>
   <div class="noty text-thames">
      <h4>Notyfication setting</h4>
      <p>By default, designers will be notified by your company's preferred dark patterns.
         Employees can also customize their notification preferences by logging into the Setproduct dashboard</p>
   </div>
   <div class="form-profile border border-2 border-light rounded-3 p-3" style="width: 100%; max-width: 47em;">
      <h5 class="text-thames mb-3">Edit profile</h5>
      <form action="" method="post">
         <div class="row">
            <div class="col-md-6 col-12">
               <input type="text" class="inputForm form-control" name="name" id="name" placeholder="Full name" disabled>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <input type="text" class="inputForm form-control" name="username" id="username" placeholder="@username" disabled>
            </div>
         </div>
         <div class="row my-3 my-md-3">
            <div class="col-md-6 col-12">
               <input type="email" class="inputForm form-control" name="email" id="email" placeholder="Your email" disabled>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <input type="text" class="inputForm form-control" name="location" id="location" placeholder="Location" disabled>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 col-12">
               <input type="text" class="inputForm form-control" name="instansi" id="instansi" placeholder="Instansi" disabled>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <label for="userImage" class="w-100">
                  <a class="form-control text-decoration-none" rel=" nofollow"><span class='glyphicon glyphicon-paperclip'></span>Profile picture</a>
               </label>
               <input type="file" name="userImage" id="userImage" class="inputForm d-none" disabled>
            </div>
         </div>
         <button type="submit" class="btn btn-success mt-3 w-100 inputForm" disabled>Submit</button>
      </form>
   </div>
</section>

<style>
   .nav-tabs .nav-item.show .nav-link,
   .nav-tabs .nav-link.active {
      color: var(--text-color);
      background-color: var(--panel-color);
      border-color: var(--bs-nav-tabs-link-active-border-color);
   }

   .nav-tabs {
      --bs-nav-tabs-link-active-border-color: var(--border-color) var(--border-color) var(--panel-color);
      border-bottom: var(--bs-nav-tabs-border-width) solid var(--border-color);
   }

   .nav-tabs .nav-link:hover {
      border: 1px solid;
      border-color: var(--border-color) var(--border-color) transparent;
   }

   .nav-tabs .nav-link {
      color: var(--text-color);
   }

   .action .bx-icon {
      --bg-btn: #d5d5d5;
      position: relative;
      display: inline-block;
      width: 34px;
      height: 34px;
      background-color: var(--bg-btn);
      border-radius: 50%;
      font-size: 1em;
   }

   .action .bx-icon::before {
      position: absolute;
      transform: translate(-50%, -50%) !important;
      left: 50% !important;
      top: 50% !important;
   }

   .action i.active {
      --bg-btn: rgba(105, 92, 254, 0.8) !important;
      color: #fff;
   }
</style>

<script src="<?= BASEURL ?>public/Vendor/jQuery/jquery-3.6.4.js"></script>
<script>
   // inputForm
   let editButton = document.querySelector('.editButton'),
      inputForms = document.querySelectorAll('.inputForm');
   editButton.addEventListener('click', () => {
      editButton.classList.toggle("active");
      inputForms.forEach((e) => {
         e.toggleAttribute('disabled');
      });
   })
   // 
   let name = document.querySelector('#name'),
      fullName = document.querySelector('.fullName'),
      username = document.querySelector('#username'),
      userName = document.querySelector('.username');
   name.addEventListener('keyup', () => {
      if (name.value.length > 1) {
         fullName.innerText = name.value.replace(/[^A-Za-z\s]/g, '');
         name.value = name.value.replace(/[^A-Za-z\s]/g, '');
      } else {
         fullName.innerText = 'Mulya Hadi Saputra';
      }
   })
   username.addEventListener('keyup', () => {
      if (username.value.length > 1) {
         userName.innerText = '@' + username.value.replace(/[^A-Za-z1-9_\s]/g, "");
         username.value = username.value.replace(/[^A-Za-z1-9_\s]/g, "");
      } else {
         userName.innerText = '@Saputra';
      }
   })

   // alert
   function deleteAlert(id) {
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
            window.location.replace(`<?= BASEURL; ?>setting/deleteUser/${id}`);
         }
      })
   }
</script>