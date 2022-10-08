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
                          <th>Nama Petugas</th>
                          <th>Tupoksi</th>
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

                            $id_pegawai = $ft['id_pegawai'];
                            $masterpegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
                            $nama_petugas = $masterpegawai['nama_pegawai'];
                            $tupoksi = $ft['tupoksi'];
                        ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= $kode_pemesanan; ?></td>
                              <td><?= $nama_pemesan; ?></td>
                              <td><?= $nama_kegiatan; ?></td>
                              <td><?= $nama_petugas; ?></td>
                              <td><?= $tupoksi; ?></td>
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