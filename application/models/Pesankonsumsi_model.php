<?php

class Pesankonsumsi_model extends CI_Model
{

    public function getAllpesankonsumsi()
    {

        return $this->db->get('pesankonsumsi')->result_array();
    }

    public function getpesankonsumsiById($id_pesankonsumsi)
    {

        return $this->db->get_where('pesankonsumsi', ['id_pesankonsumsi' => $id_pesankonsumsi])->row_array();
    }

    public function tambahDatapesankonsumsi()
    {
        $tanggal = date('Y-m-d');
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "kode_pesankonsumsi" => $this->input->post('kode_pesankonsumsi', true),
            "tanggal" => $tanggal,
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_konsumsi" => $this->input->post('id_konsumsi', true),
            "jumlah_orang" => $this->input->post('jumlah_orang', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pesankonsumsi', $data);
    }

    public function ubahDatapesankonsumsi()
    {
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_konsumsi" => $this->input->post('id_konsumsi', true),
            "jumlah_orang" => $this->input->post('jumlah_orang', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_pesankonsumsi', $this->input->post('id_pesankonsumsi', true));
        $this->db->update('pesankonsumsi', $data);
    }

    public function hapusDatapesankonsumsi($id_pesankonsumsi)
    {

        //$this->db->where('id_pesankonsumsi',$id_pesankonsumsi);
        //$this->db->delete('pesankonsumsi');
        $this->db->delete('pesankonsumsi', ['id_pesankonsumsi' => $id_pesankonsumsi]);
    }
}
