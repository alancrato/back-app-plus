<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PromotionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'rules' => 'required|min:3'
            ])
            ->add('card', 'file',[
                'rules' => 'image'
            ])
            ->add('status', 'text',[
                'rules' => 'required'
            ]);
    }
}
