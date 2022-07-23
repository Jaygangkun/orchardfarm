<?php

namespace App\Controllers;

use App\Models\MedicineModel;

class APIMedicine extends BaseController
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

        if(!isset($_POST['description']) || $_POST['description'] == '') {
            $missing_fields[] = 'No Found "description" Parameter Or Empty';
        }

        if(!isset($_POST['type']) || $_POST['type'] == '') {
            $missing_fields[] = 'No Found "type" Parameter Or Empty';
        }

        if(!isset($_POST['quantity_per_dose']) || $_POST['quantity_per_dose'] == '') {
            $missing_fields[] = 'No Found "quantity_per_dose" Parameter Or Empty';
        }

        if(!isset($_POST['frequency']) || $_POST['frequency'] == '') {
            $missing_fields[] = 'No Found "frequency" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_medicine = new MedicineModel();

        $medicine_id = $model_medicine->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "description" => isset($_POST['description']) ? $_POST['description'] : '',
            "type" => isset($_POST['type']) ? $_POST['type'] : '',
            "quantity_per_dose" => isset($_POST['quantity_per_dose']) ? $_POST['quantity_per_dose'] : '',
            "frequency" => isset($_POST['frequency']) ? $_POST['frequency'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : ''
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $medicine_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_medicine = new MedicineModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_medicine->get_all_data()
        ));
    }
}
