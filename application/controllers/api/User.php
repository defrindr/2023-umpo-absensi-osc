<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeluser');
        $this->load->model('Modelsession');

        $this->load->helper('global');
        header('Content-Type: application/json');

        if(ENVIRONMENT == 'development'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Authorization');
        } else if(ENVIRONMENT == 'testing'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Authorization');
        } else if(ENVIRONMENT == 'production'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Authorization');
        }
    }

    public function update_password(){
        $data = array(
            'id' => $this->Modelsession->get_user_id($this->input->get_request_header('Authorization', TRUE)),
            'password' => $this->input->post('password'),
            'old_password' => $this->input->post('old_password')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => null
            );
            reply($response);
        }

        //hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        $userdata = $this->Modeluser->get($data['id']);

        if(!password_verify($data['old_password'], $userdata['password'])){
            $response = array(
                'status' => 400,
                'message' => 'Old password is incorrect',
                'data' => null
            );
            reply($response);
        }

        //remove old password
        unset($data['old_password']);

        if($this->Modeluser->update($data['id'], $data)){
            $response = array(
                'status' => 200,
                'message' => 'Password updated',
                'data' => null
            );
            reply($response);
        }else{
            $response = array(
                'status' => 400,
                'message' => 'Failed to update password',
                'data' => null
            );
            reply($response);
        }
    }

    public function update(){
        $data = array(
            'id' => $this->Modelsession->get_user_id($this->input->get_request_header('Authorization', TRUE)),
            'name' => $this->input->post('name'),
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if($this->Modeluser->update($data['id'], $data)){
            $response = array(
                'status' => 200,
                'message' => 'User updated',
                'data' => $data
            );
            reply($response);
        }else{
            $response = array(
                'status' => 400,
                'message' => 'Failed to update user',
                'data' => $data
            );
            reply($response);
        }
    }

    public function my(){
        $data = $this->Modeluser->get($this->Modelsession->get_user_id($this->input->get_request_header('Authorization', TRUE)));

        //remove password, id
        unset($data['password']);
        unset($data['id']);

        if($data){
            $response = array(
                'status' => 200,
                'message' => 'User data',
                'data' => $data
            );
            reply($response);
        }else{
            $response = array(
                'status' => 400,
                'message' => 'Failed to get user data',
                'data' => null
            );
            reply($response);
        }
    }

    public function logout(){
        if($this->Modelsession->delete($this->input->get_request_header('Authorization', TRUE))){
            $response = array(
                'status' => 200,
                'message' => 'Logged out',
                'data' => null
            );
            reply($response);
        }else{
            $response = array(
                'status' => 400,
                'message' => 'Failed to logout',
                'data' => null
            );
            reply($response);
        }
    }

    public function create(){

        //data is email, password, role, name
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        if($this->Modeluser->username_exists($data['username'])){
            $response = array(
                'status' => 400,
                'message' => 'Username already exists',
                'data' => $data
            );
            reply($response);
        }

        //hash password
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        if($this->Modeluser->insert($data)){
            $response = array(
                'status' => 201,
                'message' => 'User created',
                'data' => $data
            );
            reply($response);
        } else {
            $response = array(
                'status' => 500,
                'message' => 'Internal server error',
                'data' => $data
            );
            reply($response);
        }
    }
}
