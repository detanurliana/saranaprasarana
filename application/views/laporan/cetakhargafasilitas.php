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
                          <th>Fasilitas</th>
                          <th>Kategori</th>
                          <th>Harga Fasilitas</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($filter as $hf) : ?>
                          <?php
                            $id_fasilitas = $hf['id_fasilitas'];
                            $id_kategorifasilitas = $hf['id_kategorifasilitas'];
                            $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                            $kategorifasilitas = $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
                            ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= $fasilitas['nama_fasilitas']; ?></td>
                              <td><?= $kategorifasilitas['nama_kategorifasilitas']; ?></td>
                              <td><?= rupiah($hf['harga']); ?></td>
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