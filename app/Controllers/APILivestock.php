<?php

namespace App\Controllers;

use App\Models\LivestockSourceModel;
use App\Models\LivestockModel;

class APILivestock extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function source_add()
    {
        $resp = array(
            'success' => true
        );

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $resp['success'] = false;
            $resp['message'] = 'No Found "name" Parameter Or Empty';
            return $this->response->setJson($resp);
        }

        $model_livestock_source = new LivestockSourceModel();

        $livestock_source_id = $model_livestock_source->insert_data(array(
            "name" => $_POST['name'],
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $livestock_source_id;

        return $this->response->setJson($resp);
    }

    public function add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['tag']) || $_POST['tag'] == '') {
            $missing_fields[] = 'No Found "tag" Parameter Or Empty';
        }

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['image']) || $_POST['image'] == '') {
            $missing_fields[] = 'No Found "image" Parameter Or Empty';
        }

        if(!isset($_POST['type']) || $_POST['type'] == '') {
            $missing_fields[] = 'No Found "type" Parameter Or Empty';
        }

        if(!isset($_POST['breed']) || $_POST['breed'] == '') {
            $missing_fields[] = 'No Found "breed" Parameter Or Empty';
        }

        if(!isset($_POST['stage']) || $_POST['stage'] == '') {
            $missing_fields[] = 'No Found "stage" Parameter Or Empty';
        }

        if(!isset($_POST['gender']) || $_POST['gender'] == '') {
            $missing_fields[] = 'No Found "gender" Parameter Or Empty';
        }

        if(!isset($_POST['date_of_birth']) || $_POST['date_of_birth'] == '') {
            $missing_fields[] = 'No Found "date_of_birth" Parameter Or Empty';
        }

        if(!isset($_POST['age']) || $_POST['age'] == '') {
            $missing_fields[] = 'No Found "age" Parameter Or Empty';
        }

        if(!isset($_POST['weight']) || $_POST['weight'] == '') {
            $missing_fields[] = 'No Found "weight" Parameter Or Empty';
        }

        if(!isset($_POST['source']) || $_POST['source'] == '') {
            $missing_fields[] = 'No Found "source" Parameter Or Empty';
        }

        if(!isset($_POST['mother_tag']) || $_POST['mother_tag'] == '') {
            $missing_fields[] = 'No Found "mother_tag" Parameter Or Empty';
        }

        if(!isset($_POST['father_tag']) || $_POST['father_tag'] == '') {
            $missing_fields[] = 'No Found "father_tag" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_livestock = new LivestockModel();

        $livestock_id = $model_livestock->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "tag" => isset($_POST['tag']) ? $_POST['tag'] : '',
            "image" => isset($_POST['image']) ? $_POST['image'] : '',
            "type" => isset($_POST['type']) ? $_POST['type'] : '',
            "breed" => isset($_POST['breed']) ? $_POST['breed'] : '',
            "stage" => isset($_POST['stage']) ? $_POST['stage'] : '',
            "gender" => isset($_POST['gender']) ? $_POST['gender'] : '',
            "date_of_birth" => isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '',
            "age" => isset($_POST['age']) ? $_POST['age'] : '',
            "weight" => isset($_POST['weight']) ? $_POST['weight'] : '',
            "source" => isset($_POST['source']) ? $_POST['source'] : '',
            "mother_tag" => isset($_POST['mother_tag']) ? $_POST['mother_tag'] : '',
            "father_tag" => isset($_POST['father_tag']) ? $_POST['father_tag'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $livestock_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_livestock = new LivestockModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_livestock->get_all_data()
        ));
    }

    public function offspring_list()
    {
        $resp = array(
            'success' => true
        );
        
        if(!isset($_POST['tag']) || $_POST['tag'] == '') {
            $resp['success'] = false;
            $resp['message'] = 'No Found "tag" Parameter Or Empty';
            return $this->response->setJson($resp);
        }

        $model_livestock = new LivestockModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_livestock->get_offspring_data($_POST['tag'])
        ));
    }
}
