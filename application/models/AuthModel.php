<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    protected $_tb = 'anggota';

    public function rulesLogin()
    {
        return [
            [
                'field' => 'pin',
                'label' => 'PIN',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ]
        ];
    }

    public function rulesRegister()
    {
        return [
            [
                'field' => 'pin',
                'label' => 'PIN',
                'rules' => "required|max_length[6]|is_unique[$this->_tb.pin]",
                'error' => [
                    'required' => '%s harus di isi',
                    'max_length' => '%s maksimal 6 Angka',
                    'is_unique' => '%s PIN tersebut tidak dapat digunakan'
                ]
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ],
            [
                'field' => 'repeat_password',
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[password]',
                'error' => [
                    'required' => '%s harus di isi',
                    'matches' => 'Password harus sama'
                ]
            ],
            [
                'field' => 'nama_lengkap',
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ],
            [
                'field' => 'jenis_kelamin',
                'label' => 'Jenis Kelamin',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ],
            [
                'field' => 'tanggal_lahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'error' => [
                    'required' => '%s harus di isi'
                ]
            ]
        ];
    }

    public function cekLogin()
    {
        $cek = $this->session->userdata('account');
        if ($cek) {
            return true;
        } else {
            return false;
        }
    }

    public function login(int $pin)
    {
        return $this->db->get_where($this->_tb, ['pin' => $pin])->row();
    }

    public function register($data)
    {
        return $this->db->insert($this->_tb, $data);
    }
}

/* End of file AuthModel.php */