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
        ]);
    }
}
