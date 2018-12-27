@extends('layouts.master')
@section('title')
    {{--{{ $_title }}--}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            {{--            {{ dd($errors) }}--}}
            @if($errors->has('error_login'))
                <div class="alert alert-danger alert-with-icon">
                    <i class="material-icons" data-notify="icon">error_outline</i>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    <span data-notify="message">
                    {{ $errors->first('error_login') }}
                </span>
                </div>
            @endif
            <div class="col-md-10 col-md-offset-1">
                <form class="form" method="post" action="#">
                    @csrf
                    <div class="card card-signup">
                        <h2 class="card-title text-center">{{ __("Register") }}</h2>
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="card-content">
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                        <input type="text" name="first_name" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="First Name..." value="{{ old('first_name') }}" required>
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                        <input type="text" name="last_name" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="Last Name..." value="{{ old('last_name') }}" required>
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthlast_name_day') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group date" id="birth_day">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">av_timer</i>
                                                </span>
                                        <input type="text" name="birth_day" class="form-control datepicker{{ $errors->has('birth_day') ? ' is-invalid' : '' }}" placeholder="dd/mm/yyyy" value="{{ old('birth_day') }}" required>
                                        @if ($errors->has('birth_day'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birth_day') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                        <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="Phone Number..." value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                        <div class="radio{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                            <label>
                                                <input type="radio" name="gender" value="0" checked>
                                                Nam
                                            </label>
                                        </div>
                                        <div class="radio{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                            <label>
                                                <input type="radio" name="gender" value="1">
                                                Nữ
                                            </label>
                                        </div>
                                        @if ($errors->has('gender'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                {{--<div class="social text-center">--}}
                                    {{--<button class="btn btn-just-icon btn-round btn-twitter">--}}
                                        {{--<i class="fa fa-twitter"></i>--}}
                                    {{--</button>--}}
                                    {{--<button class="btn btn-just-icon btn-round btn-dribbble">--}}
                                        {{--<i class="fa fa-dribbble"></i>--}}
                                    {{--</button>--}}
                                    {{--<button class="btn btn-just-icon btn-round btn-facebook">--}}
                                        {{--<i class="fa fa-facebook"> </i>--}}
                                    {{--</button>--}}
                                    {{--<h4> or be classical </h4>--}}
                                {{--</div>--}}

                                <div class="card-content">
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                        <input type="text" name="username" placeholder="Username..." class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" required autofocus>
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                        <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email..." value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                        <input type="password" name="password" placeholder="Password..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required/>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                        <input id="password-confirm" placeholder="Password Confirm..." type="password" class="form-control" name="password_confirmation" required>

                                    </div>
                                    <!-- If you want to add a checkbox to this form, uncomment this code -->
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="optionsCheckboxes" checked> I agree to the
                                            <a href="#something">terms and conditions</a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-primary btn-round">
                                        {{ __('Register') }}
                                    </button>
                                    {{--<a href="#pablo" class="btn btn-primary btn-round">{{ __("Register") }}</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section("script")
    <script type="text/javascript">
        $(function () {
            $('.datepicker').datetimepicker({
                viewMode: 'days',
                format: 'DD/MM/YYYY'
            });
        });
    </script>
@endsection
