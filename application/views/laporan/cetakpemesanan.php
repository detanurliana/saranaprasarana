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
                          <th>Tanggal</th>
                          <th>Kode Pemesanan</th>
                          <th>Nama Pemesan</th>
                          <th>Fasilitas</th>
                          <th>Lama Kegiatan</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($filter as $ft) :
                            $id_pemesanan = $ft['id_pemesanan'];
                            $id_pemesan = $ft['id_pemesan'];
                            $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();

                            $kegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan]);
                            if ($kegiatan->num_rows() > 0) {
                                $kegiatan = $kegiatan->row_array();
                                $nama_kegiatan = $kegiatan['nama_kegiatan'];
                                $dari_tanggal = new Datetime($kegiatan['dari_tanggal']);
                                $sampai_tanggal = new Datetime($kegiatan['sampai_tanggal']);
                                $selisih = $sampai_tanggal->diff($dari_tanggal)->days + 1;
                            } else {
                                $nama_kegiatan = '';
                            }
                            $sewafasilitas = $this->db->get_where('sewafasilitas', ['id_pemesanan' => $id_pemesanan]);
                            if ($sewafasilitas->num_rows() > 0) {
                                $sewafasilitas = $sewafasilitas->row_array();
                                $id_hargafasilitas = $sewafasilitas['id_hargafasilitas'];
                                $hargafasilitas = $this->db->get_where('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas])->row_array();
                                $id_fasilitas = $hargafasilitas['id_fasilitas'];
                                $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                                $nama_fasilitas = $fasilitas['nama_fasilitas'];
                            } else {
                                $nama_fasilitas = '';
                            }

                            $cekPembayaran = $this->db->get_where('pembayaran', ['id_pemesanan' => $id_pemesanan]);
                            $cekBuktipembayaran = $this->db->get_where('buktipembayaran', ['id_pemesanan' => $id_pemesanan]);
                            if ($cekPembayaran->num_rows() < 1) {
                                $nama_status = 'Pendaftaran';
                            } else if ($cekBuktipembayaran->num_rows() == 1) {
                                $nama_status = 'Sudah Dibayar';
                            } else if ($cekPembayaran->num_rows() == 1) {
                                $nama_status = 'Menunggu Pembayaran';
                            }
                        ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= tanggal_indo($ft['tanggal']); ?></td>
                              <td><?= $ft['kode_pemesanan']; ?></td>
                              <td><?= $pemesan['nama_pemesan']; ?></td>
                              <td><?= $nama_fasilitas; ?></td>
                              <td><?= $selisih . ' Hari'; ?></td>
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