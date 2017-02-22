<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table{

  private $__statusPublic = 1;

 public function initialize(array $config){
   $this->table('user');
 }

 public function getRowById($id)
 {
   $query =  $this->find('all')
                  ->where(['id' => $id,'valid' => $this->__statusPublic]);
   return $query->first();
 }
}
