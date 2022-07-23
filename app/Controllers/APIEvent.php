<?php

namespace App\Controllers;

use App\Models\EventGroupModel;
use App\Models\EventIndividualModel;
use App\Models\EventTypeModel;

class APIEvent extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function group_add()
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

        if(!isset($_POST['type']) || $_POST['type'] == '') {
            $missing_fields[] = 'No Found "type" Parameter Or Empty';
        }

        if(!isset($_POST['start_date']) || $_POST['start_date'] == '') {
            $missing_fields[] = 'No Found "start_date" Parameter Or Empty';
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

        $model_event_group = new EventGroupModel();

        $event_group_id = $model_event_group->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "animal_type" => isset($_POST['animal_type']) ? $_POST['animal_type'] : '',
            "type" => isset($_POST['type']) ? $_POST['type'] : '',
            "start_date" => isset($_POST['start_date']) ? $_POST['start_date'] : '',
            "frequency" => isset($_POST['frequency']) ? $_POST['frequency'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $event_group_id;

        return $this->response->setJson($resp);
    }

    public function individual_add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();

        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $missing_fields[] = 'No Found "name" Parameter Or Empty';
        }

        if(!isset($_POST['tag']) || $_POST['tag'] == '') {
            $missing_fields[] = 'No Found "tag" Parameter Or Empty';
        }

        if(!isset($_POST['type']) || $_POST['type'] == '') {
            $missing_fields[] = 'No Found "type" Parameter Or Empty';
        }

        if(!isset($_POST['date']) || $_POST['date'] == '') {
            $missing_fields[] = 'No Found "date" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_event_individual = new EventIndividualModel();

        $event_individual_id = $model_event_individual->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "tag" => isset($_POST['tag']) ? $_POST['tag'] : '',
            "type" => isset($_POST['type']) ? $_POST['type'] : '',
            "date" => isset($_POST['date']) ? $_POST['date'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $event_individual_id;

        return $this->response->setJson($resp);
    }

    public function type_add()
    {
        $resp = array(
            'success' => true
        );
        
        if(!isset($_POST['name']) || $_POST['name'] == '') {
            $resp['success'] = false;
            $resp['message'] = 'No Found "name" Parameter Or Empty';
            return $this->response->setJson($resp);
        }

        $model_event_type = new EventTypeModel();
        $event_type_id = $model_event_type->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $event_type_id;

        return $this->response->setJson($resp);
    }
}
