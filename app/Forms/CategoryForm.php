<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    public function buildForm()
    {
        $this
        ->add('name', 'text',[
            'rules' => 'required|min:3'
        ])
        ->add('frequency', 'text',[
            'rules' => 'required'
        ])
        ->add('stream', 'text', [
            'rules' => 'min:3'
        ])
        ->add('card_active', 'file',[
            'rules' => 'image'
        ])
        ->add('card_inactive', 'file',[
            'rules' => 'image'
        ])
        ->add('status', 'text',[
            'rules' => 'required'
        ])
        ->add('icon', 'file',[
            'rules' => 'image'
        ])
        ->add('page', 'text');

    }
}
