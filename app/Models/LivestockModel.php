<?php 
namespace App\Models;
use CodeIgniter\Model;

class LivestockModel extends Model
{
    protected $table = 'livestocks';
    protected $db;

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->db = \Config\Database::connect();
    //     // OR $this->db = db_connect();
    // }

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

    public function get_offspring_data($ptag)
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table . ' WHERE father_tag="'.$ptag.'" OR mother_tag="'.$ptag.'"');
        return $query->getResult();
    }
}