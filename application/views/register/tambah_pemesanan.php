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
                  <h3 class="card-title">Tambah Data Pemesanan</h3>
              </div>
              <div class="card-body col-md-6">
                  <form id="formTambah" action="" method="post">
                      <div class="modal-body">
                          <?php
                            $queryKode = $this->db->query("SELECT max(kode_pemesanan) as kodeTerbesar FROM pemesanan")->row_array();
                            $kodepemesanan = $queryKode['kodeTerbesar'];
                            $urutan = (int) substr($kodepemesanan, 2, 5);
                            $urutan++;
                            $huruf = "PM";
                            $kodepemesanan = $huruf . sprintf("%05s", $urutan);
                            ?>
                          <div class="form-group">
                              <label for="kode_pemesanan">Kode Pemesanan</label>
                              <input type="text" name="kode_pemesanan" class="form-control" id="kode_pemesanan" value="<?= $kodepemesanan; ?>" placeholder="Isi Kode Pemesanan">
                              <small class="text-danger"><?= form_error('kode_pemesanan'); ?></small>
                          </div>
                          <div class="form-group">
                              <label>Tanggal</label>
                              <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" name="tanggal" data-target="#reservationdate1" value="<?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>" data-toggle="datetimepicker">
                                  <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                          </div>
                          <?php
                            $id_level = $this->session->userdata('id_level');
                            if ($id_level == '3') {
                            ?>
                              <div class="form-group">
                                  <label for="id_pemesan">Pemesan</label>
                                  <input type="hidden" class="form-control" name="id_pemesan" value="<?= $id_pemesan; ?>" readonly>
                                  <input type="text" class="form-control" name="nama_pemesan" value="<?= $nama_pemesan; ?>" readonly>
                              </div>
                          <?php } else { ?>
                              <div class="form-group">
                                  <label for="id_pemesan">Pilih Pemesan</label>
                                  <select class="form-control select2 select2-hidden-accessible" name="id_pemesan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                      <?php foreach ($pemesan as $brg) :; ?>
                                          <option value="<?= $brg['id_pemesan']; ?>"><?= $brg['nama_pemesan'] . ' | ' . $brg['nohp']; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                          <?php } ?>
                      </div>
                      <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url('register/pemesanan'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                          <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menambah data');"><i class="fa fa-save"></i> Simpan</button>
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