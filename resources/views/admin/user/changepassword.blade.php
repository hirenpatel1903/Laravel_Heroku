@extends('layouts.master')
@section('title','Change Password')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <button class="kt-subheader__mobile-toggle" id="kt_subheader_mobile_toggle"><span></span></button>
                <h3 class="kt-subheader__title">Change Password</h3>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                <i class="la la-close"></i>
            </button>

            <!--End:: App Aside Mobile Toggle-->

            <!--Begin:: App Aside-->

            @include('admin.user.commonside')
            <!--End:: App Aside-->

            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col-xl-12">

                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Change Password<small>change or reset your account password</small></h3>
                                </div>

                            </div>
                            {!! Form::open(['route' => 'change.password','class'=>'kt-form kt-form--label-right','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                            <div class="kt-portlet__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input id="currentpassword" type="password" class="form-control" autocomplete="off" name="currentpassword"  placeholder="Current Password" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input id="password" type="password" class="form-control" autocomplete="off" name="password" autocomplete="new-password" placeholder="New Password" >
                                            </div>
                                        </div>
                                        <div class="form-group form-group-last row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">Confirm Password</label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input id="password_confirmation" type="password" class="form-control" autocomplete="off" name="password_confirmation" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-3 col-xl-3">
                                        </div>
                                        <div class="col-lg-9 col-xl-9">
                                            <button type="submit" class="btn btn-brand btn-bold submitbutton">Change Password</button>&nbsp;
                                            <a href="{{route('dashboard')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <!--End:: App Content-->
        </div>

        <!--End::App-->
    </div>

    <!-- end:: Content -->
</div>
@section('script')
<script type="text/javascript">
    $("#createform").validate({
        rules: {
            currentpassword: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 20,
            },
            password_confirmation: {
                required: true,
                minlength: 5,
                maxlength: 20,
                equalTo: "#password"
            },
        },
        submitHandler: function (form) {
            if ($("#createform").validate().checkForm()) {
                $(".submitbutton").attr("type", "button");
                $(".cancelbutton").addClass("disabled");
                $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                form.submit();
            }
        },
    });

</script>
@endsection
@endsection
