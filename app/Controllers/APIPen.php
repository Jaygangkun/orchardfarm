<?php

namespace App\Controllers;

use App\Models\PenModel;

class APIPen extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['animal_type']) || $_POST['animal_type'] == '') {
            $missing_fields[] = 'No Found "animal_type" Parameter Or Empty';
        }

        if(!isset($_POST['location']) || $_POST['location'] == '') {
            $missing_fields[] = 'No Found "location" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_pen = new PenModel();

        $pen_id = $model_pen->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "animal_type" => isset($_POST['animal_type']) ? $_POST['animal_type'] : '',
            "location" => isset($_POST['location']) ? $_POST['location'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $pen_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_pen = new PenModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_pen->get_all_data()
        ));
    }
}
