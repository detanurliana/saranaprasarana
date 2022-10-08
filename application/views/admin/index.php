  <!-- Content Wrapper. Contains page content --><style>
    .carousel-inner>.item>img,
    .carousel-inner>.item>a>img {
        display: block;
        height: auto;
        max-width: 100%;
        line-height: 1;
        width: 100%;
    }
</style>

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
                  <h3 class="card-title"><?= $judul; ?></h3>
              </div>
              <div class="card-body">
                  <div class="alert alert-info alert-dismissible">
                      <h4 align="center"><?= strtoupper($profil['nama_profil']); ?><br /><?= $profil['nama_aplikasi']; ?></h4>
                  </div>
                  <div class="row">
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fas fa fa-user"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/pegawai'); ?>"><span class="info-box-text">Pegawai</span>
                                      <span class="info-box-number"><?= $masterpegawai->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-success"><i class="fa fa-shopping-bag"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/fasilitas'); ?>"><span class="info-box-text">Fasilitas</span>
                                      <span class="info-box-number"><?= $masterfasilitas->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-warning"><i class="fa fa-location-arrow"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/hargafasilitas'); ?>"><span class="info-box-text">Harga Fasilitas</span>
                                      <span class="info-box-number"><?= $masterhargafasilitas->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-danger"><i class="fa fa-signal"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/pengguna'); ?>"><span class="info-box-text">Pemesan Fasilitas</span>
                                      <span class="info-box-number"><?= $masterpemesan->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                  </div>
                  <div class="row">
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-info"><i class="fa fa-file"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('register/pemesanan'); ?>"><span class="info-box-text">Pemesanan</span>
                                      <span class="info-box-number"><?= $pemesanan->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>

                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-success"><i class="fa fa-folder"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/konsumsi'); ?>"><span class="info-box-text">Konsumsi</span>
                                      <span class="info-box-number"><?= $konsumsi->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-warning"><i class="fa fa-times"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/jenisfasilitas'); ?>"><span class="info-box-text">Jenis Fasilitas</span>
                                      <span class="info-box-number"><?= $jenisfasilitas->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-sm-6 col-12">
                          <div class="info-box">
                              <span class="info-box-icon bg-danger"><i class="fa fa-info"></i></span>

                              <div class="info-box-content">
                                  <a href="<?= base_url('master/kategorifasilitas'); ?>"><span class="info-box-text">Kategori Fasilitas</span>
                                      <span class="info-box-number"><?= $kategorifasilitas->num_rows(); ?></span></a>
                              </div>
                              <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                      </div>
                      <?php
                      $cekfotofasilitas = $this->db->get('fotofasilitas');
                      if ($cekfotofasilitas->num_rows()>0) {
                      ?>
                      <div class="col-12">
                      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2000">
                      <div class="carousel-inner">
                          <?php
                            $no = 1;
                            $fotofasilitas = $this->db->get('fotofasilitas')->result_array();
                            foreach ($fotofasilitas as $fotofas) :
                                if ($no == 1) {
                                    $ak = 'active';;
                                } else {
                                    $ak = '';;
                                }

                            ?>
                              <div class="carousel-item <?= $ak; ?>">
                                  <img class="d-block w-100" src="<?= base_url('assets/dist/img/') . $fotofas['foto']; ?>">
                              </div>
                          <?php $no++;
                            endforeach; ?>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
                  </div>
                  </div>
                  <?php } ?>
                      <!-- /.col -->
                  </div>

              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieData = donutData;
      var pieOptions = {
          maintainAspectRatio: false,
          responsive: true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(pieChartCanvas, {
          type: 'pie',
          data: pieData,
          options: pieOptions
      })
  </script>