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
                  <h3 class="card-title">Detail Data Pengguna</h3>
              </div>
              <div class="card-body col-md-6">
                  <table class="table table-sm">
                      <tbody>
                          <?php
                            $id_level = $masterpengguna['id_level'];
                            $level = $this->db->get_where('level', ['id_level' => $id_level])->row_array();
                            ?>
                          <tr>
                              <td>Level</td>
                              <td>:</td>
                              <td><?= $level['nama_level']; ?></td>
                          </tr>
                          <tr>
                              <td>Nama Pengguna</td>
                              <td>:</td>
                              <td><?= $masterpengguna['nama_pengguna']; ?></td>
                          </tr>
                          <tr>
                              <td>Username</td>
                              <td>:</td>
                              <td><?= $masterpengguna['username']; ?></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/pengguna'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->