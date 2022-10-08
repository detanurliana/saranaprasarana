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
                  <div class="row mb-3">
                      <a href="<?= base_url('master/tambah_fasilitas') ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button></a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Kegunaan</th>
                              <th>Kode Fasilitas</th>
                              <th>Jenis Fasilitas</th>
                              <th>Nama Fasilitas</th>
                              <th>Kapasitas (Orang)</th>
                              <th>Keterangan</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1;
                            foreach ($fasilitas as $filter) : ?>
                              <?php
                                $id_jenisfasilitas = $filter['id_jenisfasilitas'];
                                $jenisfasilitas = $this->db->get_where('jenisfasilitas', ['id_jenisfasilitas' => $id_jenisfasilitas])->row_array();
                                $id_status = $filter['id_status'];
                                if ($id_status == '1') {
                                    $nama_status = 'Tersedia';
                                } else {
                                    $nama_status = 'Belum Tersedia';
                                }
                                ?>
                              <tr>
                                  <td><?= $no; ?></td>
                                  <td><?= tipe($filter['id_tipe']); ?></td>
                                  <td><?= $filter['kode_fasilitas']; ?></td>
                                  <td><?= $jenisfasilitas['nama_jenisfasilitas']; ?></td>
                                  <td><?= $filter['nama_fasilitas']; ?></td>
                                  <td><?= $filter['kapasitas']; ?></td>
                                  <td><?= $filter['keterangan']; ?></td>
                                  <td><?= $nama_status; ?></td>
                                  <td>
                                      <a href="<?= base_url(); ?>master/detail_fasilitas/<?= $filter['id_fasilitas']; ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-info"></i> Detail</button></a>
                                      <a href="<?= base_url(); ?>master/ubah_fasilitas/<?= $filter['id_fasilitas']; ?>"><button type="button" class="btn btn-primary btn-sm"><i class=" fa fa-edit"></i> Ubah</button></a>
                                      <a href="<?= base_url(); ?>master/hapus_fasilitas/<?= $filter['id_fasilitas']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                  </td>
                              </tr>
                          <?php $no++;
                            endforeach; ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Kegunaan</th>
                              <th>Kode Fasilitas</th>
                              <th>Jenis Fasilitas</th>
                              <th>Nama Fasilitas</th>
                              <th>Kapasitas (Orang)</th>
                              <th>Keterangan</th>
                              <th>Status</th>
                              <th>Aksi</th>
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