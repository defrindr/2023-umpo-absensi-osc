<?php
    $this->load->model('Modelsession');

    //check user session in database
    $session = $this->session->userdata('session_id');
    if ($this->Modelsession->verify($session)) {
        $role = $this->Modeluser->get_role($this->session->userdata('user_id'));
        if($role != 'ADMIN'){
            echo json_encode(array('status' => false,
                'message' => 'Unauthorized',
                'data' => array())
            );
            exit;
        }
    } else {
        //return error
        echo json_encode(array(
            'status' => false,
            'message' => 'Session expired',
            'session' => $session
        ));
        //set to 401 unauthorized
        http_response_code(401);
        die();
    }
?>