<?php

class Pemesanan_model extends CI_Model
{

    public function getAllpemesanan()
    {

        return $this->db->order_by('tanggal', 'desc')->get('pemesanan')->result_array();
    }

    public function getpemesananById($id_pemesanan)
    {

        return $this->db->get_where('pemesanan', ['id_pemesanan' => $id_pemesanan])->row_array();
    }
    public function getpemesananByIdPemesan($id_pemesan)
    {

        return $this->db->order_by('tanggal', 'desc')->get_where('pemesanan', ['id_pemesan' => $id_pemesan])->result_array();
    }

    public function tambahDatapemesanan()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "tanggal" => $tanggal,
            "kode_pemesanan" => $this->input->post('kode_pemesanan', true),
            "id_pemesan" => $this->input->post('id_pemesan', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('pemesanan', $data);
    }

    public function ubahDatapemesanan()
    {
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $data = [
            "tanggal" => $tanggal,
            "id_pemesan" => $this->input->post('id_pemesan', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_pemesanan', $this->input->post('id_pemesanan', true));
        $this->db->update('pemesanan', $data);
    }

    public function hapusDatapemesanan($id_pemesanan)
    {

        //$this->db->where('id_pemesanan',$id_pemesanan);
        //$this->db->delete('pemesanan');
        $this->db->delete('pemesanan', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('kegiatan', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('sewafasilitas', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('pesankonsumsi', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('petugaskegiatan', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('jadwalpetugas', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('pembayaran', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('buktipembayaran', ['id_pemesanan' => $id_pemesanan]);
    }
}
