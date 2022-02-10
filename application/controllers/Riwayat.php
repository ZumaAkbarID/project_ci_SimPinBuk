<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('BukuModel');
        $this->load->model('PinjamModel');
        $this->load->model('RiwayatModel');
        $this->load->model('AuthModel');
    }

    public function index()
    {
        if (!$this->AuthModel->cekLogin()) {
            redirect(base_url());
        }

        $data = [
            'title' => 'Riwayat',
        ];

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('riwayat/v_riwayat', $data);
        $this->load->view('template/t_footer', $data);
    }

    public function ajaxRiwayat()
    {
        $data = [
            'dataRiwayat' => $this->RiwayatModel->getRiwayat($this->session->userdata('uid')),
            'dataBuku' => $this->BukuModel->getAllBuku(),
            'dataPinjam' => $this->PinjamModel->getAllPinjam()
        ];

        return $this->load->view('riwayat/ajax/v_getRiwayat', $data);
    }

    public function hapusRiwayat()
    {
        $idRiwayat = $this->input->post('idRiwayat');

        $query = $this->RiwayatModel->deleteRiwayat($idRiwayat);

        if ($query) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function kembalikanBuku()
    {
        $idBuku = $this->input->post('idBuku');
        $idRiwayat = $this->input->post('idRiwayat');
        $idPinjam = $this->input->post('idPinjam');
        $judul = $this->input->post('judul');

        $updateRiwayat = [
            'id_buku' => null,
            'id_pinjam' => null,
            'deleted' => '1'
        ];
        $this->RiwayatModel->updateRiwayat($idRiwayat, $updateRiwayat);

        $insertRiwayat = [
            'id_anggota' => $this->session->userdata('uid'),
            'id_buku' => null,
            'id_pinjam' => null,
            'deskripsi' => "Mengembalikan Buku berjudul {$judul}.",
            'tipe' => 'Kembalikan',
            'waktu' => date('Y-m-d H:i:s'),
            'deleted' => '1'
        ];
        $this->RiwayatModel->insertRiwayat($insertRiwayat);

        $updatePinjam = [
            'tgl_kembali' => date('Y-m-d H:i:s')
        ];
        $this->PinjamModel->updatePinjam($idPinjam, $updatePinjam);

        $updateBuku = [
            'status' => '1'
        ];
        $this->BukuModel->updateBuku($idBuku, $updateBuku);

        echo 'success';
    }
}

/* End of file Riwayat.php */