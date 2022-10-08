<?php

class Buktipembayaran_model extends CI_Model
{

    public function getAllbuktipembayaran()
    {

        return $this->db->get('buktipembayaran')->result_array();
    }

    public function getbuktipembayaranById($id_buktipembayaran)
    {

        return $this->db->get_where('buktipembayaran', ['id_buktipembayaran' => $id_buktipembayaran])->row_array();
    }

    public function tambahDatabuktipembayaran($file_baru)
    {
        $tanggal = date('Y-m-d');
        $tanggal_pembayaran = date('Y-m-d', strtotime($this->input->post('tanggal_pembayaran')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "id_pembayaran" => $this->input->post('id_pembayaran', true),
            "tanggal" => $tanggal,
            "tanggal_pembayaran" => $tanggal_pembayaran,
            "bank_pengirim" => $this->input->post('bank_pengirim', true),
            "rekening_pengirim" => $this->input->post('rekening_pengirim', true),
            "nama_pengirim" => $this->input->post('nama_pengirim', true),
            "nominal" => $this->input->post('nominal', true),
            "bukti" => $file_baru,
            "keterangan" => $this->input->post('keterangan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('buktipembayaran', $data);
    }

    public function ubahDatabuktipembayaran()
    {

        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_konsumsi" => $this->input->post('id_konsumsi', true),
            "jumlah_orang" => $this->input->post('jumlah_orang', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_buktipembayaran', $this->input->post('id_buktipembayaran', true));
        $this->db->update('buktipembayaran', $data);
    }

    public function hapusDatabuktipembayaran($id_buktipembayaran)
    {

        //$this->db->where('id_buktipembayaran',$id_buktipembayaran);
        //$this->db->delete('buktipembayaran');
        $this->db->delete('buktipembayaran', ['id_buktipembayaran' => $id_buktipembayaran]);
    }
}
