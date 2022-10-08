<?php

class Submenu_model extends CI_Model
{

    public function getAllSubmenu()
    {

        return $this->db->get('submenu')->result_array();
    }

    public function getSubmenuById($id_submenu)
    {

        return $this->db->get_where('submenu', ['id_submenu' => $id_submenu])->row_array();
    }

    public function tambahDataSubmenu()
    {

        $data = [
            "id_menu" => $this->input->post('id_menu', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_submenu" => $this->input->post('nama_submenu', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('submenu', $data);
    }

    public function ubahDataSubmenu()
    {

        $data = [
            "id_submenu" => $this->input->post('id_submenu', true),
            "id_menu" => $this->input->post('id_menu', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_submenu" => $this->input->post('nama_submenu', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_submenu', $this->input->post('id_submenu', true));
        $this->db->update('submenu', $data);
    }

    public function hapusDataSubmenu($id_submenu)
    {

        //$this->db->where('id_submenu',$id_submenu);
        //$this->db->delete('submenu');
        $this->db->delete('submenu', ['id_submenu' => $id_submenu]);
    }
}
