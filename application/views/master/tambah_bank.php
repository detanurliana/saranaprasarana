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
                  <h3 class="card-title">Tambah Data <?= $judul;?></h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <div class="modal-body">                          
                          <div class="form-group">
                              <label for="nama_bank">Nama bank</label>
                              <input type="text" name="nama_bank" class="form-control" id="nama_bank" value="<?= set_value('nama_bank'); ?>" placeholder="Isi Nama bank">
                              <small class="text-danger"><?= form_error('nama_bank'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="no_rek">No Rekening bank</label>
                              <input type="text" name="no_rek" class="form-control" id="no_rek" value="<?= set_value('no_rek'); ?>" placeholder="Isi No Rekening bank">
                              <small class="text-danger"><?= form_error('no_rek'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="atas_nama">Atas Nama</label>
                              <input type="text" name="atas_nama" class="form-control" id="atas_nama" value="<?= set_value('atas_nama'); ?>" placeholder="Isi Atas Nama">
                              <small class="text-danger"><?= form_error('atas_nama'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/bank'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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