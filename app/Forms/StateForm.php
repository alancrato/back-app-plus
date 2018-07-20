<?php

namespace App\Forms;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class StateForm extends Form
{
    public function buildForm()
    {
        $this
        ->add('name', 'text',[
            'rules' => 'required|min:3'
        ])
        ->add('category_id', 'entity', [
            'class' => Category::class,
            'property' => 'name',
            'empty_value' => 'Selecione a Categoria',
            'label' => 'Categoria',
            'rules' => 'nullable|exists:categories,id'
        ])
        ->add('status', 'text',[
            'rules' => 'required'
        ]);

    }
}
