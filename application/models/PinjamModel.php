<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PinjamModel extends CI_Model
{

    protected $_tb = 'pinjam';

    public function getAllPinjam()
    {
        return $this->db->get($this->_tb)->result();
    }

    public function prosesPinjam($data)
    {
        $this->db->insert($this->_tb, $data);
        return $this->db->insert_id();
    }

    public function updatePinjam($idPinjam, $data)
    {
        return $this->db->where(['id_pinjam', $idPinjam])->update($this->_tb, $data);
    }

    public function updateIdBukuPinjam($idBuku, $data)
    {
        return $this->db->where('id_buku', $idBuku)->update($this->_tb, $data);
    }
}

/* End of file PinjamModel.php */