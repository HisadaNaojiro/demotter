<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Micropost;
use App\Form\MicropostForm;
use App\Form\ReplayForm;
use Cake\Event\Event;

class AjaxController extends AppController{

  public $uses = ['Microposts'];
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();

    if(!$this->request->is('ajax')){
      $this->response->statusCode(400);
      return;
    }
	}
  public function showMicropost()
  {

    $ReplayRowset = TableRegistry::get('Replays')->getRowsetByMicropostId($this->request->data['micropost_id']);
    foreach($ReplayRowset as $key => $ReplayRow){
      $ReplayRow->setUserName(TableRegistry::get('Users')->getRowById($ReplayRow->getUserId())->getName());
    }
    $this->viewClass = 'JSON';
    $this->set('ReplayRowset',$ReplayRowset);
    $this->set('_serialize',['ReplayRowset']);
  }

	public function addMicropost()
  {
    $formData = $this->request->data;
    $Micropost = TableRegistry::get('Microposts');
    $MicropostForm = new MicropostForm;

    if(!$MicropostForm->validate($formData)){
      $this->viewClass = 'JSON';
      $this->set('Errors',$MicropostForm->getErrors());
      $this->set('_serialize',['Errors']);
      $this->response->statusCode(500);
      return;
    }

    $NewMicropostRow = $Micropost->newEntity()
                              ->setContent($formData['content'])
                              ->setUserId($formData['user_id'])
                              ->setTimeStamp();
    $MicropostRow = $Micropost->save($NewMicropostRow);
    $MicropostRow['user_name'] = TableRegistry::get('Users')->getRowById($MicropostRow->getUserId())->getName();
    $this->viewClass = 'JSON';
    $this->set('MicropostRow',$MicropostRow);
    $this->set('_serialize',['MicropostRow']);
  }

  public function addReplay()
  {
    $formData = $this->request->data['Replay'];
    $Replay = TableRegistry::get('Replays');
    $ReplayForm = new ReplayForm;

    if(!$ReplayForm->validate($formData)){
      $this->viewClass = 'JSON';
      $this->set('Errors',$ReplayForm->getErrors());
      $this->set('_serialize',['Errors']);
      $this->response->statusCode(500);
      return;
    }

    $NewReplayRow = $Replay->newEntity()
                              ->setContent($formData['content'])
                              ->setUserId($formData['user_id'])
                              ->setOtherUserId($formData['other_user_id'])
                              ->setMicropostId($formData['micropost_id'])
                              ->setTimeStamp();
    $ReplayRow = $Replay->save($NewReplayRow);
    $this->viewClass = 'JSON';
    $this->set('status','OK');
    $this->set('_serialize',['status']);
  }
}
