  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
          <?= $this->session->flashdata('pesan_notifikasi'); ?>
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
                  <h3 class="card-title">Bukti buktipembayaran</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pembayaran" value="<?= $id_pembayaran; ?>" required>
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $pembayaran = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();
                            $kode_pembayaran = $pembayaran['kode_pembayaran'];
                            $pemesanan = $this->db->get_where('pemesanan', ['id_pemesanan' => $id_pemesanan])->row_array();
                            $id_pemesan = $pemesanan['id_pemesan'];
                            $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();
                            $kode_pemesanan = $pemesanan['kode_pemesanan'];
                            $total_sewafasilitas = 0;
                            $sewafasilitas = $this->db->get_where('sewafasilitas', ['id_pemesanan' => $id_pemesanan])->result_array();
                            foreach ($sewafasilitas as $sf) :
                                $id_kegiatan = $sf['id_kegiatan'];
                                $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                $id_hargafasilitas = $sf['id_hargafasilitas'];
                                $pilihhargafasilitas = $this->db->get_where('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas])->row_array();
                                $id_fasilitas = $pilihhargafasilitas['id_fasilitas'];
                                $pilihfasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                                $hargafasilitas = $pilihhargafasilitas['harga'];
                                $total_sewafasilitas = $total_sewafasilitas + $hargafasilitas;
                            endforeach;

                            $total_pesankonsumsi = 0;
                            $totalharga = 0;
                            $pesankonsumsi = $this->db->get_where('pesankonsumsi', ['id_pemesanan' => $id_pemesanan])->result_array();
                            foreach ($pesankonsumsi as $pk) :
                                $id_kegiatan = $pk['id_kegiatan'];
                                $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                $id_konsumsi = $pk['id_konsumsi'];
                                $pilihkonsumsi = $this->db->get_where('konsumsi', ['id_konsumsi' => $id_konsumsi])->row_array();
                                $harga = $pilihkonsumsi['harga'];
                                $jumlah = $pk['jumlah_orang'];
                                $totalharga = $harga * $jumlah;
                                $total_pesankonsumsi = $total_pesankonsumsi + $totalharga;
                            endforeach;
                            $total_pembayaran = $total_sewafasilitas + $total_pesankonsumsi;

                            ?>
                          <div class="form-group">
                              <label for="id_pembayaran">No Pembayaran</label>
                              <input type="hidden" name="id_pembayaran" class="form-control" id="id_pembayaran" value="<?= $id_pembayaran; ?>">
                              <input type="text" name="kode_pembayaran" class="form-control" id="kode_pembayaran" value="<?= $kode_pembayaran; ?>" placeholder="Isi Kode Pembayaran" disabled>
                          </div>
                          <div class="form-group">
                              <label for="total_pembayaran">Total Pembayaran</label>
                              <input type="text" class="form-control" name="total_pembayaran" id="total_pembayaran" value="<?= rupiah($total_pembayaran); ?>" disabled>
                              <small class="text-danger"><?= form_error('total_pembayaran'); ?></small>
                          </div>
                          <div class="form-group">
                              <label>Tanggal Transfer</label>
                              <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" name="tanggal_pembayaran" data-target="#reservationdate1" value="<?= date('d-m-Y'); ?>" data-toggle="datetimepicker">
                                  <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="nama_pengirim">Nama Pengirm</label>
                              <input type="text" name="nama_pengirim" class="form-control" id="nama_pengirim" value="<?= set_value('nama_pengirim'); ?>" placeholder="Isi Nama Pengirim">
                              <small class="text-danger"><?= form_error('nama_pengirim'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="bank_pengirim">Nama Bank Pengirim</label>
                              <input type="text" name="bank_pengirim" class="form-control" id="bank_pengirim" value="<?= set_value('bank_pengirim'); ?>" placeholder="Isi Nama Bank Pengirim">
                              <small class="text-danger"><?= form_error('bank_pengirim'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="rekening_pengirim">No Rekening Pengirim</label>
                              <input type="text" name="rekening_pengirim" class="form-control" id="rekening_pengirim" value="<?= set_value('rekening_pengirim'); ?>" placeholder="Isi No Rekening Pengirim">
                              <small class="text-danger"><?= form_error('rekening_pengirim'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="nominal">Nominal</label>
                              <input type="number" name="nominal" class="form-control" id="nominal" value="<?= set_value('nominal'); ?>" placeholder="Isi Nominal Transfer">
                              <small class="text-danger"><?= form_error('nominal'); ?></small>
                          </div>

                          <div class="form-group">
                              <label for="bukti">Upload File Bukti</label>
                              <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="bukti" name="bukti" required>
                                  <label class="custom-file-label" for="bukti">Pilih File</label>
                                  <small class="text-danger"><?= form_error('bukti'); ?></small>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="keterangan">Keterangan</label>
                              <input type="text" class="form-control" name="keterangan" id="keterangan" value="" placeholder="Isi keterangan (boleh dikosongkan)">
                              <small class="text-danger"><?= form_error('keterangan'); ?></small>
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