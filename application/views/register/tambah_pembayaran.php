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
                  <h3 class="card-title">Generate Nomor Pembayaran</h3>
              </div>
              <div class="card-body col-md-6">
                  <form action="" method="post" enctype="multipart/form-data" data-toggle="validator" role="form">
                      <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id_pemesanan; ?>" required>
                      <div class="modal-body">
                          <?php
                            $kodepembayaran = random_string('numeric', 10);
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
                              <label for="kode_pembayaran">No Pembayaran</label>
                              <input type="hidden" name="kode_pembayaran" class="form-control" id="kode_pembayaran" value="<?= $kodepembayaran; ?>" placeholder="Isi Kode Pembayaran">
                              <input type="text" name="kode_pembayaran1" class="form-control" id="kode_pembayaran1" value="<?= $kodepembayaran; ?>" placeholder="Isi Kode Pembayaran" disabled>
                          </div>
                          <div class="form-group">
                              <label for="id_pemesanan">Kode Pemesanan</label>
                              <input type="hidden" name="id_pemesanan" class="form-control" id="id_pemesanan" value="<?= $id_pemesanan; ?>">
                              <input type="text" name="kode_pemesanan" class="form-control" id="kode_pemesanan" value="<?= $kode_pemesanan; ?>" placeholder="Isi Kode Pemesanan" disabled>
                          </div>
                          <div class="form-group">
                              <label for="nama_pemesan">Nama Pemesan</label>
                              <input type="text" name="nama_pemesan" class="form-control" id="nama_pemesan" value="<?= $pemesan['nama_pemesan']; ?>" placeholder="Isi Kode Pembayaran" disabled>
                          </div>
                          <div class="form-group">
                              <label for="total_sewafasilitas">Total Sewa Fasilitas</label>
                              <input type="text" class="form-control" name="total_sewafasilitas" id="total_sewafasilitas" value="<?= rupiah($total_sewafasilitas); ?>" disabled>
                              <small class="text-danger"><?= form_error('total_sewafasilitas'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="total_pesankonsumsi">Total Pesan Konsumsi</label>
                              <input type="text" class="form-control" name="total_pesankonsumsi" id="total_pesankonsumsi" value="<?= rupiah($total_pesankonsumsi); ?>" disabled>
                              <small class="text-danger"><?= form_error('total_pesankonsumsi'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="total_pembayaran">Total Pembayaran</label>
                              <input type="text" class="form-control" name="total_pembayaran" id="total_pembayaran" value="<?= rupiah($total_pembayaran); ?>" disabled>
                              <small class="text-danger"><?= form_error('total_pembayaran'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="id_bank">Pilih Bank</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_bank" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    $bank = $this->db->get('bank')->result_array();
                                    foreach ($bank as $bnk) :; ?>
                                      <option value="<?= $bnk['id_bank']; ?>"><?= $bnk['nama_bank'] . ' | ' . $bnk['no_rek'] . ' | ' . $bnk['atas_nama']; ?></option>
                                  <?php endforeach; ?>
                              </select>
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