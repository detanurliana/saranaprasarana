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
                  <h3 class="card-title">Tambah Data Petugas Kegiatan</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_petugaskegiatan) as kodeTerbesar FROM petugaskegiatan")->row_array();
                            $kodepetugaskegiatan = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodepetugaskegiatan, 2, 5);
                            $urutan++;
                            $huruf = "PT";
                            $kodepetugaskegiatan = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_petugaskegiatan">Kode Petugas Kegiatan</label>
                              <input type="hidden" name="kode_petugaskegiatan" class="form-control" id="kode_petugaskegiatan" value="<?= $kodepetugaskegiatan; ?>" placeholder="Isi Kode Petugas Kegiatan">
                              <input type="text" name="kode_petugaskegiatan1" class="form-control" id="kode_petugaskegiatan1" value="<?= $kodepetugaskegiatan; ?>" placeholder="Isi Kode Petugas Kegiatan" disabled>
                              <small class="text-danger"><?= form_error('kode_petugaskegiatan'); ?></small>
                          </div>
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
                                    $masterpegawai = $this->db->get('pegawai')->result_array();
                                    foreach ($masterpegawai as $peg) :;
                                    ?>
                                      <option value="<?= $peg['id_pegawai']; ?>"><?= $peg['nama_pegawai']; ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="tupoksi">Tupoksi</label>
                              <input type="text" class="form-control" name="tupoksi" id="tupoksi" value="<?= set_value('tupoksi'); ?>">
                              <small class="text-danger"><?= form_error('tupoksi'); ?></small>
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