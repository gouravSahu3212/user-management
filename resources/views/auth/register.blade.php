@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="fname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus>

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
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname') }}" required autocomplete="lname">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select id="country" class="form-select @error('country') is-invalid @enderror" name="country" aria-label="Country" required>
                                    <option value="" selected>Select country</option>
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
                                    <!-- <option value="" selected>Select State</option> -->
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
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city"value="{{ old('city') }}" required autocomplete="city">

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
                                <input id="zip" type="number" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}" required autocomplete="zip">

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
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="reading" id="reading">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Reading
                                    </label>
                                </div>
                                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="writing" id="writing">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Writing
                                    </label>
                                </div>
                                        
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="playing" id="playing">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Playing
                                    </label>
                                </div>
                                    
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="interest[]" value="travelling" id="travelling">
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
                                <img id="profile_preview" alt="Profile Photo" width="60" height="48">
                                <input id="profile_photo" type="file" accept="image/*" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo" required>

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
                                    {{ __('Register') }}
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

    function getCountries() {
        axios({
            method: 'get',
            url: "{{route('get-countries')}}",
        })
        .then((response)=> {
            // console.log(response.data);
            countries = response.data;
            countries.forEach(country => {
                country_select.innerHTML += `<option value="${country.id}" >${country.name}</option>`;
            });
        });
    }

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

    /* function getCities(state_id) {
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

    document.addEventListener("DOMContentLoaded", function () {
        getCountries(); // Call the function to load countries when the page is loaded
    });

</script>
@endsection
