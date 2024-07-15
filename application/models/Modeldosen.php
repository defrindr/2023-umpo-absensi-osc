<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeldosen extends CI_Model
{
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'dosen';
        $this->load->helper('global');
    }

    public function insert($data)
    {
        $data['id'] = random_id(32);
        if ($this->db->insert($this->table, $data)) {
            return $data['id'];
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }

    public function get()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_with_ampuan()
    {
        $query = $this->db
            ->join('dosen_matakuliah', 'dosen_matakuliah.dosen_id = dosen.id')
            ->join('matakuliah', 'dosen_matakuliah.matakuliah_id = matakuliah.id')
            ->group_by('dosen.id, dosen.nama, dosen.nomer_induk')
            ->select('dosen.*, group_concat(matakuliah.nama_matakuliah) as nama_matakuliah')
            ->get($this->table);
        return $query->result();
    }
}
