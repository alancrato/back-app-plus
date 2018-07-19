@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">States and Categories</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                       @foreach($categories as $cat)

                           <strong>
                               @php
                                   $ctId = $cat->id;
                                   echo $ct = $cat->name
                               @endphp
                           </strong>
                           <br/>

                           @foreach($state as $st)
                               @if($st->categories->id == $ctId)
                                   {{$st->name}}
                                   <br/>
                               @endif
                           @endforeach
                           <br/>

                       @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
