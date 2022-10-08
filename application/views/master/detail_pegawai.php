  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Detail Data Pegawai</h3>
              </div>
              <div class="card-body col-md-6">
                  <table class="table table-sm">
                      <tbody>
                          <tr>
                              <td>NIP</td>
                              <td>:</td>
                              <td><?= $masterpegawai['nip']; ?></td>
                          </tr>
                          <tr>
                              <td>Nama Pegawai</td>
                              <td>:</td>
                              <td><?= $masterpegawai['nama_pegawai']; ?></td>
                          </tr>
                          <?php
                            $nama_jeniskelamin = check_jeniskelamin($masterpegawai['id_jeniskelamin']);
                            ?>
                          <tr>
                              <td>Jenis Kelamin</td>
                              <td>:</td>
                              <td><?= $nama_jeniskelamin; ?></td>
                          </tr>
                          <tr>
                              <td>Tempat Lahir</td>
                              <td>:</td>
                              <td><?= $masterpegawai['tempat_lahir']; ?></td>
                          </tr>
                          <tr>
                              <td>Tanggal Lahir</td>
                              <td>:</td>
                              <td><?= tanggal_indo($masterpegawai['tanggal_lahir']); ?></td>
                          </tr>
                          <?php
                            $id_jabatan = $masterpegawai['id_jabatan'];
                            $jabatan = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();
                            ?>
                          <tr>
                              <td>jabatan</td>
                              <td>:</td>
                              <td><?= $jabatan['nama_jabatan']; ?></td>
                          </tr>
                          <?php
                            $id_golpangkat = $masterpegawai['id_golpangkat'];
                            $golpangkat = $this->db->get_where('golpangkat', ['id_golpangkat' => $id_golpangkat])->row_array();
                            ?>
                          <tr>
                              <td>Pangkat Golongan</td>
                              <td>:</td>
                              <td><?= $golpangkat['nama_pangkat'] . '/' . $golpangkat['nama_gol']; ?></td>
                          </tr>
                          <tr>
                              <td>Alamat</td>
                              <td>:</td>
                              <td><?= $masterpegawai['alamat']; ?></td>
                          </tr>
                          <tr>
                              <td>No HP</td>
                              <td>:</td>
                              <td><?= $masterpegawai['nohp']; ?></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/pegawai'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->