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
                  <h3 class="card-title">Ubah Data Konsumsi</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_konsumsi" class="form-control" id="id_konsumsi" value="<?= $konsumsi['id_konsumsi']; ?>">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="urutan">Urutan</label>
                              <input type="number" name="urutan" class="form-control" id="urutan" value="<?= $konsumsi['urutan']; ?>" placeholder="Isi Urutan Angka">
                              <small class="text-danger"><?= form_error('urutan'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="nama_konsumsi">Nama Konsumsi</label>
                              <input type="text" name="nama_konsumsi" class="form-control" id="nama_konsumsi" value="<?= $konsumsi['nama_konsumsi']; ?>" placeholder="Isi Nama Konsumsi">
                              <small class="text-danger"><?= form_error('nama_konsumsi'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="harga">Harga</label>
                              <input type="number" name="harga" class="form-control" id="harga" value="<?= $konsumsi['harga']; ?>" placeholder="Isi Harga">
                              <small class="text-danger"><?= form_error('harga'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/konsumsi'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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