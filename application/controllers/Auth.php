<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function login()
    {
        if ($this->AuthModel->cekLogin()) {
            redirect(base_url());
        }

        $data = [
            'title' => 'Login',
        ];

        if ($this->input->method() == 'post') {
            $rules = $this->AuthModel->rulesLogin();
            $this->form_validation->set_rules($rules);


            if (!$this->form_validation->run()) {
                return redirect(base_url('auth/login'));
            } else {
                $input = $this->input->post();
                $acc = $this->AuthModel->login($input['pin']);
                if (!$acc) {
                    $this->session->set_flashdata('error', "Akun tidak ditemukan, Klik register untuk membuat akun");
                    return redirect(base_url('auth/login'));
                } else {
                    $cekPass = password_verify($input['password'], $acc->password);
                    if (!$cekPass) {
                        $this->session->set_flashdata('error', 'Pin atau Password salah');
                        return redirect(base_url('auth/login'));
                    } else {
                        $arraySession = [
                            'uid' => $acc->id,
                            'nama' => $acc->nama,
                            'role' => $acc->role,
                            'account' => true
                        ];

                        $this->session->set_userdata($arraySession);
                        return redirect(base_url('home'));
                    }
                }
            }
        }

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('auth/v_login', $data);
        $this->load->view('template/t_footer', $data);
    }

    public function register()
    {
        if ($this->AuthModel->cekLogin()) {
            redirect(base_url());
        }

        $data = [
            'title' => 'Register',
        ];

        if ($this->input->method() == 'post') {
            $rules = $this->AuthModel->rulesRegister();
            $this->form_validation->set_rules($rules);


            if (!$this->form_validation->run()) {
                $this->session->set_flashdata('error', "Gagal membuat akun, pastikan mengisi data dengan benar atau coba gunakan pin yang lain!");
                return redirect(base_url('auth/register'));
            } else {
                $input = $this->input->post();
                $acc = $this->AuthModel->login($input['pin']);

                if ($acc) {
                    $this->session->set_flashdata('error', "PIN Tidak Dapat Digunakan");
                    return redirect(base_url('auth/register'));
                } else {
                    $encPass = password_hash($input['password'], PASSWORD_DEFAULT);

                    $dataAccount = [
                        'pin' => $input['pin'],
                        'password' => $encPass,
                        'nama' => $input['nama_lengkap'],
                        'jenis_kelamin' => $input['jenis_kelamin'],
                        'tanggal_lahir' => $input['tanggal_lahir'],
                        'role' => 'Member'
                    ];

                    $query = $this->AuthModel->register($dataAccount);
                    if ($query) {
                        $this->session->set_flashdata('success', "Akun berhasil dibuat, silahkan login menggunakan akun yang telah dibuat.");
                        return redirect(base_url('auth/register'));
                    } else {
                        $this->session->set_flashdata('error', "Terjadi kesalahan");
                        return redirect(base_url('auth/register'));
                    }
                }
            }
        }

        $this->load->view('template/t_top', $data);
        $this->load->view('template/t_navbar', $data);
        $this->load->view('auth/v_register', $data);
        $this->load->view('template/t_footer', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(base_url());
    }
}

/* End of file Auth.php */