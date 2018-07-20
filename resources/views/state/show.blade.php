@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Cidade {{$state->name}}</h3>
            @php $iconEdit = Icon::create('pencil'); @endphp
            {!! Button::primary($iconEdit)->asLinkTo(route('state.edit', ['state' => $state->id])) !!}
            @php $iconDestroy = Icon::create('remove'); @endphp
            {!! Button::danger($iconDestroy)
                ->asLinkTo(route('state.destroy', ['state' => $state->id]))
                ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
            !!}
            @php $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['state.destroy','state' => $state->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]) @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="row">Id</th>
                    <td>{{$state->id}}</td>
                </tr>
                <tr>
                    <th scope="row">Nome</th>
                    <td>{{$state->name}}</td>
                </tr>
                <tr>
                    <th scope="row">Estação</th>
                    <td>{{$state->categories->name}}</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection