<?php

namespace App\Controllers;

use App\Models\InsuranceModel;

class APIInsurance extends BaseController
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

        if(!isset($_POST['plan_type']) || $_POST['plan_type'] == '') {
            $missing_fields[] = 'No Found "plan_type" Parameter Or Empty';
        }

        if(!isset($_POST['policy_amount']) || $_POST['policy_amount'] == '') {
            $missing_fields[] = 'No Found "policy_amount" Parameter Or Empty';
        }

        if(!isset($_POST['anniversary_date']) || $_POST['anniversary_date'] == '') {
            $missing_fields[] = 'No Found "anniversary_date" Parameter Or Empty';
        }

        if(!isset($_POST['frequency']) || $_POST['frequency'] == '') {
            $missing_fields[] = 'No Found "frequency" Parameter Or Empty';
        }

        if(!isset($_POST['contact_details']) || $_POST['contact_details'] == '') {
            $missing_fields[] = 'No Found "contact_details" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_insurance = new InsuranceModel();

        $insurance_id = $model_insurance->insert_data(array(
            "name" => isset($_POST['name']) ? $_POST['name'] : '',
            "plan_type" => isset($_POST['plan_type']) ? $_POST['plan_type'] : '',
            "policy_amount" => isset($_POST['policy_amount']) ? $_POST['policy_amount'] : '',
            "anniversary_date" => isset($_POST['anniversary_date']) ? $_POST['anniversary_date'] : '',
            "frequency" => isset($_POST['frequency']) ? $_POST['frequency'] : '',
            "contact_details" => isset($_POST['contact_details']) ? $_POST['contact_details'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : ''
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $insurance_id;

        return $this->response->setJson($resp);
    }

    public function list()
    {
        $model_insurance = new InsuranceModel();
        
        return $this->response->setJson(array(
            'success' => true,
            'data' => $model_insurance->get_all_data()
        ));
    }
}
