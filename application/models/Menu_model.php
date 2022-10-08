<?php

class Menu_model extends CI_Model
{

    public function getAllMenu()
    {

        return $this->db->get('menu')->result_array();
    }

    public function getMenuById($id_menu)
    {

        return $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();
    }

    public function tambahDataMenu()
    {

        $data = [
            "urutan" => $this->input->post('urutan', true),
            "nama_menu" => $this->input->post('nama_menu', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "keterangan" => $this->input->post('icon', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('menu', $data);
    }

    public function ubahDataMenu()
    {

        $data = [
            "id_menu" => $this->input->post('id_menu', true),
            "urutan" => $this->input->post('urutan', true),
            "nama_menu" => $this->input->post('nama_menu', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_menu', $this->input->post('id_menu', true));
        $this->db->update('menu', $data);
    }

    public function hapusDataMenu($id_menu)
    {

        //$this->db->where('id_menu',$id_menu);
        //$this->db->delete('menu');
        $this->db->delete('menu', ['id_menu' => $id_menu]);
    }
}
