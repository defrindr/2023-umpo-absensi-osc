<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelmatakuliah extends CI_Model
{
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'matakuliah';
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


    public function get_in($condition)
    {
        $query = $this->db->where_in('id', $condition)->get($this->table);
        return $query->result();
    }

    public function select2()
    {
        $items = $this->get();

        $template = [];
        foreach ($items as $item) {
            $template[] = ['id' => $item->id, 'text' => $item->kode_matakuliah . ' | ' . $item->nama_matakuliah];
        }

        return $template;
    }
}
