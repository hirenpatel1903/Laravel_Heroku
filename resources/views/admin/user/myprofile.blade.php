<?php use Request as Input; ?>
@extends('layouts.master')
@section('title','My profile')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <button class="kt-subheader__mobile-toggle" id="kt_subheader_mobile_toggle"><span></span></button>
                <h3 class="kt-subheader__title">My Profile</h3>

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
                        <div class="kt-portlet">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Personal Information <small>update your personal Information</small></h3>
                                </div>

                            </div>
                            {{ Form::model($data, ['route' => ['updatemyprofile'], 'method' => 'post','id'=>'createform','name'=>'createform','class'=>'kt-form kt-form--label-right','enctype'=>'multipart/form-data']) }}
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('name',$data->name, ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Name']) !!}
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    {!! Form::text('email',$data->email, ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Email']) !!}
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
                                                <button type="submit" class="btn btn-primary submitbutton">Update</button>&nbsp;
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
        ignore: [],
        rules: {
            name: {
                required: true,
                maxlength:50
            },
        },
        submitHandler: function (form) {
            if($("form").validate().checkForm()){
                $(".submitbutton").attr("type","button");
                $(".cancelbutton").addClass("disabled");
                $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                form.submit();
            }
        },
    });

</script>
@endsection
@endsection
