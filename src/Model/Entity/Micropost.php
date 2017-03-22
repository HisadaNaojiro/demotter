<?php

namespace App\Model\Entity;

use Cake\ORM\TableRegistry;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Micropost extends Entity{

  public function getId()
  {
    return !(empty($this->id))? $this->id : false;
  }

  public function getContent()
  {
    return !empty($this->content)? $this->content : false;
  }

  public function getUserId()
  {
    return !empty($this->user_id)? $this->user_id : false;
  }

  public function getUserName()
  {
    $UserRow = TableRegistry::get('Users')->getRowById($this->getUserId());
    return $UserRow->getName();
  }

  public function setContent($val)
  {
    $this->content = $val;
    return $this;
  }

  public function setTimeStamp()
  {
    $date = date('Y-m-d H:i:s');
    $this->created = $date;
    $this->modified = $date;

    return $this;
  }

  public function setUserId($val)
  {
    $this->user_id = $val;
    return $this;
  }


}
