@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <h3>Listagem de Cidades</h3>
            {!! Button::primary('Nova Cidade')->asLinkTo(route('state.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($state->items())
             ->callback('Ações', function ($field,$state){
                    $linkEdit = route('state.edit',['state' => $state->id]);
                    $linkShow = route('state.show',['state' => $state->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).' | '.
                           Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })

            !!}
            {!! $state->links() !!}
        </div>
    </div>
@endsection
