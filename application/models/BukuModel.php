<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BukuModel extends CI_Model
{
    protected $_tb = 'buku';
    protected $_tb_anggota = 'anggota';

    public function rules()
    {
        return [
            [
                'field' => 'judul',
                'label' => 'Judul',
                'rules' => 'required',
                'error' => [
                    'required' => '%s tidak boleh kosong'
                ]
            ],
            [
                'field' => 'deskripsi',
                'label' => 'Deskripsi',
                'rules' => 'required|max_length[100]',
                'error' => [
                    'required' => '%s tidak boleh kosong',
                    'max_length' => '%s tidak boleh melebihi dari 30 Karakter'
                ]
            ],
            [
                'field' => 'pengarang',
                'label' => 'Pengarang',
                'rules' => 'required',
                'error' => [
                    'required' => '%s tidak boleh kosong'
                ]
            ],
            [
                'field' => 'tahun_terbit',
                'label' => 'Tahun Terbit',
                'rules' => 'required',
                'error' => [
                    'required' => '%s tidak boleh kosong'
                ]
            ],
        ];
    }

    public function getAllBuku()
    {
        $this->db->select('nama, id, id_buku, judul, gambar, deskripsi, pengarang, tahun_terbit, pemilik, status');
        $this->db->from($this->_tb);
        $this->db->join("{$this->_tb_anggota}", "{$this->_tb_anggota}.id = {$this->_tb}.pemilik");
        return $this->db->get()->result();
    }

    public function getBukuByJudul($judul)
    {
        $this->db->select('nama, id, id_buku, judul, gambar, deskripsi, pengarang, tahun_terbit, pemilik, status');
        $this->db->from($this->_tb);
        $this->db->join("{$this->_tb_anggota}", "{$this->_tb_anggota}.id = {$this->_tb}.pemilik");
        $this->db->like('judul', $judul);

        return $this->db->get()->result();
    }

    public function getBukuById($id)
    {
        return $this->db->where('id_buku', $id)->get($this->_tb)->row();
    }

    public function updateBuku($idBuku, $data)
    {
        return $this->db->set($data)->where('id_buku', $idBuku)->update($this->_tb);
    }

    public function insertBuku($data)
    {
        $this->db->insert($this->_tb, $data);
        return $this->db->insert_id();
    }

    public function hapusBuku($idBuku)
    {
        return $this->db->delete($this->_tb, ['id_buku' => $idBuku]);
    }
}

/* End of file BukuModel.php */