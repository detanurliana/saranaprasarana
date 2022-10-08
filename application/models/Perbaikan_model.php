<?php

class Perbaikan_model extends CI_Model
{

    public function getAllPerbaikan()
    {

        return $this->db->get('perbaikan')->result_array();
    }

    public function getPerbaikanById($id_perbaikan)
    {

        return $this->db->get_where('perbaikan', ['id_perbaikan' => $id_perbaikan])->row_array();
    }

    public function tambahDataPerbaikan()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "tanggal" => $tanggal,
            "kode_perbaikan" => $this->input->post('kode_perbaikan', true),
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "id_barang" => $this->input->post('id_barang', true),
            "jumlah" => $this->input->post('jumlah', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('perbaikan', $data);
    }

    public function ubahDataPerbaikan()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "id_perbaikan" => $this->input->post('id_perbaikan', true),
            "tanggal" => $tanggal,
            "id_lokasi" => $this->input->post('id_lokasi', true),
            "id_barang" => $this->input->post('id_barang', true),
            "jumlah" => $this->input->post('jumlah', true),
            "keterangan" => $this->input->post('keterangan', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_perbaikan', $this->input->post('id_perbaikan', true));
        $this->db->update('perbaikan', $data);
    }

    public function hapusDataPerbaikan($id_perbaikan)
    {

        //$this->db->where('id_perbaikan',$id_perbaikan);
        //$this->db->delete('perbaikan');
        $this->db->delete('perbaikan', ['id_perbaikan' => $id_perbaikan]);
    }
}
