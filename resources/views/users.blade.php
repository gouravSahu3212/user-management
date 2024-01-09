@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container text-center">
    <div class="row">
        @foreach($users as $user)
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/'.$user->profile_path) }}" alt="Profile Photo" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$user->fname}} {{$user->lname}}</h5>
                        <p class="card-text">{{$user->email}}</p>
                        <a href="{{ route('edit-user-form', ['user_id' => $user->id]) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('delete-user-form', ['user_id' => $user->id]) }}" class="btn btn-danger">Delete</a>
                        <a href="{{ route('reset-password-form', ['user_id' => $user->id]) }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{$users->links()}}
</div>
@endsection
