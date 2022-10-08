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
                  <h3 class="card-title">Tambah Data Pesan Konsumsi</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_pesankonsumsi) as kodeTerbesar FROM pesankonsumsi")->row_array();
                            $kodepesankonsumsi = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodepesankonsumsi, 2, 5);
                            $urutan++;
                            $huruf = "PK";
                            $kodepesankonsumsi = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_pesankonsumsi">Kode Pesan Konsumsi</label>
                              <input type="hidden" name="kode_pesankonsumsi" class="form-control" id="kode_pesankonsumsi" value="<?= $kodepesankonsumsi; ?>" placeholder="Isi Kode Pesan Konsumsi">
                              <input type="text" name="kode_pesankonsumsi1" class="form-control" id="kode_pesankonsumsi1" value="<?= $kodepesankonsumsi; ?>" placeholder="Isi Kode Pesan Konsumsi" disabled>
                              <small class="text-danger"><?= form_error('kode_pesankonsumsi'); ?></small>
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
                              <label for="id_konsumsi">Pilih Jenis Konsumsi</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_konsumsi" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    $konsumsi = $this->db->get('konsumsi')->result_array();
                                    foreach ($konsumsi as $kon) :;
                                    ?>
                                      <option value="<?= $kon['id_konsumsi']; ?>"><?= $kon['nama_konsumsi'] . ' | ' . rupiah($kon['harga']) . ' (' . $kon['keterangan'] . ')'; ?></option>
                                  <?php endforeach; ?>
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