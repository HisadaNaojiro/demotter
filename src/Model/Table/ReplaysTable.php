<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ReplaysTable extends Table{

  private $__statusPublic = 1;

 public function initialize(array $config){
   $this->table('replay');
 }

 public function getRowsetByMicropostId($micropostId)
 {
   $query =  $this->find('all')
                  ->where(['micropost_id' => $micropostId,'valid' => $this->__statusPublic]);
   return $query->all();
 }
}
