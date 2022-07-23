<?php

namespace App\Controllers;

use App\Models\BreedModel;

class APIBreed extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['animal_type']) || $_POST['animal_type'] == '') {
            $missing_fields[] = 'No Found "animal_type" Parameter Or Empty';
        }

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['ears']) || $_POST['ears'] == '') {
            $missing_fields[] = 'No Found "ears" Parameter Or Empty';
        }

        if(!isset($_POST['horns']) || $_POST['horns'] == '') {
            $missing_fields[] = 'No Found "horns" Parameter Or Empty';
        }

        if(!isset($_POST['heights']) || $_POST['heights'] == '') {
            $missing_fields[] = 'No Found "heights" Parameter Or Empty';
        }

        if(!isset($_POST['temperament']) || $_POST['temperament'] == '') {
            $missing_fields[] = 'No Found "temperament" Parameter Or Empty';
        }

        if(!isset($_POST['bearded']) || $_POST['bearded'] == '') {
            $missing_fields[] = 'No Found "bearded" Parameter Or Empty';
        }

        if(!isset($_POST['fertility_rate']) || $_POST['fertility_rate'] == '') {
            $missing_fields[] = 'No Found "fertility_rate" Parameter Or Empty';
        }

        if(!isset($_POST['likely_offspring_number']) || $_POST['likely_offspring_number'] == '') {
            $missing_fields[] = 'No Found "likely_offspring_number" Parameter Or Empty';
        }

        if(!isset($_POST['kid_likely_weight']) || $_POST['kid_likely_weight'] == '') {
            $missing_fields[] = 'No Found "kid_likely_weight" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_breed = new BreedModel();

        $breed_id = $model_breed->insert_data(array(
            "animal_type" => isset($_POST['animal_type']) ? $_POST['animal_type'] : '',
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "ears" => isset($_POST['ears']) ? $_POST['ears'] : '',
            "horns" => isset($_POST['horns']) ? $_POST['horns'] : '',
            "heights" => isset($_POST['heights']) ? $_POST['heights'] : '',
            "temperament" => isset($_POST['temperament']) ? $_POST['temperament'] : '',
            "bearded" => isset($_POST['bearded']) ? $_POST['bearded'] : '',
            "fertility_rate" => isset($_POST['fertility_rate']) ? $_POST['fertility_rate'] : '',
            "likely_offspring_number" => isset($_POST['likely_offspring_number']) ? $_POST['likely_offspring_number'] : '',
            "kid_likely_weight" => isset($_POST['kid_likely_weight']) ? $_POST['kid_likely_weight'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $breed_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_breed = new BreedModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_breed->get_all_data()
        ));
    }
}
