<?php

namespace App\Controllers;

use App\Models\AnimalStatusModel;

class APIAnimalStatus extends BaseController
{
    protected $helpers = ['form', 'global']; 

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

        if(!isset($_POST['reason']) || $_POST['reason'] == '') {
            $missing_fields[] = 'No Found "reason" Parameter Or Empty';
        }

        if(!isset($_POST['date']) || $_POST['date'] == '') {
            $missing_fields[] = 'No Found "date" Parameter Or Empty';
        }

        if(!isset($_POST['weight']) || $_POST['weight'] == '') {
            $missing_fields[] = 'No Found "weight" Parameter Or Empty';
        }

        if(!isset($_POST['sales_price']) || $_POST['sales_price'] == '') {
            $missing_fields[] = 'No Found "sales_price" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_animal_status = new AnimalStatusModel();

        $animal_status_id = $model_animal_status->insert_data(array(
            "tag" => isset($_POST['tag']) ? $_POST['tag'] : '',
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "reason" => isset($_POST['reason']) ? $_POST['reason'] : '',
            "date" => isset($_POST['date']) ? $_POST['date'] : '',
            "weight" => isset($_POST['weight']) ? $_POST['weight'] : '',
            "sales_price" => isset($_POST['sales_price']) ? $_POST['sales_price'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $animal_status_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_animal_status = new AnimalStatusModel();
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_animal_status->get_all_data()
        ));
    }
}
