<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\UserForm;
use Cake\Event\Event;

class LessonsController extends AppController{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();
    $this->viewBuilder()->layout('default_lesson');
	}

	public function index()
	{

	}

	public function lesson0()
	{

	}

	public function lesson4()
	{
		$this->set('title','レッスン4');
	}

	public function lesson5()
	{
		$this->set('title','レッスン5');
	}
}
