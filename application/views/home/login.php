   <!-- Our  Glasses section -->
   <div class="glasses">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-6">
                   <div class="titlepage">
                       <h2>Login Akun Pengunjung</h2>                       
                       <p>Dengan login ke dalam akun pengunjung LPMP, maka anda dapat melakukan pemesanan atau registrasi fasilitas dan sarana yang ada pada LPMP Kalsel.
                       </p>
                   </div>
               </div>
               <div class="col-md-6">
                   <form action="<?= base_url('home/login'); ?>" method="post">
                       <div class="modal-body">
                           <div class="form-group">
                           <?= $this->session->flashdata('pesan_notifikasi'); ?>
                               <h3>Masukkan Username/Email dan Password Login</h3>
                           </div>
                           <div class="modal-body">
                               <div class="form-group">
                                   <input type="text" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>" placeholder="Username/Email Login">
                                   <small class="text-danger"><?= form_error('email'); ?></small>
                               </div>
                               <div class="form-group">
                                   <input type="password" name="password" class="form-control" id="password" value="<?= set_value('password'); ?>" placeholder="Password Login">
                                   <small class="text-danger"><?= form_error('password'); ?></small>
                               </div>
                           </div>
                           <div class="form-group">
                               <button class="send_btn">Login</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <!-- end Our  Glasses section -->