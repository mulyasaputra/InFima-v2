<link rel="stylesheet" href="<?= BASEURL ?>public/css/dashboard/setting.css">

<!-- Panel -->
<div class="dash-content">
   <ul class="nav nav-tabs">
      <li class="nav-item">
         <a class="nav-link <?= ($data["select"] === "profile") ? "active" : ""; ?>" href="<?= BASEURL ?>dashboard/setting/profile">Profile</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?= ($data["select"] === "output") ? "active" : ""; ?>" href="<?= BASEURL ?>dashboard/setting/output">Print Settings</a>
      </li>
      <li class="nav-item">
         <a class="nav-link <?= ($data["select"] === "account") ? "active" : ""; ?>" href="<?= BASEURL ?>dashboard/setting/account">Account</a>
      </li>
   </ul>
</div>

<style>
   #hiden {
      display: none;
   }
</style>

<!-- Profile Screen -->
<section class="mt-3" id="<?= ($data["select"] === "profile") ? "profile" : "hiden"; ?>">
   <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 my-4">
      <div class="profile d-flex  align-items-center gap-3">
         <img class="rounded-circle img-thumbnail" width="90px" data-bs-toggle="dropdown" aria-expanded="false" src="<?= BASEURL ?>public/user_profile/<?= $_SESSION['user']["profile"]; ?>" alt="">
         <div>
            <h4 class="mb-0 fullName"><?= $_SESSION["user"]["name"]; ?></h4>
            <span class="username">@<?= $_SESSION["user"]["username"]; ?></span>
         </div>
      </div>
      <div class="action">
         <i class="bx-icon uil uil-pen editButton me-2"></i>
         <i onclick="deleteAlerta('2')" class="bx-icon uil uil-trash" style="--bg-btn:#e74a3b; color: #fff;"></i>
      </div>
   </div>
   <div class="noty text-thames">
      <h4>Notification Settings</h4>
      <p>By default, designers will be notified by your company's preferred dark patterns.
         Employees can also customize their notification preferences by logging into the Setproduct dashboard</p>
   </div>
   <div class="form-profile p-3" style="width: 100%; max-width: 47em;">
      <h5 class="text-thames mb-3">Edit profile</h5>
      <form action="<?= BASEURL; ?>setting/updateProfile" method="post" enctype="multipart/form-data">
         <input type="hidden" name="profile" value="<?= $_SESSION['user']["profile"]; ?>">
         <div class="row">
            <div class="col-md-6 col-12">
               <input type="text" class="inputForm form-control" name="name" id="name" placeholder="Full name" disabled="" value="<?= $_SESSION["user"]["name"]; ?>">
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <input type="text" class="inputForm form-control" name="username" id="username" placeholder="@username" disabled="" value="@<?= $_SESSION["user"]["username"]; ?>">
            </div>
         </div>
         <div class="row my-3 my-md-3">
            <div class="col-md-6 col-12">
               <input type="email" class="inputForm form-control" name="email" id="email" placeholder="Your email" disabled="" value="<?= $data['data'][0]["email"]; ?>">
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <input type="text" class="inputForm form-control" name="location" id="location" placeholder="Location" disabled="" value="<?= $data['data'][0]["lokasi"]; ?>">
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 col-12">
               <input type="text" class="inputForm form-control" name="instansi" id="instansi" placeholder="Instansi" disabled="" value="<?= $data['data'][0]["instansi"]; ?>">
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
               <label for="userImage" class="w-100">
                  <a class="form-control text-decoration-none" rel=" nofollow" id="userProfile">Profile picture</a>
               </label>
               <input onchange="validateFile(this)" type="file" name="userImage" id="userImage" class="inputForm d-none" accept=".jpg, .jpeg, .png, .webp" disabled="">
            </div>
         </div>
         <button type="submit" class="btn btn-success mt-3 w-100 inputForm" disabled="">Submit</button>
      </form>
   </div>
</section>
<!-- Print Output Screen -->
<section class="mt-3" id="<?= ($data["select"] === "output") ? "output" : "hiden"; ?>">
   <div class="form-profile p-3" style="width: 100%; max-width: 47em;">
      <h5 class="text-thames mb-3">Print to PRF></h5>
      <form action="<?= BASEURL; ?>setting/updatePrint" method="post">
         <input type="hidden" name="id" value="<?= $data['data'][0]['id']; ?>">
         <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
               <p class="m-0 me-2">margin <span style="font-size: 11px;">[Right, Top, Left, Bottom]</span></p>
               <select class="form-select w-100 sm-fit-content" id="Konversi" name="marginUnits">
                  <?php foreach (["px", "cm", "inc"] as $units) : ?>
                     <?php if (strtolower($data['data'][0]["margin_units"]) === strtolower($units)) : ?>
                        <option value="<?= $units; ?>" selected><?= $units; ?></option>
                     <?php else : ?>
                        <option value="<?= $units; ?>"><?= $units; ?></option>
                     <?php endif ?>
                  <?php endforeach ?>
               </select>
            </div>
            <div class="row" style="row-gap: 1em;">
               <?php $a = 0;
               $b = ["Right", "Top", "Left", "Bottom"] ?>
               <?php foreach (explode(",", $data['data'][0]['margin']) as $num) : ?>
                  <div class="col-md-6 col-12">
                     <input type="text" class="inputForm form-control" name="margin_<?= $b[$a]; ?>" id="margin_<?= $b[$a]; ?>" value="<?= $num; ?>" oninput="validateInput(this)">
                  </div>
                  <?php $a++ ?>
               <?php endforeach ?>
            </div>
         </div>
         <div>
            <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
               <p class="m-0">Paper size <span style="font-size: 11px;">[Width, Height]</span></p>
               <div class="d-flex gap-2">
                  <select class="form-select w-100 sm-fit-content" id="paper_size" name="paperSize" onchange="CustomInput()">
                     <?php foreach (["Custom", "A3", "A4", "F4", "Legal", "Letter"] as $units) : ?>
                        <?php if (strtolower($data['data'][0]["type"]) === strtolower($units)) : ?>
                           <option value="<?= $units; ?>" selected><?= $units; ?></option>
                        <?php else : ?>
                           <option value="<?= $units; ?>"><?= $units; ?></option>
                        <?php endif ?>
                     <?php endforeach ?>
                  </select>
                  <select class="form-select w-100 sm-fit-content" id="size_units" name="sizeUnits">
                     <?php foreach (["px", "mm", "cm", "inch"] as $units) : ?>
                        <?php if (strtolower($data['data'][0]["size_units"]) === strtolower($units)) : ?>
                           <option value="<?= $units; ?>" selected><?= $units; ?></option>
                        <?php else : ?>
                           <option value="<?= $units; ?>"><?= $units; ?></option>
                        <?php endif ?>
                     <?php endforeach ?>
                  </select>
               </div>
            </div>
            <div class="row my-3 my-md-3" style="row-gap: 1em;">
               <?php $a = 0;
               $b = ['width', 'height']; ?>
               <?php foreach (explode(",", $data['data'][0]["size"]) as $num) : ?>
                  <div class="col-md-6 col-12">
                     <input type="text" class="inputForm form-control custom-input" name="size_<?= $b[$a]; ?>" value="<?= $num; ?>" oninput="validateInput(this)">
                  </div>
                  <?php $a++ ?>
               <?php endforeach ?>
            </div>
         </div>
         <button type="submit" class="btn btn-success mt-3 w-100 inputForm">Submit</button>
      </form>
   </div>
</section>
<!-- Account Screen -->
<section class="mt-3" id="<?= ($data["select"] === "account") ? "account" : "hiden"; ?>">
   <div class="api-key">
      <h4>Key</h4>
      <div class="w-100 width-a">
         <p class="mb-0 me-0 overflow-hidden"><?= $data['data'][0]["api_key"]; ?></p>
         <div class="p-0">
            <i class="bx-icon uil uil-redo" style="--bg-color-button: 228, 24, 24;"></i>
            <i onclick="copy('<?= $data['data'][0]['api_key']; ?>', 'Api Key')" class="bx-icon uil uil-clipboard-alt"></i>
         </div>
      </div>
   </div>
   <div class="api-reg mt-4">
      <h4>No Reg.</h4>
      <div class="w-100 width-a">
         <p class="mb-0 me-0 overflow-hidden">
            <?php foreach (explode(" ", $data['data'][0]["account"]) as $num) : ?>
               <span><?= $num; ?></span>
            <?php endforeach ?>
         </p>
         <div class="p-0">
            <i onclick="copy('<?= $data['data'][0]['account']; ?>', 'No Reg.')" class="bx-icon uil uil-clipboard-alt"></i>
         </div>
      </div>
   </div>
   <div class="mail-key mt-4">
      <h4>E-mail</h4>
      <div class="w-100 width-a">
         <p class="mb-0 me-0 overflow-hidden"><?= $data['data'][0]["email"]; ?></p>
         <div class="p-0">
            <i onclick="copy('<?= $data['data'][0]['email']; ?>', 'E-mail')" class="bx-icon uil uil-clipboard-alt"></i>
         </div>
      </div>
   </div>
   <div class="pass-key mt-4">
      <h4>Password</h4>
      <div class="w-100 width-a">
         <p class="mb-0 me-0 overflow-hidden">Change your password</p>
         <div class="p-0">
            <i data-bs-toggle="modal" data-bs-target="#ChangePassword" class="bx-icon uil uil-pen"></i>
         </div>
      </div>
   </div>
</section>

<!-- Alert -->
<div id="alert-copy" class="alert alert-primary fade fade-alert d-flex align-items-center position-absolute" role="alert" style="font-size: 76%;">
   <i class="uil uil-copy me-2"></i>
   <p class="m-0"><strong class="text-alert-copy">Text</strong> has been copied.</p>
</div>

<!-- ModalBox -->
<div class="modal fade" id="ChangePassword" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ChangePasswordLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="ChangePasswordLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <form id="Change_Pass" action="" method="post">
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="inputBox" style="margin-top: 1rem;">
                  <input type="text" name="OldPassword" class="OldPassword" required onkeyup="this.setAttribute('value', this.value);" value="" />
                  <label>Old password</label>
               </div>
               <div class="inputBox">
                  <input type="password" name="NewPassword" class="NewPassword" required onkeyup="this.setAttribute('value', this.value);" value="" />
                  <label>New password</label>
               </div>
               <div class="inputBox">
                  <input style="margin-bottom: 0.5rem;" type="password" name="NewPassword2" class="NewPassword2" required onkeyup="this.setAttribute('value', this.value); chack_password();" value="" />
                  <label>Confirm new password</label>
               </div>
               <span class="Match-notif invisible">Password do not Match</span>
               <div class="modal-footer Income">
                  <button type="button" class="btn btn-secondary btnModal-Close" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Update</button>
               </div>
         </form>
      </div>
   </div>
</div>

<!-- Script -->
<script src="<?= BASEURL ?>public/Vendor/SweetAlert2/sweetalert2.all.min.js"></script>
<script>
   function validateFile(input) {
      const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
      const file = input.files[0];
      const fileName = file.name.toLowerCase();
      const fileExtension = fileName.split('.').pop();

      if (!allowedExtensions.includes(fileExtension)) {
         alert('Hanya file dengan ekstensi JPG, JPEG, atau PNG yang diizinkan.');
         input.value = ''; // Mengosongkan input file jika tipe tidak sesuai
      }
      // const fileInput = document.getElementById('fileInput');
      const fileNameDisplay = document.getElementById('userProfile');
      if (input.files.length > 0) {
         const fileName = input.files[0].name;
         fileNameDisplay.textContent = fileName;
      } else {
         fileNameDisplay.textContent = 'Profile picture';
      }
   }

   // Mengganti karakter yang bukan angka atau tanda titik dengan string kosong
   function validateInput(input) {
      input.value = input.value.replace(/[^0-9.]/g, '');
   }

   // Validate units size
   const unitsSize = {
      "Custom": {
         "cm": {
            width: 21.6,
            height: 33.0
         },
         "mm": {
            width: 215,
            height: 330
         },
         "px": {
            width: 819,
            height: 1248
         },
         "inch": {
            width: 8.50,
            height: 13.00
         }
      },
      "A3": {
         "cm": {
            width: 29.7,
            height: 42.0
         },
         "mm": {
            width: 297,
            height: 420
         },
         "px": {
            width: 1122,
            height: 1587
         },
         "inch": {
            width: 11.69,
            height: 16.54
         }
      },
      "A4": {
         "cm": {
            width: 21.0,
            height: 29.7
         },
         "mm": {
            width: 210,
            height: 297
         },
         "px": {
            width: 794,
            height: 1123
         },
         "inch": {
            width: 8.27,
            height: 11.69
         }
      },
      "F4": {
         "cm": {
            width: 21.6,
            height: 33.0
         },
         "mm": {
            width: 215,
            height: 330
         },
         "px": {
            width: 819,
            height: 1248
         },
         "inch": {
            width: 8.50,
            height: 13.00
         }
      },
      "Legal": {
         "cm": {
            width: 21.6,
            height: 35.6
         },
         "mm": {
            width: 216,
            height: 356
         },
         "px": {
            width: 819,
            height: 1344
         },
         "inch": {
            width: 8.50,
            height: 14.00
         }
      },
      "Letter": {
         "cm": {
            width: 21.6,
            height: 27.9
         },
         "mm": {
            width: 216,
            height: 279
         },
         "px": {
            width: 819,
            height: 1056
         },
         "inch": {
            width: 8.50,
            height: 11.00
         }
      }
   };

   // Call the updateSize function initially and set up event listeners
   function updateSize() {
      const paperSizeSelect = document.getElementById("paper_size");
      const unitsSelect = document.getElementById("size_units");
      const Input = document.querySelectorAll('.custom-input');
      const newSize = unitsSize[paperSizeSelect.value][unitsSelect.value];
      let val = 0
      const size = ['width', 'height'];
      Input.forEach(e => {
         e.value = newSize[size[val]];
         val++;
      });
   }
   updateSize();
   document.getElementById("paper_size").addEventListener("change", updateSize);
   document.getElementById("size_units").addEventListener("change", updateSize);
   // ValidateDropdown
   function CustomInput() {
      const paperSize = document.getElementById('paper_size'),
         customInput = document.querySelectorAll('.custom-input');

      if (paperSize.value != 'Custom') {
         customInput.forEach(input => {
            input.readOnly = true;
         });
      } else {
         customInput.forEach(input => {
            input.readOnly = false;
         });
      }
   }
   CustomInput()

   // inputForm
   let editButton = document.querySelector('.editButton'),
      inputForms = document.querySelectorAll('.inputForm');
   editButton.addEventListener('click', () => {
      editButton.classList.toggle("active");
      inputForms.forEach((e) => {
         e.toggleAttribute('disabled');
      });
   })
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
         username.value = username.value.replace(/[^A-Za-z1-9_-]/g, "");
      } else {
         userName.innerText = '@whay';
      }
   })

   // alert delete account
   function deleteAlerta(id) {
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
            window.location.replace(`<?= BASEURL; ?>setting/profile/${id}`);
         }
      })
   }

   // Copy Function
   function copy(el, text = "tex") {
      const alertCopy = document.querySelector("#alert-copy");
      document.querySelector('.text-alert-copy').innerText = text;
      let copy = el;
      navigator.clipboard.writeText(copy);
      alertCopy.classList.add("show");
      setTimeout(function() {
         alertCopy.classList.remove("show");
      }, 2000);
   }

   // Change Password
   const NewPassword = document.querySelector('.NewPassword'),
      NewPassword2 = document.querySelector('.NewPassword2');

   function chack_password() {
      const matchNotif = document.querySelector('.Match-notif');
      if (NewPassword.value == NewPassword2.value) {
         matchNotif.classList.add('invisible')
      } else {
         matchNotif.classList.remove('invisible')
      }
   }

   // Adding a single click event listener to both elements
   document.querySelector('.modal-footer .btnModal-Close').addEventListener("click", () => {
      document.querySelector('.OldPassword').value = '';
      NewPassword.value = "";
      NewPassword2.value = "";
   });
   document.querySelector('.modal-header button').addEventListener("click", () => {
      document.querySelector('.OldPassword').value = '';
      NewPassword.value = "";
      NewPassword2.value = "";
   });
</script>