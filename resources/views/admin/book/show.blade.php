<?php
use Request as Input; ?>
@extends('layouts.master')
@section('title','Book Details')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('book.index')}}"><h3 class="kt-subheader__title">Book</h3></a>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                <span class="kt-subheader__desc">Book Details</span>

            </div>
        </div>
    </div>

    <!-- end:: Content Head -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::Section-->
        <div class="row">
            <div class="col-xl-12">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__body">
                        <div class="kt-widget kt-widget--user-profile-3">
                            <div class="kt-widget__top">
                                <div class="kt-widget__content">
                                    <div class="kt-widget__head">
                                        <a class="kt-widget__username">
                                            {{$data->title ?? '-'}}
                                            <i class="flaticon2-open-text-book"></i>
                                        </a>
                                    </div>
                                    <div class="kt-widget__subhead">
                                        <a><i class="flaticon2-calendar-3"></i>{{ucfirst($data->authors ?? '-')}}</a>
                                        <a><i class="flaticon-calendar-with-a-clock-time-tools"></i>{{ date(config('const.displayDate'),strtotime($data->publishedDate ?? '')) ?? '' }}</a>
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
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Thumbnail Details
                            </h3>
                        </div>
                    </div>
                    <!--begin::Form-->
                    @if($data->smallThumbnail && $data->thumbnail)
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>Thumbnail: </strong></label><br>
                                    <label><div class="kt-widget__media">
                                        <img src="{{ $data->thumbnail }}" alt="{{ $data->subtitle }}">
                                    </div></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><strong>SmallThumbnail: </strong></label><br>
                                    <label><div class="kt-widget__media">
                                        <img src="{{$data->smallThumbnail}}" alt="{{ $data->subtitle }}">
                                    </div></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form-->
                    @else
                    <div class="kt-portlet__body">
                        {{trans('messages.noThumbnailDeatils')}}
                    </div>
                    @endif
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
    <!-- begin:: Content -->
    <!-- end:: Content -->
</div>
@endsection
