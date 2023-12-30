<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelkelas');
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
        $data = $this->Modelkelas->get();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all kelas',
            'data' => $data
        );

        reply($response);
    }

    public function create(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'jam' => $this->input->post('jam'),
            'ruang' => $this->input->post('ruang')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $status = $this->Modelkelas->insert($data);

        if($status){
            $response = array(
                'status' => 201,
                'message' => 'kelas created',
                'data' => $status
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to create kelas',
                'data' => null
            );
        }

        reply($response);
    }

    public function update(){
        $id = $this->input->post('id');

        $data = array(
            'nama' => $this->input->post('nama'),
            'jam' => $this->input->post('jam'),
            'ruang' => $this->input->post('ruang')
        );

        if(empty($id) || !array_empty_check($data)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if($this->Modelkelas->update($id, $data)){
            $response = array(
                'status' => 200,
                'message' => 'kelas updated',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to update kelas',
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

        if($this->Modelkelas->delete($id)){
            $response = array(
                'status' => 200,
                'message' => 'kelas deleted',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to delete kelas',
                'data' => null
            );
        }

        reply($response);
    }
}
