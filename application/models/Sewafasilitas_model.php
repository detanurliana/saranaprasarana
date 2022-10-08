<?php

class Sewafasilitas_model extends CI_Model
{

    public function getAllsewafasilitas()
    {

        return $this->db->get('sewafasilitas')->result_array();
    }

    public function getsewafasilitasById($id_sewafasilitas)
    {

        return $this->db->get_where('sewafasilitas', ['id_sewafasilitas' => $id_sewafasilitas])->row_array();
    }

    public function tambahDatasewafasilitas()
    {
        $tanggal = date('Y-m-d');
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "kode_sewafasilitas" => $this->input->post('kode_sewafasilitas', true),
            "tanggal" => $tanggal,
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_hargafasilitas" => $this->input->post('id_hargafasilitas', true),
            "jumlah_orang" => $this->input->post('jumlah_orang', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('sewafasilitas', $data);
    }

    public function ubahDatasewafasilitas()
    {
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_hargafasilitas" => $this->input->post('id_hargafasilitas', true),
            "jumlah_orang" => $this->input->post('jumlah_orang', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_sewafasilitas', $this->input->post('id_sewafasilitas', true));
        $this->db->update('sewafasilitas', $data);
    }

    public function hapusDatasewafasilitas($id_sewafasilitas)
    {

        //$this->db->where('id_sewafasilitas',$id_sewafasilitas);
        //$this->db->delete('sewafasilitas');
        $this->db->delete('sewafasilitas', ['id_sewafasilitas' => $id_sewafasilitas]);
    }
}
