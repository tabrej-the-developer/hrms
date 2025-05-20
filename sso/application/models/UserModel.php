<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserModel extends CI_Model{

    public function getUsers(){
        $query = $this->db->get('users');
        return $query->result();
    }
    public function insertUser($data){
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }
    public function insertUserCompany($data){
        $this->db->insert('usercompany',$data);
        return $this->db->insert_id();
    }
    public function insertUserCenter($data){
        $this->db->insert('usercenter',$data);
        return $this->db->insert_id();
    }
    public function insertLoginToken($data){
        return $this->db->insert('logins',$data);
    }
    public function uploadProfilePicture($todId,$data){
        return $this->db->update('users', $data, array('todId' => $todId));
    }
    public function deleteLoginToken($todId){
        return $this->db->delete('logins', array('todId' => $todId));
    }
    public function getLoginToken($todId){
        $query = $this->db->get_where('logins',array('todId'=>$todId));
        return $query->row();
    }
    //Insert User App Detail Info
    public function insertUserApp($data){
        $this->db->insert('userapps',$data);
        return $this->db->insert_id();
    }
    //Fetch UserApps Based on TodId
    public function getUserApps($todId){
        $query = $this->db->query("SELECT userapps.appId,apps.appName,apps.appLogo,userapps.loginAccess FROM `userapps` JOIN apps on apps.appId = userapps.appId WHERE todId=$todId;");
        return $query->result();
    }
    public function checkEmail($email){
        $query = $this->db->get_where('users',array('email'=>$email));
        $count = $query->num_rows();
        return $count;
    }
    public function checkUserApp($appId,$todId){
        $query = $this->db->get_where('userapps',array('appId'=>$appId,'todId'=>$todId));
        $count = $query->num_rows();
        return $count;
    }
    
    public function getUserDetails($email){
        $query = $this->db->get_where('users',array('email'=>$email));
        return $query->row();
    }
    public function checkPersonUserType($appId,$companyId,$userType){
        if($userType == 'superadmin'){
            $query = $this->db->get_where('users',array('appId'=>$appId,'companyId'=>$companyId,'userType'=>'superadmin'));
            $count = $query->num_rows();
            return $count;//If returns 1 then show SUPERADMIN ALREADY EXISTS WITHIN THIS APP AND COMPANY
        }else{
            return 2;
        }

    }
    public function getAppDetails($appId){
        $query = $this->db->get_where('apps',array('appId'=>$appId));
        return $query->row();
    }
    public function verifyEmailAddress($data,$activationcode){
        $query = $this->db->get_where('users',array('EmailActivationCode'=>$activationcode));
        $count = $query->num_rows();
        $result = $query->row();
        if($count > 0){
            if($result->isEmailVerfiedYN == 'Y'){
                return 1;//1 indicates Email Already Verified
            }else{
                $this->db->where('todId',$result->todId);
                $this->db->update('users',$data);
                return 2;//2 Indicates Email is Verified
            }
        }else{
            return 3;//3 Indicates No Verfication Code Found Within DB or Invalid Activation Code
        }
    }
    public function credentialsCheck($email,$password){
        //1::check::Email is existed in db or not
        $query1 = $this->db->get_where('users',array('email'=>$email));
        $count1 = $query1->num_rows();
        if($count1 > 0){
                //2::check::Check Both Email and Password are OK
                $query2 = $this->db->get_where('users',array('email'=>$email,'password'=>md5($password)));
                $count2 = $query2->num_rows();
                $result2 = $query2->row();
                if($count2 > 0){
                    $query3 = $this->db->query("SELECT users.todId,users.email,users.userName,users.userType,usercompany.companyId,company.name as companyName FROM `users` INNER JOIN usercompany on users.todId = usercompany.todId INNER JOIN company on usercompany.companyId = company.id where users.todId = $result2->todId;");
                    $result3 = $query3->row();
                    return array('result'=>3,'data'=>$result3);
                }else{
                    return array('result'=>2,'data'=>NULL);
                }

        }else{
            return array('result'=>1,'data'=>NULL);
        }
    }
    public function updatePassword($email,$password){
		$query = $this->db->query("UPDATE users SET password = md5('$password') WHERE email = '$email'");
        if($query){
            return true;
        }else{
            return false;
        }
	}
    public function deleteUser($email){
        //First get the todId based on the email
        $query = $this->db->get_where('users',['email'=>$email]);
        $result = $query->row();
        $todId = $result->todId;
        //Then delete user in users,userapps,usercompany - for vizytor
        $tables = array('users', 'userapps', 'usercompany');
        $this->db->where('todId', $todId);
        $this->db->delete($tables);
        return true;
    }
    public function editUser($email,$data){
        $this->db->where('email',$email);
        return $this->db->update('users',$data);
    }
}
?>