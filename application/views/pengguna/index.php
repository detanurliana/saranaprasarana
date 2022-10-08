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
                  <h3 class="card-title"><?= $judul; ?></h3>
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-lg-6">
                          <div class="card card-primary card-outline">
                              <div class="card-header">
                                  <h5 class="m-0">Perbaharui Profil</h5>
                              </div>
                              <div class="card-body">
                                  <h6 class="card-title">Menu Profil</h6>

                                  <p class="card-text">Perbaharui data profil password login pada menu ini.</p>
                                  <a href="<?= base_url('profil'); ?>" class="btn btn-primary"><i class="nav-icon fas fa fa-user"></i> Menu Profil</a>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-12">
                          <div class="card card-default card-outline">
                              <div class="card-header">
                                  <h5 class="m-0">Alamat <?= $profil['nama_profil']; ?></h5>
                              </div>
                              <div class="card-body">
                                  <p class="card-text">Alamat : <?= $profil['alamat']; ?>. Telp :<?= $profil['telepon']; ?>. Kodepos : <?= $profil['kodepos']; ?> <br />
                                      Email : <?= $profil['email']; ?>. Website : <a href="http://<?= $profil['website']; ?>" target="_blank"><?= $profil['website']; ?></a></p>
                              </div>
                          </div>
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