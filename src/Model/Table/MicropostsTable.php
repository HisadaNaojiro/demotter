<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class MicropostsTable extends Table{

  private $__statusPublic = 1;

 public function initialize(array $config){
   $this->table('micropost');
 }

 public function getRowsetByUserId($id)
 {
   $query =  $this->find('all')
                  ->where(['user_id' => $id,'valid' => $this->__statusPublic])
                  ->order(['id' => 'DESC']);
   return $query->all();
 }
}
