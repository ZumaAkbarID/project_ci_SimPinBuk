<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RiwayatModel extends CI_Model
{

    protected $_tb = 'riwayat';
    protected $_tb_anggota = 'anggota';
    protected $_tb_pinjam = 'pinjam';
    protected $_tb_buku = 'buku';

    public function getRiwayat($uid)
    {
        // $this->db->select('nama, buku.id_buku, judul, id_pinjam, tgl_pinjam, tgl_kembali, id_riwayat, riwayat.deskripsi as deskripsi, tipe, waktu');
        // $this->db->from($this->_tb);
        // $this->db->join("{$this->_tb_anggota}", "{$this->_tb_anggota}.id = {$this->_tb}.id_anggota");
        // $this->db->join("{$this->_tb_pinjam}", "{$this->_tb_pinjam}.id_anggota = {$this->_tb}.id_anggota");
        // $this->db->join("{$this->_tb_buku}", "{$this->_tb_buku}.pemilik = {$this->_tb}.id_anggota");
        // return $this->db->where('riwayat.id_anggota', $uid)->get()->result();
        // return $this->db->where('id_anggota', $uid)->get($this->_tb)->result();
        // $this->db->select("$this->_tb_buku.id_buku as id_buku, $this->_tb_buku.judul as judul, $this->_tb.id_pinjam as id_pinjam, $this->_tb.id_riwayat as id_riwayat, $this->_tb.deskripsi as deskripsi, tipe, waktu, deleted");
        // // $this->db->select("*");
        // $this->db->from($this->_tb);
        // $this->db->join("$this->_tb_buku", "$this->_tb_buku.id_buku = $this->_tb.id_buku");
        // return $this->db->where(['id_anggota', $uid])->get()->result();
        return $this->db->where('id_anggota', $uid)->get($this->_tb)->result();
    }

    public function getRiwayatById($idRiwayat)
    {
        return $this->db->where(['id_riwayat' => $idRiwayat])->get($this->_tb)->row();
    }

    public function updateIdBukuRiwayat($idBuku, $idPinjam, $data)
    {
        return $this->db->where('id_buku', $idBuku)->or_where('id_pinjam', $idPinjam)->update($this->_tb, $data);
    }

    public function insertRiwayat($data)
    {
        return $this->db->insert($this->_tb, $data);
    }

    public function countAllBuku()
    {
        return $this->db->count_all($this->_tb);
    }

    public function updateRiwayat($idRiwayat, $data)
    {
        return $this->db->update($this->_tb, $data, ['id_riwayat' => $idRiwayat]);
    }

    public function deleteRiwayat($idRiwayat)
    {
        return $this->db->where(['id_riwayat' => $idRiwayat])->delete($this->_tb);
    }
}

/* End of file RiwayatModel.php */