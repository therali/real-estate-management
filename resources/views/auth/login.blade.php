@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
            <div class="login-logo animated fadeInDown" data-animation="fadeInDown">
                <a href="{{ url('/home') }}"><b>Immo</b>BAMATIC</a>
            </div><!-- /.login-logo -->

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="login-box-body animated fadeInUp" data-animation="fadeInUp">
                <p class="login-box-msg"> {{ t('siginsession') }} </p>
                <form action="{{ url('/login') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <login-input-field
                            name="{{ config('auth.providers.users.field','username') }}"
                            domain="{{ config('auth.defaults.domain','') }}"
                    ></login-input-field>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="{{ trans('message.username') }}"
                               name="username"/>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="{{ trans('message.password') }}"
                               name="password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>

                        <div class="form-group has-feedback">

                            <button type="submit"
                                    class="btn bg-orange-active btn-block btn-flat">{{ trans('message.buttonsign') }}</button>
                        </div><!-- /.col -->

                </form>

                {{--                @include('auth.partials.social_login')--}}

                <a href="{{ url('/password/reset') }}">{{ trans('message.forgotpassword') }}</a><br>

            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>
    @include('layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>

@endsection

@section('stylecss')
    <link href="{{ url('css/animation.css') }}" rel="stylesheet">
@endsection