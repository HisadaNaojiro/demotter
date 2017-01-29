<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\UserForm;

class UsersController extends AppController{

	public function index()
	{
		
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
											->setPassword($formData['password']);
		if(!$tableUsers->save($UserRow)){
			throw new InternalErrorException;
		}
		$this->request->session()->write('User.id', $UserRow->getId());
		return $this->redirect(['controller' => 'users' ,'action' => 'index']);
	}
}
