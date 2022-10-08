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
                          <th>Nama Fasilitas</th>
                          <th>Jumlah Orang</th>
                          <th>Harga</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
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

                            $id_hargafasilitas = $ft['id_hargafasilitas'];
                            $hargafasilitas = $this->db->get_where('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas])->row_array();
                            $harga = $hargafasilitas['harga'];
                            $id_fasilitas = $hargafasilitas['id_fasilitas'];
                            $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                            $nama_fasilitas = $fasilitas['nama_fasilitas'];
                            $jumlah_orang = $ft['jumlah_orang'];
                        ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= $kode_pemesanan; ?></td>
                              <td><?= $nama_pemesan; ?></td>
                              <td><?= $nama_kegiatan; ?></td>
                              <td><?= $nama_fasilitas; ?></td>
                              <td><?= $jumlah_orang; ?></td>
                              <td><?= rupiah($harga); ?></td>
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