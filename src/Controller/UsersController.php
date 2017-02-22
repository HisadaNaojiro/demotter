<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\UserForm;
use Cake\Event\Event;

class UsersController extends AppController{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['add','logout']);
		$this->set('currentUserRow',$this->Users->getRowById($this->Auth->user()['id']));
	}

	public function login()
	{
		if(!$this->request->is('post')){
			return $this->render();
		}
		$user = $this->Auth->identify();

		if(!$user){
			$this->Flash->error('ニックネームかパスワードが間違っています',['key' =>'auth']);
			return $this->render();
		}

		$this->Auth->setUser($user);
		$this->redirect($this->Auth->redirectUrl());
	}

	public function logout()
	{
		$this->redirect($this->Auth->logout());
	}

	public function index()
	{
		$this->set('MicropostRowset',TableRegistry::get('Microposts')->getRowsetByUserId($this->Auth->user()['id']));
	}

	public function add()
	{
		$User = new UserForm;
		$this->set('User',$User);

		if(!$this->request->is('post')){
			return $this->render();
		}
		$formData = $this->request->data;

		if(!$User->validate($formData)){
			return $this->render();
		}
		$tableUsers = TableRegistry::get('Users');
		$UserRow = 	$this->Users->newEntity()
											->setName($formData['name'])
											->setEmail($formData['email'])
											->setPassword($formData['password'])
											->setTimeStamp();
		if(!$tableUsers->save($UserRow)){
			throw new InternalErrorException();
		}

		$this->Auth->setUser($UserRow);
		$this->redirect($this->Auth->redirectUrl());
	}
}
