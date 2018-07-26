@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <h3>Lisagem da Programação</h3>
            {!! Button::primary('Nova Programação')->asLinkTo(route('promotions.create')) !!}
        </div>
        <div class="row">
            {!! Table::withContents($promotions->items())
             ->callback('Ações', function ($field,$promotions){
                    $linkEdit = route('promotions.edit',['promotions' => $promotions->id]);
                    $linkShow = route('promotions.show',['promotions' => $promotions->id]);
                    return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit).' | '.
                           Button::link(Icon::create('remove'))->asLinkTo($linkShow);
                })

            !!}
        </div>
    </div>
@endsection
