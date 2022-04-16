<?php
use Request as Input;
use App\Helpers\Helper;
?>
@extends('layouts.master')
@section('title','Books')
@section('css')
@endsection
@section('content')


<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Content Head -->
    <div class="kt-subheader  kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Books</h3>

            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    @if(Auth::user()->role_id==config('const.roleAdmin'))
                        <a href="{{route('book.store')}}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Load Books
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end:: Content Head -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        @include('errormessage')
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__body">
                <!-- Search Filter Start -->
                {{-- <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10 searchbarfilter">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal" id="filterData" name="filterData" novalidate="novalidate">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control" id="status" name="status">
                                                    <option value="" selected>Select Status</option>
                                                    @foreach($status as $key=>$status)
                                                        <option value="{{$key}}">{{$status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Role:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control" id="role_id" name="role_id">
                                                    <option value="" selected>Select Role</option>
                                                    @foreach($roles as $key=>$roles)
                                                        <option value="{{$roles->id}}">{{$roles->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div> --}}
                <!-- Search Filter End-->
                <br>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Authors</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Thumbnail</th>
                            {{-- <th>SmallThumbnail</th> --}}
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                </table>

                <!--end: Datatable -->
            </div>
        </div>

    </div>

    <!-- end:: Content -->

</div>
@include('confirmalert')


@section('script')
<!--end::Page Vendors -->
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<!--end::Page Vendors -->

<script>
$(document).ready(function () {
    var initTable1 = function () {
        var table = $('#kt_table_1');

        // begin first table
        table.DataTable({
            lengthMenu: getPageLengthDatatable(),
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{route('getbooks')}}",
                type: 'post',
                data: function (data) {
                    data.fromValues = $("#filterData").serialize();
                }
            },
            columns: [
                {data: 'book_id', name: 'book_id'},
                {data: 'authors', name: 'authors'},
                {data: 'title', name: 'title'},
                {data: 'subtitle', name: 'subtitle'},
                {data: 'thumbnail',
                    render: function (data, type, full, meta) {
                        return "<img src=\"" + data + "\" height=\"104\" width=\"102\" class=\"img-circle\"/>";
                    }, searchable: false, sortable: false
                },
                // {data: 'smallThumbnail',
                //     render: function (data, type, full, meta) {
                //         return "<img src=\"" + data + "\" height=\"104\" width=\"102\" class=\"img-circle\" />";
                //     }, searchable: false, sortable: false
                // },
                {data: 'publishedDate', name: 'books.publishedDate',
                    render: function (data, type, row, meta) {
                        var dateWithTimezone = moment.utc(data).tz(tz);
                        return dateWithTimezone.format('<?php echo config('const.displayDateBlade'); ?>');
                    }
                },
                {data: 'action', name: 'action', searchable: false, sortable: false,responsivePriority: -1},
            ],
        });
    };
    initTable1();

    // $("#status,#role_id").bind("change", function () {
    //     $('#kt_table_1').DataTable().clear().destroy();
    //     initTable1();
    // });
});
</script>
@endsection
@endsection
