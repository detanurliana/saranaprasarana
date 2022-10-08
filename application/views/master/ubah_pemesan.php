  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Ubah Data Pemesan</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_pemesan" class="form-control" id="id_pemesan" value="<?= $pemesan['id_pemesan']; ?>">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="nik">NIK</label>
                              <input type="number" name="nik" class="form-control" id="nik" value="<?= $pemesan['nik']; ?>" placeholder="Isi nik Angka">
                              <small class="text-danger"><?= form_error('nik'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="nama_pemesan">Nama Pemesan</label>
                              <input type="text" name="nama_pemesan" class="form-control" id="nama_pemesan" value="<?= $pemesan['nama_pemesan']; ?>" placeholder="Isi Nama Pemesan">
                              <small class="text-danger"><?= form_error('nama_pemesan'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $pemesan['alamat']; ?>" placeholder="Isi Alamat Pemesan">
                              <small class="text-danger"><?= form_error('alamat'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="nohp">No HP</label>
                              <input type="text" name="nohp" class="form-control" id="nohp" value="<?= $pemesan['nohp']; ?>" placeholder="Isi No HP Pemesan">
                              <small class="text-danger"><?= form_error('nohp'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/pemesan'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengubah data');"><i class="fa fa-save"></i> Simpan</button>
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