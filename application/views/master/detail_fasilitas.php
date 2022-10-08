  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <!-- NOTIF FLASH DISINI-->
          <?php if ($this->session->flashdata()) : ?>
              <!-- right column -->
              <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h5><i class="icon fas fa-check"></i> Notifkasi!</h5>
                      Data berhasil <?= $this->session->flashdata('flashdata'); ?>
                  </div>
              </div>
              <!--/.col (right) -->
          <?php endif; ?>
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Detail Data Fasilitas</h3>
              </div>
              <div class="row">
                  <div class="card-body col-md-6">
                      <table class="table table-sm">
                          <tbody>
                              <tr>
                                  <td>Kode Fasilitas</td>
                                  <td>:</td>
                                  <td><?= $fasilitas['kode_fasilitas']; ?></td>
                              </tr>
                              <?php
                                $id_jenisfasilitas = $fasilitas['id_jenisfasilitas'];
                                $jenisfasilitas = $this->db->get_where('jenisfasilitas', ['id_jenisfasilitas' => $id_jenisfasilitas])->row_array();
                                ?>
                              <tr>
                                  <td>Jenis Fasilitas</td>
                                  <td>:</td>
                                  <td><?= $jenisfasilitas['nama_jenisfasilitas']; ?></td>
                              </tr>
                              <tr>
                                  <td>Nama Fasilitas</td>
                                  <td>:</td>
                                  <td><?= $fasilitas['nama_fasilitas']; ?></td>
                              </tr>
                              <tr>
                                  <td>Kapasitas (Orang)</td>
                                  <td>:</td>
                                  <td><?= $fasilitas['kapasitas']; ?></td>
                              </tr>
                              <tr>
                                  <td>Keterangan</td>
                                  <td>:</td>
                                  <td><?= $fasilitas['keterangan']; ?></td>
                              </tr>
                              <?php
                                $id_status = $fasilitas['id_status'];
                                if ($id_status == '1') {
                                    $nama_status = 'Tersedia';
                                } else {
                                    $nama_status = 'Belum Tersedia';
                                }
                                ?>
                              <tr>
                                  <td>Status</td>
                                  <td>:</td>
                                  <td><?= $nama_status; ?></td>
                              </tr>
                          </tbody>
                      </table>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/fasilitas'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                      </div>
                  </div>
                  <div class="card-body col-md-6">
                      <div class="row mb-3">
                          <a href="<?= base_url('master/tambah_fotofasilitas/' . $fasilitas['id_fasilitas']) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Foto</button></a>
                      </div>
                      <table id="example2" class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Foto</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php $no = 1;
                                $cekfotofasilitas = $this->db->get_where('fotofasilitas', ['id_fasilitas' => $fasilitas['id_fasilitas']]);
                                if ($cekfotofasilitas->num_rows() > 0) {
                                    foreach ($fotofasilitas as $fotofs) : ?>
                                      <tr>
                                          <td><?= $no; ?></td>
                                          <td><img src="<?= base_url('assets/dist/img/' . $fotofs['foto']); ?>" height="100" width="100" /></td>
                                          <td>
                                              <a href="<?= base_url(); ?>master/hapus_fotofasilitas/<?= $fotofs['id_fotofasilitas']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                          </td>
                                      </tr>
                              <?php $no++;
                                    endforeach;
                                } ?>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>No</th>
                                  <th>Foto</th>
                                  <th>Aksi</th>
                              </tr>
                          </tfoot>
                      </table>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->