<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeluser extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'user';

        //load global helper
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

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_min($role){
        //only id and name
        $this->db->where('role', $role);
        $this->db->select('id, email, name');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_role($id){
        $this->db->where('id', $id);
        $this->db->select('role');
        $query = $this->db->get($this->table);
        //return as string
        return $query->row()->role;
    }

    public function username_exists($username){
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            //return user data as array
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get($id){
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            //return user data as array
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function get_school_id($id){
        $this->db->where('id', $id);
        $this->db->select('school_id');
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            //return only school_id
            return $query->row()->school_id;
        } else {
            return false;
        }
    }
}

?>