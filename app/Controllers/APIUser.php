<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserRoleModel;
use Firebase\JWT\JWT;

class APIUser extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function login()
    {
        $key = getenv('JWT_SECRET');
        
        $iat = time(); // current timestamp value
        $exp = $iat + 3600;
  
        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => 'email@email.com',
        );
 
        $token = JWT::encode($payload, $key, 'HS256');
 
        $resp = array(
            'success' => true,
            'token' => $token
        );

        return $this->response->setJson($resp);
    }

    public function signup()
    {
        $resp = [
            'errors' => 'erros',
            'message' => 'Invalid Inputs'
        ];
        // $this->response->setStatusCode(404);
        
        $resp = array(
            'success' => true
        );

        return $this->response->setJson($resp);
    }

    public function forgot_password()
    {
        $resp = array(
            'success' => true
        );
        return $this->response->setJson($resp);
    }

    public function add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['username']) || $_POST['username'] == '') {
            $missing_fields[] = 'No Found "username" Parameter Or Empty';
        }

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['nickname']) || $_POST['nickname'] == '') {
            $missing_fields[] = 'No Found "nickname" Parameter Or Empty';
        }

        if(!isset($_POST['password']) || $_POST['password'] == '') {
            $missing_fields[] = 'No Found "password" Parameter Or Empty';
        }

        if(!isset($_POST['image']) || $_POST['image'] == '') {
            $missing_fields[] = 'No Found "image" Parameter Or Empty';
        }

        if(!isset($_POST['role']) || $_POST['role'] == '') {
            $missing_fields[] = 'No Found "role" Parameter Or Empty';
        }

        if(!isset($_POST['date_joined']) || $_POST['date_joined'] == '') {
            $missing_fields[] = 'No Found "date_joined" Parameter Or Empty';
        }

        if(!isset($_POST['active']) || $_POST['active'] == '') {
            $missing_fields[] = 'No Found "active" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_user = new UserModel();

        $user_id = $model_user->insert_data(array(
            "username" => isset($_POST['username']) ? $_POST['username'] : '',
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "nickname" => isset($_POST['nickname']) ? $_POST['nickname'] : '',
            "password" => isset($_POST['password']) ? $_POST['password'] : '',
            "image" => isset($_POST['image']) ? $_POST['image'] : '',
            "role" => isset($_POST['role']) ? $_POST['role'] : '',
            "joined_at" => isset($_POST['date_joined']) ? $_POST['date_joined'] : '',
            "active" => isset($_POST['active']) ? $_POST['active'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $user_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_user = new UserModel();

        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_user->get_all_data()
        ));
    }

    public function role_add()
    {
        $resp = array(
            'success' => true
        );

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $resp['success'] = false;
            $resp['message'] = 'No Found "name" Parameter Or Empty';
            return $this->response->setJson($resp);
        }

        $model_user_role = new UserRoleModel();

        $user_role_id = $model_user_role->insert_data(array(
            "name" => $_POST['name'],
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $user_role_id;

        return $this->response->setJson($resp);
    }
}
