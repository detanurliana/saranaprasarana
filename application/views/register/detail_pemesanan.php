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
      <?php $id_pemesanan = $pemesanan['id_pemesanan']; ?>
      <?php
        $id_level = $this->session->userdata('id_level');
        if ($id_level == '3') {
            $menunya = 'pemesan';
        } else {
            $menunya = 'register';
        }
        ?>
      <!-- Main content -->
      <section class="content">
          <!-- Default box -->
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Detail Data Pemesanan</h3>
              </div>
              <div class="card-body col-md-12">
                  <div class="justify-content-between">
                      <button type="button" class="btn btn-warning" onclick="window.location='<?= base_url($menunya . '/pemesanan'); ?>'"><i class="fa fa-arrow-left"></i> Kembali</button>
                  </div>
                  <div class="col-12 col-sm-12 mt-3">
                      <div class="card card-success card-tabs">




                          <div class="card-header p-0 pt-1">
                              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active" id="custom-tabs-one-pendaftaran-tab" data-toggle="pill" href="#custom-tabs-one-pendaftaran" role="tab" aria-controls="custom-tabs-one-pendaftaran" aria-selected="true">Pendaftaran</a>
                                  </li>

                                  <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-one-kegiatan-tab" data-toggle="pill" href="#custom-tabs-one-kegiatan" role="tab" aria-controls="custom-tabs-one-kegiatan" aria-selected="false">Kegiatan</a>
                                  </li>

                                  <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-one-sewafasilitas-tab" data-toggle="pill" href="#custom-tabs-one-sewafasilitas" role="tab" aria-controls="custom-tabs-one-sewafasilitas" aria-selected="false">Sewa Fasilitas</a>
                                  </li>

                                  <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-one-pesankonsumsi-tab" data-toggle="pill" href="#custom-tabs-one-pesankonsumsi" role="tab" aria-controls="custom-tabs-one-pesankonsumsi" aria-selected="false">Pesan Konsumsi</a>
                                  </li>
                                  <?php
                                    if ($id_level != '3') {
                                    ?>
                                      <li class="nav-item">
                                          <a class="nav-link" id="custom-tabs-one-petugaskegiatan-tab" data-toggle="pill" href="#custom-tabs-one-petugaskegiatan" role="tab" aria-controls="custom-tabs-one-petugaskegiatan" aria-selected="false">Petugas Kegiatan</a>
                                      </li>

                                      <li class="nav-item">
                                          <a class="nav-link" id="custom-tabs-one-jadwalpetugas-tab" data-toggle="pill" href="#custom-tabs-one-jadwalpetugas" role="tab" aria-controls="custom-tabs-one-jadwalpetugas" aria-selected="false">Jadwal Petugas</a>
                                      </li>
                                  <?php } ?>
                                  <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-one-pembayaran-tab" data-toggle="pill" href="#custom-tabs-one-pembayaran" role="tab" aria-controls="custom-tabs-one-pembayaran" aria-selected="false">Pembayaran</a>
                                  </li>

                                  <li class="nav-item">
                                      <a class="nav-link" id="custom-tabs-one-buktipembayaran-tab" data-toggle="pill" href="#custom-tabs-one-buktipembayaran" role="tab" aria-controls="custom-tabs-one-buktipembayaran" aria-selected="false">Bukti Pembayaran</a>
                                  </li>
                              </ul>
                          </div>
                          <div class="card-body">
                              <div class="tab-content" id="custom-tabs-one-tabContent">
                                  <div class="tab-pane fade show active" id="custom-tabs-one-pendaftaran" role="tabpanel" aria-labelledby="custom-tabs-one-pendaftaran-tab">
                                      <div class="col-6">
                                          <table class="table table-sm">
                                              <tbody>
                                                  <tr>
                                                      <td>Kode Pemesanan</td>
                                                      <td>:</td>
                                                      <td><?= $pemesanan['kode_pemesanan']; ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Tanggal</td>
                                                      <td>:</td>
                                                      <td><?= tanggal_indo($pemesanan['tanggal']); ?></td>
                                                  </tr>
                                                  <?php
                                                    $id_pemesan = $pemesanan['id_pemesan'];
                                                    $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();
                                                    ?>
                                                  <tr>
                                                      <td>Nama Pemesan</td>
                                                      <td>:</td>
                                                      <td><?= $pemesan['nama_pemesan']; ?></td>
                                                  </tr>
                                                  <?php
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
                                                      <td>Status</td>
                                                      <td>:</td>
                                                      <td><?= $nama_status; ?></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-kegiatan" role="tabpanel" aria-labelledby="custom-tabs-one-kegiatan-tab">
                                      <div class="col-12">
                                          <div class="row mb-3">
                                              <a href="<?= base_url($menunya . '/tambah_kegiatan/' . $id_pemesanan) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Kegiatan</button></a>
                                          </div>
                                          <table class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>No</th>
                                                      <th>Kode Kegiatan</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Dari Tanggal</th>
                                                      <th>Sampai Tanggal</th>
                                                      <th>Lama</th>
                                                      <th>Waktu</th>
                                                      <th>Aksi</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    $cekkegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan]);
                                                    $no = 1;
                                                    $kegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan])->result_array();
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
                                                          <td>
                                                              <a href="<?= base_url($menunya); ?>/hapus_kegiatan/<?= $keg['id_kegiatan'] . '/' . $keg['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                          </td>
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-sewafasilitas" role="tabpanel" aria-labelledby="custom-tabs-one-sewafasilitas-tab">
                                      <div class="col-12">
                                          <div class="row mb-3">
                                              <?php
                                                if ($cekkegiatan->num_rows() > 0) {

                                                ?>
                                                  <a href="<?= base_url($menunya . '/tambah_sewafasilitas/' . $id_pemesanan . '/1') ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Sewa Fasilitas Kegiatan</button></a> &nbsp;&nbsp;&nbsp;
                                                  <a href="<?= base_url($menunya . '/tambah_sewafasilitas/' . $id_pemesanan . '/2') ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Sewa Penginapan</button></a>
                                              <?php } ?>
                                          </div>
                                          <table class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>No</th>
                                                      <th>Kode Sewa Fasilitas</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Fasilitas</th>
                                                      <th>Jumlah Orang</th>
                                                      <th>Harga</th>
                                                      <th>Aksi</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    $no = 1;
                                                    $total_sewafasilitas = 0;
                                                    $sewafasilitas = $this->db->get_where('sewafasilitas', ['id_pemesanan' => $id_pemesanan])->result_array();
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
                                                          <td>
                                                              <a href="<?= base_url($menunya); ?>/hapus_sewafasilitas/<?= $sf['id_sewafasilitas'] . '/' . $sf['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                          </td>
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                                                  <tr>
                                                      <td colspan="5" align="right"><b>Total</b></td>
                                                      <td colspan="2"><b><?= rupiah($total_sewafasilitas); ?></b></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-pesankonsumsi" role="tabpanel" aria-labelledby="custom-tabs-one-pesankonsumsi-tab">
                                      <div class="col-12">
                                          <div class="row mb-3">
                                              <?php
                                                if ($cekkegiatan->num_rows() > 0) {

                                                ?>
                                                  <a href="<?= base_url($menunya . '/tambah_pesankonsumsi/' . $id_pemesanan) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Pesan Konsumsi</button></a>
                                              <?php } ?>
                                          </div>
                                          <table class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>No</th>
                                                      <th>Kode Pesan Konsumsi</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Konsumsi</th>
                                                      <th>Harga</th>
                                                      <th>Keterangan</th>
                                                      <th>Jumlah Orang</th>
                                                      <th>Total Harga</th>
                                                      <th>Aksi</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    $no = 1;
                                                    $total_pesankonsumsi = 0;
                                                    $totalharga = 0;
                                                    $pesankonsumsi = $this->db->get_where('pesankonsumsi', ['id_pemesanan' => $id_pemesanan])->result_array();
                                                    foreach ($pesankonsumsi as $pk) :
                                                        $id_kegiatan = $pk['id_kegiatan'];
                                                        $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                                        $id_konsumsi = $pk['id_konsumsi'];
                                                        $pilihkonsumsi = $this->db->get_where('konsumsi', ['id_konsumsi' => $id_konsumsi])->row_array();
                                                        $harga = $pilihkonsumsi['harga'];
                                                        $jumlah = $pk['jumlah_orang'];
                                                        $totalharga = $harga * $jumlah;
                                                        $total_pesankonsumsi = $total_pesankonsumsi + $totalharga;
                                                    ?>
                                                      <tr>
                                                          <td><?= $no; ?></td>
                                                          <td><?= $pk['kode_pesankonsumsi']; ?></td>
                                                          <td><?= $pilihkegiatan['nama_kegiatan']; ?></td>
                                                          <td><?= $pilihkonsumsi['nama_konsumsi']; ?></td>
                                                          <td><?= rupiah($pilihkonsumsi['harga']); ?></td>
                                                          <td><?= $pilihkonsumsi['keterangan']; ?></td>
                                                          <td><?= $pk['jumlah_orang']; ?></td>
                                                          <td><?= rupiah($totalharga); ?></td>
                                                          <td>
                                                              <a href="<?= base_url($menunya); ?>/hapus_pesankonsumsi/<?= $pk['id_pesankonsumsi'] . '/' . $pk['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                          </td>
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                                                  <tr>
                                                      <td colspan="6" align="right"><b>Total</b></td>
                                                      <td colspan="2"><b><?= rupiah($total_pesankonsumsi); ?></b></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-petugaskegiatan" role="tabpanel" aria-labelledby="custom-tabs-one-petugaskegiatan-tab">
                                      <div class="col-12">
                                          <div class="row mb-3">
                                              <?php
                                                if ($cekkegiatan->num_rows() > 0) {

                                                ?>
                                                  <a href="<?= base_url($menunya . '/tambah_petugaskegiatan/' . $id_pemesanan) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Petugas Kegiatan</button></a>
                                              <?php } ?>
                                          </div>
                                          <table class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>No</th>
                                                      <th>Kode Petugas Kegiatan</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Petugas</th>
                                                      <th>Tupoksi</th>
                                                      <th>Aksi</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $no = 1;
                                                    $petugaskegiatan = $this->db->get_where('petugaskegiatan', ['id_pemesanan' => $id_pemesanan])->result_array();
                                                    foreach ($petugaskegiatan as $pt) :
                                                        $id_kegiatan = $pt['id_kegiatan'];
                                                        $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                                        $id_pegawai = $pt['id_pegawai'];
                                                        $pilihpegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
                                                    ?>
                                                      <tr>
                                                          <td><?= $no; ?></td>
                                                          <td><?= $pt['kode_petugaskegiatan']; ?></td>
                                                          <td><?= $pilihkegiatan['nama_kegiatan']; ?></td>
                                                          <td><?= $pilihpegawai['nama_pegawai']; ?></td>
                                                          <td><?= $pt['tupoksi']; ?></td>
                                                          <td>
                                                              <a href="<?= base_url($menunya); ?>/hapus_petugaskegiatan/<?= $pt['id_petugaskegiatan'] . '/' . $pt['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                          </td>
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-jadwalpetugas" role="tabpanel" aria-labelledby="custom-tabs-one-jadwalpetugas-tab">
                                      <div class="col-12">
                                          <div class="row mb-3">
                                              <?php
                                                if ($cekkegiatan->num_rows() > 0) {

                                                ?>
                                                  <a href="<?= base_url($menunya . '/tambah_jadwalpetugas/' . $id_pemesanan) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data Jadwal Petugas</button></a>
                                              <?php } ?>
                                          </div>
                                          <table class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>No</th>
                                                      <th>Nama Kegiatan</th>
                                                      <th>Nama Petugas</th>
                                                      <th>Tanggal</th>
                                                      <th>Waktu</th>
                                                      <th>Aksi</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php $no = 1;
                                                    $jadwalpetugas = $this->db->get_where('jadwalpetugas', ['id_pemesanan' => $id_pemesanan])->result_array();
                                                    foreach ($jadwalpetugas as $jp) :
                                                        $id_kegiatan = $jp['id_kegiatan'];
                                                        $pilihkegiatan = $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
                                                        $id_pegawai = $jp['id_pegawai'];
                                                        $pilihpegawai = $this->db->get_where('pegawai', ['id_pegawai' => $id_pegawai])->row_array();
                                                    ?>
                                                      <tr>
                                                          <td><?= $no; ?></td>
                                                          <td><?= $pilihkegiatan['nama_kegiatan']; ?></td>
                                                          <td><?= $pilihpegawai['nama_pegawai']; ?></td>
                                                          <td><?= tanggal_indo($jp['tanggal_jadwal']); ?></td>
                                                          <td><?= $jp['dari_jam'] . ' - ' . $jp['sampai_jam']; ?></td>
                                                          <td>
                                                              <a href="<?= base_url($menunya); ?>/hapus_jadwalpetugas/<?= $jp['id_jadwalpetugas'] . '/' . $jp['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                          </td>
                                                      </tr>
                                                  <?php $no++;
                                                    endforeach; ?>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-pembayaran" role="tabpanel" aria-labelledby="custom-tabs-one-pembayaran-tab">
                                      <div class="col-12">
                                          <?php
                                            $pembayaran = $this->db->get_where('pembayaran', ['id_pemesanan' => $id_pemesanan]);
                                            if ($pembayaran->num_rows() < 1) {
                                            ?>
                                              <div class="row mb-3">
                                                  <?php
                                                    if ($cekkegiatan->num_rows() > 0) {
                                                    ?>
                                                      <a href="<?= base_url($menunya . '/tambah_pembayaran/' . $id_pemesanan) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Generate Nomor Pembayaran</button></a>
                                                  <?php } ?>
                                              </div>
                                          <?php } ?>
                                          <?php
                                            $pembayaran = $this->db->get_where('pembayaran', ['id_pemesanan' => $id_pemesanan]);
                                            if ($pembayaran->num_rows() > 0) {
                                            ?>
                                              <table class="table table-bordered table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>Nomor Pembayaran</th>
                                                          <th>Bank Tujuan</th>
                                                          <th>Total Sewa Fasilitas</th>
                                                          <th>Total Pesan Konsumsi</th>
                                                          <th>Total Pembayaran</th>
                                                          <th>Aksi</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1;
                                                        $pembayaran = $this->db->get_where('pembayaran', ['id_pemesanan' => $id_pemesanan])->result_array();
                                                        foreach ($pembayaran as $pembyr) :
                                                            $id_pembayaran = $pembyr['id_pembayaran'];
                                                            $id_bank = $pembyr['id_bank'];

                                                            $banktujuan = $this->db->get_where('bank', ['id_bank' => $id_bank])->row_array();
                                                            $total_pembayaran = $total_sewafasilitas + $total_pesankonsumsi;
                                                        ?>
                                                          <tr>
                                                              <td><?= $no; ?></td>
                                                              <td><?= $pembyr['kode_pembayaran']; ?></td>
                                                              <td><?= $banktujuan['nama_bank']; ?></td>
                                                              <td><?= rupiah($total_sewafasilitas); ?></td>
                                                              <td><?= rupiah($total_pesankonsumsi); ?></td>
                                                              <td><?= rupiah($total_pembayaran); ?></td>
                                                              <td>
                                                                  <a href="<?= base_url($menunya); ?>/hapus_pembayaran/<?= $pembyr['id_pembayaran'] . '/' . $pembyr['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                              </td>
                                                          </tr>
                                                      <?php $no++;
                                                        endforeach; ?>
                                                  </tbody>
                                              </table>
                                          <?php } ?>
                                      </div>
                                  </div>

                                  <div class="tab-pane fade" id="custom-tabs-one-buktipembayaran" role="tabpanel" aria-labelledby="custom-tabs-one-buktipembayaran-tab">
                                      <div class="col-12">
                                          <?php
                                            $pembayaran = $this->db->get_where('pembayaran', ['id_pemesanan' => $id_pemesanan]);
                                            $buktipembayaran = $this->db->get_where('buktipembayaran', ['id_pemesanan' => $id_pemesanan]);
                                            if (($buktipembayaran->num_rows() <= 0) and ($pembayaran->num_rows() > 0)) {
                                            ?>
                                              <div class="row mb-3">
                                                  <a href="<?= base_url($menunya . '/tambah_buktipembayaran/' . $id_pemesanan . '/' . $id_pembayaran) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Upload Bukti Pembayaran</button></a>
                                              </div>
                                          <?php } ?>
                                          <?php
                                            if ($buktipembayaran->num_rows() > 0) {
                                            ?>
                                              <table class="table table-bordered table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>Tanggal Pembayaran</th>
                                                          <th>Bank Pengirim</th>
                                                          <th>Rekening Pengirim</th>
                                                          <th>Nama Pengirim</th>
                                                          <th>Nominal</th>
                                                          <th>Bukti</th>
                                                          <th>Keterangan</th>
                                                          <th>Aksi</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1;
                                                        $buktipembayaran = $this->db->get_where('buktipembayaran', ['id_pemesanan' => $id_pemesanan])->result_array();
                                                        foreach ($buktipembayaran as $bktipem) :
                                                        ?>
                                                          <tr>
                                                              <td><?= $no; ?></td>
                                                              <td><?= tanggal_indo($bktipem['tanggal_pembayaran']); ?></td>
                                                              <td><?= $bktipem['bank_pengirim']; ?></td>
                                                              <td><?= $bktipem['rekening_pengirim']; ?></td>
                                                              <td><?= $bktipem['nama_pengirim']; ?></td>
                                                              <td><?= rupiah($bktipem['nominal']); ?></td>
                                                              <td><a href="<?= base_url('documents/') . $bktipem['bukti']; ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a></td>
                                                              <td><?= $bktipem['keterangan']; ?></td>
                                                              <td>
                                                                  <a href="<?= base_url($menunya); ?>/hapus_buktipembayaran/<?= $bktipem['id_buktipembayaran'] . '/' . $bktipem['id_pemesanan']; ?>"><button type="button" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fa fa-trash"></i> Hapus</button></a>
                                                              </td>
                                                          </tr>
                                                      <?php $no++;
                                                        endforeach; ?>
                                                  </tbody>
                                              </table>
                                          <?php } ?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card -->
                      </div>
                  </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->