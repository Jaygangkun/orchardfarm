<?php

namespace App\Controllers;

use App\Models\AnimalTypeModel;

class APIAnimalType extends BaseController
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

        if(!isset($_POST['gestation_days']) || $_POST['gestation_days'] == '') {
            $missing_fields[] = 'No Found "gestation_days" Parameter Or Empty';
        }

        if(!isset($_POST['adult_months']) || $_POST['adult_months'] == '') {
            $missing_fields[] = 'No Found "adult_months" Parameter Or Empty';
        }

        if(!isset($_POST['kids_months']) || $_POST['kids_months'] == '') {
            $missing_fields[] = 'No Found "kids_months" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(!isset($_POST['image']) || $_POST['image'] == '') {
            $missing_fields[] = 'No Found "image" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_animal_type = new AnimalTypeModel();

        $animal_type_id = $model_animal_type->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "gestation_days" => isset($_POST['gestation_days']) ? $_POST['gestation_days'] : '',
            "adult_months" => isset($_POST['adult_months']) ? $_POST['adult_months'] : '',
            "kids_months" => isset($_POST['kids_months']) ? $_POST['kids_months'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
            "image" => isset($_POST['image']) ? $_POST['image'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $animal_type_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_animal_type = new AnimalTypeModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_animal_type->get_all_data()
        ));
    }
}
