<?php

class Rusak_model extends CI_Model
{

    public function getAllRusak()
    {

        return $this->db->get('rusak')->result_array();
    }

    public function getRusakById($id_rusak)
    {

        return $this->db->get_where('rusak', ['id_rusak' => $id_rusak])->row_array();
    }

    public function tambahDataRusak()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "tanggal" => $tanggal,
            "kode_rusak" => $this->input->post('kode_rusak', true),
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "id_barang" => $this->input->post('id_barang', true),
            "jumlah" => $this->input->post('jumlah', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('rusak', $data);
    }

    public function ubahDataRusak()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "id_rusak" => $this->input->post('id_rusak', true),
            "tanggal" => $tanggal,
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "id_barang" => $this->input->post('id_barang', true),
            "jumlah" => $this->input->post('jumlah', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_rusak', $this->input->post('id_rusak', true));
        $this->db->update('rusak', $data);
    }

    public function hapusDataRusak($id_rusak)
    {

        //$this->db->where('id_rusak',$id_rusak);
        //$this->db->delete('rusak');
        $this->db->delete('rusak', ['id_rusak' => $id_rusak]);
    }
}
