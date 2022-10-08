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
                  <h3 class="card-title">Ubah Data Pengguna</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_pengguna" class="form-control" id="id_pengguna" value="<?= $masterpengguna['id_pengguna']; ?>">
                      <div class="modal-body">
                          <?php
                            $data['masterpegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $masterpengguna['id_pegawai']])->row_array();
                            ?>
                          <div class="form-group">
                              <label for="id_pegawai">Pegawai</label>
                              <input type="hidden" name="id_pegawai" class="form-control" id="id_pegawai" value="<?= $data['masterpegawai']['id_pegawai']; ?>">
                              <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai" value="<?= $data['masterpegawai']['nama_pegawai']; ?>" placeholder="Isi Nama Pegawai" disabled>
                          </div>
                          <div class="form-group">
                              <label for="level">Pilih Level</label>
                              <select class="form-control select2 select2-hidden-accessible" name="id_level" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php foreach ($masterlevel as $lv) :; ?>
                                      <?php
                                        if ($lv['id_level'] == $masterpengguna['id_level']) {

                                        ?>
                                          <option value="<?= $lv['id_level']; ?>" selected="selected"><?= $lv['nama_level']; ?></option>
                                      <?php
                                        } else {
                                        ?>
                                          <option value="<?= $lv['id_level']; ?>"><?= $lv['nama_level']; ?></option>
                                      <?php
                                        }
                                        ?>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="nama_pengguna">Nama Pengguna</label>
                              <input type="text" name="nama_pengguna" class="form-control" id="nama_pengguna" value="<?= $masterpengguna['nama_pengguna']; ?>" placeholder="Isi Nama Pengguna">
                              <small class="text-danger"><?= form_error('nama_pengguna'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" name="username" class="form-control" id="username" value="<?= $masterpengguna['username']; ?>" placeholder="Isi Username">
                              <small class="text-danger"><?= form_error('username'); ?></small>
                          </div>
                          <div class="form-group">
                              <label for="password">Password <i>(Kosongkan jika tidak ingin mengganti password)</i></label>
                              <input type="text" name="password" class="form-control" id="password" value="" placeholder="Isi Password">
                          </div>
                          <div class="form-group">
                              <label for="aktif">Status Pengguna</label>
                              <select class="form-control select2 select2-hidden-accessible" name="aktif" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                  <?php
                                    if ($masterpengguna['aktif'] == '1') {

                                    ?>
                                      <option value="1" selected="selected">Aktif</option>
                                  <?php
                                    } else {
                                    ?>
                                      <option value="2" selected="selected">Tidak Aktif</option>
                                  <?php
                                    }
                                    ?>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/pengguna'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengubah data');"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                  </form>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->