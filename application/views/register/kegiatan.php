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
                              <th>Kode Kegiatan</th>
                              <th>Nama Kegiatan</th>
                              <th>Dari Tanggal</th>
                              <th>Sampai Tanggal</th>
                              <th>Lama</th>
                              <th>Waktu</th>
                          </tr>
                      </thead>
						<tbody>
                         <?php $no = 1;
                         $kegiatan = $this->db->get('kegiatan')->result_array();
                         foreach ($kegiatan as $keg) :
                         $dari_tanggal = new Datetime($keg['dari_tanggal']);
                         $sampai_tanggal = new Datetime($keg['sampai_tanggal']);
                         $selisih = $sampai_tanggal->diff($dari_tanggal)->days + 1;
                         ?>
							<tr>
								<td><?= $no; ?></td>
                                <td><?= $keg['kode_kegiatan']; ?></td>
                                <td><?= $keg['nama_kegiatan']; ?></td>
                                <td><?= tanggal_indo($keg['dari_tanggal']); ?></td>
                                <td><?= tanggal_indo($keg['sampai_tanggal']); ?></td>
                                <td><?= $selisih . ' Hari'; ?></td>
                                <td><?= $keg['dari_jam'] . ' - ' . $keg['sampai_jam']; ?></td>
                          <?php $no++;
							endforeach; ?>
                        </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Kode Kegiatan</th>
                              <th>Nama Kegiatan</th>
                              <th>Dari Tanggal</th>
                              <th>Sampai Tanggal</th>
                              <th>Lama</th>
                              <th>Waktu</th>
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