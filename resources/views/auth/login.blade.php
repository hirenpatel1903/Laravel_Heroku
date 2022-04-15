@extends('layouts.app')
@section('title','Login')
@section('css')
<style>
    #password-error,#email-error{
    font-weight: 500;
    font-size: 0.9rem;
    padding-left: 1.6rem;
}
</style>
@endsection
@section('content')

    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="{{route('login')}}">
                                <img src="{{ url('assets/media/icons/admin_logo.png') }}">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Sign In To Admin</h3>
                            </div>
                            @include('errormessage')
                            <form class="kt-form" action="{{ url('login') }}" method="post" id="login_form">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                                </div>
                                <div class="input-group">
                                    <input class="form-control" type="password" placeholder="Password" name="password">
                                </div>
                                <div class="row kt-login__extra">
                                    <div class="col">
                                    </div>
                                    <div class="col kt-align-right">
                                        <a href="javascript:;" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
                                    </div>
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Sign In</button>
                                </div>
                            </form>
                        </div>

                        <div class="kt-login__forgot">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Forgotten Password ?</h3>
                                <div class="kt-login__desc">Enter your email to reset your password:</div>
                            </div>
                            <form class="kt-form" action="{{ url('resetpasswordemail') }}" method="post" id="forget-form">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off" value="{{ old('email') }}">
                                </div>
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Request</button>&nbsp;&nbsp;
                                    <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary cancelbutton">Cancel</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- end:: Page -->

@section('script')
<script>
    $(document).ready(function () {

    var login = $('#kt_login');
    function displayForgotForm(){
        $(document).prop('title', siteName+'- Forgot Password');
        login.removeClass('kt-login--signin');
        login.removeClass('kt-login--signup');

        login.addClass('kt-login--forgot');
        KTUtil.animateClass(login.find('.kt-login__forgot')[0], 'flipInX animated');
    }

    function displaySignInForm(){
        $(document).prop('title', siteName+'- Login');
        login.removeClass('kt-login--forgot');
        login.removeClass('kt-login--signup');

        login.addClass('kt-login--signin');
        KTUtil.animateClass(login.find('.kt-login__signin')[0], 'flipInX animated');
    }

    $('#kt_login_forgot').click(function(e) {
        e.preventDefault();
        displayForgotForm();
    });

    $('#kt_login_forgot_cancel').click(function(e) {
        e.preventDefault();
        displaySignInForm();
    });


    $('#login_form').validate({

        rules: {
            email: {
                required: true,
                maxlength: 50,
                email: true
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
        },
        submitHandler: function (form) {
            if ($("#login_form").validate().checkForm()) {
                $('#kt_login_signin_submit').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
                $(".cancelbutton").attr("type", "button");
                $(".cancelbutton").addClass("disabled");
                form.submit();
            }
        }
    });

    $('#forget-form').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 50,
                    email: true
                }
            },
            submitHandler: function(form) {
                if($("#forget-form").validate().checkForm()){
                    $('#kt_login_forgot_submit').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
                    $(".cancelbutton").attr("type","button");
                    $(".cancelbutton").addClass("disabled");
                    form.submit();
                }
            }
        });
    });

</script>
@endsection
@endsection
