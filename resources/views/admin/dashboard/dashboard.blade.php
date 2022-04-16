@extends('layouts.master')
@section('title','Dashboard')
@section('css')
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Dashboard</h3>
            </div>
        </div>
    </div>

    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 3-->

        <!--Begin::Row-->
        <div class="row">

            <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

                <!--begin:: Widgets/Trends-->

                <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Activity
                            </h3>
                        </div>
                        {{-- <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-label-light btn-sm btn-bold dropdown-toggle" data-toggle="dropdown">
                                Export
                            </a>
                            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Finance</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                            <span class="kt-nav__link-text">Statistics</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                            <span class="kt-nav__link-text">Events</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                            <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__section">
                                        <span class="kt-nav__section-text">Customers</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                            <span class="kt-nav__link-text">Notifications</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                            <span class="kt-nav__link-text">Files</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-widget17">
                            <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                                <div class="kt-widget17__chart" style="height:320px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="kt_chart_activities" width="977" height="224" class="chartjs-render-monitor" style="display: block; width: 977px; height: 224px;"></canvas>
                                </div>
                            </div>
                            <div class="kt-widget17__stats">
                                <div class="kt-widget17__items">
                                    <div class="kt-widget17__item">
                                        <span class="kt-widget17__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                            </g>
                                            </svg> </span>
                                        <span class="kt-widget17__subtitle">
                                            Total Users
                                        </span>
                                        <span class="kt-widget17__desc">
                                            {{$data_total->data_total_UserAccount}} New Users
                                        </span>
                                    </div>
                                    <div class="kt-widget17__item">
                                        <span class="kt-widget17__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                            <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                                            </g>
                                            </svg> </span>
                                        <span class="kt-widget17__subtitle">
                                            Total Books
                                        </span>
                                        <span class="kt-widget17__desc">
                                            {{$data_total->data_total_Books}} New Books
                                        </span>
                                    </div>
                                </div>
                                {{-- <div class="kt-widget17__items">
                                    <div class="kt-widget17__item">
                                        <span class="kt-widget17__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--warning">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z" fill="#000000"></path>
                                            </g>
                                            </svg> </span>
                                        <span class="kt-widget17__subtitle">
                                            Reported
                                        </span>
                                        <span class="kt-widget17__desc">
                                            72 Support Cases
                                        </span>
                                    </div>
                                    <div class="kt-widget17__item">
                                        <span class="kt-widget17__icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--danger">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>
                                            </g>
                                            </svg> </span>
                                        <span class="kt-widget17__subtitle">
                                            Arrived
                                        </span>
                                        <span class="kt-widget17__desc">
                                            34 Upgraded Boxes
                                        </span>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Trends-->
            </div>
            {{-- <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">

                <!--begin:: Widgets/Sales Stats-->
                <div class="kt-portlet kt-portlet--head--noborder kt-portlet--height-fluid">
                    <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Sales Stats
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="dropdown dropdown-inline">
                                <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="flaticon-more-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="kt-nav">
                                        <li class="kt-nav__section kt-nav__section--first">
                                            <span class="kt-nav__section-text">Finance</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-graph-1"></i>
                                                <span class="kt-nav__link-text">Statistics</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Events</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-layers-1"></i>
                                                <span class="kt-nav__link-text">Reports</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__section">
                                            <span class="kt-nav__section-text">Customers</span>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-calendar-4"></i>
                                                <span class="kt-nav__link-text">Notifications</span>
                                            </a>
                                        </li>
                                        <li class="kt-nav__item">
                                            <a href="#" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon2-file-1"></i>
                                                <span class="kt-nav__link-text">Files</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Widget 6-->
                        <div class="kt-widget15">
                            <div class="kt-widget15__chart">
                                <canvas id="kt_chart_sales_stats" style="height:160px;"></canvas>
                            </div>
                            <div class="kt-widget15__items kt-margin-t-40">
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__item">
                                            <span class="kt-widget15__stats">
                                                63%
                                            </span>
                                            <span class="kt-widget15__text">
                                                Sales Grow
                                            </span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-widget15__chart-progress--sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="kt-widget15__item">
                                            <span class="kt-widget15__stats">
                                                54%
                                            </span>
                                            <span class="kt-widget15__text">
                                                Orders Grow
                                            </span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__item">
                                            <span class="kt-widget15__stats">
                                                41%
                                            </span>
                                            <span class="kt-widget15__text">
                                                Profit Grow
                                            </span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 55%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="kt-widget15__item">
                                            <span class="kt-widget15__stats">
                                                79%
                                            </span>
                                            <span class="kt-widget15__text">
                                                Member Grow
                                            </span>
                                            <div class="kt-space-10"></div>
                                            <div class="progress kt-progress--sm">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="kt-widget15__desc">
                                            * lorem ipsum dolor sit amet consectetuer sediat elit
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end::Widget 6-->
                    </div>
                </div>

                <!--end:: Widgets/Sales Stats-->
            </div> --}}
        </div>

        <!--End::Row-->
        {{-- <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">

            <!--begin:: Widgets/User Progress -->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            User Progress
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-pills nav-pills-sm nav-pills-label nav-pills-bold" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_widget31_tab1_content" role="tab">
                                    Today
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_widget31_tab2_content" role="tab">
                                    Week
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="kt_widget31_tab1_content">
                            <div class="kt-widget31">
                                <div class="kt-widget31__item">
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__pic">
                                            <img src="{{url('assets/media/users/100_4.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget31__info">
                                            <a href="#" class="kt-widget31__username">
                                                Anna Strong
                                            </a>
                                            <p class="kt-widget31__text">
                                                Visual Designer,Google Inc
                                            </p>
                                        </div>
                                    </div>
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__progress">
                                            <a href="#" class="kt-widget31__stats">
                                                <span>63%</span>
                                                <span>London</span>
                                            </a>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-brand" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                    </div>
                                </div>
                                <div class="kt-widget31__item">
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__pic">
                                            <img src="{{url('assets/media/users/100_14.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget31__info">
                                            <a href="#" class="kt-widget31__username">
                                                Milano Esco
                                            </a>
                                            <p class="kt-widget31__text">
                                                Product Designer, Apple Inc
                                            </p>
                                        </div>
                                    </div>
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__progress">
                                            <a href="#" class="kt-widget31__stats">
                                                <span>33%</span>
                                                <span>Paris</span>
                                            </a>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                    </div>
                                </div>
                                <div class="kt-widget31__item">
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__pic kt-widget4__pic--pic">
                                            <img src="{{url('assets/media/users/100_11.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget31__info">
                                            <a href="#" class="kt-widget31__username">
                                                Nick Bold
                                            </a>
                                            <p class="kt-widget31__text">
                                                Web Developer, Facebook Inc
                                            </p>
                                        </div>
                                    </div>
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__progress">
                                            <a href="#" class="kt-widget31__stats">
                                                <span>13%</span>
                                                <span>London</span>
                                            </a>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                    </div>
                                </div>
                                <div class="kt-widget31__item">
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__pic kt-widget4__pic--pic">
                                            <img src="{{url('assets/media/users/100_1.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget31__info">
                                            <a href="#" class="kt-widget31__username">
                                                Wiltor Delton
                                            </a>
                                            <p class="kt-widget31__text">
                                                Project Manager, Amazon Inc
                                            </p>
                                        </div>
                                    </div>
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__progress">
                                            <div class="kt-widget31__stats">
                                                <span>93%</span>
                                                <span>New York</span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                    </div>
                                </div>
                                <div class="kt-widget31__item">
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__pic">
                                            <img src="{{url('assets/media/users/100_6.jpg')}}" alt="">
                                        </div>
                                        <div class="kt-widget31__info">
                                            <a href="#" class="kt-widget31__username">
                                                Sam Stone
                                            </a>
                                            <p class="kt-widget31__text">
                                                Project Manager, Kilpo Inc
                                            </p>
                                        </div>
                                    </div>
                                    <div class="kt-widget31__content">
                                        <div class="kt-widget31__progress">
                                            <div class="kt-widget31__stats">
                                                <span>50%</span>
                                                <span>New York</span>
                                            </div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <a href="#" class="btn-label-brand btn btn-sm btn-bold">Follow</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!--end:: Widgets/User Progress -->
        </div> --}}
        <!--End::Dashboard 3-->
    </div>

    <!-- end:: Content -->
</div>
@endsection
