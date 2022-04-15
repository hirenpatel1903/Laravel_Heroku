<?php

use Request as Input; ?>
@extends('layouts.master')
@section('title','Create User')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('user.index')}}"><h3 class="kt-subheader__title">User</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Create User</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                @include('errormessage')
                <div class="kt-portlet">
                    {!! Form::open(['route' => 'user.store','class'=>'kt-form','id'=>'createform','name'=>'createform','enctype'=>'multipart/form-data']) !!}
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    {!! Form::text('name',Input::old('name'), ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter Name']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('name',Input::old('email'), ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Enter Email']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    {!! Form::password('password',['class' => 'form-control','id'=>"password",'placeholder'=>'Enter Password']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    {!! Form::password('password_confirmation',['class' => 'form-control','id'=>"password_confirmation",'placeholder'=>'Enter Confirm Password']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role_id" name="role_id">
                                        @foreach($roles as $roles)
                                            @if (Input::old('role_id') == $roles->id)
                                            <option value="{{ $roles->id }}" selected>{{ $roles->name }}</option>
                                            @else
                                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton">Save</button>
                            <a href="{{route('user.index')}}"><button type="button" class="btn btn-secondary cancelbutton">Cancel</button></a>
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@section('script')
<script>
    $(document).ready(function () {

        $('#createform').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50,
                },
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
            }
        });
    });
</script>
@endsection
@endsection
