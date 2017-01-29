<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity{

  public function getId()
  {
    return !(empty($this->id))? $this->id : false;
  }

  public function setName($val)
  {
    $this->name = $val;
    return $this;
  }

  public function setEmail($val)
  {
    $this->email = $val;
    return $this;
  }

  public function setPassword($val)
  {
    $this->password = $this->__hashPassword($val);
    return $this;
  }

  private function __hashPassword($password)
  {
     return (new DefaultPasswordHasher)->hash($password);
  }
}
