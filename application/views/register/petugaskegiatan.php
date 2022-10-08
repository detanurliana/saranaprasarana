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
                  <h3 class="card-title"><?= $judul; ?></h3>
              </div>
              <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                               <th>No</th>
                               
                                                       <th>Kode Petugas Kegiatan</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Petugas</th>
                                                      <th>Tupoksi</th>
                          </tr>
                      </thead>
						<tbody>
                           <?php $no = 1;
                                                    $petugaskegiatan = $this->db->get('petugaskegiatan')->result_array();
                                                    foreach ($petugaskegiatan as $pt) :
                                                        $id_kegiatan = $pt['id_kegiatan'];
                                                        $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                                        $id_pegawai = $pt['id_pegawai'];
                                                        $pilihpegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
                                                    ?>
                                                      <tr>
                                                          <td><?= $no; ?></td>
                                                          <td><?= $pt['kode_petugaskegiatan']; ?></td>
                                                          <td><?= $pilihkegiatan['nama_kegiatan']; ?></td>
                                                          <td><?= $pilihpegawai['nama_pegawai']; ?></td>
                                                          <td><?= $pt['tupoksi']; ?></td>
                                                         
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                        </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                             <th>Kode Petugas Kegiatan</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Petugas</th>
                                                      <th>Tupoksi</th>
                          </tr>
                      </tfoot>
                  </table>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->