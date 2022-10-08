  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->

          <?= $this->session->flashdata('pesan_notifikasi'); ?>

      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Ubah Password Username <i><?= $pengguna['username']; ?></i></h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_pengguna" class="form-control" id="id_pengguna" value="<?= $pengguna['id_pengguna']; ?>">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="password_lama">Password Lama</label>
                              <input type="text" name="password_lama" class="form-control" id="password_lama" value="" placeholder="Isi Password Lama">
                              <small class="text-danger"><?= form_error('password_lama'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="password_baru1">Password Baru</label>
                              <input type="text" name="password_baru1" class="form-control" id="password_baru1" value="" placeholder="Isi Password Baru">
                              <small class="text-danger"><?= form_error('password_baru1'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="password_baru2">Konfirmasi Password Baru</label>
                              <input type="text" name="password_baru2" class="form-control" id="password_baru2" value="" placeholder="Isi Konfirmasi Password Baru">
                              <small class="text-danger"><?= form_error('password_baru2'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('profil'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengubah password');"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                  </form>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->