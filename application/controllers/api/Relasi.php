<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relasi extends CI_Controller {
    //load sensors model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelrelasi');
        $this->load->model('Modelsession');
        $this->load->model('Modelkelas');

        $this->load->helper('global');
        //header('Content-Type: application/json');

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
        $data = $this->Modelrelasi->get();

        $response = array(
            'status' => 200,
            'message' => 'Fetch all dosen',
            'data' => $data
        );

        reply($response);
    }

    public function get_detailed(){
        $id_dosen = $this->input->post('id_dosen');
        $id_mahasiswa = $this->input->post('id_mahasiswa');

        $data = $this->Modelrelasi->get_detailed($id_dosen, $id_mahasiswa);

        $response = array(
            'status' => 200,
            'message' => 'Fetch detailed schedule',
            'data' => $data
        );

        reply($response);
    }

    public function get_schedule(){
        $data = $this->Modelrelasi->get_schedule();
        $rooms = $this->Modelkelas->unique_ruang();

        //convert rooms to array
        $rooms = array_map(function($room){
            return $room->ruang;
        }, $rooms);

        $days = array('senin', 'selasa', 'rabu', 'kamis', 'jumat');
        
        $schedule = array();
        $hour_limit = 8;

        $start_hour = 7;
        $end_hour = 17;
        $break_hours = array(12, 13);
        
        $exec_start = microtime(true);
        foreach($days as $day){
            $schedule[$day] = array();
            foreach($rooms as $room){
                $current_hour = 0;
                $schedule[$day][$room] = array();

                //if data is empty continue
                if(empty($data)){
                    continue;
                }

                foreach($data as $item){
                    if($item->ruang == $room && $current_hour - $item->jam <= $hour_limit){
                        $current_hour += $item->jam;
                        //add waktu property in hh:mm - hh:mm, make sure it doesn't exceed 17:00 and doesn't include break hours
                        $item->waktu = $start_hour + $current_hour - $item->jam . ':00 - ' . $start_hour + $current_hour . ':00';

                        //check if waktu is in break hours
                        $waktu = explode(' - ', $item->waktu);
                        $waktu = array_map(function($waktu_item){
                            return explode(':', $waktu_item)[0];
                        }, $waktu);

                        //if yes push after break hours
                        for ($i = 0; $i < count($break_hours); $i++) {
                            if($waktu[0] < $break_hours[$i] && $waktu[1] > $break_hours[$i]){
                                $waktu[0] = $break_hours[$i] + 1;
                                $item->waktu = $waktu[0] . ':00 - ' . $waktu[1] . ':00';
                            }
                        }

                        //if exceeds 17:00, push to next day
                        if($waktu[1] > $end_hour){
                            continue;
                        }

                        array_push($schedule[$day][$room], $item);
                        

                        //add 'waktu' property

                        //remove item from data
                        $data = array_filter($data, function($data_item) use ($item){
                            return $data_item->id != $item->id;
                        });
                    }
                }
            }
        }

        $exec_end = microtime(true);

        //empty response
        $response = array(
            'status' => 200,
            'message' => 'Fetch schedule',
            'data' => $schedule,
            'time' => $exec_end - $exec_start
        );
        reply($response);
    }

    public function create(){
        $data = array(
            'id_dosen' => $this->input->post('id_dosen'),
            'id_kelas' => $this->input->post('id_kelas')
        );

        if(!array_empty_check($data)){
            $response = array(
                'status' => 400,
                'message' => 'Invalid data',
                'data' => $data
            );
            reply($response);
        }

        $status = $this->Modelrelasi->insert($data);

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
            'id_dosen' => $this->input->post('id_dosen'),
            'id_kelas' => $this->input->post('id_kelas'),
            'list_mahasiswa' => $this->input->post('list_mahasiswa')
        );

        //remove empty data
        $data = array_filter($data);


        if($this->Modelrelasi->update($id, $data)){
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

        if($this->Modelrelasi->delete($id)){
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
