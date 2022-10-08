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
                      <a href="<?= base_url('master/tambah_hargafasilitas') ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button></a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama Fasilitas</th>
                              <th>Pengguna Fasilitas</th>
                              <th>Harga</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $no = 1;
                            foreach ($hargafasilitas as $hf) :
                                $id_fasilitas = $hf['id_fasilitas'];
                                $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                                $id_kategorifasilitas = $hf['id_kategorifasilitas'];
                                $kategorifasilitas = $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
                            ?>
                              <tr>
                                  <td><?= $no; ?></td>
                                  <td><?= $fasilitas['nama_fasilitas']; ?></td>
                                  <td><?= $kategorifasilitas['nama_kategorifasilitas']; ?></td>
                                  <td><?= rupiah($hf['harga']); ?></td>
                                  <td>
                                      <a href="<?= base_url(); ?>master/detail_hargafasilitas/<?= $hf['id_hargafasilitas']; ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-info"></i> Detail</button></a>
                                      <a href="<?= base_url(); ?>master/ubah_hargafasilitas/<?= $hf['id_hargafasilitas']; ?>"><button type="button" class="btn btn-primary btn-sm"><i class=" fa fa-edit"></i> Ubah</button></a>
                                      <a href="<?= base_url(); ?>master/hapus_hargafasilitas/<?= $hf['id_hargafasilitas']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                  </td>
                              </tr>
                          <?php $no++;
                            endforeach; ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Nama Fasilitas</th>
                              <th>Pengguna Fasilitas</th>
                              <th>Harga</th>
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