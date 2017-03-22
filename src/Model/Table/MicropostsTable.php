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
                  ->where(['microposts.user_id' => $id,'microposts.valid' => $this->__statusPublic])
                  ->order(['microposts.id' => 'DESC']);
   return $query->all();
 }
}
