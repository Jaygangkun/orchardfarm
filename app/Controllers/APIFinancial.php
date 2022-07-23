<?php

namespace App\Controllers;

use App\Models\FinancialCategoryModel;
use App\Models\FinancialTransactionModel;

class APIFinancial extends BaseController
{
    protected $helpers = ['form', 'global']; 

    public function category_add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['code']) || $_POST['code'] == '') {
            $missing_fields[] = 'No Found "code" Parameter Or Empty';
        }

        if(!isset($_POST['short_name']) || $_POST['short_name'] == '') {
            $missing_fields[] = 'No Found "short_name" Parameter Or Empty';
        }

        if(!isset($_POST['category']) || $_POST['category'] == '') {
            $missing_fields[] = 'No Found "category" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_financial_category = new FinancialCategoryModel();

        $financial_category_id = $model_financial_category->insert_data(array(
            "code" => isset($_POST['code']) ? $_POST['code'] : '',
            "short_name" => isset($_POST['short_name']) ? $_POST['short_name'] : '',
            "category" => isset($_POST['category']) ? $_POST['category'] : ''
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $financial_category_id;

        return $this->response->setJson($resp);
    }

    public function transaction_add()
    {
        $resp = array(
            'success' => true
        );
        
        $missing_fields = array();
        if(!isset($_POST['date']) || $_POST['date'] == '') {
            $missing_fields[] = 'No Found "date" Parameter Or Empty';
        }

        if(!isset($_POST['category']) || $_POST['category'] == '') {
            $missing_fields[] = 'No Found "category" Parameter Or Empty';
        }

        if(!isset($_POST['amount']) || $_POST['amount'] == '') {
            $missing_fields[] = 'No Found "amount" Parameter Or Empty';
        }

        if(!isset($_POST['receipt_no']) || $_POST['receipt_no'] == '') {
            $missing_fields[] = 'No Found "receipt_no" Parameter Or Empty';
        }

        if(!isset($_POST['comments']) || $_POST['comments'] == '') {
            $missing_fields[] = 'No Found "comments" Parameter Or Empty';
        }

        if(count($missing_fields) > 0) {
            $resp['success'] = false;
            $resp['message'] = implode(",", $missing_fields);
            return $this->response->setJson($resp);
        }

        $model_financial_transaction = new FinancialTransactionModel();

        $financial_transaction_id = $model_financial_transaction->insert_data(array(
            "date" => isset($_POST['date']) ? $_POST['date'] : '',
            "category" => isset($_POST['category']) ? $_POST['category'] : '',
            "amount" => isset($_POST['amount']) ? $_POST['amount'] : '',
            "receipt_no" => isset($_POST['receipt_no']) ? $_POST['receipt_no'] : '',
            "comments" => isset($_POST['comments']) ? $_POST['comments'] : '',
        ));

        $resp['message'] = 'Added Successfully';
        $resp['id'] = $financial_transaction_id;

        return $this->response->setJson($resp);
    }
}
