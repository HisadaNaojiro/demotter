<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class UserForm extends Form
{


    protected function _buildValidator(Validator $validator)
    {

          $validator
              ->notEmpty('name','名前を入力してください')
              ->add('name',[
                'isMaxlength' => [
                  'rule' => ['maxLength',100],
                  'message' => '名前は100字以内で入力してください'
                ]
              ])
              ->notEmpty('email','メールアドレスを入力してください')
              ->add('email',[
                 'isMaxlength' =>[
                   'rule' =>['maxLength',255],
                   'message' > 'メールアドレスは255字以内で入力してください'
                 ],
                 'isProperAddress' =>[
                   'rule' =>['email',true],
                   'message' => 'メールアドレスの形式が正しくありません'
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
                   'rule' => function($password){
                     $char_length  = mb_strlen($password);
                     return ($char_length  >= 6 && $char_length  <= 8);
                   },
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
