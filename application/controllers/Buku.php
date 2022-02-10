<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
            'title' => 'Semua Buku'
        ];

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('buku/v_semuabuku', $data);
        $this->load->view('template/t_footer', $data);
    }

    public function getBuku()
    {

        $data = [
            'dataBuku' => $this->BukuModel->getAllBuku()
        ];

        return $this->load->view('buku/ajax/a_getBuku', $data);
    }

    public function getBukuByJudul()
    {

        $getJudul = $this->input->post('judul');

        $query = $this->BukuModel->getBukuByJudul($getJudul);

        if (!$getJudul) {
            return 'Error';
        } else {
            $data = [
                'dataBuku' => $query
            ];

            return $this->load->view('buku/ajax/a_getBuku', $data);
        }
    }

    public function prosesPinjam()
    {
        if (!$this->session->userdata('account')) {
            return redirect(base_url());
        }

        $idBuku = $this->input->post('idBuku');

        $dataQuery = [
            'id_anggota' => $this->session->userdata('uid'),
            'id_buku' => $idBuku,
            'tgl_pinjam' => date('Y-m-d H:i:s'),
            'tgl_kembali' => null
        ];

        $currentDate = date('d-M-Y');
        $kembaliTgl = date('d-M-Y', strtotime($currentDate . '+ 7 Days'));

        $prosesPinjam = $this->PinjamModel->prosesPinjam($dataQuery);

        $queryRiwayat = [
            'id_anggota' => $this->session->userdata('uid'),
            'id_buku' => $idBuku,
            'id_pinjam' => $prosesPinjam,
            'deskripsi' => "Meminjam Buku berjudul {$this->input->post('judul')}, Kode pinjam : " . rand() . ", wajib dikembalikan paling lambat tanggal {$kembaliTgl}.",
            'tipe' => 'Pinjam',
            'waktu' => date('Y-m-d H:i:s')
        ];;

        $dataUbah = [
            'status' => '0'
        ];

        $this->BukuModel->updateBuku($idBuku, $dataUbah);

        return $this->RiwayatModel->insertRiwayat($queryRiwayat);
    }

    public function simpanbuku()
    {
        if (!$this->AuthModel->cekLogin()) {
            redirect(base_url());
        }

        $data = [
            'title' => 'Simpan Buku'
        ];

        if ($this->input->method() == 'post') {
            $dataInput = $this->input->post();
            $this->form_validation->set_rules($this->BukuModel->rules());
            // $this->form_validation->set_rules('gambar', 'Gambar', 'callback_file_check');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path']   = 'assets/img/buku/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $uploadGambar = $this->upload->data();
                    $dataInsert = [
                        'judul' => $dataInput['judul'],
                        'gambar' => $uploadGambar['file_name'],
                        'deskripsi' => $dataInput['deskripsi'],
                        'pengarang' => $dataInput['pengarang'],
                        'tahun_terbit' => $dataInput['tahun_terbit'],
                        'pemilik' => $this->session->userdata('uid'),
                        'status' => '1'
                    ];

                    $query = $this->BukuModel->insertBuku($dataInsert);

                    $queryRiwayat = [
                        'id_anggota' => $this->session->userdata('uid'),
                        'id_buku' => $query,
                        'id_pinjam' => null,
                        'deskripsi' => "Menyimpan Buku berjudul {$dataInput['judul']}, Kode buku : " . $query . ".",
                        'tipe' => 'Simpan',
                        'waktu' => date('Y-m-d H:i:s')
                    ];

                    $this->RiwayatModel->insertRiwayat($queryRiwayat);

                    if (!empty($query)) {
                        $this->session->set_flashdata('success', 'Buku berhasil disimpan, silahkan setorkan buku Anda ke perpustakaan SimPinBuk terdekat, dengan menunjukkan kode di riwayat.');
                        return redirect(base_url('buku/simpanbuku'));
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi Kesalahan');
                        return redirect(base_url('buku/simpanbuku'));
                    }
                } else {
                    $this->session->set_flashdata('error', 'Gambar gagal diupload');
                    return redirect(base_url('buku/simpanbuku'));
                }
            } else {
                $this->session->set_flashdata('error', 'Gagal melewati validasi');
                return redirect(base_url('buku/simpanbuku'));
            }
        }

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('buku/v_simpanBuku', $data);
        $this->load->view('template/t_footer', $data);
    }

    public function perbaruiBuku($idBuku)
    {
        if (!$this->AuthModel->cekLogin()) {
            redirect(base_url());
        }

        $getBuku = $this->BukuModel->getBukuById($idBuku);

        $data = [
            'title' => 'Perbarui Buku',
            'dataBuku' => $getBuku
        ];

        if ($this->input->method() == 'post') {
            $dataInput = $this->input->post();

            $this->form_validation->set_rules($this->BukuModel->rules());
            // $this->form_validation->set_rules('gambar', 'Gambar', 'callback_file_check');

            if ($this->form_validation->run() == TRUE) {
                $config['upload_path']   = 'assets/img/buku/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $uploadGambar = $this->upload->data();
                    $updateGambar = $uploadGambar['file_name'];

                    $dataInsert = [
                        'judul' => $dataInput['judul'],
                        'gambar' => $updateGambar,
                        'deskripsi' => $dataInput['deskripsi'],
                        'pengarang' => $dataInput['pengarang'],
                        'tahun_terbit' => $dataInput['tahun_terbit'],
                        'pemilik' => $this->session->userdata('uid')
                    ];

                    if (file_exists("./assets/img/buku/$getBuku->gambar")) {
                        unlink("./assets/img/buku/$getBuku->gambar");
                    }

                    $query = $this->BukuModel->updateBuku($idBuku, $dataInsert);

                    $queryRiwayat = [
                        'id_anggota' => $this->session->userdata('uid'),
                        'id_buku' => $query,
                        'id_pinjam' => null,
                        'deskripsi' => "Memperbarui Buku berjudul {$dataInput['judul']}, Kode buku : " . $query . ".",
                        'tipe' => 'Perbarui',
                        'waktu' => date('Y-m-d H:i:s')
                    ];

                    $this->RiwayatModel->insertRiwayat($queryRiwayat);

                    if (!empty($query)) {
                        $this->session->set_flashdata('success', 'Data buku berhasil diperbarui');
                        return redirect(base_url('buku/perbaruiBuku/' . $idBuku));
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi Kesalahan');
                        return redirect(base_url('buku/perbaruiBuku/' . $idBuku));
                    }
                } else {
                    $updateGambar = $getBuku->gambar;

                    $dataInsert = [
                        'judul' => $dataInput['judul'],
                        'gambar' => $updateGambar,
                        'deskripsi' => $dataInput['deskripsi'],
                        'pengarang' => $dataInput['pengarang'],
                        'tahun_terbit' => $dataInput['tahun_terbit'],
                        'pemilik' => $this->session->userdata('uid')
                    ];

                    $query = $this->BukuModel->updateBuku($idBuku, $dataInsert);

                    $queryRiwayat = [
                        'id_anggota' => $this->session->userdata('uid'),
                        'id_buku' => $query,
                        'id_pinjam' => null,
                        'deskripsi' => "Memperbarui Buku berjudul {$dataInput['judul']}, dengan gambar, Kode buku : " . $query . ".",
                        'tipe' => 'Perbarui',
                        'waktu' => date('Y-m-d H:i:s')
                    ];

                    $this->RiwayatModel->insertRiwayat($queryRiwayat);

                    if (!empty($query)) {
                        $this->session->set_flashdata('success', 'Simpan Buku Berhasil');
                        return redirect(base_url('buku/perbaruiBuku/' . $idBuku));
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi Kesalahan');
                        return redirect(base_url('buku/perbaruiBuku/' . $idBuku));
                    }
                }
            } else {
                $this->session->set_flashdata('error', 'Gagal melewati validasi');
                return redirect(base_url('buku/perbaruiBuku/' . $idBuku));
            }
        }

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('buku/v_perbaruiBuku', $data);
        $this->load->view('template/t_footer', $data);
    }
}

/* End of file Buku.php */