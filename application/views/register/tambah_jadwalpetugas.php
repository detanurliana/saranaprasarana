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
                  <h3 class="card-title">Tambah Data Jadwal Petugas</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="id_kegiatan">Pilih Kegiatan</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_kegiatan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    $pilihkegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan])->result_array();
                                    foreach ($pilihkegiatan as $pkeg) :; ?>
                                      <option value="<?= $pkeg['id_kegiatan']; ?>"><?= $pkeg['nama_kegiatan']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="id_pegawai">Pilih Petugas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_pegawai" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    $petugaskegiatan = $this->db->get_where('petugaskegiatan', ['id_pemesanan' => $id_pemesanan])->result_array();

                                    foreach ($petugaskegiatan as $peg) :;
                                        $master_idpegawai =  $peg['id_pegawai'];
                                        $masterpegawai = $this->db->get_where('pegawai', ['id_pegawai' => $master_idpegawai])->row_array();
                                    ?>
                                      <option value="<?= $peg['id_pegawai']; ?>"><?= $masterpegawai['nama_pegawai']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Tanggal Jadwal</label>
                              <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" name="tanggal_jadwal" data-target="#reservationdate1" value="<?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>" data-toggle="datetimepicker">
                                  <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
                                      <input type="text" class="form-control" name="sampai_jam" id="sampai_jam" value="<?= set_value('sampai_jam'); ?>" placeholder="08:00">
                                      <small class="text-danger"><?= form_error('sampai_jam'); ?></small>
                                  </div>
                              </div>
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