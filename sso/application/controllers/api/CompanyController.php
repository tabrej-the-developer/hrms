<?php

date_default_timezone_set('Asia/Kolkata');

class CompanyController extends CI_Controller{
    public function getCompanies(){
        $company = new CompanyModel;
        $company_data = $company->fetchCompanies();
        // not proper JSON received - set response headers properly
        header("HTTP/1.1 200 OK"); 
        // respond with error
        $response = ['status'=>true,'message'=>'All Companies Fetched','data'=>$company_data];
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
}
?>