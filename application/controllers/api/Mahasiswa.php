<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelmahasiswa');
        $this->load->model('Modelsession');

        $this->load->helper('global');
        header('Content-Type: application/json');

        //call helper cors check
        if(!cors_check()){
            $response = array(
                'status' => 403,
                'message' => 'Invalid/Expired key',
                'data' => null
            );
            reply($response);
        }

        if(ENVIRONMENT == 'testing' || ENVIRONMENT == 'production'){
            //set user_id variable
            $this->user_id = $this->Modelsession->get_user_id($this->input->get_request_header('Authorization', TRUE));

            //if null, reply with 403 status
            if($this->user_id == null){
                $response = array(
                    'status' => 403,
                    'message' => 'MISSING SCHOOL ID',
                    'data' => null
                );
                reply($response);
            }
        }
    }

    public function get(){
        $data = $this->Modelmahasiswa->get();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all mahasiswa',
            'data' => $data
        );

        reply($response);
    }

    public function get_in(){
        $ids = $this->input->post('ids');
        //explode with +
        $ids = explode(' ', $ids);

        if(empty($ids)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => null
            );
            reply($response);
        }

        $data = $this->Modelmahasiswa->get_in($ids);

        $response = array(
            'status' => 200,
            'message' => 'Fetch mahasiswa by ids',
            'data' => $data,
            'ids' => $ids
        );

        reply($response);
    }

    public function searchnim(){
        $nim = $this->input->post('nim');

        if(empty($nim)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => null
            );
            reply($response);
        }

        $data = $this->Modelmahasiswa->get_by_nim($nim);

        $response = array(
            'status' => 200,
            'message' => 'Fetch mahasiswa by nim',
            'data' => $data
        );

        reply($response);
    }

    public function create(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $status = $this->Modelmahasiswa->insert($data);

        if($status){
            $response = array(
                'status' => 201,
                'message' => 'mahasiswa created',
                'data' => $status
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to create mahasiswa',
                'data' => null
            );
        }

        reply($response);
    }

    public function update(){
        $id = $this->input->post('id');

        $data = array(
            'nama' => $this->input->post('nama'),
            'nim' => $this->input->post('nim')
        );

        if(empty($id) || !array_empty_check($data)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if($this->Modelmahasiswa->update($id, $data)){
            $response = array(
                'status' => 200,
                'message' => 'mahasiswa updated',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to update mahasiswa',
                'data' => null
            );
        }

        reply($response);
    }

    public function delete(){
        $id = $this->input->post('id');

        if(empty($id)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => null
            );
            reply($response);
        }

        if($this->Modelmahasiswa->delete($id)){
            $response = array(
                'status' => 200,
                'message' => 'mahasiswa deleted',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to delete mahasiswa',
                'data' => null
            );
        }

        reply($response);
    }
}
