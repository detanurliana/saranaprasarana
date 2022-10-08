<?php

class Kegiatan_model extends CI_Model
{

    public function getAllKegiatan()
    {

        return $this->db->get('kegiatan')->result_array();
    }

    public function getKegiatanById($id_kegiatan)
    {

        return $this->db->get_where('kegiatan', ['id_kegiatan' => $id_kegiatan])->row_array();
    }

    public function tambahDataKegiatan()
    {
        $tanggal = date('Y-m-d');
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "kode_kegiatan" => $this->input->post('kode_kegiatan', true),
            "tanggal" => $tanggal,
            "nama_kegiatan" => $this->input->post('nama_kegiatan', true),
            "dari_tanggal" => $dari_tanggal,
            "sampai_tanggal" => $sampai_tanggal,
            "dari_jam" => $this->input->post('dari_jam', true),
            "sampai_jam" => $this->input->post('sampai_jam', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('kegiatan', $data);
    }

    public function ubahDataKegiatan()
    {
        $dari_tanggal = date('Y-m-d', strtotime($this->input->post('dari_tanggal')));
        $sampai_tanggal = date('Y-m-d', strtotime($this->input->post('sampai_tanggal')));
        $data = [
            "nama_kegiatan" => $this->input->post('nama_kegiatan', true),
            "dari_tanggal" => $dari_tanggal,
            "sampai_tanggal" => $sampai_tanggal,
            "dari_jam" => $this->input->post('dari_jam', true),
            "sampai_jam" => $this->input->post('sampai_jam', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_kegiatan', $this->input->post('id_kegiatan', true));
        $this->db->update('kegiatan', $data);
    }

    public function hapusDataKegiatan($id_kegiatan)
    {

        //$this->db->where('id_kegiatan',$id_kegiatan);
        //$this->db->delete('kegiatan');
        $this->db->delete('kegiatan', ['id_kegiatan' => $id_kegiatan]);
    }
}
