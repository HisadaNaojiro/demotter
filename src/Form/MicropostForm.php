<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class MicropostForm extends Form
{
    protected function _buildValidator(Validator $validator)
    {

          $validator->notEmpty('content','ツイートを入力してください')
                    ->add('content',[
                      'isMaxlength' => [
                        'rule' => ['maxLength',140],
                        'message' => '140字以内で入力してください'
                      ]
                    ]);
          return  $validator;
    }

    public function getErrors()
    {
      return $this->_errors;
    }
}
