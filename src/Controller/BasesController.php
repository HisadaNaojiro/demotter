<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\UserForm;
use Cake\Event\Event;

class TestController extends AppController{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow();
    $this->viewBuilder()->layout('default_lesson');
	}

	public function index()
  {
		$this->set('title','レッスン一覧');
  }

	public function base()
	{
		$this->set('title','PHP初期設定');
	}

	public function base1()
	{
		$this->set('title','PHP基礎1');
		$this->render('Base/base1');
	}

	public function base2()
	{
		$this->set('title','PHP基礎2');
		$this->render('Base/base2');
	}

	public function base3()
	{
		$this->set('title','PHP基礎3');
		$this->render('Base/base3');
	}

	public function base4()
	{
		$this->set('title','PHP基礎4');
		$this->render('Base/base4');
	}
}
