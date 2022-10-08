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
                  <h3 class="card-title">Detail Data Harga Fasilitas</h3>
              </div>
              <div class="card-body col-md-6">
                  <table class="table table-sm">
                      <tbody>
                          <?php
                            $id_fasilitas = $hargafasilitas['id_fasilitas'];
                            $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
                            ?>
                          <tr>
                              <td>Nama Fasilitas</td>
                              <td>:</td>
                              <td><?= $fasilitas['nama_fasilitas']; ?></td>
                          </tr>
                          <?php
                            $id_kategorifasilitas = $hargafasilitas['id_kategorifasilitas'];
                            $kategorifasilitas = $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
                            ?>
                          <tr>
                              <td>Kategori Fasilitas</td>
                              <td>:</td>
                              <td><?= $kategorifasilitas['nama_kategorifasilitas']; ?></td>
                          </tr>
                          <tr>
                              <td>Harga Fasilitas</td>
                              <td>:</td>
                              <td><?= rupiah($hargafasilitas['harga']); ?></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/hargafasilitas'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->