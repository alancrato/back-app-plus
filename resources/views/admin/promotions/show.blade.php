@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Estação {{$promotion->name}}</h3>
                @php $iconEdit = Icon::create('pencil'); @endphp
                {!! Button::primary($iconEdit)->asLinkTo(route('admin.promotions.edit', ['promotion' => $promotion->id])) !!}
                @php $iconDestroy = Icon::create('remove'); @endphp
                {!! Button::danger($iconDestroy)
                    ->asLinkTo(route('admin.promotions.destroy', ['promotion' => $promotion->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit();"])
                !!}
                @php $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['admin.promotions.destroy','promotion' => $promotion->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]) @endphp
            {!! form($formDelete) !!}
            <br/><br/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$promotion->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$promotion->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Status</th>
                        <td>{{$promotion->status}}</td>
                    </tr>
                    <tr>
                </thead>
            </table>
        </div>
    </div>
@endsection