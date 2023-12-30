<?php

if(!function_exists('random_id')){
    function random_id($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

//random id but uppercase and numbers only
if(!function_exists('random_id_upper')){
    function random_id_upper($length = 32)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

//reply with output
if(!function_exists('reply')){
    function reply($response)
    {
        //add timestamp
        $response['timestamp'] = time();

        $ci = &get_instance();

        //check if response status exists, if it doesnt reply with 500
        if (!isset($response['status']) || empty($response['status']) || $response['status'] == null || $response['status'] == '') {
            $response['status'] = 500;
            $response['message'] = 'Improper response format';
        }

        $ci->output->set_status_header($response['status']);
        $ci->output->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        $ci->output->_display();
        die;
    }
}

//check for empty values in array
if(!function_exists('array_empty_check')) {
    function array_empty_check($array)
    {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }
}

//remove empty key pairs from array
if(!function_exists('array_empty_remove')) {
    function array_empty_remove($array)
    {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                unset($array[$key]);
            }
        }
        return $array;
    }
}

//json reply function
if(!function_exists('json_reply')){
    function json_reply($status, $message, $data = null)
    {
        $reply = array(
            'status' => $status,
            'message' => $message,
            'timestamp' => time(),
            'data' => $data
        );
        echo json_encode($reply, JSON_PRETTY_PRINT);
    }
}

//session check
if(!function_exists('session_check')){
    function session_check($role = null, $target = 'json')
    {
        $ci = &get_instance();
        $ci->load->model('Modelsession');
        $ci->load->model('Modeluser');

        //check user session in database
        $session = $ci->session->userdata('session_id');
        if ($ci->Modelsession->verify($session)) {
            if ($role != null) {
                $user_role = $ci->Modeluser->get_role($ci->session->userdata('user_id'));
                //if role is all
                if ($role == 'ALL') {
                    return true;
                }
                if ($user_role != $role) {
                    //if target is page redirect to auth else return json
                    if ($target == 'page') {
                        $ci->session->sess_destroy();
                        redirect(site_url('auth'));
                    } else {
                        json_reply(false, 'Unauthorized', array());
                        exit;
                    }
                    exit;
                }
            }
        } else {
            if ($target == 'page') {
                //destroy session
                $ci->session->sess_destroy();
                redirect(site_url('auth'));
            } else {
                json_reply(false, 'Unauthorized', array());
                exit;
            }
            http_response_code(401);
            die();
        }
    }
}

//cors check
if(!function_exists('cors_check')){
    function cors_check()
    {
        $ci = &get_instance();

        //load session model
        $ci->load->model('Modelsession');
        
        //if environment is development, allow all origins and dont check for key
        //if testing allow all origins and check for key
        //if production allow only specific origins and check for key
        if(ENVIRONMENT == 'development'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Authorization');
            return true;
        } else if(ENVIRONMENT == 'testing'){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Authorization');
            if(!$ci->Modelsession->verify($ci->input->get_request_header('Authorization', TRUE))){
                return false;
            }
            else{
                return true;
            }
        } else if(ENVIRONMENT == 'production'){
            header('Access-Control-Allow-Origin: https://perpus.yakinjaya.com');
            header('Access-Control-Allow-Headers: Authorization');
            if(!$ci->Modelsession->verify($ci->input->get_request_header('Authorization', TRUE))){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }
}

?>