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
            <div class="col-md-4 col-sm-4 col-6 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/'.$user->profile_path) }}" alt="Profile Photo" class="card-img-top" alt="..." height="270">
                    <div class="card-body">
                        <h5 class="card-title">{{$user->fname}} {{$user->lname}}</h5>
                        <p class="card-text">{{$user->email}}</p>
                        <a href="{{ route('edit-user-form', ['user_id' => $user->id]) }}" class="btn btn-warning" title="Edit user">Edit</a>
                        <button type="button" class="btn btn-danger dltUsrBtn" onclick="deleteUser(this);" data-user-id="{{$user->id}}" data-user-fname="{{$user->fname}}" data-user-lname="{{$user->lname}}" title="Delete user">Delete</button>
                        <a href="{{ route('reset-password-form', ['user_id' => $user->id]) }}" class="btn btn-secondary" title="Reset password">Reset</a>
                        <form method="post" action="{{ route('delete-user') }}" id="deleteUser{{$user->id}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{$users->links()}}
</div>
<script>
    function deleteUser(elem) {
        let user_id = elem.dataset.userId;
        let user_fname = elem.dataset.userFname;
        let user_lname = elem.dataset.userLname;
        if(confirm(`Are you sure you want to delete user ${user_fname} ${user_lname}?`)){
            let delete_form = document.getElementById(`deleteUser${user_id}`);
            delete_form.submit();
        }
        
    }
</script>
@endsection
