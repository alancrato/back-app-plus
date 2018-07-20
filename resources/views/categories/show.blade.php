@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Estação {{$category->name}}</h3>
                @php $iconEdit = Icon::create('pencil'); @endphp
                {!! Button::primary($iconEdit)->asLinkTo(route('categories.edit', ['category' => $category->id])) !!}
                @php $iconDestroy = Icon::create('remove'); @endphp
                {!! Button::danger($iconDestroy)
                    ->asLinkTo(route('categories.destroy', ['category' => $category->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
                !!}
                @php $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['categories.destroy','category' => $category->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]) @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$category->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$category->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Frequência</th>
                        <td>{{$category->frequency}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Stream</th>
                        <td>{{$category->stream}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>{{$category->status}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Ionic Page</th>
                        <td>{{$category->page}}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection