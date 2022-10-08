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
                  <h3 class="card-title">Detail Data Menu</h3>
              </div>
              <div class="card-body col-md-6">
                  <table class="table table-sm">
                      <tbody>
                          <tr>
                              <td>Urutan</td>
                              <td>:</td>
                              <td><?= $menu['urutan']; ?></td>
                          </tr>
                          <tr>
                              <td>Nama Menu</td>
                              <td>:</td>
                              <td><?= $menu['nama_menu']; ?></td>
                          </tr>
                          <tr>
                              <td>URL</td>
                              <td>:</td>
                              <td><?= $menu['url']; ?></td>
                          </tr>
                          <tr>
                              <td>Icon</td>
                              <td>:</td>
                              <td><?= $menu['icon']; ?></td>
                          </tr>
                          <tr>
                              <td>Keterangan</td>
                              <td>:</td>
                              <td><?= $menu['keterangan']; ?></td>
                          </tr>
                      </tbody>
                  </table>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('master/menu'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->