   <!-- loader  -->
   <div class="loader_bg">
       <div class="loader"><img src="<?= base_url('assets/dist/img/logo.gif'); ?>" alt="#" /></div>
   </div>
   <!-- end loader -->
   <!-- header -->
   <header>
       <!-- header inner -->
       <div class="header">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                       <div class="full">
                           <div class="center-desk">
                               <div class="logo">

                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                       <nav class="navigation navbar navbar-expand-md navbar-dark ">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                               <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarsExample04">
                               <ul class="navbar-nav mr-auto">
                                   <li class="nav-item ">
                                       <a class="nav-link <?php if ($aktif == '1') {
                                                                echo 'active';
                                                            } ?>" href="<?= base_url(); ?>">Beranda</a>
                                   </li>
                                   <li class="nav-item ">
                                       <a class="nav-link <?php if ($aktif == '2') {
                                                                echo 'active';
                                                            } ?>" href="<?= base_url('home/fasilitas'); ?>">Fasilitas dan Sarana</a>
                                   </li>
                                   <li class="nav-item">
                                       <a class="nav-link" href="https://web.whatsapp.com/send?phone=+6287730298057&text=Permisi">Hubungi Kami</a>
                                   </li>
                                   <li class="nav-item ">
                                       <a class="nav-link <?php if ($aktif == '3') {
                                                                echo 'active';
                                                            } ?>" href="<?= base_url('home/daftar'); ?>">Pendaftaran</a>
                                   </li>
                                   <li class="nav-item ">
                                       <a class="nav-link <?php if ($aktif == '4') {
                                                                echo 'active';
                                                            } ?>" href="<?= base_url('home/login'); ?>">Login</a>
                                   </li>
                               </ul>
                           </div>
                       </nav>
                   </div>
               </div>
           </div>
       </div>
   </header>
   <!-- end header inner -->
   <!-- end header -->