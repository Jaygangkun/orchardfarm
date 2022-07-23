<?php 
namespace App\Models;
use CodeIgniter\Model;

class FinancialTransactionModel extends Model
{
    protected $table = 'financial_transactions';
    protected $db;

    public function insert_data($data = array())
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function get_all_data()
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table);
        return $query->getResult();
    }

}