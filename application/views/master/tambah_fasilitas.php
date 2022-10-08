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
                  <h3 class="card-title">Tambah Data Fasilitas</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="urutan">Kegunaan Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_tipe" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <option value="1"><?= tipe('1'); ?></option>
                                  <option value="2"><?= tipe('2'); ?></option>
                              </select>
                          </div>
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_fasilitas) as kodeTerbesar FROM Fasilitas")->row_array();
                            $kodefasilitas = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodefasilitas, 2, 5);
                            $urutan++;
                            $huruf = "FS";
                            $kodefasilitas = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_fasilitas">Kode Fasilitas</label>
                              <input type="hidden" name="kode_fasilitas" class="form-control" id="kode_fasilitas" value="<?= $kodefasilitas; ?>" placeholder="Isi Kode Fasilitas">
                              <input type="text" name="kode_fasilitas1" class="form-control" id="kode_fasilitas1" value="<?= $kodefasilitas; ?>" placeholder="Isi Kode Fasilitas" disabled>
                              <small class="text-danger"><?= form_error('kode_fasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="id_jenisfasilitas">Pilih Jenis Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_jenisfasilitas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php foreach ($jenisfasilitas as $js) :; ?>
                                      <option value="<?= $js['id_jenisfasilitas']; ?>"><?= $js['nama_jenisfasilitas']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="nama_fasilitas">Nama Fasilitas</label>
                              <input type="text" name="nama_fasilitas" class="form-control" id="nama_fasilitas" value="<?= set_value('nama_fasilitas'); ?>" placeholder="Isi Nama Fasilitas">
                              <small class="text-danger"><?= form_error('nama_fasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="kapasitas">Kapasitas (Orang)</label>
                              <input type="number" name="kapasitas" class="form-control" id="kapasitas" value="<?= set_value('kapasitas'); ?>" placeholder="Isi Kapasitas Fasilitas">
                              <small class="text-danger"><?= form_error('kapasitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Isi Keterangan Fasilitas"><?= set_value('nama_fasilitas'); ?></textarea>
                              <small class="text-danger"><?= form_error('keterangan'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/fasilitas'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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