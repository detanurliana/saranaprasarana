        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <h2 class="text-center display-4"><?= $judul; ?></h2>
                    <form id="formTambah" action="" method="post">
                        <div class="row">
                            <div class="col-md-10 offset-md-1" align="center">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Filter Periode :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" name="periode" id="reservation">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Anda yakin ingin melihat laporan');"><i class="fa fa-print"></i> Lihat Laporan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php if (($this->session->flashdata()) and (isset($periode))) : ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Catatan :</h5>
                                Halaman ini hanya menampilkan laporan yang akan dicetak, untuk mencetak laporan klik tombol Cetak Laporan dibawah.
                            </div>


                            <!-- Main content -->
                            <div class="invoice p-3 mb-3">
                                <!-- title row -->
                                <div class="row">
                                    <div class="col-12">
                                        <table width="80%" align="center">
                                            <tr>
                                                <td rowspan="2" align="right"><img src="<?= base_url('assets/dist/img/' . $profil['logo']); ?>" height="120" width="120" /></td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <h4><?= $profil['nama_profil']; ?></h4>
                                                    <p>Alamat : <?= $profil['alamat']; ?>. Telp :<?= $profil['telepon']; ?>. Kodepos : <?= $profil['kodepos']; ?> <br />
                                                        Email : <?= $profil['email']; ?>. Website : <?= $profil['website']; ?></p>
                                                    <h4>
                                                        <?= $judul; ?>
                                                    </h4>
                                                    <p>Periode : <?= date('d-m-Y', strtotime($dariTanggal)) . ' s.d ' . date('d-m-Y', strtotime($sampaiTanggal)); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr />

                                <!-- Table row -->
                                <div class="row">
                                    <div class="col-12 table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Pemesanan</th>
                                                    <th>Nama Pemesan</th>
                                                    <th>Nama Kegiatan</th>
                                                    <th>Tanggal Pembayaran</th>
                                                    <th>Bank Pengirim</th>
                                                    <th>Nama Pengirim</th>
                                                    <th>Nominal Transfer</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total_harga = 0;
                                                foreach ($filter as $ft) :
                                                    $id_pemesanan = $ft['id_pemesanan'];
                                                    $pemesanan = $this->db->get_where('pemesanan', ['id_pemesanan' => $id_pemesanan])->row_array();
                                                    $kode_pemesanan = $pemesanan['kode_pemesanan'];
                                                    $id_pemesan = $pemesanan['id_pemesan'];
                                                    $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id_pemesan])->row_array();
                                                    $nama_pemesan = $pemesan['nama_pemesan'];
                                                    $id_pemesanan = $ft['id_pemesanan'];
                                                    $kegiatan = $this->db->get_where('kegiatan', ['id_pemesanan' => $id_pemesanan])->row_array();
                                                    $nama_kegiatan = $kegiatan['nama_kegiatan'];

                                                    $tanggal_pembayaran = $ft['tanggal_pembayaran'];
                                                    $bank_pengirim = $ft['bank_pengirim'];
                                                    $rekening_pengirim = $ft['rekening_pengirim'];
                                                    $nama_pengirim = $ft['nama_pengirim'];
                                                    $nominal = $ft['nominal'];
                                                    $keterangan = $ft['keterangan'];
                                                ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $kode_pemesanan; ?></td>
                                                        <td><?= $nama_pemesan; ?></td>
                                                        <td><?= $nama_kegiatan; ?></td>

                                                        <td><?= tanggal_indo($tanggal_pembayaran); ?></td>
                                                        <td><?= $bank_pengirim . ' (' . $rekening_pengirim . ')'; ?></td>
                                                        <td><?= $nama_pengirim; ?></td>
                                                        <td><?= rupiah($nominal); ?></td>
                                                        <td><?= $keterangan; ?></td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <!-- accepted payments column -->
                                    <div class="col-6">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <p class="lead float-right">Banjarmasin, <?= tanggal_indo(date('Y-m-d')); ?></p>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->

                                <!-- this row will not appear when printing -->
                                <div class="row no-print">
                                    <div class="col-12">
                                        <form id="formTambah" action="<?= base_url('laporan/cetakbuktipembayaran'); ?>" method="post" target="_blank">
                                            <input type="hidden" class="form-control" name="periode" id="reservation" value="<?= $periode; ?>">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-print"></i> Cetak Laporan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.invoice -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                <?php endif; ?>
            </section>
        </div>