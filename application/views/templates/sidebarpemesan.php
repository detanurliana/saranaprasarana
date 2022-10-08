  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url('assets/'); ?>index3.html" class="brand-link">
          <img src="<?= base_url('assets/'); ?>dist/img/logo.gif" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light"><?= $level['nama_level']; ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= base_url('assets/'); ?>dist/img/<?= $pemesan['foto']; ?>" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"><?= $pemesan['nama_pemesan']; ?></a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <?php
                    $id_level = $this->session->userdata('id_level');
                    $queryMenu = "SELECT menu.id_menu,menu.nama_menu,menu.url,menu.icon
                                  FROM menu
                                  JOIN aksesmenu ON menu.id_menu = aksesmenu.id_menu
                                  WHERE aksesmenu.id_level = $id_level
                                  ORDER BY menu.urutan ASC";
                    $menu = $this->db->query($queryMenu)->result_array();
                    ?>
                  <?php foreach ($menu as $mn) :; ?>
                      <?php
                        $id_menu = $mn['id_menu'];
                        $querySubMenu = "SELECT * FROM submenu WHERE id_menu=$id_menu and aktif='1' ORDER BY urutan ASC";
                        $submenu = $this->db->query($querySubMenu);
                        if ($submenu->num_rows() > 0) {
                            $adasubmenu = '<i class="right fas fa-angle-left"></i>';
                        } else {
                            $adasubmenu = '';
                        }
                        if ($judul == $mn['nama_menu']) {
                            $aktif = 'active';
                        } else {
                            $aktif = '';
                        }
                        ?>
                      <li class="nav-item">
                          <a href="<?= base_url($mn['url']); ?>" class="nav-link <?= $aktif; ?>">
                              <i class="<?= $mn['icon']; ?>"></i>
                              <p>
                                  <?= $mn['nama_menu']; ?>
                                  <?= $adasubmenu; ?>
                              </p>
                          </a>
                          <?php if ($submenu->num_rows() > 0) { ?>
                              <?php foreach ($submenu->result_array() as $submn) :; ?>
                                  <?php

                                    if ($judul == $submn['nama_submenu']) {
                                        $aktif = 'active';
                                    } else {
                                        $aktif = '';
                                    }
                                    ?>
                                  <ul class="nav nav-treeview">
                                      <li class="nav-item">
                                          <a href="<?= base_url($submn['url']); ?>" class="nav-link <?= $aktif; ?>">
                                              <i class="<?= $submn['icon']; ?>"></i>
                                              <p><?= $submn['nama_submenu']; ?></p>
                                          </a>
                                      </li>
                                  </ul>
                              <?php endforeach; ?>
                          <?php } ?>
                      </li>
                  <?php endforeach; ?>
                  <li class="nav-item">
                      <a href="<?= base_url('auth/logout'); ?>" class="nav-link">
                          <i class="nav-icon fas fa-sign-out-alt"></i>
                          <p>
                              Logout
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>