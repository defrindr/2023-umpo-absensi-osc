<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function auth()
    {
        $this->load->view('auth');
    }

    public function dashboard()
    {
        $this->load->view('dashboard');
    }

    // Data Master
    public function kelas()
    {
        $this->load->view('kelas');
    }

    public function dosen()
    {
        $this->load->view('dosen');
    }

    public function ruang()
    {
        $this->load->view('ruang');
    }

    public function matakuliah()
    {
        $this->load->view('matakuliah');
    }
}
