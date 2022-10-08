  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
          <?= $this->session->flashdata('pesan_notifikasi'); ?>
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title"><?= $judul; ?></h3>
              </div>
              <div class="card-body">
                  <div class="col-md-6">
                      <!-- Widget: user widget style 2 -->
                      <div class="card card-widget widget-user-2">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-primary">
                              <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-edit"></i> Ubah Foto</button>
                              <div class="widget-user-image">
                                  <img class="img-circle elevation-2" src="<?= base_url('assets/'); ?>dist/img/<?= $pegawai['foto']; ?>" alt="User Avatar">
                              </div>
                              <!-- /.widget-user-image -->
                              <h3 class="widget-user-username"><?= $pegawai['nama_pegawai']; ?></h3>
                              <h5 class="widget-user-desc"><?= $jabatan['nama_jabatan']; ?></h5>
                          </div>
                          <div class="card-footer p-0">
                              <table class="table">
                                  <tr>
                                      <td>Jenis Kelamin</td>
                                      <td>:</td>
                                      <td><?= check_jeniskelamin($jeniskelamin); ?></td>
                                  </tr>
                                  <tr>
                                      <td>Golongan Pangkat</td>
                                      <td>:</td>
                                      <td><?= $golpangkat['nama_gol'] . '/' . $golpangkat['nama_pangkat']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>Tempat/Tanggal Lahir</td>
                                      <td>:</td>
                                      <td><?= $pegawai['tempat_lahir'] . ' / ' . tanggal_indo($pegawai['tanggal_lahir']); ?></td>
                                  </tr>
                                  <tr>
                                      <td>Alamat</td>
                                      <td>:</td>
                                      <td><?= $pegawai['alamat']; ?></td>
                                  </tr>
                                  <tr>
                                      <td>No HP</td>
                                      <td>:</td>
                                      <td><?= $pegawai['nohp']; ?></td>
                                  </tr>
                                  <tr>
                                      <td></td>
                                      <td></td>
                                      <td><button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('profil/ubah_password'); ?>'"><i class="fa fa-key"></i> Ubah Password</button></td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <!-- /.widget-user -->
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="uploadModal">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Upload Foto</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form id="formTambah" action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" class="form-control" id="id_pegawai" name="id_pegawai" value="<?= $pegawai['id_pegawai']; ?>">
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="foto">Pilih Foto</label>
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="foto" name="foto">
                              <label class="custom-file-label" for="foto">Choose file</label>
                              <small class="text-danger"><?= form_error('foto'); ?></small>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban"></i> Batal</button>
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengubah password');"><i class="fa fa-save"></i> Simpan</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->