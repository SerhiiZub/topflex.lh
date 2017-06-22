<?php
namespace reflectionUtil\logger;

//use phpDocumentor\Reflection\Types\This;
use reflectionUtil\logger\sqllite\Db;
/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 13.06.2017
 * Time: 20:07
 */
class Logger
{
    private $db;
    private $tableName;
    private $data = array();

    public function __construct()
    {
        $this->db = new Db;
        $this->tableName();
        $this->atrFill();
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->data)){
            return $this->data[$name] = $value;
        }
        return null;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

/*        $trace = debug_backtrace();
        trigger_error(
            'Неопределенное свойство в __get(): ' . $name .
            ' в файле ' . $trace[0]['file'] .
            ' на строке ' . $trace[0]['line'],
            E_USER_NOTICE);*/
        return null;
    }

    protected function tableName(){
        return $this->tableName = 'log';
    }

    protected function atrFill(){
        $tablesquery = $this->db->query("PRAGMA table_info($this->tableName);");

        while ($table = $tablesquery->fetchArray(SQLITE3_ASSOC)) {
            $this->data[$table['name']] = null;
        }
    }
    
    public function find(){
        
    }
    
    public function findAll(){
        $sql = "SELECT * FROM $this->tableName ";
        $results = $this->db->query($sql);
        while ($row = $results->fetchArray()) {
            $data[] = $row;
        }
        return !empty($data) ? $data : array();
    }

    public function save()
    {
        $sql = "INSERT INTO $this->tableName ";
        $k = 0;
        $column = '';
        $value = '';
        foreach ($this->data as $key => $val){
            if (empty($val)) continue;
            if($k++ != 0){
                $column .= ', ';
                $value .= ', ';
            }
            $column .= "$key";
            $value .= "$val";
        }
        $sql .= "($column) VALUES ($value);";
        $this->db->exec($sql);
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }

    public function search()
    {

    }
}

//$log = new Logger();