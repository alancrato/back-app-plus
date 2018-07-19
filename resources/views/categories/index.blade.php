@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <h3>Listagem de Categorias</h3>
            {!! Button::primary('Nova Categoria')->asLinkTo(route('categories.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($categories->items())
             ->callback('Ações', function ($field,$categories){
                    $linkEdit = route('categories.edit',['categories' => $categories->id]);
                    $linkShow = route('categories.show',['categories' => $categories->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).' | '.
                           Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })

            !!}
        </div>
    </div>
@endsection
