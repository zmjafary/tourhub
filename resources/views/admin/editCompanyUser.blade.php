@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-2 text-left">
                        <a class="btn btn-info" style="color:#ffffff;"  href="{{ route('home') }}"> Return to Home </a>
                      </div>          
                      <div class="col-10 text-center" style="padding-top: 10px;">
                            <strong> Edit User </strong> 
                      </div>  
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('updateCompanyUser', $user->id) }}" enctype='multipart/form-data'>
                        
                        @csrf

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username }}" autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} <span style="color: red">*</span> </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" autofocus required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} <span style="color: red">*</span> </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="display" class="col-md-4 col-form-label text-md-right">{{ __('Profile Display') }}</label>

                            <div class="col-md-6">
                                <input id="display" type="file" class="form-control{{ $errors->has('display') ? ' is-invalid' : '' }}" name="display" value="{{ old('display') }}" autofocus>

                                @if ($errors->has('display'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('display') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <span style="color: red">*</span> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                <!-- <small id="passwordHelp" class="form-text text-muted"> The password is just visible to the admin only</small> -->

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update User') }}
                                </button>
                            </div>
                        </div> 
                    </form>      
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection