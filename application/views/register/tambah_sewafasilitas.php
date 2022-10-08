  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
      </section>
      <?php
        if ($id_tipe == '1') {
            $nama_tipe = "Kegiatan";
        } else {
            $nama_tipe = "Penginapan";
        }
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
                  <h3 class="card-title">Tambah Data Sewa Fasilitas <?= $nama_tipe; ?></h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_sewafasilitas) as kodeTerbesar FROM sewafasilitas")->row_array();
                            $kodesewafasilitas = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodesewafasilitas, 2, 5);
                            $urutan++;
                            $huruf = "SF";
                            $kodesewafasilitas = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_sewafasilitas">Kode Sewa Fasilitas</label>
                              <input type="hidden" name="kode_sewafasilitas" class="form-control" id="kode_sewafasilitas" value="<?= $kodesewafasilitas; ?>" placeholder="Isi Kode Sewa Fasilitas">
                              <input type="text" name="kode_sewafasilitas1" class="form-control" id="kode_sewafasilitas1" value="<?= $kodesewafasilitas; ?>" placeholder="Isi Kode Sewa Fasilitas" disabled>
                              <small class="text-danger"><?= form_error('kode_sewafasilitas'); ?></small>
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
                              <label for="id_hargafasilitas">Pilih Fasilitas</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_hargafasilitas" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    $hargafasilitas = $this->db->get('hargafasilitas')->result_array();
                                    foreach ($hargafasilitas as $phf) :
                                        $id_kategorifasilitas = $phf['id_kategorifasilitas'];
                                        $pilihkategorifasilitas = $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
                                        $id_fasilitas = $phf['id_fasilitas'];
                                        $pilihfasilitas = $this->db->get_where('fasilitas', [
                                            'id_fasilitas' => $id_fasilitas,
                                            'id_tipe' => $id_tipe,
                                        ]);
                                        if ($pilihfasilitas->num_rows() > 0) {
                                            $pilihfasilitas = $this->db->get_where('fasilitas', [
                                                'id_fasilitas' => $id_fasilitas,
                                                'id_tipe' => $id_tipe,
                                            ])->row_array();
                                    ?>
                                          <option value="<?= $phf['id_hargafasilitas']; ?>"><?= $pilihfasilitas['nama_fasilitas'] . ' | ' . $pilihkategorifasilitas['nama_kategorifasilitas'] . ' | ' . rupiah($phf['harga']); ?></option>
                                  <?php
                                        }
                                    endforeach;
                                    ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="jumlah_orang">Jumlah Orang</label>
                              <input type="number" class="form-control" name="jumlah_orang" id="jumlah_orang" value="<?= set_value('jumlah_orang'); ?>">
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