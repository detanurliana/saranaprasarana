   <!-- banner -->
   <section class="banner_main">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#banner1" data-slide-to="0" class="active"></li>
            <li data-target="#banner1" data-slide-to="1"></li>
            <li data-target="#banner1" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="text-bg">
                        <h1> <span class="blu">LPMP <br></span>Mendapat ESQ</h1>
                        <figure><img src="<?= base_url('assets/home/'); ?>images/slide1.jpg" alt="#" /></figure>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="text-bg">
                        <h1> <span class="blu">QAC <br></span>Quality Assurance Class</h1>
                        <figure><img src="<?= base_url('assets/home/'); ?>images/slide2.jpg" alt="#" /></figure>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="text-bg">
                        <h1> <span class="blu">LPMP <br></span>Mengadakan Pelatihan</h1>
                        <figure><img src="<?= base_url('assets/home/'); ?>images/slide3.jpg" alt="#" /></figure>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
         </a>
         <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
         </a>
      </div>
   </section>
   <!-- end banner -->
   <!-- about section -->
   <div class="about">
      <div class="container">
         <div class="row d_flex">
            <div class="col-md-5">
               <div class="about_img">
                  <figure><img src="<?= base_url('assets/dist/img/login.jpg'); ?>" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-7">
               <div class="titlepage">
                  <h2>LPMP Kalsel</h2>
                  <p>Lembaga Penjaminan Mutu Pendidikan Kalimantan Selatan adalah Unit Pelaksana Teknis Kemendikbud yang pembentukannya berdasarkan Permendikbud nomer 37 tahun 2012, semula bernama Balai Penataran Guru (BPG) Banjarmasin berdasarkan Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia 024a/O/1979 tanggal 2 Mei 1991.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- about section -->
   <!-- Our  Glasses section -->
   <div class="glasses">
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <div class="titlepage">
                  <h2>Our Glasses</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor
                     e et dolore magna aliqua. Ut enim ad minim veniam, qui
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="row">
            <?php
            $hargafasilitas = $this->db->limit('8')->get('hargafasilitas')->result_array();
            foreach ($hargafasilitas as $hrgfasilitas) :
               $harga = $hrgfasilitas['harga'];
               $id_fasilitas = $hrgfasilitas['id_fasilitas'];
               $fasilitas = $this->db->get_where('fasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();
               $nama_fasilitas = $fasilitas['nama_fasilitas'];
               $kapasitas = $fasilitas['kapasitas'];
               $fotofasilitas = $this->db->get_where('fotofasilitas', ['id_fasilitas' => $id_fasilitas])->row_array();

               $id_kategorifasilitas = $hrgfasilitas['id_kategorifasilitas'];
               $kategorifasilitas = $this->db->get_where('kategorifasilitas', ['id_kategorifasilitas' => $id_kategorifasilitas])->row_array();
               $nama_kategorifasilitas = $kategorifasilitas['nama_kategorifasilitas'];

               $id_status = $fasilitas['id_status'];
               if ($id_status == '1') {
                  $nama_status = 'Tersedia';
               } else {
                  $nama_status = 'Belum Tersedia';
               }
            ?>
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                  <div class="glasses_box">
                     <figure><img src="<?= base_url('assets/dist/img/') . $fotofasilitas['foto']; ?>" alt="#" /></figure>
                     <h3><span class="blu"><?= rupiah($hrgfasilitas['harga']); ?></span></h3>
                     <p><?= $fasilitas['nama_fasilitas'] . '(' . $nama_kategorifasilitas . ')' . ' ' . $nama_status; ?></p>
                  </div>
               </div>
            <?php endforeach; ?>
            <div class="col-md-12">
               <a class="read_more" href="<?= base_url('home/fasilitas'); ?>">Pemesanan</a>
            </div>
         </div>
      </div>
   </div>
   <!-- end Our  Glasses section -->
   <!-- clients section -->
   <div class="clients">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Komentar LPMP Kalsel</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div id="myCarousel" class="carousel slide clients_Carousel " data-ride="carousel">
                  <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="container">
                           <div class="carousel-caption ">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="clients_box">
                                       <figure><img src="<?= base_url('assets/dist/'); ?>img/ibnusina.jpg" alt="#" /></figure>
                                       <h3>Walikota Banjarmasin - Ibnu Sina</h3>
                                       <p>Terima kasih kepada Lembaga Penjaminan Mutu Pendidikan yang sudah membuat kegiatan yang sangat bermanfaat yaitu Forum Pemangku Kepentingan untuk meningkatkan mutu pendidikan kita di Kota Banjarmasin, dan ulun kira ini upaya kita untuk mendidik guru-guru kita agar mereka punya kemampuan di era digital.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="clients_box">
                                       <figure><img src="<?= base_url('assets/dist/'); ?>img/ketuadprdbjb.jpg" alt="#" /></figure>
                                       <h3>Ketua DPRD - Fadliansyah </h3>
                                       <p>Kami akan mengupayakan agar LPM bisa bergerak menjalankan program kerjanya dan kalangan dewan sebagai mitra siap membantu mewujudkan apa yang diharapkan pengurus LPMP.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="clients_box">
                                       <figure><img src="<?= base_url('assets/dist/'); ?>img/roy.jpg" alt="#" /></figure>
                                       <h3>Sekretaris Daerah Kalsel - Roy Rizali Anwar</h3>
                                       <p>Saya berterima kasih dengan LPMP Kalsel yang berupaya meningkatkan mutu pendidikan di Banua ini.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                     <i class='fa fa-angle-left'></i>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                     <i class='fa fa-angle-right'></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <hr />
   <!-- end clients section -->