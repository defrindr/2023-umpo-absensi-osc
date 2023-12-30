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

    public function editor()
    {
        $this->load->view('editor');
    }

    public function kelas()
    {
        $this->load->view('kelas');
    }

    public function mahasiswa()
    {
        $this->load->view('mahasiswa');
    }

    public function dosen()
    {
        $this->load->view('dosen');
    }

    public function jadwal()
    {
        $this->load->view('relasi');
    }

    public function home()
    {
        $this->load->view('home');
    }

    public function ruang()
    {
        $this->load->view('ruang');
    }

    public function jadwal_real()
    {
        $this->load->view('jadwal');
    }

    public function jadwal_2()
    {
        $this->load->view('jadwal2');
    }
}
