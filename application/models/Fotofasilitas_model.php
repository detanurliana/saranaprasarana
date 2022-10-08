<?php

class Fotofasilitas_model extends CI_Model
{

    public function getAllfotofasilitas()
    {

        return $this->db->get('fotofasilitas')->result_array();
    }

    public function getfotofasilitasById($id_fotofasilitas)
    {

        return $this->db->get_where('fotofasilitas', ['id_fotofasilitas' => $id_fotofasilitas])->row_array();
    }
    public function getfotofasilitasByIdFasilitas($id_fasilitas)
    {

        return $this->db->get_where('fotofasilitas', ['id_fasilitas' => $id_fasilitas])->result_array();
    }

    public function tambahDatafotofasilitas($file_baru)
    {

        $data = [
            "id_fasilitas" => $this->input->post('id_fasilitas', true),
            "foto" => $file_baru,
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('fotofasilitas', $data);
    }

    public function hapusDatafotofasilitas($id_fotofasilitas)
    {
        $fotofasilitas = $this->db->get_where('fotofasilitas', ['id_fotofasilitas' => $id_fotofasilitas])->row_array();
        $foto = $fotofasilitas['foto'];

        //$this->db->where('id_fotofasilitas',$id_fotofasilitas);
        //$this->db->delete('fotofasilitas');
        $this->db->delete('fotofasilitas', ['id_fotofasilitas' => $id_fotofasilitas]);
        unlink(FCPATH . './assets/dist/img/' . $foto);
    }
}
