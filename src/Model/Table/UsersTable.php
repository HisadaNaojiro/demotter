<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table{

 public function initialize(array $config){
   $this->table('user');
 }

 public function validationDefault(Validator $validator)
   {
       $validator
           ->notEmpty('name','名前を入力してください')
           ->add('name',[
             'isMaxlength' => [
               'rule' => ['maxLength',255],
               'message' => '名前は255字以内で入力してください'
             ]
           ])
           ->notEmpty('email','メールアドレスを入力してください')
           ->add('email',[
              'isMaxlength' =>[
                'rule' =>['maxLength',255],
                'message' > 'メールアドレスは255字以内で入力してください'
              ]
           ])
           ->notEmpty('emailConfirmation','確認用メールアドレスを入力してください')
           ->add('emailConfirmation',[
             'isEqual' =>[
                'rule' => function($emailConfirmation,$data){
                  return ($emailConfirmation === $data['data']['email']);
                },
                'message' => 'メールアドレスが一致しません'
              ]
          ])
           ->notEmpty('password','パスワードを入力してください')
           ->add('password',[
              'isRange' =>[
                'rule' => ['range',6,8],
                'message' => 'パスワードは6文字~8文字以内で入力してください'
              ]
           ])
           ->notEmpty('passwordConfirmation','確認用パスワードを入力してください')
           ->add('passwordConfirmation',[
              'isEqual' =>[
                'rule' =>  function($passwordConfirmation,$data){
                  return ($passwordConfirmation === $data['data']['password']);
                },
                'message' => 'パスワードが一致しません'
              ]
          ]);

       return  $validator;
   }
}
