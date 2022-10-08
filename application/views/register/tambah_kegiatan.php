  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
      </section>
      <?php
        $id_level = $this->session->userdata('id_level');
        if ($id_level == '3') {
            $menunya = 'pemesan';
        } else {
            $menunya = 'register';
        }
        ?>
      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Tambah Data Kegiatan</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_kegiatan) as kodeTerbesar FROM kegiatan")->row_array();
                            $kodekegiatan = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodekegiatan, 2, 5);
                            $urutan++;
                            $huruf = "KG";
                            $kodekegiatan = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_kegiatan">Kode Kegiatan</label>
                              <input type="hidden" name="kode_kegiatan" class="form-control" id="kode_kegiatan" value="<?= $kodekegiatan; ?>" placeholder="Isi Kode kegiatan">
                              <input type="text" name="kode_kegiatan1" class="form-control" id="kode_kegiatan1" value="<?= $kodekegiatan; ?>" placeholder="Isi Kode kegiatan" disabled>
                              <small class="text-danger"><?= form_error('kode_kegiatan'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="nama_kegiatan">Nama Kegiatan</label>
                              <input type="text" class="form-control" name="nama_kegiatan" id="nama_kegiatan" value="<?= set_value('nama_kegiatan'); ?>">
                              <small class="text-danger"><?= form_error('nama_kegiatan'); ?></small>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-6">
                                      <label>Dari Tanggal</label>
                                      <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" name="dari_tanggal" data-target="#reservationdate2" value="<?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>" data-toggle="datetimepicker">
                                          <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-6">
                                      <label>Sampai Tanggal</label>
                                      <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                          <input type="text" class="form-control datetimepicker-input" name="sampai_tanggal" data-target="#reservationdate3" value="<?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>" data-toggle="datetimepicker">
                                          <div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
                                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="row">
                                  <div class="col-6">
                                      <label for="dari_jam">Dari Jam</label>
                                      <input type="text" class="form-control" name="dari_jam" id="dari_jam" value="<?= set_value('dari_jam'); ?>" placeholder="08:00">
                                      <small class="text-danger"><?= form_error('dari_jam'); ?></small>
                                  </div>
                                  <div class="col-6">
                                      <label for="sampai_jam">Sampai Jam</label>
                                      <input type="text" class="form-control" name="sampai_jam" id="sampai_jam" value="<?= set_value('dari_jam'); ?>" placeholder="08:00">
                                      <small class="text-danger"><?= form_error('sampai_jam'); ?></small>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="jumlah_orang">Jumlah Orang</label>
                              <input type="number" class="form-control" name="jumlah_orang" id="jumlah_orang" value="<?= set_value('dari_jam'); ?>">
                              <small class="text-danger"><?= form_error('jumlah_orang'); ?></small>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url($menunya . '/detail_pemesanan/' . $id_pemesanan); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
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