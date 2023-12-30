<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelopen extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('global');
    }

    public function desa(){
        //get desa from user, DO NOT REFER TO OTHER FILE
        $this->db->select('id, desa');
        $this->db->from('user');

        $query = $this->db->get();

        //convert to array
        $desa = $query->result_array();
        

        return $query->result();
    }

    public function berita($user_id){
        $this->db->select('id, judul, kategori, isi, gambar, created');
        $this->db->from('berita');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();

        return $query->result();
    }
}

?>