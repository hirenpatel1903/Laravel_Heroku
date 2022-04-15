@extends('layouts.app')
@section('title','Reset Password')
@section('css')
<style>
    #password-error{
    font-weight: 500;
    font-size: 0.9rem;
    padding-left: 1.6rem;
}
</style>
@endsection
@section('content')

    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="{{route('login')}}">
                                <img src="{{ url('assets/media/logos/logologin.png') }}">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Reset Password</h3>
                            </div>
                            @include('errormessage')
                            {!! Form::open(['route' => array('passwordreset',$token,$isMobile),'class'=>'kt-form','id'=>'reset_form','name'=>'reset_form','method'=>"POST"]) !!}
                                @csrf
                                
                                <div class="input-group">
                                    <input class="form-control" id="password" type="password" placeholder="Password" name="password" autocomplete="off">
                                </div>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control" autocomplete="off" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                                
                                <div class="kt-login__actions">
                                    <button id="kt_login_forgot_submit" type="submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Reset Password</button>&nbsp;&nbsp;
                                    <button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate kt-login__btn-secondary submitbutton">Cancel</button>
                                </div>
                            {{ Form::close() }}
                        </div>                       

                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
<script>
     $(document).ready(function () {


        $('#kt_login_forgot_cancel').click(function(e) {
            e.preventDefault();
            window.location.href ="{{route('login')}}";
        });
    
        $('#reset_form').validate({// initialize the plugin
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                },
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    equalTo: "#password"
                },
            },
            submitHandler: function(form) {
                 if($("form").validate().checkForm()){
                    $('#kt_login_forgot_submit').addClass('kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light').attr('disabled', true);
                    $(".submitbutton").attr("type","button");
                    $(".submitbutton").addClass("disabled");                    
                    form.submit();
                }  
            }
        });

    });
</script>
@endsection
@endsection
