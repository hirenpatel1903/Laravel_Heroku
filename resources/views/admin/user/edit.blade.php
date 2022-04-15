<?php
use Illuminate\Support\Facades\Auth;
use Request as Input; ?>
@extends('layouts.master')
@section('title','Edit User')
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
                <span class="kt-subheader__desc">Edit User</span>

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
<!--                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Edit User
                            </h3>
                        </div>
                    </div>-->

                    <!--begin::Form-->
                    {{ Form::model($data, ['route' => ['user.update',$data->id], 'method' => 'patch','id'=>'createform','name'=>'createform','class'=>'kt-form','enctype'=>'multipart/form-data']) }}
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    {!! Form::text('name',old('name', $data->name), ['class' => 'form-control','id'=>"name",'name'=>'name','placeholder'=>'Enter Name']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    {!! Form::text('email',old('email', $data->email), ['class' => 'form-control','id'=>"email",'name'=>'email','placeholder'=>'Enter Email']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role_id" name="role_id">
                                        @foreach($roles as $roles)
                                        @if($roles->id !=config('const.roleAdmin'))
                                                <option value="{{ $roles->id }}" <?php if ($data->role_id == $roles->id) {
                                                    echo "selected";
                                                } ?>>{{ $roles->name }}</option>

                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        @foreach($statusArray as $key=>$statusArray)
                                            <option value="{{ $key }}" <?php
                                            if ($data->status == $key) {
                                                echo "selected";
                                            }
                                            ?>>{{ $statusArray }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions ">
                            <button type="submit" class="btn btn-primary submitbutton ">Update</button>
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
<script src="{{ url('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
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
                }
            },
            submitHandler: function (form) {
                if ($("#createform").validate().checkForm()) {
                    $(".submitbutton").attr("type", "button");
                    $(".submitbutton").addClass("disabled");
                    $(".cancelbutton").addClass("disabled");
                    $(".submitbutton").addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    form.submit();
                }
            }
        });
    });
</script>
@endsection
@endsection
