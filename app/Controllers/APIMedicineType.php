<?php

namespace App\Controllers;

use App\Models\MedicineTypeModel;

class APIMedicineType extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function add()
    {
        $resp = array(
            'success' => true
        );

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $resp['success'] = false;
            $resp['message'] = 'No Found "name" Parameter Or Empty';
            return $this->response->setJson($resp);
        }

        $model_medicine_type = new MedicineTypeModel();

        $medicine_type_id = $model_medicine_type->insert_data(array(
            "name" => $_POST['name'],
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $medicine_type_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_medicine_type = new MedicineTypeModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_medicine_type->get_all_data()
        ));
    }
}
