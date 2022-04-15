@section('title','404')
@extends('layouts.errormaster')
@section('content')

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v5" > <!-- style="background-image: url(assets/media/error/bg5.jpg);"-->
        <div class="kt-error_container">
            <span class="kt-error_title">
                <h1>Oops!</h1>
            </span>
            <p class="kt-error_subtitle">
                Oops! You're lost.
            </p>
            <p class="kt-error_description">
                We can not find the page you're looking for.<br>
                <a href="{{route('dashboard')}}" class="btn red btn-outline">Go To Home </a>
            </p>
        </div>
    </div>
</div>
<!-- end:: Page -->

@endsection

