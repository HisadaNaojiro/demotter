<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Model\Entity\Micropost;
use App\Form\MicropostForm;
use Cake\Event\Event;

class AjaxController extends AppController{

  public $uses = ['Microposts'];
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();
	}


	public function addMicropost()
  {
    if(!$this->request->is('ajax')){
      $this->response->statusCode(400);
      return;
    }

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
}
