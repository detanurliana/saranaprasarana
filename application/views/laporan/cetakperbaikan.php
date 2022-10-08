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
                          <p>Periode : <?= date('d-m-Y', strtotime($dariTanggal)) . ' s.d ' . date('d-m-Y', strtotime($sampaiTanggal)); ?></p>
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
                          <th>Kode Perbaikan</th>
                          <th>Lokasi</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Keterangan</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($filter as $rsk) :
                            $id_lokasi = $rsk['id_lokasi'];
                            $lokasi = $this->db->get_where('lokasi', ['id_lokasi' => $id_lokasi])->row_array();
                            $id_barang = $rsk['id_barang'];
                            $barang = $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
                        ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= date('d-m-Y', strtotime($rsk['tanggal'])); ?></td>
                              <td><?= $rsk['kode_perbaikan']; ?></td>
                              <td><?= $lokasi['nama_lokasi']; ?></td>
                              <td><?= $barang['nama_barang']; ?></td>
                              <td><?= $rsk['jumlah']; ?></td>
                              <td><?= $rsk['keterangan']; ?></td>
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