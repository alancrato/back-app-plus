@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Estações e Cidades</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                       @foreach($categories as $cat)
                           @if($cat->status == 'active')

                                <strong>
                                    @php
                                        $ctId = $cat->id;
                                        echo $cat->name;
                                        echo ' ';
                                        echo $cat->frequency
                                    @endphp
                                </strong>
                                <br/>

                                @foreach($states as $state)
                                    @if($state->categories->id == $ctId)
                                        {{$state->name}}
                                        <br/>
                                    @endif
                                @endforeach
                                <br/>

                           @endif
                       @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
