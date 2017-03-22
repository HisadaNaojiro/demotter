<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Replay extends Entity{

  public function getId()
  {
    return !(empty($this->id))? $this->id : false;
  }

  public function getMicropostId()
  {
    return !empty($this->micropost_id)? $this->micropost_id : false;
  }

  public function getUserId()
  {
    return !empty($this->user_id)? $this->user_id : false;
  }

  public function getOtherUserId()
  {
    return !empty($this->other_user_id)? $this->other_user_id : false;
  }

  public function setContent($val)
  {
    $this->content = $val;
    return $this;
  }

  public function setMicropostId($val)
  {
    $this->micropost_id = $val;
    return $this;
  }
  
  public function setUserId($val)
  {
    $this->user_id = $val;
    return $this;
  }

  public function setOtherUserId($val)
  {
    $this->other_user_id = $val;
    return $this;
  }

  public function setTimeStamp()
  {
    $date = date('Y-m-d H:i:s');
    $this->created = $date;
    $this->modified = $date;

    return $this;
  }

  public function setUserName($val)
  {
    $this->user_name = $val;
    return $this;
  }


}
