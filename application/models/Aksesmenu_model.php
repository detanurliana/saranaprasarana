<?php

class Aksesmenu_model extends CI_Model
{

    public function getAllAksesmenu()
    {

        return $this->db->get('aksesmenu')->result_array();
    }

    public function getAksesmenuById($id_level)
    {

        return $this->db->get_where('aksesmenu', ['id_level' => $id_level])->row_array();
    }

    public function SimpanAksesMenu()
    {
        $id_level = $this->input->post('id_level');
        $this->db->delete('aksesmenu', ['id_level' => $id_level]);

        $queryMenu = $this->db->get_where('menu');
        $jumlah = $queryMenu->num_rows();

        for ($i = 1; $i <= $jumlah; $i++) {
            $check = $this->input->post('check' . $i, true);
            if (isset($check)) {
                $data = [
                    "id_menu" => $this->input->post('id_menu' . $i, true),
                    "id_level" => $this->input->post('id_level', true)
                ];
                $this->db->insert('aksesmenu', $data);
            }
        }
    }
}
