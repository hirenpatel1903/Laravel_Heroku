<?php
use Request as Input; ?>
@extends('layouts.master')
@section('title','User Details')
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
                <span class="kt-subheader__desc">User Details</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Applications/User/Profile3-->
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a  class="kt-widget__username">
                                            {{$data->name}}
                                            <i class="flaticon2-correct"></i>
                                        </a>
                                        @if($data->role_id !=config('const.roleAdmin'))
                                            @if($showResetPasswordBtn==true)
                                            <div class="kt-widget__action">
                                                <button type="button" data-toggle="modal" data-target="#kt_modal_reset" class="btn btn-brand btn-sm btn-upper">Reset Password</button>
                                            </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a href="mailto:{{$data->email}}"><i class="flaticon2-new-email"></i>{{$data->email}}</a>
                                        <a><i class="flaticon2-calendar-3"></i>{{ucfirst($data->status)}}</a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!--end:: Widgets/Applications/User/Profile3-->
            </div>
        </div>

        <!--End::Section-->

    </div>
    <!-- begin:: Content -->
    <!-- end:: Content -->
</div>

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to reset password ?</p>
            </div>
            <input type="hidden" name="id" id="id" value="{{$data->id}}"/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn btn-primary submitbutton" id="reset-password">Reset</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->

<!--begin::Modal-->
<div class="modal fade modal-part" id="kt_modal_delete_invite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this record?</p>
            </div>
            <input type="hidden" name="invite_id" id="invite_id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn btn-danger" id="delete-invite">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_resend_invite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resend</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to resend invitation?</p>
            </div>
            <input type="hidden" name="resend_invite_id" id="resend_invite_id" value=""/>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancelbutton" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn m-btn btn-primary submitbutton" id="resend-invite">Resend</button>
            </div>
        </div>
    </div>
</div>
<!--End::Modal-->

@section('script')
<script>
    $(document).ready(function () {

        $("#reset-password").on("click", function () {
            var id = $("#id").val();
            $(".cancelbutton").addClass("disabled");
            $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
            $.ajax({
                url: baseUrl + '/admin/userresetpassword',
                type: "post",
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    if (data == 'Error') {
                        toastr.error("@lang('messages.oopserror')");
                    } else {
                        toastr.success('@lang('messages.passwordReset')', '@lang('messages.success')');
                    }
                    $('#kt_modal_reset').modal('hide');
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                },
                error: function (data) {
                    toastr.error("@lang('messages.oopserror')", "@lang('messages.error')");
                    $('#kt_modal_reset').modal('hide');
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                }
            });
        });


        $("#delete-invite").on("click", function () {
            var id = $("#invite_id").val();
            $(".cancelbutton").addClass("disabled");
            $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
            $.ajax({
                url: baseUrl + '/admin/invitedelete',
                type: "post",
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    $('#kt_modal_delete_invite').modal('hide');
                    if (data == 'Error') {
                        toastr.error("@lang('messages.oopserror')");
                    } else {
                        toastr.success('@lang('messages.inviteDelete')', '@lang('messages.success')');
                    }
                    $('#invite_'+id).hide();
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                },
                error: function (data) {
                    $('#kt_modal_delete_invite').modal('hide');
                    toastr.error("@lang('messages.oopserror')", "@lang('messages.error')");
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                }
            });
        });


        $("#resend-invite").on("click", function () {
            var id = $("#resend_invite_id").val();
            $(".cancelbutton").addClass("disabled");
            $(".submitbutton").addClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
            $.ajax({
                url: baseUrl + '/admin/resendinvite',
                type: "post",
                dataType: 'json',
                data: {id: id},
                success: function (data) {
                    if (data == 'Error') {
                        toastr.error("@lang('messages.oopserror')");
                    } else {
                        toastr.success('@lang('messages.resendInvite')', '@lang('messages.success')');
                    }
                    $('#kt_modal_resend_invite').modal('hide');
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                },
                error: function (data) {
                    $('#kt_modal_resend_invite').modal('hide');
                    $(".cancelbutton").removeClass("disabled");
                    $(".submitbutton").removeClass("disabled kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light");
                    toastr.error("@lang('messages.oopserror')", "@lang('messages.error')");

                }
            });
        });

    });
</script>
@endsection
@endsection
