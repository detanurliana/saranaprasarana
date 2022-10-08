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
                  <h3 class="card-title">Tambah Data Foto <?= $judul; ?></h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="nip">Nama Fasilitias</label>
                              <input type="hidden" name="id_fasilitas" class="form-control" id="id_fasilitas" value="<?= $fasilitas['id_fasilitas']; ?>">
                              <input type="text" name="nama_fasilitas" class="form-control" id="nama_fasilitas" value="<?= $fasilitas['nama_fasilitas']; ?>" readonly>
                              <small class="text-danger"><?= form_error('id_fasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="foto">Pilih Foto</label>
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="foto" name="foto" required>
                                  <label class="custom-file-label" for="foto">Choose file</label>
                                  <small class="text-danger"><?= form_error('foto'); ?></small>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/detail_fasilitas/') . $fasilitas['id_fasilitas']; ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menambah data');"><i class="fa fa-save"></i> Simpan</button>
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