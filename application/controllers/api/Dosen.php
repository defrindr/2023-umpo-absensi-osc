<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldosen');
        $this->load->model('Modeldosen_matakuliah');
        $this->load->model('Modelmatakuliah');
        $this->load->model('Modelsession');

        $this->load->helper('global');
        header('Content-Type: application/json');

        //call helper cors check
        if (!cors_check()) {
            $response = array(
                'status' => 403,
                'message' => 'Invalid/Expired key',
                'data' => null
            );
            reply($response);
        }

        if (ENVIRONMENT == 'testing' || ENVIRONMENT == 'production') {
            //set user_id variable
            $this->user_id = $this->Modelsession->get_user_id($this->input->get_request_header('Authorization', TRUE));

            //if null, reply with 403 status
            if ($this->user_id == null) {
                $response = array(
                    'status' => 403,
                    'message' => 'MISSING SCHOOL ID',
                    'data' => null
                );
                reply($response);
            }
        }
    }

    public function get()
    {
        $data = $this->Modeldosen->get_with_ampuan();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all dosen',
            'data' => $data
        );

        reply($response);
    }

    public function create()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'nomer_induk' => $this->input->post('nomer_induk')
        );

        $matakuliah_ampuan = $this->input->post('matakuliah') ?? [];
        if (!array_empty_check($data) || count($matakuliah_ampuan) < 1) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $this->db->trans_start();
        $status = $this->Modeldosen->insert($data);

        if ($status) {
            $status_matakuliah = $this->Modeldosen_matakuliah->sync($status, $matakuliah_ampuan);
            if ($status_matakuliah) {
                $this->db->trans_complete();
                $response = array(
                    'status' => 201,
                    'message' => 'dosen created',
                    'data' => $status
                );

                goto end;
            }
        }
        $response = array(
            'status' => 500,
            'message' => 'Failed to create dosen',
            'data' => null
        );

        end:
        reply($response);
    }

    public function update()
    {
        $id = $this->input->post('id');

        $data = array(
            'nama' => $this->input->post('nama'),
            'nomer_induk' => $this->input->post('nomer_induk')
        );

        $matakuliah_ampuan = $this->input->post('matakuliah') ?? [];
        if ((empty($id) || !array_empty_check($data)) || count($matakuliah_ampuan) < 1) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $this->db->trans_start();
        if ($this->Modeldosen->update($id, $data)) {
            $status_matakuliah = $this->Modeldosen_matakuliah->sync($id, $matakuliah_ampuan);
            if ($status_matakuliah) {
                $this->db->trans_complete();
                $response = array(
                    'status' => 201,
                    'message' => 'dosen updated',
                    'data' => null
                );

                goto end;
            }
        }

        $response = array(
            'status' => 500,
            'message' => 'Failed to update dosen',
            'data' => null
        );
        end:

        reply($response);
    }

    public function delete()
    {
        $id = $this->input->post('id');

        if (empty($id)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => null
            );
            reply($response);
        }

        if ($this->Modeldosen->delete($id)) {
            $response = array(
                'status' => 200,
                'message' => 'dosen deleted',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to delete dosen',
                'data' => null
            );
        }

        reply($response);
    }

    public function ampuan($dosen_id)
    {
        $data = $this->Modelmatakuliah->get_in(array_map(function ($item) {
            return $item->matakuliah_id;
        }, $this->Modeldosen_matakuliah->get_by_dosen_id($dosen_id)));

        $response = array(
            'status' => 200,
            'message' => 'dosen ampaun retrieve',
            'data' => $data
        );

        reply($response);
    }
}
