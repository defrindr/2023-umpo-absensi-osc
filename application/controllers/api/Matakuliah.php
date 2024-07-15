<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    //load sensors model
    public function __construct()
    {
        parent::__construct();
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
        $data = $this->Modelmatakuliah->get();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all Matakuliah',
            'data' => $data
        );

        reply($response);
    }

    public function select2()
    {
        $data = $this->Modelmatakuliah->select2();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all Matakuliah',
            'results' => $data
        );

        reply($response);
    }

    public function create()
    {
        $data = array(
            'kode_matakuliah' => $this->input->post('kode_matakuliah'),
            'nama_matakuliah' => $this->input->post('nama_matakuliah'),
            'sks' => $this->input->post('sks'),
            'created_at' => date('Y-m-d H:i:s')
        );

        if (!array_empty_check($data)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $status = $this->Modelmatakuliah->insert($data);

        if ($status) {
            $response = array(
                'status' => 201,
                'message' => 'Matakuliah created',
                'data' => $status
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to create Matakuliah',
                'data' => null
            );
        }

        reply($response);
    }

    public function update()
    {
        $id = $this->input->post('id');

        $data = array(
            'kode_matakuliah' => $this->input->post('kode_matakuliah'),
            'nama_matakuliah' => $this->input->post('nama_matakuliah'),
            'sks' => $this->input->post('sks')
        );

        if (empty($id) || !array_empty_check($data)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if ($this->Modelmatakuliah->update($id, $data)) {
            $response = array(
                'status' => 200,
                'message' => 'Matakuliah updated',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to update Matakuliah',
                'data' => null
            );
        }

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

        if ($this->Modelmatakuliah->delete($id)) {
            $response = array(
                'status' => 200,
                'message' => 'Matakuliah deleted',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to delete Matakuliah',
                'data' => null
            );
        }

        reply($response);
    }
}
