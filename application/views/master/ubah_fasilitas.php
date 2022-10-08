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
                  <h3 class="card-title">Ubah Data Fasilitas</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_fasilitas" class="form-control" id="id_fasilitas" value="<?= $fasilitas['id_fasilitas']; ?>">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="urutan">Kegunaan Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_tipe" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="<?= $fasilitas['id_tipe']; ?>" selected="selected"><?= tipe($fasilitas['id_tipe']); ?></option>
                                  <option value="1"><?= tipe('1'); ?></option>
                                  <option value="2"><?= tipe('2'); ?></option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="kode_fasilitas">Kode Fasilitas</label>
                              <input type="text" name="kode_fasilitas" class="form-control" id="kode_fasilitas" value="<?= $fasilitas['kode_fasilitas']; ?>" placeholder="Isi Kode Fasilitas" disabled>
                              <small class="text-danger"><?= form_error('kode_fasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="urutan">Pilih Jenis Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_jenisfasilitas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php foreach ($jenisfasilitas as $js) : ?>
                                      <?php
                                        if ($js['id_jenisfasilitas'] == $fasilitas['id_jenisfasilitas']) {

                                        ?>
                                          <option value="<?= $js['id_jenisfasilitas']; ?>" selected="selected"><?= $js['nama_jenisfasilitas']; ?></option>
                                      <?php
                                        } else {
                                        ?>
                                          <option value="<?= $js['id_jenisfasilitas']; ?>"><?= $js['nama_jenisfasilitas']; ?></option>
                                      <?php
                                        }
                                        ?>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="nama_fasilitas">Nama Fasilitas</label>
                              <input type="text" name="nama_fasilitas" class="form-control" id="nama_fasilitas" value="<?= $fasilitas['nama_fasilitas']; ?>" placeholder="Isi Nama Fasilitas">
                              <small class="text-danger"><?= form_error('nama_fasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="kapasitas">Kapasitas (Orang)</label>
                              <input type="number" name="kapasitas" class="form-control" id="kapasitas" value="<?= $fasilitas['kapasitas']; ?>" placeholder="Isi Kapasitas Fasilitas">
                              <small class="text-danger"><?= form_error('kapasitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Isi Keterangan Fasilitas"><?= $fasilitas['keterangan']; ?></textarea>
                              <small class="text-danger"><?= form_error('keterangan'); ?></small>
                          </div>
                          <?php
                            $id_status = $fasilitas['id_status'];
                            if ($id_status == '1') {
                                $nama_status = 'Tersedia';
                            } else {
                                $nama_status = 'Belum Tersedia';
                            }
                            ?>
                          <div class="form-group">
                              <label for="urutan">Status Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_status" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="<?= $fasilitas['id_status']; ?>" selected="selected"><?= $nama_status; ?></option>
                                  <option value="1">Tersedia</option>
                                  <option value="2">Belum Tersedia</option>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/fasilitas'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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