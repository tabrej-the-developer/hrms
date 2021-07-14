<?php

date_default_timezone_set('Asia/Kolkata');

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

class RoomController extends RestController{

    public function __construct()
    {
        parent::__construct();
    }
    public function storeRoom_post(){
        $room = new RoomModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'roomId'=>isset($jsonData->roomId) ? $jsonData->roomId : '',
                'name'=>isset($jsonData->name) ? $jsonData->name : '',
                'careAgeFrom'=>isset($jsonData->careAgeFrom) ? $jsonData->careAgeFrom : '',
                'careAgeTo'=>isset($jsonData->careAgeTo) ? $jsonData->careAgeTo : '',
                'capacity'=>isset($jsonData->capacity) ? $jsonData->capacity : '',
                'ratio'=>isset($jsonData->ratio) ? $jsonData->ratio : ''
            ];
            $room->insertRoom($data);
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function getRoom_get($centerId){
        $room = new RoomModel;
        $result = $room->fetchRoom($centerId);
        if(!$result){
            $response = ['status'=>false,'message'=>'NO ROOMS FOUND'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $response = ['status'=>true,'message'=>'CENTER ROOMS FETCHED','data'=>$result];
            $this->response($response,RestController::HTTP_OK);
        }
    }
    public function getAllRooms_get(){
        $room = new RoomModel;
        $result = $room->fetchAllRooms();
        if(!$result){
            $response = ['status'=>false,'message'=>'NO ROOMS FOUND'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $response = ['status'=>true,'message'=>'ALL ROOMS FETCHED','data'=>$result];
            $this->response($response,RestController::HTTP_OK);
        }
    }
    public function editRoom_post($roomId){
        $room = new RoomModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'name'=>$jsonData->name,
                'careAgeFrom'=>$jsonData->careAgeFrom,
                'careAgeTo'=>$jsonData->careAgeTo,
                'capacity'=>$jsonData->capacity,
                'ratio'=>isset($jsonData->ratio) ? $jsonData->ratio : '',
                'isDeletedYN'=>isset($jsonData->isDeletedYN) ? $jsonData->isDeletedYN : 'N'
            ];
            $room->updateRoom($roomId,$data);
        }else{
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }
    }
    public function storeCenterRoom_post(){
        $room = new RoomModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $roomdata = explode('|',$jsonData->roomId);
            foreach($roomdata as $rd){
                if($rd != null && $rd != ""){
                    $data = [
                        'centerId'=>$jsonData->centerId,
                        'roomId'=>$rd
                    ];
                    $room->insertCenterRoom($data);
                }
            }
        }else{
            // not proper JSON received - set response headers properly
            header("HTTP/1.1 400 Bad Request"); 
            // respond with error
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($response));
        }
    }
    public function removeRoom_delete($roomId){
        $room = new RoomModel;
        $room->deleteRoom($roomId);
    }
}
?>