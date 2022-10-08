<?php

class Petugaskegiatan_model extends CI_Model
{

    public function getAllpetugaskegiatan()
    {

        return $this->db->get('petugaskegiatan')->result_array();
    }

    public function getpetugaskegiatanById($id_petugaskegiatan)
    {

        return $this->db->get_where('petugaskegiatan', ['id_petugaskegiatan' => $id_petugaskegiatan])->row_array();
    }

    public function tambahDatapetugaskegiatan()
    {
        $tanggal = date('Y-m-d');
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "kode_petugaskegiatan" => $this->input->post('kode_petugaskegiatan', true),
            "tanggal" => $tanggal,
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_pegawai" => $this->input->post('id_pegawai', true),
            "tupoksi" => $this->input->post('tupoksi', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('petugaskegiatan', $data);
    }

    public function ubahDatapetugaskegiatan()
    {
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_pegawai" => $this->input->post('id_pegawai', true),
            "tupoksi" => $this->input->post('tupoksi', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_petugaskegiatan', $this->input->post('id_petugaskegiatan', true));
        $this->db->update('petugaskegiatan', $data);
    }

    public function hapusDatapetugaskegiatan($id_petugaskegiatan)
    {

        //$this->db->where('id_petugaskegiatan',$id_petugaskegiatan);
        //$this->db->delete('petugaskegiatan');
        $this->db->delete('petugaskegiatan', ['id_petugaskegiatan' => $id_petugaskegiatan]);
    }
}
