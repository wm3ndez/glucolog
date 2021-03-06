@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('auth.profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" value=""
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.confirm-password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" value=""
                                           name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.birthday') }}</label>

                                <div class="col-md-6">
                                    <input name="birthday" type="date"
                                           class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->birthday }}" required autofocus>

                                    @if ($errors->has('birthday'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.diabetes') }}</label>

                                <div class="col-md-6">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary @if ($user->diabetes == '1') active @endif>">
                                            <input type="radio" name="diabetes" autocomplete="off"
                                                   value="1" @if ($user->diabetes == '1') checked="checked" @endif>
                                            {{ __('auth.type_one') }}
                                        </label>
                                        <label class="btn btn-secondary  @if ($user->diabetes == '2') active @endif>">
                                            <input type="radio" name="diabetes" autocomplete="off"
                                                   value="2" @if ($user->diabetes == '2') checked="checked" @endif>
                                            {{ __('auth.type_two') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sex"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.sex') }}</label>

                                <div class="col-md-6">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary  @if ($user->sex == 'Male') active @endif>">
                                            <input type="radio" name="sex" autocomplete="off"
                                                   value="Male" @if ($user->sex == 'Male') checked="checked" @endif>
                                            {{ __('auth.male') }}
                                        </label>
                                        <label class="btn btn-secondary  @if ($user->sex == 'Female') active @endif>">
                                            <input type="radio" name="sex" autocomplete="off"
                                                   value="Female" @if ($user->sex == 'Female') checked="checked" @endif>
                                            {{ __('auth.female') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.detection_date') }}</label>

                                <div class="col-md-6">
                                    <input name="detection_date" type="date"
                                           class="form-control{{ $errors->has('detection_date') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->detection_date }}" required autofocus>

                                    @if ($errors->has('detection_date'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('detection_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('auth.save') }}
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
