//"use strict";
//var KTDatatablesBasicScrollable = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
                        lengthMenu: getPageLengthDatatable(),
			responsive: true,
			searchDelay: 500,
			processing: true,
                        serverSide: true,
//                        scrollY: '50vh',
//			scrollX: true,
//			scrollCollapse: false,
                        order: [],
                        
			ajax: {
                            url: 'http://localhost/project/apurvawatersolution/public/admin/getusers',
                            type: 'post',
                            data: function (data) {
                                 data.fromValues = $("#filterData").serialize();
                            }
                        },
			columns: [
				{data: 'first_name',name: 'users.first_name'},
                                {data: 'last_name',name: 'users.last_name'},
                                {data: 'email',name: 'users.email'},
                                {data: 'status', name: 'users.status'},
                                {data: 'action', name: 'action', searchable: false, sortable: false},
//                                {data: 'created_at',
//                                render: function (data, type, row, meta) {
//                                     //var utcDate = moment.utc(data);
//                                     var dateWithTimezone = moment.utc(data).tz(tz);
//                                     return dateWithTimezone.format('<?php echo config('const.JSdisplayDateTimeFormatWithAMPM');?>');
//                                 }
//                             },
			],
			
		});
	};

//	return {
//
//		//main function to initiate the module
//		init: function() {
//			initTable1();
//		},
//
//	};
//
//}();

//jQuery(document).ready(function() {
//	KTDatatablesBasicScrollable.init();
//});