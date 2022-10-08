<?php

class Pembayaran_model extends CI_Model
{

    public function getAllpembayaran()
    {

        return $this->db->get('pembayaran')->result_array();
    }

    public function getpembayaranById($id_pembayaran)
    {

        return $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row_array();
    }

    public function tambahDatapembayaran()
    {
        $tanggal = date('Y-m-d');
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "kode_pembayaran" => $this->input->post('kode_pembayaran', true),
            "tanggal" => $tanggal,
            "id_bank" => $this->input->post('id_bank', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pembayaran', $data);
    }

    public function ubahDatapembayaran()
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
        $this->db->where('id_pembayaran', $this->input->post('id_pembayaran', true));
        $this->db->update('pembayaran', $data);
    }

    public function hapusDatapembayaran($id_pembayaran)
    {

        //$this->db->where('id_pembayaran',$id_pembayaran);
        //$this->db->delete('pembayaran');
        $this->db->delete('pembayaran', ['id_pembayaran' => $id_pembayaran]);
    }
}
