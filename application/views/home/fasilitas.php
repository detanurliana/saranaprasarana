   <!-- Our  Glasses section -->
   <div class="glasses">
       <div class="container-fluid">
           <div class="row">
               <?php
                $hargafasilitas = $this->db->get('hargafasilitas')->result_array();
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
                           <a href="https://web.whatsapp.com/send?phone=+6287730298057&text=Permisi%20bertanya%20fasilitas%20<?= $nama_fasilitas; ?>%20untuk%20<?= $nama_kategorifasilitas; ?>" target="_blank"><button class="send_btn">Pesan Via Whatsapp</button></a>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       </div>
   </div>
   <!-- end Our  Glasses section -->