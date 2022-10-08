  <!-- Main content -->
  <div class="invoice">
      <!-- title row -->
      <div class="row">
          <div class="col-12" align="center">
              <table width="80%" align="center">
                  <tr>
                      <td rowspan="2" align="right"><img src="<?= base_url('assets/dist/img/' . $profil['logo']); ?>" height="120" width="120" /></td>
                  </tr>
                  <tr>
                      <td align="center">
                          <h4><?= $profil['nama_profil']; ?></h4>
                          <p>Alamat : <?= $profil['alamat']; ?>. Telp :<?= $profil['telepon']; ?>. Kodepos : <?= $profil['kodepos']; ?> <br />
                              Email : <?= $profil['email']; ?>. Website : <?= $profil['website']; ?></p>
                          <h4>
                              <?= $judul; ?>
                          </h4>
                      </td>
                  </tr>
              </table>
          </div>
      </div>
      <hr />

      <!-- Table row -->
      <div class="row">
          <div class="col-12 table-responsive">
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode Pemesanan</th>
                          <th>Nama Pemesan</th>
                          <th>Nama Kegiatan</th>
                          <th>Nomor Pembayaran</th>
                          <th>Bank Tujuan</th>
                          <th>Total Sewa Fasilitas</th>
                          <th>Total Pesan Konsumsi</th>
                          <th>Total Pembayaran</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        $total_harga = 0;
                        foreach ($filter as $ft) :
                            $id_pemesanan = $ft['id_pemesanan'];
                            $pemesanan = $this->db->get_where('pemesanan', ['id_pemesanan' => $id_pemesanan])->row_array();
                            $kode_pemesanan = $pemesanan['kode_pemesanan'];
                            $id_pemesan = $pemesanan['id_pemesan'];
                            $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();
                            $nama_pemesan = $pemesan['nama_pemesan'];
                            $id_pemesanan = $ft['id_pemesanan'];
                            $kegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan])->row_array();
                            $nama_kegiatan = $kegiatan['nama_kegiatan'];

                            $kode_pembayaran = $ft['kode_pembayaran'];
                            $id_bank = $ft['id_bank'];
                            $bank = $this->db->get_where('bank', ['id_bank' => $id_bank])->row_array();
                            $nama_bank = $bank['nama_bank'];
                            $no_rek = $bank['no_rek'];
                            $atas_nama = $bank['atas_nama'];

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
                            $cekBuktipembayaran = $this->db->get_where('buktipembayaran', ['id_pemesanan' => $id_pemesanan]);
                            if ($cekBuktipembayaran->num_rows() == 1) {
                                $nama_status = "Sudah Dibayar";
                            } else {
                                $nama_status = "Belum Dibayar";
                            }
                        ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= $kode_pemesanan; ?></td>
                              <td><?= $nama_pemesan; ?></td>
                              <td><?= $nama_kegiatan; ?></td>
                              <td><?= $kode_pembayaran; ?></td>
                              <td><?= $nama_bank . ' (' . $no_rek . ')'; ?></td>
                              <td><?= rupiah($total_sewafasilitas); ?></td>
                              <td><?= rupiah($total_pesankonsumsi); ?></td>
                              <td><?= rupiah($total_pembayaran); ?></td>
                              <td><?= $nama_status; ?></td>
                          </tr>
                      <?php $no++;
                        endforeach; ?>
                  </tbody>
              </table>

          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
          <!-- accepted payments column -->
          <div class="col-6">

          </div>
          <!-- /.col -->
          <div class="col-6">
              <p class="lead float-right">Banjarmasin, <?= tanggal_indo(date('Y-m-d')); ?></p>
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>