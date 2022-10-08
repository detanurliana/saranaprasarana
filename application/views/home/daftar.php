   <!-- Our  Glasses section -->
   <div class="glasses">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-6">
                   <div class="titlepage">
                       <h2>Pendaftaran Akun Pengunjung</h2>
                       <p>Dengan melakukan pendaftaran, maka anda dapat melakukan pemesanan atau registrasi fasilitas dan sarana yang ada pada LPMP Kalsel.
                       </p>
                   </div>
               </div>
               <div class="col-md-6">
                   <form action="" method="POST">
                       <div class="modal-body">
                           <div class="form-group">
                               <h3>Lengkapi Form Pendaftaran</h3>
                           </div>
                           <div class="modal-body">
                               <div class="form-group">
                                   <input type="text" name="nik" class="form-control" id="nik" value="<?= set_value('nik'); ?>" placeholder="NIK">
                                   <small class="text-danger"><?= form_error('nik'); ?></small>
                               </div>
                               <div class="form-group">
                                   <input type="text" name="nama_pengunjung" class="form-control" id="nama_pengunjung" value="<?= set_value('nama_pengunjung'); ?>" placeholder="Nama Lengkap">
                                   <small class="text-danger"><?= form_error('nama_pengunjung'); ?></small>
                               </div>
                               <div class="form-group">
                                   <select class="form-control select2 select2-hidden-accessible" name="id_jeniskelamin" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                       <option value="1" selected>Laki-laki</option>
                                       <option value="2">Perempuan</option>
                                   </select>
                               </div>
                               <div class="form-group">
                                   <input type="text" name="email" class="form-control" id="email" value="<?= set_value('email'); ?>" placeholder="Email Login">
                                   <small class="text-danger"><?= form_error('email'); ?></small>
                               </div>
                               <div class="form-group">
                                   <input type="text" name="password" class="form-control" id="password" value="<?= set_value('password'); ?>" placeholder="Password Login">
                                   <small class="text-danger"><?= form_error('password'); ?></small>
                               </div>
                               <div class="form-group">
                                   <input type="text" name="alamat" class="form-control" id="alamat" value="<?= set_value('alamat'); ?>" placeholder="Alamat">
                                   <small class="text-danger"><?= form_error('alamat'); ?></small>
                               </div>
                               <div class="form-group">
                                   <input type="text" name="nohp" class="form-control" id="nohp" value="<?= set_value('nohp'); ?>" placeholder="Nomor HP">
                                   <small class="text-danger"><?= form_error('nohp'); ?></small>
                               </div>
                           </div>
                           <div class="form-group">
                               <button class="send_btn" onclick="return confirm('Anda yakin ingin melakukan pendaftaran?');">Daftar</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <!-- end Our  Glasses section -->