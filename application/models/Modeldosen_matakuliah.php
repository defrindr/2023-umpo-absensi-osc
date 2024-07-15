<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeldosen_matakuliah extends CI_Model
{
    public $table;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = 'dosen_matakuliah';
        $this->load->helper('global');
    }

    public function sync($dosen_id, $list_matakuliah)
    {
        $list_existing = array_map(function ($item) {
            return $item->matakuliah_id;
        }, $this->get_by_dosen_id($dosen_id));

        // menghapus data yang tidak tersedia pada $list_matakuliah
        $deleted_key = array_diff($list_existing, $list_matakuliah);
        try {
            if ($deleted_key) $this->db
                ->where_in('matakuliah_id', $deleted_key)
                ->where('dosen_id', $dosen_id)
                ->delete($this->table);

            $new_key = array_diff($list_matakuliah, $list_existing);
            $ids = [];
            foreach ($new_key as $mk) {
                if ($id = $this->db->insert($this->table, ['matakuliah_id' => $mk, 'dosen_id' => $dosen_id])) {
                    $ids[] = $id;
                } else {
                    return false;
                }
            }
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }

        return true;
    }

    public function get_by_dosen_id($id)
    {
        $query = $this->db->get_where($this->table, ['dosen_id' => $id]);
        return $query->result();
    }
}
