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
                  <h3 class="card-title">Tambah Data Harga Fasilitas</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="id_fasilitas">Pilih Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_fasilitas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php foreach ($fasilitas as $fs) :; ?>
                                      <option value="<?= $fs['id_fasilitas']; ?>"><?= $fs['nama_fasilitas']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="id_kategorifasilitas">Pilih Kategori Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_kategorifasilitas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php foreach ($kategorifasilitas as $pf) :; ?>
                                      <option value="<?= $pf['id_kategorifasilitas']; ?>"><?= $pf['nama_kategorifasilitas']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="harga">Harga</label>
                              <input type="text" name="harga" class="form-control" id="harga" value="<?= set_value('harga'); ?>" placeholder="Isi Harga Fasilitas">
                              <small class="text-danger"><?= form_error('harga'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/hargafasilitas'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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