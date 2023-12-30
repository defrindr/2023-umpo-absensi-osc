<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelsession extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'session';
        $this->load->helper('global');
    }

    public function insert($data){
        $data['id'] = random_id(128);
        if ($this->db->insert($this->table, $data)) {
            return $data['id'];
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

    public function update($id, $data){
        $this->db->where('id', $id);
        if ($this->db->update($this->table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function verify($id){
        if($id == null){
            return false;
        }

        //check if expired
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);

        if($query->num_rows() == 0){
            return false;
        }

        $row = $query->row();
        //check in mysql datetime format, if expired return false
        if ($row->expiry < date('Y-m-d H:i:s')) {
            return false;
        } else {
            return true;
        }
    }

    public function get_user_id($session_id){
        $this->db->where('id', $session_id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        if($row){
            return $row->user_id;
        }else{
            return false;
        }
    }

    public function get_id($session_id){
        $user_id = $this->get_user_id($session_id);
        $this->db->where('id', $user_id);
        $this->db->select('id');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            //return only id
            return $query->row()->id;
        } else {
            return false;
        }
    }

    public function get_by_user($user_id){
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        if($row){
            return $row;
        }else{
            return false;
        }
    }

    public function delete_by_user($user_id){
        $this->db->where('user_id', $user_id);
        if ($this->db->delete($this->table)) {
            return true;
        } else {
            return false;
        }
    }
}

?>