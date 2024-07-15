<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Open extends CI_Controller {
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

    public function check_session(){
        if(!$this->Modelsession->verify($this->input->get_request_header('Authorization', TRUE))){
            $response = array(
                'status' => 403,
                'message' => 'Invalid/Expired key',
                'data' => null
            );

            reply($response);
        }
        else{
            $response = array(
                'status' => 200,
                'message' => 'Valid key',
                'data' => null
            );

            reply($response);
        }
    }
    
    public function verify(){
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data'
            );
            reply($response);
        }

        $userdata = $this->Modeluser->username_exists($data['username']);

        if($userdata){
            if(password_verify($data['password'], $userdata['password'])){
                $message = '';
                //check for previous session
                $session = $this->Modelsession->get_by_user($userdata['id']);
                if($session){
                    //delete previous session
                    $this->Modelsession->delete($session->id);
                    $message = 'Previous session deleted';
                }
                //create new session, with +7 days expiry
                $session_id = $this->Modelsession->insert(array('user_id' => $userdata['id'], 'expiry' => date('Y-m-d H:i:s', strtotime('+7 days'))));
                if($session_id){
                    //set session
                    $this->session->set_userdata('session_id', $session_id);
                    $this->session->set_userdata('user_id', $userdata['id']);

                    $response = array(
                        'status' => 200,
                        'message' => 'Login successful',
                        'data' => array(
                            'session_id' => $session_id,
                            'user_id' => $userdata['id'],
                            'message' => $message
                        )
                    );
                    reply($response);
                }else{
                    $response = array(
                        'status' => 500,
                        'message' => 'Error creating session',
                        'data' => null
                    );
                    reply($response);
                }
            }else{
                $response = array(
                    'status' => 403,
                    'message' => 'Invalid credentials',
                    'data' => null
                );
                reply($response);
            }
        }else{
            $response = array(
                'status' => 403,
                'message' => 'Invalid credentials',
                'data' => null
            );
            reply($response);
        }
    }

    public function logout(){
        $session = $this->session->userdata('session_id');

        //delete session
        $this->Modelsession->delete($session);

        //unset session
        $this->session->unset_userdata('session_id');
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();

        echo json_encode(array('status' => 'success', 'message' => 'Logout success'));
    }
}
