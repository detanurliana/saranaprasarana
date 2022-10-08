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
                      <?php
                        $id_level = $this->session->userdata('id_level');
                        if ($id_level == '3') {
                            $menunya = 'pemesan';
                        } else {
                            $menunya = 'register';
                        }
                        ?>
                      <a href="<?= base_url($menunya . '/tambah_pemesanan') ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button></a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Kode Pemesanan</th>
                              <th>Nama Pemesan</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1;
                            foreach ($pemesanan as $pms) : ?>
                              <?php
                                $id_pemesanan = $pms['id_pemesanan'];
                                $id_pemesan = $pms['id_pemesan'];
                                $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();



                                $cekpesankonsumsi = $this->db->get_where('pesankonsumsi', ['id_pemesanan' => $id_pemesanan]);
                                $cekBuktipembayaran = $this->db->get_where('buktipembayaran', ['id_pemesanan' => $id_pemesanan]);
                                if ($cekpesankonsumsi->num_rows() <= 0) {
                                    $nama_status = 'Pendaftaran';
                                } else if ($cekBuktipembayaran->num_rows() == 1) {
                                    $nama_status = 'Sudah Dibayar';
                                } else if ($cekpesankonsumsi->num_rows() > 0) {
                                    $nama_status = 'Menunggu Pembayaran';
                                }


                                ?>
                              <tr>
                                  <td><?= $no; ?></td>
                                  <td><?= tanggal_indo($pms['tanggal']); ?></td>
                                  <td><?= $pms['kode_pemesanan']; ?></td>
                                  <td><?= $pemesan['nama_pemesan']; ?></td>
                                  <td><?= $nama_status; ?></td>
                                  <td>
                                      <a href="<?= base_url($menunya); ?>/detail_pemesanan/<?= $pms['id_pemesanan']; ?>"><button type="button" class="btn btn-success btn-sm"><i class="fa fa-info"></i> Detail</button></a>
                                      <?php
                                        if ($id_level != '3') {
                                        ?>
                                          <a href="<?= base_url($menunya); ?>/ubah_pemesanan/<?= $pms['id_pemesanan']; ?>"><button type="button" class="btn btn-primary btn-sm"><i class=" fa fa-edit"></i> Ubah</button></a>
                                          <a href="<?= base_url($menunya); ?>/hapus_pemesanan/<?= $pms['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                      <?php } ?>
                                  </td>
                              </tr>
                          <?php $no++;
                            endforeach; ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Kode Pemesanan</th>
                              <th>Nama Pemesan</th>
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