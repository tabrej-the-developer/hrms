<?php

date_default_timezone_set('Asia/Kolkata');

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

class CenterController extends RestController{

    public function __construct()
    {
        parent::__construct();
    }
    public function storeCenter_post(){
        $center = new CenterModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'centerId'=>isset($jsonData->centerId) ? $jsonData->centerId : '',
                'addressStreet'=>isset($jsonData->addressStreet) ? $jsonData->addressStreet : '',
                'addressCity'=>isset($jsonData->addressCity) ? $jsonData->addressCity : '',
                'addressState'=>isset($jsonData->addressState) ? $jsonData->addressState : '',
                'addressZip'=>isset($jsonData->addressZip) ? $jsonData->addressZip : '',
                'name'=>isset($jsonData->name) ? $jsonData->name : '',
                'about'=>isset($jsonData->about) ? $jsonData->about : '',
                'motto'=>isset($jsonData->motto) ? $jsonData->motto : '',
                'contactNumber'=>isset($jsonData->contactNumber) ? $jsonData->contactNumber : '',
                'logoUrl'=>isset($jsonData->logoUrl) ? $jsonData->logoUrl : '',
            ];
            $center->insertCenter($data);
        }else{
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }
    }

    public function storeUserCenter_post(){
        $center = new CenterModel;
        $user = new UserModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'centerId'=>$jsonData->centerId,
                'todId'=>$jsonData->todId,
                'companyId'=>$jsonData->companyId
            ];
            $user->insertUserCenter($data);
        }else{
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }
    }

    public function getCenter_get($companyId){
        $center = new CenterModel;
        $result = $center->fetchCenter($companyId);
        if(!$result){
            $response = ['status'=>false,'message'=>'NO CENTERS FOUND'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $response = ['status'=>true,'message'=>'COMPANY CENTERS FETCHED','data'=>$result];
            $this->response($response,RestController::HTTP_OK);
        }
    }
    public function getAllCenters_get(){
        $center = new CenterModel;
        $result = $center->fetchAllCenters();
        if(!$result){
            $response = ['status'=>false,'message'=>'NO CENTERS FOUND'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $response = ['status'=>true,'message'=>'ALL CENTERS FETCHED','data'=>$result];
            $this->response($response,RestController::HTTP_OK);
        }
    }
    public function editCenter_post($centerId){
        $center = new CenterModel;
        $jsonData = json_decode(file_get_contents("php://input"));
        if($jsonData !== NULL){
            $data = [
                'addressStreet'=>$jsonData->addressStreet,
                'addressCity'=>$jsonData->addressCity,
                'addressState'=>$jsonData->addressState,
                'addressZip'=>$jsonData->addressZip,
                'name'=>$jsonData->name,
                'about'=>$jsonData->about,
                'motto'=>$jsonData->motto,
                'contactNumber'=>$jsonData->contactNumber,
                'logoUrl'=>$jsonData->logoUrl,
            ];
            $center->updateCenter($centerId,$data);
        }else{
            $response = ['status'=>false,'message'=>'ONLY SEND REQUEST AS RAW'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }
    }
    public function removeLogoUrl_post($centerId){
        $center = new CenterModel();
        $data = [
            'logoUrl'=>NULL
        ];
        $result = $center->removeCenterLogoUrl($centerId,$data);
        if($result > 0){
            $response = ['status'=>true,'message'=>'CENTER LOGO REMOVED'];
            $this->response($response,RestController::HTTP_OK);
        }elseif(!$result){
            $response = ['status'=>false,'message'=>'SORRY!WE COULDN\'T FIND CENTER LOGO TO REMOVE'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $response = ['status'=>false,'message'=>'FAILED TO REMOVE'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }
    }
    public function uploadLogoUrl_post($centerId){
        $center = new CenterModel;

        $data = [
            'logoUrl'=>isset($_POST['logoUrl']) ? $_POST['logoUrl'] : ''
        ];

        if(empty($_POST['logoUrl'])){
            $response = ['status'=>false,'message'=>'UPLOAD FILE IS EMPTY'];
            $this->response($response,RestController::HTTP_BAD_REQUEST);
        }else{
            $result = $center->updateCenterLogoUrl($centerId,$data);
            if($result > 0){
                $response = ['status'=>true,'message'=>'CENTER LOGO UPDATED'];
                $this->response($response,RestController::HTTP_OK);
            }elseif(!$result){
                $response = ['status'=>false,'message'=>'SORRY!WE COULDN\'T FIND CENTER LOGO TO UPDATE'];
                $this->response($response,RestController::HTTP_BAD_REQUEST);
            }else{
                $response = ['status'=>false,'message'=>'FAILED TO UPDATE CENTER LOGO'];
                $this->response($response,RestController::HTTP_BAD_REQUEST);
            }
        }
    }
    public function removeCenter_delete($centerId){
        $center = new CenterModel;
        $center->deleteCenter($centerId);
    }
}
?>