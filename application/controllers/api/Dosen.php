<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeldosen');
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
        $data = $this->Modeldosen->get();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all dosen',
            'data' => $data
        );

        reply($response);
    }

    public function create(){
        $data = array(
            'nama' => $this->input->post('nama'),
            'nomer_induk' => $this->input->post('nomer_induk')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $status = $this->Modeldosen->insert($data);

        if($status){
            $response = array(
                'status' => 201,
                'message' => 'dosen created',
                'data' => $status
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to create dosen',
                'data' => null
            );
        }

        reply($response);
    }

    public function update(){
        $id = $this->input->post('id');

        $data = array(
            'nama' => $this->input->post('nama'),
            'nomer_induk' => $this->input->post('nomer_induk')
        );

        if(empty($id) || !array_empty_check($data)) {
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if($this->Modeldosen->update($id, $data)){
            $response = array(
                'status' => 200,
                'message' => 'dosen updated',
                'data' => null
            );
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Failed to update dosen',
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

        if($this->Modeldosen->delete($id)){
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
}
