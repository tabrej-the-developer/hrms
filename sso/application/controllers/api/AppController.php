<?php
class AppController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
	{
        if($this->session->userdata('todId') !== ''){
            $user = new UserModel;
            $todId = $this->session->userdata('todId');
            $data['userapps'] = $user->getUserApps($todId);
            $data['title'] = 'APPS';
            $data['content'] = $this->load->view('apps',$data,true);
            $this->load->view('template/default_layout',$data);
        }else{
			redirect(base_url());
        }
		
	}
    public function getApps(){
        $apps = new AppModel;
        $app_data = $apps->fetchApps();
        // not proper JSON received - set response headers properly
        header("HTTP/1.1 200 OK"); 
        // respond with error
        $response = ['status'=>true,'message'=>'All Apps Fetched','data'=>$app_data];
        $this->output->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
    public function appDashboard(){
        $appName = $_POST['appName'];
        if($appName == 'vizytor'){
            $vizytor_base_url = BASE_VIZYTOR_URL;
            redirect($vizytor_base_url.'dashboard');
        }
    }
}
?>