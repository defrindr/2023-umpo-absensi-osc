<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelrelasi extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'relasi';
        $this->load->helper('global');
    }

    public function insert($data){
        $data['id'] = random_id(64);
        if ($this->db->insert($this->table, $data)) {
            return $data['id'];
        } else {
            return false;
        }
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        if ($this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function get(){
        //join on dosen, kelas, mahasiswa for 'nama'
        $this->db->select('relasi.id, id_dosen, id_kelas, dosen.nama as nama_dosen, kelas.nama as nama_kelas, list_mahasiswa');
        $this->db->from($this->table);
        $this->db->join('dosen', 'dosen.id = relasi.id_dosen');
        $this->db->join('kelas', 'kelas.id = relasi.id_kelas');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_detailed($id_dosen, $id_mahasiswa){
        //join on dosen, kelas, mahasiswa for 'nama'
        $this->db->select('relasi.id, id_dosen, id_kelas, dosen.nama as nama_dosen, kelas.nama as nama_kelas, list_mahasiswa, jam, ruang');
        
        if($id_dosen != null){
            $this->db->where('id_dosen', $id_dosen);
        }

        if($id_mahasiswa != null){
            //like both
            $this->db->like('list_mahasiswa', $id_mahasiswa, 'both');
        }
        
        $this->db->from($this->table);
        $this->db->join('dosen', 'dosen.id = relasi.id_dosen');
        $this->db->join('kelas', 'kelas.id = relasi.id_kelas');

        $query = $this->db->get();
        return $query->result();
    }

    public function get_schedule(){
        //join on dosen, kelas, mahasiswa for 'nama'
        $this->db->select('relasi.id, dosen.nama as nama_dosen, kelas.nama as nama_kelas, jam, ruang');
        
        $this->db->from($this->table);
        $this->db->join('dosen', 'dosen.id = relasi.id_dosen');
        $this->db->join('kelas', 'kelas.id = relasi.id_kelas');
        
        //order by jam
        $this->db->order_by('jam', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

?>