<?php 
namespace App\Models;
use CodeIgniter\Model;

class FarmModel extends Model
{
    protected $table = 'farms';
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