@extends('layouts.app')

@section('content')
    @if ($errors)
        @foreach($errors as $error)
            {{$error->first}}
        @endforeach
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.name')</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.last_name')</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                           class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                           name="last_name" value="{{ old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.phone')</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone" value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.email')</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.country')</label>
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                            name="country" value="{{ old('country') }}" required>
                                        <option selected>@lang('registration.countryselect')</option>
                                        @foreach($countries as $country)

                                            <option @if($country->code==old('country')) selected @endif
                                            value="{{$country->code}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="referred"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.referred.label')</label>
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('referred') ? ' is-invalid' : '' }}"
                                            name="referred" required>
                                        <option @if('invited'==old('referred')) selected @endif
                                        val="invited">@lang('registration.referred.options.1')</option>
                                        <option @if('contact'==old('referred')) selected @endif
                                        val="contact">@lang('registration.referred.options.2')</option>
                                        <option @if('contact'==old('referred')) selected @endif
                                        val="other">@lang('registration.referred.options.3')</option>
                                    </select>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-md-4 text-md-right">@lang('registration.language.label')</legend>
                                    <div class="col-md-6 form-inline">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="language" id="es"
                                                   @if('es'==old('language')) selected @endif
                                                   value="es">
                                            <label class="form-check-label" for="es">
                                                @lang('registration.language.options.es')
                                            </label>
                                        </div>
                                        <div class="form-check ml-2">
                                            <input class="form-check-input" type="radio" name="language" id="En"
                                                   @if('en'==old('language')) selected @endif
                                                   value="en">
                                            <label class="form-check-label" for="En">
                                                @lang('registration.language.options.en')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>


                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">@lang('registration.password_confirmation')</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>
                            <input type="hidden" name="subscribed" value="0">

                            <div class="form-group row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           class="custom-control-input {{ $errors->has('subscribed') ? ' is-invalid' : '' }}"
                                           name="subscribed"
                                           id="subscribed" val="1">
                                    <label class="custom-control-label"
                                           for="subscribed">@lang('registration.subscribed')</label>
                                </div>
                                @if ($errors->has('subscribed'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('subscribed') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
