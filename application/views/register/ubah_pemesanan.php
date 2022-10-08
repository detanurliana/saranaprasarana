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
                  <h3 class="card-title">Ubah Data <?= $judul; ?></h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <input type="hidden" name="id_pemesanan" class="form-control" id="id_pemesanan" value="<?= $pemesanan['id_pemesanan']; ?>">
                      <div class="modal-body">
                          <div class="modal-body">
                              <div class="form-group">
                                  <label for="kode_pemesanan">Kode Pemesanan</label>
                                  <input type="text" name="kode_pemesanan" class="form-control" id="kode_pemesanan" value="<?= $pemesanan['kode_pemesanan']; ?>" placeholder="Isi Kode Pemesanan" readonly>
                                  <small class="text-danger"><?= form_error('kode_pemesanan'); ?></small>
                              </div>
                              <div class="form-group">
                                  <label>Tanggal</label>
                                  <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" name="tanggal" data-target="#reservationdate1" data-toggle="datetimepicker" value="<?= date('d-m-Y', strtotime($pemesanan['tanggal'])); ?>">
                                      <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="id_pemesan">Pilih Pemesan</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="id_pemesan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php
                                        $pemesan = $this->db->get('pemesan')->result_array();
                                        foreach ($pemesan as $pm) :; ?>
                                          <?php
                                            if ($pm['id_pemesan'] == $pemesanan['id_pemesan']) {

                                            ?>
                                              <option value="<?= $pm['id_pemesan']; ?>" selected="selected"><?= $pm['nama_pemesan'] . ' | ' . $pm['nohp']; ?></option>
                                          <?php
                                            } else {
                                            ?>
                                              <option value="<?= $pm['id_pemesan']; ?>"><?= $pm['nama_pemesan'] . ' | ' . $pm['nohp']; ?></option>
                                          <?php
                                            }
                                            ?>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('register/pemesanan'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin mengubah data');"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                  </form>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->