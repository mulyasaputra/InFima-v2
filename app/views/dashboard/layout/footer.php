   </main>

   <!-- Notyvication -->
   <div class="position-absolute notifikasi">
      <?php Flasher::flash(); ?>
   </div>

   </section>
   <!-- Modal -->
   <div class="modal fade" id="Logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="LogoutLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="LogoutLabel">Ready to Leave?</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></i></button>
            </div>
            <div class="modal-body">
               Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <a type="button" class="btn btn-primary" href="<?= BASEURL; ?>ryu/logout">Logout</a>
            </div>
         </div>
      </div>
   </div>
   </body>

   <!-- Bootstrap v5 JavaSctipt -->
   <script src="<?= BASEURL; ?>public/Vendor/Bootstrap5/js/bootstrap.bundle.min.js"></script>
   <!-- JavaSctipt -->
   <script src="<?= BASEURL; ?>public/js/main.js"></script>
   <script src="<?= BASEURL; ?>public/Vendor/InSketch/js/toCurrency.js"></script>

   </html>