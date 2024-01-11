@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('edit-user', ['user_id'=>$user->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->fname }}" required autocomplete="fname" autofocus>

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="lname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ $user->lname }}" required autocomplete="lname">

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select id="country" class="form-select @error('country') is-invalid @enderror" name="country" aria-label="Country" required>
                                    @forEach($countries as $country)
                                        <option value="{{$country->id}}" @if($country->id==$user->country) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="state" class="col-md-4 col-form-label text-md-end">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" class="form-select @error('state') is-invalid @enderror" name="state" aria-label="State" required>
                                    @forEach($states as $state)
                                        <option value="{{$state->id}}" @if($state->id==$user->state) selected @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="zip" class="col-md-4 col-form-label text-md-end">{{ __('Zip') }}</label>

                            <div class="col-md-6">
                                <input id="zip" type="number" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ $user->zip }}" required autocomplete="zip">

                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="zip" class="col-md-4 col-form-label text-md-end">{{ __('Area of interest') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="reading" id="reading" @if(in_array("reading",$interests)) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Reading
                                    </label>
                                </div>
                                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="writing" id="writing" @if(in_array("writing",$interests)) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Writing
                                    </label>
                                </div>
                                        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="playing" id="playing" @if(in_array("playing",$interests)) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Playing
                                    </label>
                                </div>
                                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="travelling" id="travelling" @if(in_array("travelling",$interests)) checked @endif>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Travelling
                                    </label>
                                </div>

                                @error('interest[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profile" class="col-md-4 col-form-label text-md-end">{{ __('Profile picture') }}</label>

                            <div class="col-md-6">
                                <img id="profile_preview" src="{{ asset('storage/'.$user->profile_path) }}" alt="Profile Photo" width="60" height="48">
                                <input id="profile_photo" type="file" accept="image/*" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo">

                                @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const country_select = document.getElementById('country');
    const state_select = document.getElementById('state');
    const city_select = document.getElementById('city');
    const profile_input = document.getElementById('profile_photo');

    function getStates(country_id) {
        axios({
            method: 'get',
            url: "{{route('get-states')}}",
            params: {country_id: country_id}
        })
        .then((response)=> {
            // console.log(response.data);
            states = response.data;
            states.forEach(state => {
                state_select.innerHTML += `<option value="${state.id}" >${state.name}</option>`;
            });
        });
    }

    /*function getCities(state_id) {
        axios({
            method: 'get',
            url: "{{route('get-cities')}}",
            params: {state_id: state_id}
        })
        .then((response)=> {
            // console.log(response.data);
            cities = response.data;
            cities.forEach(city => {
                city_select.innerHTML += `<option value="${city.id}" >${city.name}</option>`;
            });
        });
    } */
    
    country_select.addEventListener("change", ()=> {
        city_select.innerHTML = "";
        state_select.innerHTML = "";

        country_id = country_select.value;
        if(country_id!=""){
            getStates(country_id);
        }
    });
    
    /* state_select.addEventListener("change", ()=> {
        state_id = state_select.value;
        getCities(state_id);
    }); */

    profile_input.addEventListener("change", () => {
        const [file] = profile_input.files
        let profile_preview = document.getElementById('profile_preview')
        if (file) {
            profile_preview.src = URL.createObjectURL(file)
        }
    });
</script>
@endsection
