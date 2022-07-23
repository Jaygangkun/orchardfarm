<?php

namespace App\Controllers;

use App\Models\FarmModel;

class APIFarm extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function profile()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['code']) || $_POST['code'] == '') {
            $missing_fields[] = 'No Found "code" Parameter Or Empty';
        }

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['address']) || $_POST['address'] == '') {
            $missing_fields[] = 'No Found "address" Parameter Or Empty';
        }

        if(!isset($_POST['contact_name']) || $_POST['contact_name'] == '') {
            $missing_fields[] = 'No Found "contact_name" Parameter Or Empty';
        }

        if(!isset($_POST['contact_phone']) || $_POST['contact_phone'] == '') {
            $missing_fields[] = 'No Found "contact_phone" Parameter Or Empty';
        }

        if(!isset($_POST['email']) || $_POST['email'] == '') {
            $missing_fields[] = 'No Found "email" Parameter Or Empty';
        }

        if(!isset($_POST['website']) || $_POST['website'] == '') {
            $missing_fields[] = 'No Found "website" Parameter Or Empty';
        }

        if(!isset($_POST['location_lat']) || $_POST['location_lat'] == '') {
            $missing_fields[] = 'No Found "location_lat" Parameter Or Empty';
        }

        if(!isset($_POST['location_lng']) || $_POST['location_lng'] == '') {
            $missing_fields[] = 'No Found "location_lng" Parameter Or Empty';
        }

        if(!isset($_POST['image']) || $_POST['image'] == '') {
            $missing_fields[] = 'No Found "image" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_farm = new FarmModel();

        $farm_id = $model_farm->insert_data(array(
            "code" => isset($_POST['code']) ? $_POST['code'] : '',
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "address" => isset($_POST['address']) ? $_POST['address'] : '',
            "contact_name" => isset($_POST['contact_name']) ? $_POST['contact_name'] : '',
            "contact_phone" => isset($_POST['contact_phone']) ? $_POST['contact_phone'] : '',
            "email" => isset($_POST['email']) ? $_POST['email'] : '',
            "website" => isset($_POST['website']) ? $_POST['website'] : '',
            "location_lat" => isset($_POST['location_lat']) ? $_POST['location_lat'] : '',
            "location_lng" => isset($_POST['location_lng']) ? $_POST['location_lng'] : '',
            "image" => isset($_POST['image']) ? $_POST['image'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $farm_id;

        return $this->response->setJson($resp);
    }

}
