<?php
namespace reflectionUtil\logger;

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

    public function __construct()
    {
        $this->db = new Db;
    }
    
    public function find(){
        
    }
    
    public function findAll(){
        
    }

    public function save()
    {
        
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }

    public function serch()
    {
        
    }
}