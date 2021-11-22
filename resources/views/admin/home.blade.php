@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Yapilacaklar Listesi</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{route('admin.home')}}" method="get">
                            <div class="row my-4">

                                <div class="col-8 text-center">
                                    <input type="text" name="search" placeholder="Arama..." class="form-control">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary"> Ara</button>
                                </div>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($todos as $todo)
                                <tr>
                                    <th scope="row">{{$todo->id }}</th>
                                    <td>{{$todo->user->name}}</td>
                                    <td>{{$todo->content}}</td>
                                </tr>
                            @empty
                            @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="float-right mt-4">
                    {{ $todos->appends($_GET)->links("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>

@endsection
