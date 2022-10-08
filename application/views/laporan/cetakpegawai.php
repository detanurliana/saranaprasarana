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
                          <th>NIP</th>
                          <th>Nama Pegawai</th>
                          <th>Jenis Kelamin</th>
                          <th>Jabatan</th>
                          <th>Pangkat Golongan</th>
                          <th>Tempat Lahir</th>
                          <th>Tanggal Lahir</th>
                          <th>Alamat</th>
                          <th>No HP</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($filter as $pgw) : ?>
                          <?php
                            $id_jabatan = $pgw['id_jabatan'];
                            $jabatan = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();
                            $id_golpangkat = $pgw['id_golpangkat'];
                            $golpangkat = $this->db->get_where('golpangkat', ['id_golpangkat' => $id_golpangkat])->row_array();
                            $nama_jeniskelamin = check_jeniskelamin($pgw['id_jeniskelamin']);
                            ?>
                          <tr>
                              <td><?= $no; ?></td>
                              <td><?= $pgw['nip']; ?></td>
                              <td><?= $pgw['nama_pegawai']; ?></td>
                              <td><?= $nama_jeniskelamin; ?></td>
                              <td><?= $jabatan['nama_jabatan']; ?></td>
                              <td><?= $golpangkat['nama_pangkat'] . ' / ' . $golpangkat['nama_gol']; ?></td>
                              <td><?= $pgw['tempat_lahir']; ?></td>
                              <td><?= tanggal_indo($pgw['tanggal_lahir']); ?></td>
                              <td><?= $pgw['alamat']; ?></td>
                              <td><?= $pgw['nohp']; ?></td>
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