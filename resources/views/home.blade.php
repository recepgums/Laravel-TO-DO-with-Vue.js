@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Yapilacaklar Listem</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="text-right">
                    <a href="{{route('todo.create')}}" class="btn btn-primary">Create</a>
                </div>
                 <div id="app">
                     <example-component>

                     </example-component>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
