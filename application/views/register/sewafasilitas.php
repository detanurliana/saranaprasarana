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
                               <th>Kode Sewa Fasilitas</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Fasilitas</th>
                                                      <th>Jumlah Orang</th>
                                                      <th>Harga</th>
                          </tr>
                      </thead>
						<tbody>
                         <?php
                                                    $no = 1;
                                                    $total_sewafasilitas = 0;
                                                    $sewafasilitas = $this->db->get('sewafasilitas')->result_array();
                                                    foreach ($sewafasilitas as $sf) :
                                                        $id_kegiatan = $sf['id_kegiatan'];
                                                        $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                                        $id_hargafasilitas = $sf['id_hargafasilitas'];
                                                        $pilihhargafasilitas = $this->db->get_where('hargafasilitas', ['id_hargafasilitas' => $id_hargafasilitas])->row_array();
                                                        $id_fasilitas = $pilihhargafasilitas['id_fasilitas'];
                                                        $pilihfasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                                                        $hargafasilitas = $pilihhargafasilitas['harga'];
                                                        $total_sewafasilitas = $total_sewafasilitas + $hargafasilitas;
                                                    ?>
                                                      <tr>
                                                          <td><?= $no; ?></td>
                                                          <td><?= $sf['kode_sewafasilitas']; ?></td>
                                                          <td><?= $pilihkegiatan['nama_kegiatan']; ?></td>
                                                          <td><?= $pilihfasilitas['nama_fasilitas']; ?></td>
                                                          <td><?= $sf['jumlah_orang']; ?></td>
                                                          <td><?= rupiah($pilihhargafasilitas['harga']); ?></td>
                                                          
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                        </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Kode Sewa Fasilitas</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Fasilitas</th>
                                                      <th>Jumlah Orang</th>
                                                      <th>Harga</th>
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