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
                  <h3 class="card-title">Detail Data Konsumsi</h3>
              </div>
              <div class="card-body col-md-6">
                  <table class="table table-sm">
                      <tbody>
                          <tr>
                              <td>Urutan</td>
                              <td>:</td>
                              <td><?= $konsumsi['urutan']; ?></td>
                          </tr>
                          <tr>
                              <td>Nama Konsumsi</td>
                              <td>:</td>
                              <td><?= $konsumsi['nama_konsumsi']; ?></td>
                          </tr>
                          <tr>
                              <td>Harga</td>
                              <td>:</td>
                              <td><?= rupiah($konsumsi['harga']); ?></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/konsumsi'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->