<?php

class Jadwalpetugas_model extends CI_Model
{

    public function getAlljadwalpetugas()
    {

        return $this->db->get('jadwalpetugas')->result_array();
    }

    public function getjadwalpetugasById($id_jadwalpetugas)
    {

        return $this->db->get_where('jadwalpetugas', ['id_jadwalpetugas' => $id_jadwalpetugas])->row_array();
    }

    public function tambahDatajadwalpetugas()
    {
        $tanggal = date('Y-m-d');
        $tanggal_jadwal = date('Y-m-d', strtotime($this->input->post('tanggal_jadwal')));
        $data = [
            "id_pemesanan" => $this->input->post('id_pemesanan', true),
            "tanggal" => $tanggal,
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_pegawai" => $this->input->post('id_pegawai', true),
            "tanggal_jadwal" => $tanggal_jadwal,
            "dari_jam" => $this->input->post('dari_jam', true),
            "sampai_jam" => $this->input->post('sampai_jam', true),
            "user_input" => check_username(),
            "tgl_input" => date('Y-m-d h:m:i')
        ];
        $this->db->insert('jadwalpetugas', $data);
    }

    public function ubahDatajadwalpetugas()
    {
        $tanggal_jadwal = date('Y-m-d', strtotime($this->input->post('tanggal_jadwal')));
        $data = [
            "id_kegiatan" => $this->input->post('id_kegiatan', true),
            "id_pegawai" => $this->input->post('id_pegawai', true),
            "tanggal_jadwal" => $tanggal_jadwal,
            "dari_jam" => $this->input->post('dari_jam', true),
            "sampai_jam" => $this->input->post('sampai_jam', true),
            "user_ubah" => check_username(),
            "tgl_ubah" => date('Y-m-d h:m:i')
        ];
        $this->db->where('id_jadwalpetugas', $this->input->post('id_jadwalpetugas', true));
        $this->db->update('jadwalpetugas', $data);
    }

    public function hapusDatajadwalpetugas($id_jadwalpetugas)
    {

        //$this->db->where('id_jadwalpetugas',$id_jadwalpetugas);
        //$this->db->delete('jadwalpetugas');
        $this->db->delete('jadwalpetugas', ['id_jadwalpetugas' => $id_jadwalpetugas]);
    }
}
