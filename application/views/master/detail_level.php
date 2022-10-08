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
                  <h3 class="card-title">Akses Menu Level <?= $levelakses['nama_level']; ?></h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <?php $id_levelakses = $levelakses['id_level']; ?>
                      <input type="hidden" name="id_level" value="<?= $id_levelakses; ?>">
                      <table class="table table-sm">
                          <thead>
                              <tr>
                                  <th>Nama Menu</th>
                                  <th>URL</th>
                                  <th>Akses</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $i = 1;
                                foreach ($menu as $mn) : ?>
                                  <?php
                                    $id_menu = $mn['id_menu'];
                                    $queryAksesMenu = $this->db->get_where('aksesmenu', [
                                        'id_level' => $id_levelakses,
                                        'id_menu' => $id_menu
                                    ]);
                                    if ($queryAksesMenu->num_rows() == 1) {
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }
                                    ?>
                                  <tr>
                                      <td><?= $mn['nama_menu']; ?></td>
                                      <td><?= $mn['url']; ?></td>
                                      <td>
                                          <div class="form-check">
                                              <input class="form-check-input" type="checkbox" <?= $checked; ?> name="check<?= $i; ?>">
                                              <input type="hidden" name="id_menu<?= $i; ?>" value="<?= $id_menu; ?>">
                                          </div>
                                      </td>
                                  </tr>
                              <?php $i++;
                                endforeach; ?>
                          </tbody>
                      </table>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/level'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menyimpan data');"><i class="fa fa-save"></i> Simpan</button>
                      </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->