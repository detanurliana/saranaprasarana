        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <h2 class="text-center display-4"><?= $judul; ?></h2>
                    <form id="formTambah" action="" method="post">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Filter Jabatan :</label>
                                            <select class="form-control select2 select2-hidden-accessible" name="id_jabatan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option selected value="Semua">Semua</option>
                                                <?php foreach ($masterjabatan as $jb) :; ?>
                                                    <option value="<?= $jb['id_jabatan']; ?>"><?= $jb['nama_jabatan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Urutkan :</label>
                                            <select class="form-control select2 select2-hidden-accessible" name="urutan" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                <option selected value="ASC">Tertinggi</option>
                                                <option value="DESC">Terendah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
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
                <?php if (($this->session->flashdata()) and (isset($input_jabatan))) : ?>
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
                                    <div class="col-12" align="center">
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
                                                    <th>NIP</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Jabatan</th>
                                                    <th>Pangkat Golongan</th>
                                                    <th>Tempat Lahir</th>
                                                    <th>Tanggal Lahir</th>
                                                    <th>Alamat</th>
                                                    <th>No HP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($filter as $pgw) : ?>
                                                    <?php
                                                    $id_jabatan = $pgw['id_jabatan'];
                                                    $jabatan = $this->db->get_where('jabatan', ['id_jabatan' => $id_jabatan])->row_array();
                                                    $id_golpangkat = $pgw['id_golpangkat'];
                                                    $golpangkat = $this->db->get_where('golpangkat', ['id_golpangkat' => $id_golpangkat])->row_array();
                                                    $nama_jeniskelamin = check_jeniskelamin($pgw['id_jeniskelamin']);
                                                    ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $pgw['nip']; ?></td>
                                                        <td><?= $pgw['nama_pegawai']; ?></td>
                                                        <td><?= $nama_jeniskelamin; ?></td>
                                                        <td><?= $jabatan['nama_jabatan']; ?></td>
                                                        <td><?= $golpangkat['nama_pangkat'] . ' / ' . $golpangkat['nama_gol']; ?></td>
                                                        <td><?= $pgw['tempat_lahir']; ?></td>
                                                        <td><?= tanggal_indo($pgw['tanggal_lahir']); ?></td>
                                                        <td><?= $pgw['alamat']; ?></td>
                                                        <td><?= $pgw['nohp']; ?></td>
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
                                        <form id="formTambah" action="<?= base_url('laporan/cetakpegawai'); ?>" method="post" target="_blank">
                                            <input type="hidden" name="id_jabatan" value=<?= $input_jabatan; ?>>
                                            <input type="hidden" name="urutan" value=<?= $input_urutan; ?>>
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