$(document).ready(function() {
    toastr.clear();
    toastr.options = {
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000
        }
        //$('[data-toggle="tooltip"]').tooltip(); 
        // datatable 
    var table_msg = ltr_matching_msg;
    if ($('.server_datatable').hasClass("live_class_list_teacher")) {
        var table_msg = ltr_live_class_msg;
    }
    if (typeof MathJax !== 'undefined') { MathJax.Hub.Queue(["Typeset", MathJax.Hub]); }
    var dataTableObj = $('.server_datatable').DataTable({
        searching: true,
        processing: true,
        dom: 'lf<"table-responsive" t >ip',
        language: {
            paginate: {
                previous: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>',
            },
            emptyTable: table_msg,
            search: ltr_search + ':',

        },
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        responsive: true,
        serverSide: { "regex": true },
        columnDefs: [{
            targets: "_all",
            orderable: false
        }],
        ajax: {
            "url": base_url + $('.server_datatable').attr('data-url'),
            "type": "POST"
        },
        initComplete: function(settings, json) {

            if ($('.server_datatable').attr('data-url') == 'ajaxcall/teacher_table') {
                $("table.dataTable td").css("white-space", "initial");
            }
            if ($('.server_datatable').attr('data-url') == 'ajaxcall/student_table') {
                $("table.dataTable td").css("white-space", "initial");
            }
            $('.datatableSelect').select2({
                minimumResultsForSearch: -1
            });
            $('.datatableSelectSrch').select2();
            $('.server_datatable').on('draw.dt', function() {
                $('.datatableSelect').select2({
                    minimumResultsForSearch: -1
                });
                $('.datatableSelectSrch').select2();
            });
        },

    });

    // Datepicker
    $(".basic_datatable").DataTable({
        /* No ordering applied by DataTables during initialisation */
        "ordering": false
    });
    $(".chooseDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        yearRange: "c-30:c+15",

    });
    $(".chooseDate_extra").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        yearRange: "c-30:c+15",
        minDate: 0
    });

    $(".chooseCurrDate").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        minDate: '-1m',
        maxDate: '-1d'
    });

    if ($('#b_startDate').length && $('#b_endDate').length) {
        var batchstart_date = $('#b_startDate').val();
        var batchend_date = $('#b_endDate').val();

        var startbatchDateArr = batchstart_date.split('-');
        var endbatchDateArr = batchend_date.split('-');

        var batchstart_date = startbatchDateArr[1] + '-' + startbatchDateArr[0] + '-' + startbatchDateArr[2];
        var batchend_date = endbatchDateArr[1] + '-' + endbatchDateArr[0] + '-' + endbatchDateArr[2];

        $('.edu_accordion_container .chooseDate').datepicker('option', 'minDate', new Date(batchstart_date));
        $('.edu_accordion_container .chooseDate').datepicker('option', 'maxDate', new Date(batchend_date));
    }



    $("#b_startDate").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        onSelect: function(date) {
            var minDate = $(this).datepicker('getDate');
            $('.edu_accordion_container .chooseDate').datepicker('option', 'minDate', minDate);
            $('#b_endDate').datepicker('option', 'minDate', minDate);
        }
    });

    $('#b_endDate').datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        onSelect: function(date) {
            var maxDate = $(this).datepicker('getDate');
            $('.edu_accordion_container .chooseDate').datepicker('option', 'maxDate', maxDate);
        }
    });

    $.magnificPopup.instance._onFocusIn = function(e) {

        if ($(e.target).hasClass('ui-datepicker-month')) {
            return true;
        }
        if ($(e.target).hasClass('ui-datepicker-year')) {
            return true;
        }
        $.magnificPopup.proto._onFocusIn.call(this, e);
    };

    //Accordian js
    $(document).on("click", ".edu_accord_parent > span", function() {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
                .siblings(".edu_accordion_content")
                .slideUp(200);
            $(".edu_accord_parent > span .upDownI")
                .removeClass("fa-angle-down")
                .addClass("fa-angle-right");
        } else {
            $(".edu_accord_parent > span .upDownI")
                .removeClass("fa-angle-down")
                .addClass("fa-angle-right");
            $(this)
                .find(".upDownI")
                .removeClass("fa-angle-right")
                .addClass("fa-angle-down");
            $(".edu_accord_parent > span").removeClass("active");
            $(this).addClass("active");
            $(".edu_accordion_content").slideUp(200);
            $(this)
                .siblings(".edu_accordion_content")
                .slideDown(200);
        }
    });

    $('.AssignSubBatch').on('click', function() {
        $('.edu_accord_parent > span').removeClass("active");
        $('.edu_accord_parent > span')
            .siblings(".edu_accordion_content")
            .slideUp(200);

        var optionArr = $.parseJSON($('.subjectArrayDiv').html());
        var options = '<option value="">' + ltr_select_subject + '</option>';

        if (optionArr.length) {
            var i;
            for (i = 0; i < optionArr.length; ++i) {
                options += '<option value="' + optionArr[i]['id'] + '">' + optionArr[i]['subject_name'] + '</option>';
            }
        }

        var b_startTime = $('#b_startTime').val();
        var b_endTime = $('#b_endTime').val();
        var appendHtml = '<div class="edu_accord_parent"><span class="edu_accordion_header"><span class="subjects_name">' + ltr_subject + '</span><i><i class="fa fa-angle-right upDownI"></i><i class="fa fa-trash eb_removeacc removeAccSub"></i></i></span><div class="edu_accordion_content"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="form-group"><label>Subject <sup>*</sup></label><select class="edu_selectbox_with_search form-control require filter_subject" name="batch_subject[]" data-teacher="yes" data-placeholder="' + ltr_select_subject + '">' + options + '</select></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_chapters + ' <sup>*</sup></label><select class="edu_selectbox_with_search form-control require filter_chapter" multiple data-placeholder="' + ltr_select_chapter + '"><option value="">' + ltr_select_chapter + '</option></select></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_teacher + '<sup>*</sup></label><select class="edu_selectbox_with_search form-control require filter_teacher" name="batch_teacher[]" data-placeholder="' + ltr_select_teacher + '"><option value="">' + ltr_select_teacher + '</option></select></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_start_date + '<sup>*</sup></label><input type="text" class="form-control chooseDate require"  placeholder="' + ltr_start_date + '" name="sub_start_date[]"></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_end_date + '<sup>*</sup></label><input type="text" class="form-control chooseDate require" placeholder="' + ltr_end_date + '" name="sub_end_date[]"></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_start_time + '<sup>*</sup></label><div class="chooseTime"><input type="text" class="form-control require"  placeholder="' + ltr_start_time + '" value="' + b_startTime + '" name="sub_start_time[]"></div></div></div><div class="col-lg-6 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_end_time + '<sup>*</sup></label><div class="chooseTime"><input type="text" class="form-control require" placeholder="' + ltr_end_time + '" value="' + b_endTime + '" name="sub_end_time[]"></div></div></div></div></div></div>';

        $('.edu_accordion_container').append(appendHtml);

        $('.edu_accordion_container').find('.edu_accord_parent:last select').each(function() {
            $(this).select2({
                placeholder: $(this).attr("data-placeholder"),
                width: '100%'
            });
            $('.select2-search__field').css('width', '100%');
        });

        $('.edu_accordion_container').find('.edu_accord_parent:last edu_accord_parent > span').addClass("active").siblings(".edu_accordion_content").slideDown(200);

        var start_date = $('#b_startDate').val();
        var end_date = $('#b_endDate').val();

        var startDateArr = start_date.split('-');
        var endDateArr = end_date.split('-');
        var start_date = startDateArr[1] + '-' + startDateArr[0] + '-' + startDateArr[2];
        var end_date = endDateArr[1] + '-' + endDateArr[0] + '-' + endDateArr[2];

        $('.edu_accordion_container').find(".edu_accord_parent:last .chooseDate").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
            minDate: new Date(start_date),
            maxDate: new Date(end_date)
        });
        $('.edu_accordion_container').find('.edu_accord_parent:last .chooseTime').clockpicker({
            donetext: 'Done',
            twelvehour: true,
            autoclose: false,
            leadingZeroHours: false,
            upperCaseAmPm: true,
            leadingSpaceAmPm: true,
            placement: 'top',
            afterHourSelect: function() {
                $('.clockpicker').clockpicker('realtimeDone');

            },
            afterMinuteSelect: function() {
                $('.clockpicker').clockpicker('realtimeDone');
            },
            afterAmPmSelect: function() {
                $('.clockpicker').clockpicker('realtimeDone');
            }
        });
    });

    $('.AssignBatchHeading').on('click', function() {
        $('.edu_accord_parent > span').removeClass("active");
        $('.edu_accord_parent > span')
            .siblings(".edu_accordion_content")
            .slideUp(200);


        var appendHtml = '<div class="edu_accord_parent"><span class="edu_accordion_header"><span class="speci_heading">' + ltr_benefit + '</span> <i><i class="fa fa-angle-right upDownI"></i><i class="fa fa-trash eb_removeacc removeAccHeading"></i></i></span><div class="edu_accordion_content count_heading"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_heading + '</label><input type="text" class="form-control"  placeholder="' + ltr_i_learn + '" name="batch_speci_heading[]" ><input value="" type="hidden" name="batch_speci_id[]"></div></div><div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="form-group"><label>' + ltr_fecherd + '</label><div class="batch_sub_heading"><div class="sub_input"><input type="text" class="form-control fecherd"  placeholder="' + ltr_fecherd + '" ><div class="eb_subhead_icon"><i class="fa fa-plus eb_add_sheading assSubHeading"></i><i class="fa fa-trash eb_rem_sheading removeSubHeading"></i></div></div></div></div></div></div></div></div>';
        $('.edu_accordion_container_heading').append(appendHtml);


    });

    $(document).on('click', '.assSubHeading', function() {
        var appendHtml = '<div class="sub_input"><input type="text" class="form-control fecherd"  placeholder="' + ltr_fecherd + '" ><div class="eb_subhead_icon"><i class="fa fa-plus eb_add_sheading assSubHeading"></i><i class="fa fa-trash eb_rem_sheading removeSubHeading"></i></div></div>';

        $(this).closest('.batch_sub_heading').append(appendHtml);


    });
    $(document).on('click', '.removeSubHeading', function() {
        if ($('.batch_sub_heading').closest('.sub_input').length == 1) {
            toastr.error(ltr_cant_msg);
            return false;
        } else {
            swal({
                    title: ltr_are_you_so_msg,
                    text: ltr_you_delete,
                    icon: "warning",
                    buttons: [ltr_cancel, ltr_ok],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $(this).closest('.sub_input').remove();
                    }

                });
        }
    });

    $(document).on('click', '.removeAccHeading', function() {
        if ($('.edu_accordion_container_heading .edu_accord_parent').length == 1) {
            toastr.error(ltr_batch_spe_msg);
            return false;
        } else {
            swal({
                    title: ltr_are_you_so_msg,
                    text: ltr_you_delete,
                    icon: "warning",
                    buttons: [ltr_cancel, ltr_ok],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        if ($(this).attr('data-id') != '') {
                            $.ajax({
                                method: "POST",
                                url: base_url + "ajaxcall/deleteData",
                                data: { 'id': $(this).attr('data-id'), 'table': 'batch_fecherd' },
                                success: function(resp) {
                                    var resp = $.parseJSON(resp);
                                },
                            });
                        }
                        $(this).closest('.edu_accord_parent').remove();
                    }
                });
        }
    });

    function getTwentyFourHourTime(amPmString) {
        var d = new Date("1/1/2013 " + amPmString);
        return d.getHours() + ':' + d.getMinutes();
    }
    $(document).on('click', '.clockpicker-button-done', function() {
        var b_endTime = $('#b_endTime').val();
        var b_startTime = $('#b_startTime').val();
        var a_star = $('input[name="sub_start_time[]"]').val();
        var a_end = $('input[name="sub_end_time[]"]').val();

        if (a_star == '') {
            $('input[name="sub_start_time[]"]').val(b_startTime);

        }

        if (a_end == '') {
            $('input[name="sub_end_time[]"]').val(b_endTime);

        }


    });
    $(document).on('click', '.removeAccSub', function() {
        if ($('.edu_accordion_container .edu_accord_parent').length == 1) {
            toastr.error(ltr_cant_msg);
            return false;
        } else {
            swal({
                    title: ltr_are_you_so_msg,
                    text: ltr_you_delete,
                    icon: "warning",
                    buttons: [ltr_cancel, ltr_ok],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $(this).closest('.edu_accord_parent').remove();
                    }

                });
        }
    });

    // Course Js

    $(document).on('click', '.edit_course, .add_course, .add_blog,.edit_blog', function() {
        var parentDiv = $('#courseModal');
        if ($(this).hasClass('add_course')) {
            parentDiv.find('#courseModalLabel').html(ltr_add_course);
            parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            parentDiv.find('.fileNameShow').html('');
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addEditCourse').attr('data-type', 'add');
        } else if ($(this).hasClass('add_blog')) {
            parentDiv.find('#blogModalLabel').html(ltr_add_blog);
            parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            parentDiv.find('.fileNameShow').html('');
            parentDiv.find('form').trigger('reset');
            parentDiv.find('input[name="image"]').addClass('require');
            parentDiv.find('input[name="image"]').removeClass('error');
            $(".summernote").summernote("code", '');
            parentDiv.find('.addEditBlog').attr('data-type', 'add');
        } else if ($(this).hasClass('edit_blog')) {
            parentDiv.find('#blogModalLabel').html(ltr_add_blog);
            parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            parentDiv.find('.fileNameShow').html('');
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addEditBlog').attr('data-type', 'add');
            parentDiv.find('#blogTitle').val($(this).closest('tr').find('td:eq(3)').text());
            parentDiv.find('.fileNameShow').html($(this).attr('data-img'));
            parentDiv.find('#blog_id').val($(this).attr('data-id'));
            parentDiv.find('#c_crsImg').removeClass('require');
            $(".summernote").summernote("code", $('<div/>').html($(this).attr('data-des')));

            parentDiv.find('.addEditBlog').attr('data-type', 'edit');
        } else {
            parentDiv.find('#courseModalLabel').html(ltr_edit_course);
            parentDiv.find('#blogTitle').val($(this).closest('tr').find('td:eq(3)').text());
            parentDiv.find('#c_startDate').val($(this).closest('tr').find('td:eq(4)').text());
            parentDiv.find('#c_endDate').val($(this).closest('tr').find('td:eq(5)').text());
            if ($(this).closest('tr').find('td:eq(2) img').attr('src') != '' || $(this).closest('tr').find('td:eq(2) img').attr('src') != 'undefined') {
                parentDiv.find('#c_crsImg').removeClass('require').val('').closest('.form-group').find('label sup').addClass('hide');
            }

            parentDiv.find('#c_clsSize').val($(this).closest('tr').find('td:eq(7)').text());
            parentDiv.find('#c_timeDurat').val($(this).closest('tr').find('td:eq(8)').text());
            var ttt = $(this).closest('tr').find('a').attr('data-word');
            if (ttt != undefined) {
                parentDiv.find('#c_desc').val(ttt);
            } else {
                parentDiv.find('#c_desc').val($(this).closest('tr').find('td:eq(9)').text());
            }
            parentDiv.find('.addEditCourse').attr('data-type', 'edit');
            parentDiv.find('#course_id').val($(this).attr('data-id'));
            parentDiv.find('.fileNameShow').html($(this).attr('data-img'));
        }
        $.magnificPopup.open({
            items: {
                src: '#courseModal',
            },
            type: 'inline'
        });
    });
    // upcoming exam
    $(document).on('click', '.edit_vacancy, .add_doubt_ask, .add_vacancy, .appointmentDate', function() {
        var parentDiv = $('#input_feilds_vacancy');
        if ($(this).hasClass('appointmentDate')) {
            var doubt_id = $(this).attr('data-id');
            parentDiv.find('#myModalLabel1').html(ltr_add_doubts_date_class);
            parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            parentDiv.find('form').trigger('reset');
            parentDiv.find('#doubt_id').val(doubt_id);
            var userid = $(this).attr('data-userid');
            $('#user_id').val(userid);
            var batch_id = $(this).attr('data-batchid');
            $('#batch_id').val(batch_id);
            var doubtdate = $(this).attr('data-doubtdate');
            var doubtdes = $(this).attr('data-doubtdes');
            var doubttime = $(this).attr('data-doubttime');

            parentDiv.find('#doubts_date').val(doubtdate);
            parentDiv.find('#doubts_time').val(doubttime);
            parentDiv.find('#description').val(doubtdes);

            var batchstart_date = $(this).attr('data-startDate');
            var batchend_date = $(this).attr('data-endDate');

            parentDiv.find('#b_startDate').val(batchstart_date);
            parentDiv.find('#b_endDate').val(batchend_date);

            var startbatchDateArr = batchstart_date.split('-');
            var endbatchDateArr = batchend_date.split('-');

            var batchstart_date = startbatchDateArr[1] + '-' + startbatchDateArr[0] + '-' + startbatchDateArr[2];
            var batchend_date = endbatchDateArr[1] + '-' + endbatchDateArr[0] + '-' + endbatchDateArr[2];

            $('.chooseDate').datepicker('option', 'minDate', new Date(batchstart_date));
            $('.chooseDate').datepicker('option', 'maxDate', new Date(batchend_date));


        } else if ($(this).hasClass('add_doubt_ask')) {
            parentDiv.find('form').trigger('reset');
        } else if ($(this).hasClass('add_vacancy')) {
            parentDiv.find('#myModalLabel1').html(ltr_add_new_exam);
            parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            parentDiv.find('.fileNameShow').html('');
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addNewVacancy').attr('data-type', 'add');
        } else {
            parentDiv.find('#myModalLabel1').html('Edit Exam');
            var tttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
            if (tttt != undefined) {
                parentDiv.find('#title').val(tttt);
            } else {
                parentDiv.find('#title').val($(this).closest('tr').find('td:eq(2)').text());
            }

            var ttt = $(this).closest('tr').find('td:eq(3)').find('a').attr('data-word');
            if (ttt != undefined) {
                parentDiv.find('#description').val(ttt);
            } else {
                parentDiv.find('#description').val($(this).closest('tr').find('td:eq(3)').text());
            }
            parentDiv.find('#start_date').val($(this).closest('tr').find('td:eq(4)').text());
            parentDiv.find('#last_date').val($(this).closest('tr').find('td:eq(5)').text());
            parentDiv.find('#mode').val($(this).closest('tr').find('td:eq(6)').text()).trigger('change');
            parentDiv.find('.fileNameShow').html($(this).attr('data-img'));
            parentDiv.find('.addNewVacancy').attr('data-type', 'edit');
            parentDiv.find('#vac_id').val($(this).attr('data-id'));
        }
        $.magnificPopup.open({
            items: {
                src: '#input_feilds_vacancy',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.MultiappointmentDate', function() {
        var parentDiv = $('#input_feilds_vacancy');

        parentDiv.find('#myModalLabel1').html(ltr_add_doubts_date_class);
        parentDiv.find('#c_crsImg').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
        parentDiv.find('form').trigger('reset');
        parentDiv.find('#doubt_id').val("all");

        $('#user_id').val("all");




        $.magnificPopup.open({
            items: {
                src: '#input_feilds_vacancy',
            },
            type: 'inline'
        });
    });
    // Batch Js

    $(document).on('click', '.addEditCourse, .addEditBatch', function() {
        var formdata = new FormData($(this).closest('form')[0]);
        var type = $(this).attr('data-type');
        formdata.append('type', type)
        if ($(this).hasClass('addEditBatch')) {
            var url = base_url + "ajaxcall/addbatch";
            var modal_id = $('#batchModal');
            var name = 'Batch';
            var startDate = $('#b_startDate').val();
            var endDate = $('#b_endDate').val();
            var value = 0;
            var batchType = $("input[name='batchType']:checked").val();
            var batchPrice = $('#batchPrice').val();
            var batchOfferPrice = $('#batchOfferPrice').val();
            if (batchType == 2 && batchPrice == '') {
                $('#batchPrice').focus();
                toastr.error(ltr_batch_price_msg);
                return false;
            }

            if (batchPrice != '' && batchPrice != undefined) {
                var amount = batchPrice;
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/convertCurrency",
                    data: { 'amount': amount },
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            if (resp['convert'] < 1) {
                                $('#batchPrice').addClass('error').focus();
                                toastr.error(ltr_payment_msg);
                                return false;
                            }
                        }
                    }
                });
                //toastr.error(ltr_offer_price_msg);
            }

            if (batchOfferPrice != '' && batchOfferPrice != undefined) {
                var amount = batchOfferPrice;
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/convertCurrency",
                    data: { 'amount': amount },
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        console.log(resp['convert']);
                        if (resp['status'] == '1') {
                            if (resp['convert'] < 1) {
                                $('#batchOfferPrice').addClass('error').focus();
                                toastr.error(ltr_payment_msg);
                                return false;
                            }
                        }
                    }
                });
                //toastr.error(ltr_offer_price_msg);
            }


        } else {
            var url = base_url + "ajaxcall/addcourse";
            var modal_id = $('#courseModal');
            var name = 'Course';
            var startDate = $('#c_startDate').val();
            var endDate = $('#c_endDate').val();
        }

        var valid_check = validate_form($(this).closest('form'));

        if (valid_check == 'valid') {
            var startDateArr = startDate.split('-');
            var endDateArr = endDate.split('-');
            var startDate = startDateArr[1] + '-' + startDateArr[0] + '-' + startDateArr[2];
            var endDate = endDateArr[1] + '-' + endDateArr[0] + '-' + endDateArr[2];

            if (new Date(endDate) <= new Date(startDate)) {
                toastr.error(ltr_end_date_msg);
                return false;
            } else if ($(this).hasClass('addEditBatch') && $('.edu_accordion_container .edu_accord_parent').length == 0) {
                toastr.error(ltr_subject_msg);
                return false;
            } else {
                if ($(this).hasClass('addEditBatch')) {
                    var batchChapter = [];
                    $('select.filter_chapter').each(function() {
                        batchChapter.push($(this).val());
                        console.log($(this).val());
                    });
                    console.log(batchChapter);
                    formdata.append('batch_chapter', JSON.stringify(batchChapter));


                    var batchSubFecherd = [];
                    $('.count_heading').each(function() {
                        var arrayFecherd = [];
                        $(this).find('.fecherd').each(function() {
                            arrayFecherd.push($(this).val());
                        });
                        batchSubFecherd.push(arrayFecherd);
                    });

                    //console.log(batchSubFecherd);
                    formdata.append('batch_sub_fecherd', JSON.stringify(batchSubFecherd));

                }

                //	return false;
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: url,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            if (resp['url']) {
                                window.location.href = resp['url'];
                            } else {
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();
                                modal_id.find('.mfp-close').trigger('click');
                            }
                        } else if (resp['status'] == '2') {
                            toastr.error(resp['msg']);
                        } else {
                            toastr.error(ltr_something_msg);
                        }
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if (textstatus === 'timeout') {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    }
                });
            }
        }

    });

    $(document).on('keyup paste keypress Keydown', '#batchPrice, #batchOfferPrice', function(e) {
        var hval = $(this).val();
        $(this).attr('data-conv', hval);

    });

    // Student Js

    $('.find_student').on('click', function() {
        console.log("555555555555");
        targetTableUrl = $('.server_datatable').attr('data-url');
        var lgStatus = $('#lgStatus').val();
        var user_status = $('#user_status').val();
        var user_batch = $('#user_batch').val();
        dataTableObj.ajax.url(base_url + targetTableUrl + '?lgStatus=' + lgStatus + '&user_status=' + user_status + '&user_batch=' + user_batch).load();
        $('.create_ppr_popup').hide();
    });

    $('.search_studentsFind').on('click', function() {
        targetTableUrl = $('.server_datatable').attr('data-url');
        var id = $('.usersName').val();
        dataTableObj.ajax.url(base_url + targetTableUrl + '?id=' + id).load();
    });

    $(document).on('click', '.addNewStudent', function() {
        var formdata = new FormData($('#add_student_form')[0]);
        var type = $(this).attr('data-type');
        formdata.append('type', type)
        var valid_check = validate_form($(this).closest('form'));
        var student_name = $('#add_student_form input[name="name"]').val();

        if (valid_check == 'valid') {

            if (student_name.length >= 50) {
                toastr.error(ltr_characters_msg);
                $('#add_student_form input[name="name"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="name"]').removeClass("error");
            }

            var father_name = $('#add_student_form input[name="father_name"]').val();
            if (father_name.length >= 50) {
                toastr.error(ltr_characters_msg);
                $('#add_student_form input[name="father_name"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="father_name"]').removeClass("error");
            }

            var father_designtn = $('#add_student_form input[name="father_designtn"]').val();
            if (father_designtn.length >= 50) {
                toastr.error(ltr_characters_msg);
                $('#add_student_form input[name="father_designtn"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="father_designtn"]').removeClass("error");
            }

            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/addNewStudent",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        if (type == 'add') {
                            if (resp['enroll_id'] != '' && resp['password'] != '') {
                                $('#add_student_form').html('<div class="enrollmentDetails text-center"><p >' + ltr_password_student_msg + '<b> ' + student_name + '</b> is </p><h5 class="padderTop20">' + ltr_enrollment_id + ' : ' + resp['enroll_id'] + '</h5><h5 class="padderBottom20">' + ltr_password + ' : ' + resp['password'] + '</h5><a href="' + base_url + 'admin/add-student" class="btn btn-primary">' + ltr_add_another_student + '</a></div>');
                            }
                        } else {
                            setTimeout(function() {
                                window.location.href = base_url + 'admin/student-manage';
                                // location.reload();
                            }, 1000);
                        }
                    } else if (resp['status'] == '0') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    // 	toastr.error(ltr_duplicate_email);
                    $('.edu_preloader').fadeOut();
                }
            });
        }

    });

    $(document).on('click', '.addEditBlog', function() {
        var formdata = new FormData($('#blogForm')[0]);
        var type = $(this).attr('data-type');
        formdata.append('type', type)
        var valid_check = validate_form($(this).closest('form'));
        targetTableUrl = $('.server_datatable').attr('data-url');
        if (valid_check == 'valid') {

            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/addBlog",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('#courseModal').find('.mfp-close').trigger('click');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                    } else if (resp['status'] == '0') {
                        toastr.error(resp['msg']);
                        $('#courseModal').find('.mfp-close').trigger('click');
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }

    });

    $(document).on('change', '.changeStudBatch', function() {
        var batch_id = $(this).val();
        if (batch_id == '') {
            toastr.error(ltr_select_batch_msg);
        } else {
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/change_student_batch",
                data: { 'batch_id': batch_id, 'id': $(this).attr('data-id') },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(ltr_changed_batch_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                }
            });
        }

    });

    $(document).on('click', '.changePassModal', function() {
        $('#changePassword .updateStudPassword').attr('data-id', $(this).attr('data-id'));
        $('#changePassword #newPass').val();
        $('#changePassword #confirmPass').val();
        $('#changePassword .modal-title').html(ltr_changed_password_for_msg + $(this).closest('tr').find('td:eq(1)').text());
        $.magnificPopup.open({
            items: {
                src: '#changePassword',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.updateStudPassword', function() {
        var valid_check = validate_form($(this).closest('form'));
        if (valid_check == 'valid') {
            if ($('#newPass').val() != $('#confirmPass').val()) {
                toastr.error(ltr_confirm_password_msg);
                $('#confirmPass').focus();
                $('#newPass').val('');
                $('#confirmPass').val('');
                return false;
            } else {
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/update_student_pass",
                    data: { 'id': $(this).attr('data-id'), 'password': $('#newPass').val() },
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(ltr_password_msg);
                            $('#changePassword').find('.mfp-close').trigger('click');
                            $('#newPass').val('');
                            $('#confirmPass').val('');
                        } else {
                            toastr.error(ltr_something_msg);
                        }
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                    }
                });
            }
        }
    });

    $('.find_student').on('click', function() {
        console.log("dssssssssssss");
        targetTableUrl = $('.server_datatable').attr('data-url');
        var lgStatus = $('#lgStatus').val();
        var user_status = $('#user_status').val();
        var user_batch = $('#user_batch').val();
        dataTableObj.ajax.url(base_url + targetTableUrl + '?lgStatus=' + lgStatus + '&user_status=' + user_status + '&user_batch=' + user_batch).load();
        $('.create_ppr_popup').hide();
    });

    $(document).on('keypress', '.alphaField', function(e) {
        var key = e.keyCode;
        if (key >= 48 && key <= 57) {
            e.preventDefault();
        }
    });

    // subject js
    if ($(".addSubject").length) {
        //console.log();
        var input = document.getElementById("subjectName");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(".addSubject").trigger("click");
            }
        });
    }

    $(document).on('click', '.edit_SbjectChaptr,.addSubjctPop', function() {

        if ($(this).hasClass('addSubjctPop')) {
            $('#subjectName').val('').removeClass('error');
            $.magnificPopup.open({
                items: {
                    src: '#subjectsPopup',
                },
                type: 'inline'
            });
        } else {
            $('#subjectEditName').val($(this).closest('tr').find('td:eq(2)').text()).removeClass('error');
            $('.editSubject').attr('data-id', $(this).attr('data-id'));
            $.magnificPopup.open({
                items: {
                    src: '#subjectsEditPopup',
                },
                type: 'inline'
            });
        }
    });

    $(document).on('click', '.addSubject, .editSubject', function() {
        var inputfld = $(this).closest('form').find('input[type="text"]');
        var id = $(this).attr('data-id');
        // 		var TagReg = /[<>`;&=+/()|^%*+]/g;
        if (inputfld.val() == '') {
            toastr.error(ltr_subject_name_msg);
            inputfld.addClass('error').focus();
            return false;
            // 		}else if(TagReg.test(inputfld.val()) == true){
            // 			toastr.error(ltr_letters_characters_msg);
            // 			return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_subject",
                data: { 'name': inputfld.val(), 'id': id },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        inputfld.val('');
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                        if (id != '') {
                            toastr.success(inputfld.val() + ltr_subject_updated_msg);
                            $('#subjectsEditPopup').find('.mfp-close').trigger('click');
                        } else {
                            toastr.success(inputfld.val() + ltr_subject_add_msg);
                            $('#subjectsPopup').find('.mfp-close').trigger('click');
                        }
                    } else if (resp['status'] == '2') {
                        toastr.error(ltr_subject_exists_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.edit_Category,.addcatPop', function() {

        if ($(this).hasClass('addcatPop')) {
            $('#categoryName').val('').removeClass('error');
            $.magnificPopup.open({
                items: {
                    src: '#categoryPopup',
                },
                type: 'inline'
            });
        } else {
            $('#categoryEditName').val($(this).closest('tr').find('td:eq(2)').text()).removeClass('error');
            $('.editCategory').attr('data-id', $(this).attr('data-id'));
            $.magnificPopup.open({
                items: {
                    src: '#categoryEditPopup',
                },
                type: 'inline'
            });
        }
    });


    $(document).on('click', '.addCategory, .editCategory', function() {
        var inputfld = $(this).closest('form').find('input[type="text"]');
        var id = $(this).attr('data-id');
        var TagReg = /[<>`;&=+/()|^%*+]/g;
        if (inputfld.val() == '') {
            toastr.error(ltr_cat_name_msg);
            inputfld.addClass('error').focus();
            return false;
        } else if (TagReg.test(inputfld.val()) == true) {
            toastr.error(ltr_letters_characters_msg);
            return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_category",
                data: { 'name': inputfld.val(), 'id': id },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        inputfld.val('');
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                        if (id != '') {
                            toastr.success(inputfld.val() + ltr_cat_updated_msg);
                            $('#categoryEditPopup').find('.mfp-close').trigger('click');
                        } else {
                            toastr.success(inputfld.val() + ltr_cat_add_msg);
                            $('#categoryPopup').find('.mfp-close').trigger('click');
                        }
                    } else if (resp['status'] == '2') {
                        toastr.error(ltr_cat_exists_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.editsub_Category,.addsubcatPop', function() {

        if ($(this).hasClass('addsubcatPop')) {
            $('#subcategoryName').val('').removeClass('error');
            $.magnificPopup.open({
                items: {
                    src: '#subcategoryPopup',
                },
                type: 'inline'
            });
        } else {
            $('#subcategoryEditName').val($(this).closest('tr').find('td:eq(3)').text()).removeClass('error');
            $('#categoryData').val($(this).attr('data-catid')).trigger('change');
            $('.editsubCategory').attr('data-id', $(this).attr('data-id'));
            $.magnificPopup.open({
                items: {
                    src: '#subcategoryEditPopup',
                },
                type: 'inline'
            });
        }
    });

    $(document).on('click', '.addsubCategory, .editsubCategory', function() {

        var inputfld = $(this).closest('form').find('input[type="text"]');
        var cat_id = $(this).closest('form').find('select[name="category"]');
        var id = $(this).attr('data-id');
        var TagReg = /[<>`;&=+/()|^%*+]/g;
        if (inputfld.val() == '') {
            toastr.error(ltr_cat_name_msg);
            inputfld.addClass('error').focus();
            return false;
        } else if (TagReg.test(inputfld.val()) == true) {
            toastr.error(ltr_letters_characters_msg);
            return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_subcategory",
                data: { 'name': inputfld.val(), 'id': id, 'cat_id': cat_id.val() },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        inputfld.val('');
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                        if (id != '') {
                            toastr.success(inputfld.val() + ltr_cat_updated_msg);
                            $('#subcategoryEditPopup').find('.mfp-close').trigger('click');
                        } else {
                            toastr.success(inputfld.val() + ltr_cat_add_msg);
                            $('#subcategoryPopup').find('.mfp-close').trigger('click');
                        }
                    } else if (resp['status'] == '2') {

                        toastr.error(ltr_cat_exists_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.deleteSubject', function() {

        swal({
                title: ltr_are_you_so_msg,
                text: ltr_subject_delete_alert_msg,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/deleteSubjects",
                        data: { 'id': $(this).attr('data-id') },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();

                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });
    });

    $(document).on('click', '.addChapers, .editChapterName', function() {
        if ($(this).hasClass('editChapterName')) {
            $('#chapterEditPopup #chapterEditName').val('');
            var id = $(this).closest('.ChapterEditDltWrap').attr('data-id');
            var sid = $(this).closest('.ChapterEditDltWrap').attr('data-sid');

            $('.editChapterofSub').attr('data-sid', sid).attr('data-id', id);
            var ttt = $(this).closest('.ChapterEditDltWrap').attr('data-word');
            //alert(ttt);
            if (ttt != undefined) {
                $('#chapterEditPopup #chapterEditName').val(ttt);
            } else {
                $('#chapterEditPopup #chapterEditName').val($(this).closest('.chapter_wrap').text());
            }
            $('#chapterEditPopup .subject_name').html(ltr_subject + ': ' + $(this).closest('tr').find('td:eq(2)').text()).removeClass('error');

            $.magnificPopup.open({
                items: {
                    src: '#chapterEditPopup',
                },
                type: 'inline'
            });
        } else {
            $('.addChapterofSub').attr('data-sid', $(this).attr('data-id'));
            $('#chapterPopup .subject_name').html(ltr_subject + ': ' + $(this).closest('tr').find('td:eq(2)').text());
            $('#chapterPopup #chapterName').val('').removeClass('error');
            $.magnificPopup.open({
                items: {
                    src: '#chapterPopup',
                },
                type: 'inline'
            });
        }
    });

    $(document).on('click', '.charaViewPopupModel', function() {

        var word = $(this).attr('data-word');
        var title = $(this).attr('data-title');
        $('#charactersViewPopup #charaTitele').html(title);
        $('#charactersViewPopup .charactersViewResult').html(word);
        $.magnificPopup.open({
            items: {
                src: '#charactersViewPopup',
            },
            type: 'inline'
        });
    });
    $(document).on('click', '.addChapterofSub', function() {
        var inputfld = $(this).closest('form').find('textarea');
        var sid = $(this).attr('data-sid');
        // 		var TagReg = /[<>`;&=+/()|^%*+]/g;
        if (inputfld.val() == '') {
            toastr.error(ltr_atleast_chapter_msg);
            inputfld.focus().addClass('error');
            return false;
            // 		}else if(TagReg.test(inputfld.val()) == true){
            // 			toastr.error(ltr_letters_characters_msg);
            // 			return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_chapter",
                data: { 'name': inputfld.val(), 'sid': sid },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        inputfld.val('');
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                        toastr.success(ltr_add_chapter_msg);
                        $('#chapterPopup').find('.mfp-close').trigger('click');
                    } else if (resp['status'] == '2') {
                        var char = resp['char'];
                        toastr.error(char + ' ' + ltr_exists_chapter_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.editChapterofSub', function() {
        var inputfld = $('#chapterEditName');
        var sid = $(this).attr('data-sid');
        var id = $(this).attr('data-id');
        var TagReg = /[<>`;&=+/()|^%*+]/g;
        if (inputfld.val() == '') {
            toastr.error(ltr_chapter_name_msg);
            inputfld.focus();
            return false;
        } else if (TagReg.test(inputfld.val()) == true) {
            toastr.error(ltr_letters_characters_msg);
            return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/edit_chapter",
                data: { 'name': inputfld.val(), 'sid': sid, 'id': id },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        inputfld.val('');
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                        toastr.success(ltr_chapter_updated_msg);
                        $('#chapterEditPopup').find('.mfp-close').trigger('click');
                    } else if (resp['status'] == '2') {
                        toastr.error(ltr_exists_chapter_msg);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.deleteChapterName', function() {
        swal({
                title: ltr_are_you_so_msg,
                text: ltr_chapter_delete_msg,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    var id = $(this).closest('.ChapterEditDltWrap').attr('data-id');
                    var sid = $(this).closest('.ChapterEditDltWrap').attr('data-sid');
                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/deleteChapter",
                        data: { 'id': id, 'sid': sid },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();

                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });
    });

    //question js
    $(document).on('change', '.filter_subject', function() {
        var subject = $(this).val();

        if (subject != '') {
            if ($(this).hasClass('modalSubjectCls')) {

                get_chapter($('.filter_modal_chapter'), subject);

            } else if ($(this).attr('data-teacher') == 'yes') {
                get_chapter('filter_chapter', subject, 'filter_teacher', $(this));
                $(this).closest('.edu_accord_parent').find('.edu_accordion_header span.subjects_name').text($(this).find('option:selected').text());
            } else if ($(this).hasClass('video_subject')) {
                var batch_id = $('.video_batch').val();
                get_chapter($('.filter_chapter'), subject, '', '', $(this).attr('data-count'), batch_id);
                console.log(batch_id);
            } else {
                get_chapter($('.filter_chapter'), subject, '', '', $(this).attr('data-count'));
            }

        }
    });

    $(document).on('change', '.filter_batch', function() {

        var batch = $(this).val();
        if (batch != '') {
            if ($(this).hasClass('video_batch')) {
                get_teacher('filter_subject', batch, 'subject', $(this));

            } else if ($(this).hasClass('book_batch')) {
                console.log(batch);
                get_subject('filter_subject', batch, 'subject', $(this));
                console.log(batch);
            } else {

                if ($(this).attr('data-teacherbatch') == 'yes') {
                    var tid = $('.extra_class_batch').find('[name="teachr_id"]').val();
                    if (tid != '') {
                        get_teacher('filter_teacher', batch, tid, $(this));
                    } else {

                        get_teacher('filter_teacher', batch, 'yes', $(this));
                    }
                    $('.extra_class_batch').find('[name="teachr_id"]').val('');

                } else {
                    console.log($('.filter_chapter'));
                    //	get_chapter($('.filter_chapter'),subject,'','',$(this).attr('data-count'));
                }
            }
        }

    });

    $(document).on('change', '.video_batch', function() {

        var batch = $(this).val();
        if (batch != '') {
            if ($(this).hasClass('video_batch')) {
                get_subject('filter_subject', batch, 'subject', $(this));

            } else if ($(this).hasClass('book_batch')) {
                console.log(batch);
                get_subject('filter_subject', batch, 'subject', $(this));
            } else {

                if ($(this).attr('data-teacherbatch') == 'yes') {
                    var tid = $('.extra_class_batch').find('[name="teachr_id"]').val();
                    if (tid != '') {
                        get_teacher('filter_teacher', batch, tid, $(this));
                    } else {

                        get_teacher('filter_teacher', batch, 'yes', $(this));
                    }
                    $('.extra_class_batch').find('[name="teachr_id"]').val('');

                } else {
                    console.log($('.filter_chapter'));
                    //	get_chapter($('.filter_chapter'),subject,'','',$(this).attr('data-count'));
                }
            }
        }

    });

    function get_subject(subject_cls, batchId, subject = '', _this, count = '') {
        if (subject_cls != '') {
            $('.' + subject_cls).html("<option> " + ltr_loading_msg + " ... </option>");
        }

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_subjects",
            data: { 'batch_id': batchId },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                console.log(resp);
                if (resp['status'] == '1') {
                    if (subject != '') {
                        if (subject == "subject") {

                            $('.' + subject_cls).html(resp['html']);
                        } else {

                            $('.' + subject_cls).html(resp['html']);
                        }
                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });
    }

    function get_chapter(chapter_cls, subject, teacher = '', _this, count = '', batch_id = '') {
        if (teacher != '') {
            _this.closest('.edu_accord_parent').find('.' + chapter_cls).html("<option> " + ltr_loading_msg + " ... </option>");
            _this.closest('.edu_accord_parent').find('.' + teacher).html("<option> " + ltr_loading_msg + " ... </option>");
        } else {
            chapter_cls.html("<option> " + ltr_loading_msg + " ... </option>");
        }

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_chapter",
            data: { 'subject': subject, 'teacher': teacher, 'count': count, 'batch_id': batch_id },
            success: function(resp) {
                var resp = $.parseJSON(resp);

                if (resp['status'] == '1') {
                    if (teacher != '') {
                        _this.closest('.edu_accord_parent').find('.' + chapter_cls).html(resp['html']);
                        _this.closest('.edu_accord_parent').find('.' + teacher).html(resp['teacherHtml']);


                        _this.closest('.' + chapter_cls).val('').trigger('change');
                    } else {
                        chapter_cls.html(resp['html']);

                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });
    }

    function get_teacher(teacher_cls, batchId, teacher = '', _this, count = '') {
        if (teacher_cls != '') {
            _this.closest('.extra_class_batch').find('.' + teacher_cls).html("<option> " + ltr_loading_msg + " ... </option>");
        }

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_batch_teacher",
            data: { 'batchId': batchId, 'teacher': teacher, 'count': count },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    if (teacher != '') {
                        if (teacher == "subject") {

                            _this.closest('.video_lecture_batch').find('.' + teacher_cls).html(resp['teacherHtml']);
                        } else {

                            _this.closest('.extra_class_batch').find('.' + teacher_cls).html(resp['teacherHtml']);
                        }
                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });
    }

    $('.filter_question').on('click', function() {
        if ($('.filter_subject').val() == '') {
            toastr.error(ltr_select_subject_msg);
            return false;
        } else if ($('.filter_subject').val() == '' && $('.filter_chapter').val() != '') {
            toastr.error(ltr_select_subject_both_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var subject = $('.filter_subject').val();
            var chapter = $('.filter_chapter').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject + '&chapter=' + chapter).load();

        }
        $('.create_ppr_popup').hide();
    });

    $('.filter_by_word').on('click', function() {
        if ($('.filter_word').val() == '') {
            toastr.error(ltr_word_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var word = $('.filter_word').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?word=' + word).load();

        }
    });

    $(document).on('click', '.addQuestionPopShow, .edit_question', function() {
        //CKEDITOR.remove('question');
        if (CKEDITOR.instances.question) CKEDITOR.instances.question.destroy();
        if ($(this).hasClass('addQuestionPopShow')) {

            $('.bulk_upload').removeClass("hide");
            $('#questionPopup').find('form').trigger('reset');
            $('#questionPopup').find('#questionPopupLabel').html('Add Question');
            $('#questionPopup').find('.add_Newquestion').attr('data-id', '').val('Add Question');
            $('#questionPopup').find('select[name="subject_id"]').val('').trigger('change');
            $('#questionPopup').find('select[name="chapter_id"]').html('').trigger('change');
        } else {

            $('.bulk_upload').addClass("hide");
            $('#questionPopup').find('#questionPopupLabel').html('Edit Question');
            $('#questionPopup').find('.add_Newquestion').attr('data-id', $(this).attr('data-id')).val('Update Question');
            $('#questionPopup').find('select[name="subject_id"]').val($(this).attr('data-sub')).trigger('change');
            var chapter = $(this).attr('data-chap');
            setTimeout(function() {
                $('#questionPopup').find('select[name="chapter_id"]').val(chapter).trigger('change');
            }, 500);
            var ttt = $(this).closest('tr').find('a').attr('data-word');
            if (ttt != undefined) {
                $('#questionPopup').find('[name="question"]').val(ttt);
            } else {
                $('#questionPopup').find('[name="question"]').val($(this).closest('tr').find('td:eq(2)').text());
            }
            $('#questionPopup').find('[value="' + $(this).closest('tr').find('td:eq(4)').text() + '"].ansRadioChck').prop('checked', 'checked');
            var optionTd = $(this).closest('tr').find('td:eq(3)');
            var i = 1;
            $('#questionPopup #question_options').find('input').each(function() {
                $(this).val(optionTd.find('span.option_' + i).text());
                i++;
            });
        }
        $.magnificPopup.open({
            items: {
                src: '#questionPopup',
            },
            type: 'inline'
        });
        CKEDITOR.replace('question', {
            extraPlugins: 'mathjax',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
        });

    });

    $(document).on('click', '.add_Newquestion', function() {
        var validchk = validate_form($(this).closest('form'));
        var value = CKEDITOR.instances['question'].getData();
        var option1 = CKEDITOR.instances['option1'].getData();
        var option2 = CKEDITOR.instances['option2'].getData();
        var option3 = CKEDITOR.instances['option3'].getData();
        var option4 = CKEDITOR.instances['option4'].getData();

        if (value == "") {
            toastr.error('Some required fields are missing.');
            return false;
        }
        if (option1 == "") {
            toastr.error('Some required fields are missing.');
            return false;
        }
        if (option2 == "") {
            toastr.error('Some required fields are missing.');
            return false;
        }
        if (option3 == "") {
            toastr.error('Some required fields are missing.');
            return false;
        }
        if (option4 == "") {
            toastr.error('Some required fields are missing.');
            return false;
        }

        if (validchk == 'valid') {
            if ($('input[type=radio].ansRadioChck:checked').length > 0) {
                var formdata = new FormData($(this).closest('form')[0]);
                formdata.append('question', value);
                var id = $(this).attr('data-id');
                formdata.append('question_id', id);
                formdata.append('option1', option1);
                formdata.append('option2', option2);
                formdata.append('option3', option3);
                formdata.append('option4', option4);

                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/add_question",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        console.log(resp);
                        var resp = $.parseJSON(resp);
                        $('.create_ppr_popup').hide();
                        $(".checkOneRow").prop("checked", false);
                        $(".checkAllAttendance").prop("checked", false);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            setTimeout(function() {
                                window.location.href = resp['url'];
                            }, 500);
                            targetTableUrl = $('.server_datatable').attr('data-url');
                            dataTableObj.ajax.url(base_url + targetTableUrl).load();
                            var no_data = $('.eac_page_re').html();
                            if (no_data != undefined) {
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 500);
                            }

                        } else if (resp['status'] == '2') {
                            toastr.error(resp['msg']);

                        } else {
                            toastr.error(ltr_something_msg);
                        }
                        $('#questionPopup').find('.mfp-close').trigger('click');
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                    }
                });
            } else {
                toastr.error(ltr_answer_msg);
                return false;
            }
        }
    });

    //notice js

    if ($('#noticePage').length)
        $('span.notice_count').remove();

    $(document).on('click', '.addNewNotice', function() {
        var url_data = $('.tabTableCls').find('.active').prop('href');
        var arr = url_data.split('#');

        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);

            var notice_for = formdata.get('notice_for');

            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_notice",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('#input_feilds_notice').find('form').trigger('reset');
                        /*targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url+targetTableUrl).load();*/
                        if (arr[1] == "common") {
                            dataTableObj.ajax.url(base_url + "ajaxcall/notice_table/common").load();
                        }
                        if (arr[1] == "student") {
                            dataTableObj.ajax.url(base_url + "ajaxcall/notice_table/student").load();
                        }
                        if (arr[1] == "teacher") {
                            dataTableObj.ajax.url(base_url + "ajaxcall/notice_table/teacher").load();
                        }

                        $("." + notice_for).trigger("click");
                        $(".tabTableCls").find(".nav-link").removeClass('active show');
                        $("." + notice_for).find(".nav-link").addClass('active show');

                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }

                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('#input_feilds_notice').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.addPrsnlNotice', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_personal_notice",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('#input_feilds_notice').find('.mfp-close').trigger('click');
                    $('input[name="title"]').val('');
                    $('textarea[name="description"]').val('');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $('.tabTableCls').on('click', function() {
        targetTableUrl = $(this).attr('data-url');
        dataTableObj.ajax.url(base_url + targetTableUrl).load();
    });

    //vacancy js

    $(document).on('click', '.addNewVacancy', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var _this = $(this);

            if ($(this).attr('data-type') == 'add') {
                var aurl = "ajaxcall/add_vacancy";
            } else {
                var aurl = "ajaxcall/edit_vacancy";
            }
            var startDateArr = $('#start_date').val().split('-');
            var endDateArr = $('#last_date').val().split('-');
            var startDate = startDateArr[1] + '-' + startDateArr[0] + '-' + startDateArr[2];
            var endDate = endDateArr[1] + '-' + endDateArr[0] + '-' + endDateArr[2];

            if (new Date(endDate) <= new Date(startDate)) {
                toastr.error(ltr_start_date_greater_msg);
                return false;
            } else {
                var formdata = new FormData($(this).closest('form')[0]);
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + aurl,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            targetTableUrl = $('.server_datatable').attr('data-url');
                            dataTableObj.ajax.url(base_url + targetTableUrl).load();
                            var no_data = $('.eac_page_re').html();
                            if (no_data != undefined) {
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 500);
                            }
                            $('#input_feilds_vacancy').find('.mfp-close').trigger('click');
                        } else {
                            toastr.error(ltr_something_msg);
                        }
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                    }
                });
            }
        }
    });

    $(document).on('click', '.showinPopData', function() {
        var _this = $(this);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/showinPopData",
            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table') },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    $('#view_vacancy_files #VacancyTitlePop').html('Files - ' + _this.closest('tr').find('td:eq(1)').text());
                    $('#view_vacancy_files #VacancyDataPop').html(resp['html']);
                    $('#view_vacancy_files').find('.mfp-close').trigger('click');
                    $.magnificPopup.open({
                        items: {
                            src: '#view_vacancy_files',
                        },
                        type: 'inline'
                    });
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    //video js
    $(document).on('click', '.viewVideo', function() {
        var src = parseVideo($(this).attr('data-url'), $(this).attr('data-type'));
        var description = $(this).attr("data-desc");
        if (description = '') {
            var desc = description;
        } else {
            desc = '';
        }
        // 		console.log(src);
        var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><iframe width="100%" width="500" height="350" src="' + src + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span>' + desc + '</span></div>';
        $('#view_video_popup .videoIframeShow').html(html);
        $.magnificPopup.open({
            items: {
                src: '#view_video_popup',
            },
            type: 'inline'
        });
        $('#view_video_popup #viewVideoTopic').html($(this).closest('tr').find('td:eq(2)').text());
        $('#view_video_popup #viewVideoTitle').html($(this).closest('tr').find('td:eq(1)').text());
    });


    $('input[name=video_type]').on('change', function() {
        var video_type = $('input[name=video_type]:checked').val();
        if (video_type == "video") {
            $('.video_type_all').addClass("hide");
            $('.video_type_video').removeClass("hide");
            $('.video_type_video').find('input').addClass("require");
            $('.video_type_all').find('input').removeClass("require");

        } else {
            $('.video_type_video').addClass("hide");
            $('.video_type_all').removeClass("hide");
            $('.video_type_all').find('input').addClass("require");
            $('.video_type_video').find('input').removeClass("require");
        }

        $(".video_url").attr("data-valid", $('input[name=video_type]:checked').val());
    });
    $('input[name=payment_type]').on('change', function() {
        //alert($('input[name=video_type]:checked').val()); 
        if ($('input[name=payment_type]:checked').val() == 2) {
            $("input[name=paypal_client_id]").addClass("require");
            $("input[name=sandbox_accounts]").addClass("require");

        } else {
            $("input[name=razorpay_key_id]").addClass("require");
        }

    });



    $(document).on('click', '.addNewVideo', function() {

        var validchk = validate_form($(this).closest('form'));
        var formdata = new FormData($(this).closest('form')[0]);
        // alert("ok");
        if (validchk == 'valid') {
            //console.log($('input[name=video_type]:checked').val());
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            formdata.append('title', $.trim($('.video_title').val()));
            formdata.append('batch', $.trim($('.video_batch').val()));
            formdata.append('subject', $.trim($('.filter_subject option:selected').text()));
            formdata.append('topic', $.trim($('.filter_chapter option:selected').text()));
            formdata.append('url', $.trim($('.video_url').val()));
            formdata.append('video_type', $.trim($('input[name=video_type]:checked').val()));
            formdata.append('preview_type', $.trim($('input[name=preview_type]').val()));
            formdata.append('id', $.trim($('input[name=id]').val()));

            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    $('.progress').removeClass('hide');
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = ((evt.loaded / evt.total) * 100).toFixed(0);
                            $(".progress-bar").width(percentComplete + '%');
                            $(".progress-bar").html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                method: "POST",
                url: base_url + "ajaxcall/add_video",
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(".progress-bar").width('0%');
                    // $('#uploadStatus').html('<img src="'+base_url+'assets/images/loading.gif"/>');
                },
                error: function() {
                    $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                },

                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        $('#uploadForm')[0].reset();
                        $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                        toastr.success(resp['msg']);

                        if ($(".progress-bar").html('100%')) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 300);
                        }
                        // 		targetTableUrl = $('.server_datatable').attr('data-url');
                        // 		dataTableObj.ajax.url(base_url+targetTableUrl).load();
                        $('.pxn_amin form').find('form').trigger('reset');
                        var no_data = $('.eac_page_re').html();

                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 300);
                        }
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    // 	$('#add_video_popup').find('.mfp-close').trigger('click');
                    // 	$('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    // $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $('.searchVideo').on('click', function() {
        if ($('.filter_subject').val() != '' && $('.filter_chapter').val() != '') {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var subject = $.trim($('.filter_subject').val());
            var chapter = $.trim($('.get_chapter option:selected').text().replace("Select Chapter", ""));
            dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject + '&chapter=' + chapter).load();
        } else {
            toastr.error(ltr_select_subject_both_msg);
        }
    });

    //Teacher js

    function teacher_edit(id, subject_id) {
        var id = id;
        //  alert(subject_id);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/techaer_edit_new",
            data: { id: id },
            // processData: false,
            // contentType: false,
            success: function(resp) {
                var data = JSON.parse(resp);
                // var subject =JSON.parse(data[0]['teach_subject']);
                // alert(subject);
                $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('require');
                $('#input_feilds_teacher').find('[name="teach_image"]').val('');
                $('#input_feilds_teacher').find('#PopupTitle').html(ltr_edit_teacher);
                $('#input_feilds_teacher').find('.addNewTeacher').attr('data-id', data[0]['id']).val(ltr_update_teacher);
                var ttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
                if (ttt != undefined) {
                    $('#input_feilds_teacher').find('[name="name"]').val(data[0]['name']);
                } else {
                    $('#input_feilds_teacher').find('[name="name"]').val(data[0]['name']);
                }

                $('#input_feilds_teacher').find('[name="email"]').val(data[0]['email']).attr('readonly', 'readonly');
                $('#input_feilds_teacher').find('[name="teach_education"]').val(data[0]['teach_education']);
                $('#input_feilds_teacher').find('[name="teach_gender"]').val(data[0]['teach_gender']).trigger('change');
                $('#input_feilds_teacher').find('[name="password"]').removeClass('require').closest('.form-group').find('label sup').addClass('hide');
                $('#input_feilds_teacher').find('[value="' + $(this).closest('tr').find('td:eq(4)').text() + '"].ansRadioChck').prop('checked', 'checked');
                $('#input_feilds_teacher').find('.fileNameShow').html(data[0]['teach_image']);
                // var subject = $(this).attr('data-subject');
                // alert(subject_id);
                $('[name="teach_subject[]"]').val(subject_id.split(",")).trigger('change');
            }
        });
    }

    //Teacher js
    // $(document).on('click', '.addTeacherPop, .edit_teacher', function() {
    //     if ($(this).hasClass('addTeacherPop')) {
    //         if (($('#input_feilds_teacher').find('[name="teach_image"]').hasClass('require')) == false) {
    //             $('#input_feilds_teacher').find('[name="teach_image"]').addClass('require');
    //         }
    //         $('#input_feilds_teacher').find('form').trigger('reset');
    //         $('#input_feilds_teacher').find('#PopupTitle').html(ltr_add_teacher);
    //         $('#input_feilds_teacher').find('[name="teach_image"]').val('');
    //         $('#input_feilds_teacher').find('.addNewTeacher').attr('data-id', '').val(ltr_add_teacher);
    //         $('#input_feilds_teacher').find('[name="password"]').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
    //         $('#input_feilds_teacher').find('[name="email"]').removeAttr('readonly');
    //         $('#input_feilds_teacher').find('.fileNameShow').html('');
    //         $('#input_feilds_teacher [name="teach_subject[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
    //         $('#input_feilds_teacher [name="teach_subject[]"]').select2({ placeholder: ltr_select_subject });
    //         $('#input_feilds_teacher').find('[name="teach_gender"]').val('').trigger('change');
    //     } else {
    //         var id = $(this).attr('data-id');
    //         var subject = $(this).attr('data-subject');
    //         teacher_edit(id, subject);
    //         // $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('require');
    //         // $('#input_feilds_teacher').find('[name="teach_image"]').val('');
    //         // $('#input_feilds_teacher').find('#PopupTitle').html(ltr_edit_teacher);
    //         // $('#input_feilds_teacher').find('.addNewTeacher').attr('data-id', $(this).attr('data-id')).val(ltr_update_teacher);
    //         // var ttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
    //         // if (ttt != undefined) {
    //         //     $('#input_feilds_teacher').find('[name="name"]').val(ttt);
    //         // } else {
    //         //     $('#input_feilds_teacher').find('[name="name"]').val($(this).closest('tr').find('td:eq(2)').text());
    //         // }

    //         // $('#input_feilds_teacher').find('[name="email"]').val($(this).closest('tr').find('td:eq(3)').text()).attr('readonly', 'readonly');
    //         // $('#input_feilds_teacher').find('[name="teach_education"]').val($(this).closest('tr').find('td:eq(4)').text());
    //         // $('#input_feilds_teacher').find('[name="teach_gender"]').val($(this).closest('tr').find('td:eq(5)').text()).trigger('change');
    //         // $('#input_feilds_teacher').find('[name="password"]').removeClass('require').closest('.form-group').find('label sup').addClass('hide');
    //         // $('#input_feilds_teacher').find('[value="' + $(this).closest('tr').find('td:eq(4)').text() + '"].ansRadioChck').prop('checked', 'checked');
    //         // $('#input_feilds_teacher').find('.fileNameShow').html($(this).attr('data-img'));
    //         // var subject = $(this).attr('data-subject');
    //         // $('[name="teach_subject[]"]').val(subject.split(",")).trigger('change');

    //     }
    //     $.magnificPopup.open({
    //         items: {
    //             src: '#input_feilds_teacher',
    //         },
    //         type: 'inline'
    //     });
    // });
    $(document).on('click', '.addTeacherPop, .edit_teacher', function() {
        if ($(this).hasClass('addTeacherPop')) {
            if (($('#input_feilds_teacher').find('[name="teach_image"]').hasClass('require')) == false) {
                $('#input_feilds_teacher').find('[name="teach_image"]').addClass('require');
            }
            $('#input_feilds_teacher').find('form').trigger('reset');
            $('#input_feilds_teacher').find('#PopupTitle').html(ltr_add_teacher);
            $('#input_feilds_teacher').find('.addNewTeacher').attr('data-id', '').val(ltr_add_teacher);
            $('#input_feilds_teacher').find('[name="password"]').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            $('#input_feilds_teacher').find('[name="email"]').removeAttr('readonly');
            $('#input_feilds_teacher').find('.fileNameShow').html('');
            $('#input_feilds_teacher [name="teach_subject[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
            $('#input_feilds_teacher [name="teach_subject[]"]').select2({ placeholder: ltr_select_subject });
            $('#input_feilds_teacher').find('[name="teach_gender"]').val('').trigger('change');
        } else {
            $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('require');
            $('#input_feilds_teacher').find('#PopupTitle').html(ltr_edit_teacher);
            $('#input_feilds_teacher').find('.addNewTeacher').attr('data-id', $(this).attr('data-id')).val(ltr_update_teacher);
            var ttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
            if (ttt != undefined) {
                $('#input_feilds_teacher').find('[name="name"]').val(ttt);
            } else {
                $('#input_feilds_teacher').find('[name="name"]').val($(this).closest('tr').find('td:eq(2)').text());
            }

            $('#input_feilds_teacher').find('[name="email"]').val($(this).closest('tr').find('td:eq(3)').text()).attr('readonly', 'readonly');
            $('#input_feilds_teacher').find('[name="teach_education"]').val($(this).closest('tr').find('td:eq(4)').text());
            $('#input_feilds_teacher').find('[name="teach_gender"]').val($(this).closest('tr').find('td:eq(5)').text()).trigger('change');
            $('#input_feilds_teacher').find('[name="password"]').removeClass('require').closest('.form-group').find('label sup').addClass('hide');
            $('#input_feilds_teacher').find('[value="' + $(this).closest('tr').find('td:eq(4)').text() + '"].ansRadioChck').prop('checked', 'checked');
            $('#input_feilds_teacher').find('.fileNameShow').html($(this).attr('data-img'));
            var subject = $(this).attr('data-subject');
            $('[name="teach_subject[]"]').val(subject.split(",")).trigger('change');

        }
        $.magnificPopup.open({
            items: {
                src: '#input_feilds_teacher',
            },
            type: 'inline'
        });
    });
    // $(document).on('click','.addTeacherPop, .edit_teacher',function(){
    // 	if($(this).hasClass('addTeacherPop')){
    // 	    if(($('#input_feilds_teacher').find('[name="teach_image"]').hasClass('require'))==false){
    // 	        $('#input_feilds_teacher').find('[name="teach_image"]').addClass('require');
    // 	    }
    // 		$('#input_feilds_teacher').find('form').trigger('reset');
    // 		$('#input_feilds_teacher').find('#PopupTitle').html(ltr_add_teacher);
    // 		 $('#input_feilds_teacher').find('[name="teach_image"]').val(''); 
    // 		$('#input_feilds_teacher').find('.addNewTeacher').attr('data-id','').val(ltr_add_teacher);
    // 		$('#input_feilds_teacher').find('[name="password"]').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
    // 		$('#input_feilds_teacher').find('[name="email"]').removeAttr('readonly');
    // 		$('#input_feilds_teacher').find('.fileNameShow').html('');
    // 		$('#input_feilds_teacher [name="teach_subject[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
    // 		$('#input_feilds_teacher [name="teach_subject[]"]').select2({placeholder: ltr_select_subject});
    // 		$('#input_feilds_teacher').find('[name="teach_gender"]').val('').trigger('change');
    // 	}else{
    // 	    $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('require');
    // 	    $('#input_feilds_teacher').find('[name="teach_image"]').val(''); 
    // 		$('#input_feilds_teacher').find('#PopupTitle').html(ltr_edit_teacher);
    // 		$('#input_feilds_teacher').find('.addNewTeacher').attr('data-id',$(this).attr('data-id')).val(ltr_update_teacher);
    // 		var ttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
    // 		if(ttt != undefined){
    // 		    $('#input_feilds_teacher').find('[name="name"]').val(ttt);
    // 		}else{
    // 		    $('#input_feilds_teacher').find('[name="name"]').val($(this).closest('tr').find('td:eq(2)').text());
    // 		}

    // 		$('#input_feilds_teacher').find('[name="email"]').val($(this).closest('tr').find('td:eq(3)').text()).attr('readonly','readonly');
    // 		$('#input_feilds_teacher').find('[name="teach_education"]').val($(this).closest('tr').find('td:eq(4)').text());
    // 		$('#input_feilds_teacher').find('[name="teach_gender"]').val($(this).closest('tr').find('td:eq(5)').text()).trigger('change');
    // 		$('#input_feilds_teacher').find('[name="password"]').removeClass('require').closest('.form-group').find('label sup').addClass('hide');
    // 		$('#input_feilds_teacher').find('[value="'+$(this).closest('tr').find('td:eq(4)').text()+'"].ansRadioChck').prop('checked','checked');
    // 		$('#input_feilds_teacher').find('.fileNameShow').html($(this).attr('data-img'));
    // 		var subject = $(this).attr('data-subject');
    // 		$('[name="teach_subject[]"]').val(subject.split(",")).trigger('change');

    // 	}
    // 	$.magnificPopup.open({
    // 		items: {
    // 			src: '#input_feilds_teacher',
    // 		},
    // 		type: 'inline'
    // 	});
    // });

    $(document).on('click', '.addNewTeacher', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var id = $(this).attr('data-id');
            formdata.append('teacher_id', id);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_teacher",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('error');
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                        $('.edu_preloader').fadeOut();
                        return false;
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    $('.edu_preloader').fadeOut();
                    $('#input_feilds_teacher').find('.mfp-close').trigger('click');

                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });

    $(document).on('click', '.add_extaClassPop, .edit_extraclass', function() {
        if ($(this).hasClass('add_extaClassPop')) {
            $('#pxn_extra_class').find('form').trigger('reset');
            $('#pxn_extra_class').find('#PopupTitle').html(ltr_add_extra_class);
            $('#pxn_extra_class').find('.addNewExtraClss').attr('data-id', '').val(ltr_add_class);
            $('#pxn_extra_class').find('[name="teacher_id"]').val('').trigger('change');
            $('#pxn_extra_class').find('[name="batch_id[]"]').val('').trigger("change");

        } else {

            $('#pxn_extra_class').find('#PopupTitle').html(ltr_edit_extra_class);
            $('#pxn_extra_class').find('.addNewExtraClss').attr('data-id', $(this).attr('data-id')).val(ltr_update_class);
            $('#pxn_extra_class').find('[name="date"]').val($(this).closest('tr').find('td:eq(2)').text());
            var time = $(this).closest('tr').find('td:eq(3)').text().split('-');
            $('#pxn_extra_class').find('[name="start_time"]').val(time[0]);
            $('#pxn_extra_class').find('[name="end_time"]').val(time[1]);
            var ttt = $(this).closest('tr').find('td:eq(4)').find('a').attr('data-word');
            if (ttt != undefined) {
                $('#pxn_extra_class').find('[name="description"]').val(ttt);
            } else {
                $('#pxn_extra_class').find('[name="description"]').val($(this).closest('tr').find('td:eq(4)').text());
            }

            $('.extra_class_batch').find('[name="teachr_id"]').val($(this).attr('data-teacher'));
            //var vals =JSON.parse($(this).attr('data-batch'));
            $('#pxn_extra_class').find('[name="batch_id[]"]').val(JSON.parse($(this).attr('data-batch'))).trigger("change");
        }
        $.magnificPopup.open({
            items: {
                src: '#pxn_extra_class',
            },
            type: 'inline'
        });
    });

    $('.searchExtraClass').on('click', function() {
        targetTableUrl = $('.server_datatable').attr('data-url');
        var teacher = $.trim($('#teacherIdSrch').val());
        var status = $.trim($('#classStatus').val());
        dataTableObj.ajax.url(base_url + targetTableUrl + '?teacher=' + teacher + '&status=' + status).load();

    });

    function GetTodayDate() {
        var tdate = new Date();
        var dd = tdate.getDate(); //yields day
        var MM = tdate.getMonth(); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var currentDate = dd + "-" + (MM + 1) + "-" + yyyy;

        return currentDate;
    }
    $(document).on('click', '.addNewExtraClss', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var id = $(this).attr('data-id');
            formdata.append('edit_id', id);

            var dateAr = $('#pxn_extra_class .chooseDate_extra').val().split('-');
            var newDate = dateAr[1] + '-' + dateAr[0] + '-' + dateAr[2];
            var CDate = new Date(newDate);
            var today = new Date();
            var addnew = dateAr[0] + '-' + dateAr[1] + '-' + dateAr[2];
            var tday = GetTodayDate();
            var start_time = $('[name="start_time"]').val();
            var end_time = $('[name="end_time"]').val();
            var currentdate = new Date();
            var datetime = currentdate.getHours() + ":" +
                currentdate.getMinutes();
            var st = getTwentyFourHourTime(start_time);
            var et = getTwentyFourHourTime(end_time);
            if (tday == addnew) {

                if (datetime > st || datetime > et) {
                    toastr.error(ltr_past_time_msg);
                    return false;
                }
            }
            if (st >= et) {
                toastr.error(ltr_end_greater_msg);
                return false;
            }

            today.setDate(today.getDate() - 1);
            if (CDate < today) {
                toastr.error(ltr_today_greater_msg);
                return false;
            } else {
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/add_extracls",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            targetTableUrl = $('.server_datatable').attr('data-url');
                            dataTableObj.ajax.url(base_url + targetTableUrl).load();
                            var no_data = $('.eac_page_re').html();
                            if (no_data != undefined) {
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 500);
                            }
                        } else if (resp['status'] == '2') {
                            toastr.error(ltr_class_already_added_msg);
                            $('.edu_preloader').fadeOut();
                            return false;
                        } else if (resp['status'] == '3') {
                            toastr.error(ltr_valid_time_msg);
                            $('.edu_preloader').fadeOut();
                            return false;
                        } else {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                            return false;
                        }
                        $('#pxn_extra_class').find('.mfp-close').trigger('click');
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                });
            }
        }
    });

    $('.searchPRevCls').on('click', function() {
        var date = $('.filter_date').val();
        if (date == '') {
            toastr.error(ltr_select_date_msg);
            $('.filter_date').focus()
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            dataTableObj.ajax.url(base_url + targetTableUrl + '?date=' + date).load();

        }
    });

    $(document).on('click', '.extraClsCmplete', function() {
        var table = $(this).attr('data-table');
        if ($(this).prop('checked') == true) {
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/change_extraCls_status",
                data: { 'id': $(this).attr('data-id') },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(ltr_status_msg);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                }
            });
        }
    });

    //exam js

    var AllQuesArray = [];

    $(document).on('click', '.checkAllTableRow', function() {
        $('.createDivWrapper').removeClass('hide');
        if ($(this).prop('checked') == true) {
            $(this).closest('table').find('.checkOneRow').prop('checked', true);
            $(this).closest('table').find('.checkOneRow:checked').each(function() {
                var value = $(this).val();
                if (AllQuesArray.indexOf(value) === -1) AllQuesArray.push(value);
                $('.create_ppr_popup').show();
            });
        } else {
            $(this).closest('table').find('.checkOneRow').prop('checked', false);
            $(this).closest('table').find('.checkOneRow').each(function() {
                var value = $(this).val();
                if ($(this).prop('checked') == false && AllQuesArray.indexOf(value) != -1) {
                    AllQuesArray = $.grep(AllQuesArray, function(value) {
                        return value != value;
                    });
                    $('.create_ppr_popup').hide();
                }
            });
        }
        $('.SelectedQuestionCount').html(AllQuesArray.length);
    });

    $(document).on('click', '.checkOneRow', function() {
        var value = $(this).val();
        $('.createDivWrapper').removeClass('hide');
        if ($(this).prop('checked') == true) {
            if (AllQuesArray.indexOf(value) === -1) AllQuesArray.push(value);
            $('.create_ppr_popup').show();
        } else {
            if ($(this).prop('checked') == false && AllQuesArray.indexOf(value) != -1) {
                AllQuesArray = $.grep(AllQuesArray, function(values) {
                    return values != value;
                });
                if (AllQuesArray.length == 0) {
                    $('.create_ppr_popup').hide();
                }

            }
        }
        $('.SelectedQuestionCount').html(AllQuesArray.length);
    });

    $(document).on('click', '.addQuestionLocalStorage', function() {
        AllQuesArray = [];
        $('.SelectedQuestionCount').html(AllQuesArray.length);
        $('.checkOneRow, .checkAllTableRow').prop('checked', false);
    });

    $('.showCreatePaperModal').on('click', function() {
        if ($.trim($('.SelectedQuestionCount').html()) == 0) {
            toastr.error(ltr_atleast_question_msg);
            return false;
        } else {
            $('#no_of_totalselected_que b').html(AllQuesArray.length);
            $('.quetionIdsArr').html(JSON.stringify(AllQuesArray));
            $('.totalQuestions').val(AllQuesArray.length);
            $.magnificPopup.open({
                items: {
                    src: '#createExamModal',
                },
                type: 'inline'
            });
        }
    });

    $(document).on('change', '.changePaperType', function() {
        if ($(this).val() == '1') {
            $('.mocktesthideshow').removeClass('hide');
            $('.mocktesthideshow .chooseDate').addClass('require');
            $('.mocktesthideshow .chooseTime').addClass('require');
        } else {
            $('.mocktesthideshow').addClass('hide');
            $('.mocktesthideshow .chooseDate').removeClass('require');
            $('.mocktesthideshow .chooseTime').removeClass('require');
        }
    });

    $(document).on('click', '.createFinalExamPaper', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var question_ids = $.trim($('.quetionIdsArr').html());
            formdata.append('question_ids', question_ids);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_exam_paper",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        setTimeout(function() {
                            window.location.href = resp['url'];
                        }, 1000)
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                        $('.edu_preloader').fadeOut();
                        return false;
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    $('#createExamModal').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });

    $('.filter_result_by_monyr').on('click', function() {
        if ($('.filter_month').val() == '') {
            toastr.error('Please select month.');
            return false;
        } else if ($('.filter_year').val() == '') {
            toastr.error(ltr_select_year_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var month = $('.filter_month').val();
            var year = $('.filter_year').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?month=' + month + '&year=' + year).load();

        }
    });

    $('.filter_paper_by_name').on('click', function() {
        if ($('.filter_paper').val() == '' && $('.filter_batch').val() == '') {
            toastr.error(ltr_select_paper_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var paper = $('.filter_paper').val();
            var batch_id = $('.filter_batch').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?paper=' + paper + '&batch_id=' + batch_id).load();

        }
    });

    //facility js
    $(document).on('click', '.edit_facility, .add_facility', function() {
        var parentDiv = $('#faciModal');
        if ($(this).hasClass('add_facility')) {
            parentDiv.find('#faciModalLabel').html(ltr_add_facility);
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addEditFacility').attr('data-id', '');
        } else {
            parentDiv.find('#faciModalLabel').html(ltr_edit_facility);
            parentDiv.find('input[name="title"]').val($(this).closest('tr').find('td:eq(2)').text());
            parentDiv.find('input[name="icon"]').val($(this).closest('tr').find('td:eq(3) i').attr('class'));
            var ttt = $(this).closest('tr').find('a').attr('data-word');
            if (ttt != undefined) {
                parentDiv.find('textarea[name="description"]').val(ttt);
            } else {
                parentDiv.find('textarea[name="description"]').val($(this).closest('tr').find('td:eq(4)').text());
            }
            parentDiv.find('.addEditFacility').attr('data-id', $(this).attr('data-id'));
        }
        $.magnificPopup.open({
            items: {
                src: '#faciModal',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.addEditFacility', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var id = $(this).attr('data-id');
            formdata.append('edit_id', id);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_facility",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    $('#faciModal').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });

    //gallery js

    $(document).on('change', '.galleryType', function() {
        if ($(this).val() == 'Image') {
            $('.galleryImgFld').removeClass('hide').find('input').addClass('require');
            $('.galleryVideoFld').addClass('hide').find('input').removeClass('require');
            $('.galleryVideofile').addClass('hide').find('input').removeClass('require');
            $('.galleryVideolink').addClass('hide').find('input').removeClass('require');
        } else {
            $('.galleryImgFld').addClass('hide').find('input').removeClass('require');
            $('.galleryVideoFld').removeClass('hide').find('input').addClass('require');
            $('.galleryVideofile').removeClass('hide').find('input').addClass('require');
        }
    });

    $(document).on('change', '.galleryTypefile', function() {
        if ($(this).val() == 'URL') {

            $('.galleryVideolink').removeClass('hide').find('input').addClass('require');
            $('.galleryVideofile').addClass('hide').find('input').removeClass('require');
        } else {
            $('.galleryVideolink').addClass('hide').find('input').removeClass('require');
            $('.galleryVideofile').removeClass('hide').find('input').addClass('require');

        }
    });

    $(document).on('click', '.addGalleryPop, .editVideoImgGalry', function() {
        var parentDiv = $('#add_image_video');
      
        if ($(this).hasClass('addGalleryPop')) {
            parentDiv.find('#myModalLabel1').html(ltr_add_image);
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addVideoImgGalry').attr('data-id', '');
        } else {

            parentDiv.find('#myModalLabel1').html(ltr_edit_image);
            parentDiv.find('.addVideoImgGalry').val('Edit');


            parentDiv.find('input[name="title"]').val($(this).closest('tr').find('td:eq(2)').text());
            var type = $(this).attr('data-type');
            parentDiv.find('.galleryType').val($(this).attr('data-type')).trigger('change');
            parentDiv.find('.video').removeClass('require');
            if (type == 'Image') {
                parentDiv.find('.Image').removeClass('require');
                parentDiv.find('.fileNameShow').html($(this).attr('data-img'));
            } else {
                var video = $(this).attr('data-video');
                if (video == null) {
                    parentDiv.find('.video').removeClass('require');
                    parentDiv.find('.galleryTypefile').val('URL').trigger('change');
                    parentDiv.find('input[name="video_url"]').val($(this).attr('data-url'));

                } else {
                    parentDiv.find('.fileNameShow').html($(this).attr('data-video'));
                }
                parentDiv.find('.editVideoImgGalry').attr('data-id', $(this).attr('data-id'));
            }

            //  parentDiv.find('.editVideoImgGalry').val($(this).attr('data-img'));

            $(".video_url").attr("data-valid", $(this).closest('tr').find('td:eq(4)').text());
            parentDiv.find('#gallery_id').val($(this).attr('data-id'));

        }

        $.magnificPopup.open({
            items: {
                src: '#add_image_video',
            },
            type: 'inline'
        });
    });


    $(document).on('click', '.addVideoImgGalry', function() {
        var validchk = validate_form($(this).closest('form'));
        var id = $('#gallery_id').val();

        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            formdata.append('id', id);

            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_gallery",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    $('#add_image_video').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });

    $(document).on('click', '.viewImage', function() {
        var src = base_url + $(this).attr('data-img');
        $('#view_image_popup img').attr('src', src);
        $.magnificPopup.open({
            items: {
                src: '#view_image_popup',
            },
            type: 'inline'
        });

        $('#view_image_popup #viewImgTitle').html($(this).closest('tr').find('td:eq(1)').text());
    });

    $('.addGalleryPop').on('click', function() {
        $('#add_image_video').find('.fileNameShow').html('');
    });

    //homework js
    var val_sub1 = '';
    $(document).on('click', '.add_homework, .edit_homework', function() {
        if ($(this).hasClass('add_homework')) {
            $('#homeworkPopup').find('form').trigger('reset');
            $('#homeworkPopup').find('#homeworkPopupLabel').html(ltr_add_assignment);
            $('#homeworkPopup').find('.addEditHomewrk').attr('data-id', '').val(ltr_add_assignment);
            $('#homeworkPopup').find('[name="subject_id"]').val('').trigger('change');
            $('#homeworkPopup').find('[name="batch_id"]').val('').trigger('change');
        } else {
            // var sub = $(this).attr('data-sub');
            let Subject = $(this).closest('tr').find('td:eq(3)').text();
            val_sub1 = $('#homeworkPopup [name="subject_id"]').find("option:contains('" + Subject + "')").val()
                // $('#homeworkPopup [name="subject_id"]').val(val_sub1).trigger('change');
                // alert(sub);
            var batch = $(this).attr('data-batch');
            $('#homeworkPopup').find('#homeworkPopupLabel').html(ltr_edit_assignment);
            $('#homeworkPopup').find('.addEditHomewrk').attr('data-id', $(this).attr('data-id')).val(ltr_update_assignment);
            //  $('#homeworkPopup').find('[name="subject_id"]').val(sub).trigger('change');
            $('#homeworkPopup').find('[name="batch_id"]').val(batch).trigger('change');
            $('#homeworkPopup').find('[name="description"]').val($(this).closest('tr').find('td:eq(5)').text());
            $('#homeworkPopup').find('[name="date"]').val($(this).closest('tr').find('td:eq(4)').text());
        }
        $.magnificPopup.open({
            items: {
                src: '#homeworkPopup',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.addEditHomewrk', function() {
        var validchk = validate_form($(this).closest('form'));
        var id = $(this).attr('data-id');
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            formdata.append('edit_id', id);
            var dateAr = $('#homeworkPopup input[name="date"]').val().split('-');
            var newDate = dateAr[1] + '-' + dateAr[0] + '-' + dateAr[2];
            var HDate = new Date(newDate);
            var today = new Date();
            today.setDate(today.getDate() - 1);

            if (HDate < today) {
                toastr.error(ltr_today_greater_msg);
                return false;
            } else {
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/add_homework",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            targetTableUrl = $('.server_datatable').attr('data-url');
                            dataTableObj.ajax.url(base_url + targetTableUrl).load();
                            var no_data = $('.eac_page_re').html();
                            if (no_data != undefined) {
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 500);
                            }
                        } else if (resp['status'] == '2') {
                            toastr.error(resp['msg']);
                        } else {
                            toastr.error(ltr_something_msg);
                            return false;
                        }
                        $('.edu_preloader').fadeOut();
                        $('#homeworkPopup').find('.mfp-close').trigger('click');
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                });
            }
        }
    });

    $('.filter_homework').on('click', function() {
        if ($('.from_date').val() == '') {
            toastr.error(ltr_select_from_date_msg);
            return false;
        } else if ($('.to_date').val() == '') {
            toastr.error(ltr_select_to_date_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var from_date = $('.from_date').val();
            var to_date = $('.to_date').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?from_date=' + from_date + '&to_date=' + to_date).load();

        }
    });
    $('.filter_doubts').on('click', function() {
        if ($('.filter_subject').val() == '') {
            toastr.error(ltr_select_from_date_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var subject = $('.filter_subject').val();

            dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject).load();

        }
    });
    $('.filter_payment_history').on('click', function() {
        if ($('.from_date').val() == '') {
            toastr.error(ltr_select_from_date_msg);
            return false;
        } else if ($('.to_date').val() == '') {
            toastr.error(ltr_select_to_date_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var from_date = $('.from_date').val();
            var to_date = $('.to_date').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?from_date=' + from_date + '&to_date=' + to_date).load();

        }
    });
    $('.filter_batchdetails, .filter_progress').on('click', function() {
        targetTableUrl = $('.server_datatable').attr('data-url');
        var subject = $('.slctSubject').val();
        var batch = $('.slctBatch').val();
        dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject + '&batch=' + batch).load();

    });

    $('.filter_progress').on('click', function() {
        $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_progress",
            data: { 'batch': $('.slctBatch').val(), 'subject': $('.slctSubject').val(), 'teacher_id': $('#teacher_id').val() },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                console.log(resp);
                if (resp['status'] == '1') {
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [
                                    resp['complete'],
                                    resp['pending']
                                ],
                                backgroundColor: [
                                    '#109618',
                                    '#ee0808'
                                ],
                            }],
                            labels: [
                                'Complete',
                                'Pending'
                            ]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                enabled: false
                            }
                        }
                    };
                    $('#canvas-holder').html(''); // this is my <canvas> element
                    $('#canvas-holder').append('<canvas id="chart-area"><canvas>');
                    var ctx = document.getElementById('chart-area').getContext('2d');
                    window.myPie = new Chart(ctx, config);

                } else {
                    toastr.error(resp['msg']);
                    var config = {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [
                                    resp['complete'],
                                    resp['pending']
                                ],
                                backgroundColor: [
                                    '#109618',
                                    '#ee0808'
                                ],
                            }],
                            labels: [
                                'Complete',
                                'Pending'
                            ]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                enabled: false
                            }
                        }
                    };
                    $('#canvas-holder').html(''); // this is my <canvas> element
                    $('#canvas-holder').append('<canvas id="chart-area"><canvas>');
                    var ctx = document.getElementById('chart-area').getContext('2d');
                    window.myPie = new Chart(ctx, config);
                }
                $('.edu_preloader').fadeOut();
                $('#homeworkPopup').find('.mfp-close').trigger('click');
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
                $('.edu_preloader').fadeOut();
                return false;
            }
        });
    });

    $(document).on('click', '.edit_batchDetails', function() {
        if ($(this).attr('data-batchon') == 1) {
            toastr.error(ltr_batch_inactive_msg);
            $('.edu_preloader').fadeOut();
            return false;
        } else {
            var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12">';
            var indexes = $(this).attr('data-index');
            var i = 0;
            $(this).closest('tr').find('td:eq(7) p').each(function() {
                console.log($(this).attr('data-chapter'));
                if (indexes != '' && (indexes.indexOf($(this).attr('data-chapter')) != -1)) {
                    var checkbox = 'Complete';
                } else {
                    var checkbox = '<input type="checkbox" class="markChptrCmpl" data-id="' + $(this).attr('data-id') + '" data-chapter="' + $(this).attr('data-chapter') + '"> <label>' + ltr_mark_complete + '</label>';
                }
                html += '<div class="row chptrlistwrap"><div class="col-lg-6 col-md-6 col-sm-6 col-12"><label>' + $(this).text() + '</label></div> <div class="col-lg-6 col-md-6 col-sm-6 col-12">' + checkbox + '</div></div>';
                i++;
            });
            html += '</div>';
            $('#chapterModal').find('.chapter_wrapperDiv').html(html);
            $.magnificPopup.open({
                items: {
                    src: '#chapterModal',
                },
                type: 'inline'
            });
        }
    });

    $(document).on('click', '.markChptrCmpl', function() {
        if ($(this).prop('checked') == true) {
            var _this = $(this);
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/change_chapter_staus",
                data: { 'id': $(this).attr('data-id'), 'chapter': $(this).attr('data-chapter') },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(ltr_status_msg);
                        _this.addClass('hide');
                        _this.next('label').replaceWith('<label>' + ltr_complete + '</label>');
                        $('#chapterModal').find('.mfp-close').trigger('click');
                        location.reload();
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                }
            });
        }
    });

    //profile js

    $('.changePassword').on('click', function() {
        var new_pass = $.trim($('#admin_new_pass').val());
        var rep_pass = $.trim($('#admin_rep_pass').val());
        var TagReg = /[<>`;&=+/()|^%*+]/g;

        if (new_pass == "") {
            toastr.error(ltr_all_fields_msg);
            return false;
        } else if (new_pass != rep_pass) {
            toastr.error(ltr_password_same_msg);
            return false;
        } else {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/admin_change_password",
                data: { 'new_pass': new_pass },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('#admin_new_pass').val('');
                        $('#admin_rep_pass').val('')
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $('.openPassFld').on('click', function() {
        if ($(this).hasClass('hidedfld')) {
            $('.passwordFields').slideDown();
            $(this).removeClass('hidedfld').addClass('showdfld').html(ltr_hide_password);
        } else {
            $('.passwordFields').slideUp();
            $(this).addClass('hidedfld').removeClass('showdfld').html(ltr_change_password);
        }
    });

    $(document).on('change', 'input[type="file"]', function(e) {
        if (e.target.files[0]) {
            var length = e.target.files.length - parseInt(1);
            if (length > 0) {
                var fileName = e.target.files[0].name + ' + ' + length + ' files';
            } else {
                var fileName = e.target.files[0].name;
            }
            $(this).parent().find('p.fileNameShow').html(fileName);
        }
    });

    $(document).on('click', '.view_large_image', function() {
        $('#stImgModal').find('img#std_img').attr('src', $(this).attr('src'));
        $.magnificPopup.open({
            items: {
                src: '#stImgModal',
            },
            type: 'inline'
        });
    });

    $('.updateTeachrStudProfile').on('click', function() {
        var TagReg = /[<>`;&=+/()|^%*+]/g;
        if ($('.username').val() == '') {
            toastr.error("Name can't be empty.");
            $('.username').addClass('error').focus()
            return false;
        } else if ($('.openPassFld').hasClass('showdfld') && $('#newPasswrd').val() == '') {
            toastr.error(ltr_new_password_msg);
            $('#newPasswrd').addClass('error').focus()
            return false;
        } else if ($('.openPassFld').hasClass('showdfld') && ($('#reNewPasswrd').val() != $('#newPasswrd').val())) {
            toastr.error(ltr_password_same_msg);
            $('#reNewPasswrd').addClass('error').focus()
            return false;
        } else {
            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/update_teacher_profile",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    $('.edu_preloader').fadeOut();
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    $('.edu_preloader').fadeOut();
                    toastr.error(ltr_something_msg);
                }
            });
        }
    });

    /* Student Section Js */

    $('.selectPracticePaper').on('change', function() {
        if ($(this).val() != '') {
            $('.paperDescriptionDiv').find('.totalQuest').html($(this).find('option:selected').attr('data-ques'));
            $('.paperDescriptionDiv').find('.totalTime').html($(this).find('option:selected').attr('data-time'));
            $('.paperDescriptionDiv').find('.paperName').html($(this).find('option:selected').text());
            $('.paperDescriptionDiv').find('.continuePaper').attr('data-id', $(this).val());
            $('.paperDescriptionDiv').removeClass('hide');
        } else {
            $('.paperDescriptionDiv').addClass('hide');
        }
    });

    var timeInterval, totalTime, paper_type;

    $(document).on('click', '.continuePaper', function() {
        $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
        $.ajax({
            method: "POST",
            url: base_url + "front_ajax/get_paper_details",
            data: { 'id': $(this).attr('data-id'), 'paper_type': $(this).attr('data-type') },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('.edu_preloader').fadeOut()
                if (resp['status'] == '1') {

                    $('.showQuestionPaperWrapper').html(resp['html']);
                    totalTime = resp['totalTime'] * 60;
                    paper_type = resp['paper_type'];
                } else {
                    toastr.error(ltr_something_msg);
                }
                if (typeof MathJax !== 'undefined') { MathJax.Hub.Queue(["Typeset", MathJax.Hub]); }
            },
            error: function(resp) {
                $('.edu_preloader').fadeOut()
                toastr.error(ltr_something_msg);
            },
            complete: function(data) {
                var dt = new Date();
                var time = dt.getHours() + ":" + dt.getMinutes();
                $('.question_paper_footer #start_time').val(time);
                timeInterval = setInterval(paper_count_down, 1000);
            }
        });
    });

    $(document).on('click', '.resetAnswer', function() {
        $(this).closest('.questionDesrpWrap').find('input[type="radio"]').prop('checked', false);
        var count = $('.questionDesrpWrap .edu_question_options').find('input[type="radio"]:checked').length;
        $('.edu_question_options ol li label input:not(:checked)').parent().removeClass("selected");
        var total = $('.questionDesrpWrap').length;
        var remaining = parseInt(total) - parseInt(count);
        $('.remainingQuest').html(remaining);
    });

    $(document).on('click', '.submitPopupShow', function() {
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
        $('.question_paper_footer #submit_time').val(time);
        $.magnificPopup.open({
            items: {
                src: '#submitPopup',
            },
            type: 'inline',
        });
    });

    $(document).on('click', '.PopupCancelBtn', function() {
        $('#submitPopup').find('.mfp-close').trigger('click');
    });

    $(document).on('click', '.SubmitPaperForm', function() {

        $('#submitPopup').find('.mfp-close').trigger('click');
        $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
        var questionAttmp = {};

        $('.showQuestionPaperWrapper .questionDesrpWrap').each(function() {
            if ($(this).find('input[type="radio"]:checked').length) {
                var ques_id = $(this).attr('data-id');
                var ans = $(this).find('input[type="radio"]:checked').val();
                questionAttmp[ques_id] = ans;
            }
        });

        var formdata = new FormData($('.showQuestionPaperWrapper form')[0]);
        formdata.append('question_answer', JSON.stringify(questionAttmp));
        // console.log(formdata);
        // return false;
        $.ajax({
            method: "POST",
            url: base_url + "front_ajax/submit_paper",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('.edu_preloader').fadeOut();
                if (resp['status'] == '1') {
                    toastr.success(resp['msg']);
                    window.location.href = resp['url'];
                } else if (resp['status'] == '2') {
                    toastr.success(resp['msg']);
                } else if (resp['status'] == '3') {
                    window.location.href = resp['url'];
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                $('.edu_preloader').fadeOut();
                toastr.error(ltr_something_msg);
            }
        });
    });

    function paper_count_down() {
        totalTime = --totalTime;
        if (totalTime > 0) {
            update_time(totalTime);
        } else {
            clearInterval(timeInterval);
            update_time(totalTime);
            time_completed();
        }

    }

    function update_time(totalTime) {
        var hours = parseInt(totalTime / 3600) % 24;
        var minutes = parseInt(totalTime / 60) % 60;
        var seconds = totalTime % 60;

        var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);

        $('#timer').html(result);
    }

    function time_completed() {
        $('.question_paper_wrapper').css('background', 'rgba(255, 110, 102, 0.19)');
        if (paper_type == 'mock') {
            clearInterval();
            var dt = new Date();
            var time = dt.getHours() + ":" + dt.getMinutes();
            $('.question_paper_footer #submit_time').val(time);
            $.magnificPopup.open({
                items: {
                    src: '#autoSubmitPopup',
                },
                type: 'inline',
                closeOnBgClick: false
            });
            $('#autoSubmitPopup .mfp-close').hide();
            $('#autoSubmitPopup .SubmitPaperForm').hide();
            $('#autoSubmitPopup .nomarginbtm').css('margin-bottom', '0');
            setTimeout(function() {
                $('.SubmitPaperForm').trigger('click');
            }, 500);
        }
    }

    if ($('.mockPaperTimerWrapper').length) {
        $('.mockPaperTimerWrapper').each(function() {
            var second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24;
            var _this = $(this);
            var countDown = new Date(_this.find('.mock_actual_date').text()).getTime();

            //let countDown = new Date('Oct 13, 2018 03:00:00').getTime(),
            x = setInterval(function() {
                var now = new Date().getTime();
                distance = countDown - now;

                days_show = Math.floor(distance / (day));
                hr_show = Math.floor((distance % (day)) / (hour));
                min_show = Math.floor((distance % (hour)) / (minute));
                sec_show = Math.floor((distance % (minute)) / second);

                _this.find('.remain_days').text(((days_show < 10) ? '0' + days_show : days_show));
                _this.find('.remain_hours').text(((hr_show < 10) ? '0' + hr_show : hr_show));
                _this.find('.remain_minutes').text(((min_show < 10) ? '0' + min_show : min_show));
                _this.find('.remain_seconds').text(((sec_show < 10) ? '0' + sec_show : sec_show));

                //do something later when date is reached
                if (distance <= 0) {
                    _this.find(".mockPaperTimer").addClass('hide');
                    _this.find(".paperDescriptionDiv").removeClass('hide');
                }

            }, second);
        });
        setTimeout(function() {
            $('.mockPaperTimerWrapper .mockPaperTimer').removeClass('hide');
        }, 500);
    }

    $(document).on('click', '.questionOptionRad', function() {
        if ($(this).prop('checked') == true) {
            var count = $('.questionDesrpWrap .edu_question_options').find('input[type="radio"]:checked').length;
            var total = $('.questionDesrpWrap').length;
            var remaining = parseInt(total) - parseInt(count);
            $('.remainingQuest').html(remaining);
        }
    });

    /* Student Section Js */

    //common js

    //prevent to white space in begining
    // $(document).on('keypress','input,textarea',function(){
    // 	if(/^\s/.test($(this).val())){
    // 		return false;
    // 	}
    // });


    $(document).on('click', '.deleteData', function() {

        var t = $(this).attr('data-table');
        if (t == 'questions' || t == 'exams') {
            var cnf = ltr_all_test_record_msg;
        } else {
            var cnf = ltr_once_deleted_alert_msg;
        }
        swal({
                title: ltr_are_deleted_alert_msg,
                text: cnf,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var file = $(this).attr('data-file');
                    if (file != 'undefined' || file != '') {
                        file = file;
                    } else {
                        file = '';
                    }

                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/deleteData",
                        data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'file': file },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();

                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                            $('.create_ppr_popup').hide();
                            $(".checkOneRow").prop("checked", false);
                            $(".checkAllAttendance").prop("checked", false);
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });



    });

    $(document).on('click', '.deleteDataBlogComment', function() {

        var t = $(this).attr('data-table');
        if (t == 'questions' || t == 'exams') {
            var cnf = ltr_all_test_record_msg;
        } else {
            var cnf = ltr_once_deleted_alert_msg;
        }
        swal({
                title: ltr_are_deleted_alert_msg,
                text: cnf,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var file = $(this).attr('data-file');
                    if (file != 'undefined' || file != '') {
                        file = file;
                    } else {
                        file = '';
                    }

                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/deleteData",
                        data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'file': file },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();
                                location.reload();
                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                            $('.create_ppr_popup').hide();
                            $(".checkOneRow").prop("checked", false);
                            $(".checkAllAttendance").prop("checked", false);
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });



    });
    $(document).on('click', '.deleteDataNotice', function() {

        // 	toastr.error(ltr_delete_access);
        // 	return false;
        var cnf = ltr_once_deleted_alert_msg;

        swal({
                title: ltr_are_deleted_alert_msg,
                text: cnf,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var file = $(this).attr('data-file');
                    if (file != 'undefined' || file != '') {
                        file = file;
                    } else {
                        file = '';
                    }

                    $(this).closest('tr').remove();
                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/deleteData",
                        data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'file': file },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);

                                // 		targetTableUrl = $('.server_datatable').attr('data-url');
                                // 		dataTableObj.ajax.url(base_url+targetTableUrl).load();

                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });



    });
    $(document).on('change', '.changeDropVal', function() {
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/change_dropdown_Value",
            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'value': $(this).val(), 'column': $(this).attr('name') },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(ltr_updated_msg);
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    $(document).on('change', '.changeStatus', function() {
        var table = $(this).attr('data-table');
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/change_status",
            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'status': $(this).val() },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(ltr_status_msg);
                    if (table == 'extra_classes') {
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    $(document).on('click', '.changeStatusButton', function() {
        var table = $(this).attr('data-table');
        var status = $(this).attr('data-status');
        var data_tabel = $(this).attr('data-table');

        if ((data_tabel == 'questions') && (status != 1)) {
            swal({
                    title: ltr_alert_updated_msg,
                    text: ltr_all_test_record_msg,
                    icon: "warning",
                    buttons: [ltr_cancel, ltr_ok],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            method: "POST",
                            url: base_url + "ajaxcall/change_status",
                            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'status': $(this).attr('data-status') },
                            success: function(resp) {
                                var resp = $.parseJSON(resp);
                                if (resp['status'] == '1') {
                                    toastr.success(ltr_status_msg);
                                    targetTableUrl = $('.server_datatable').attr('data-url');
                                    dataTableObj.ajax.url(base_url + targetTableUrl).load();

                                } else {
                                    toastr.error(ltr_something_msg);
                                }
                                $('.create_ppr_popup').hide();
                                $(".checkOneRow").prop("checked", false);
                                $(".checkAllAttendance").prop("checked", false);
                            },
                            error: function(resp) {
                                toastr.error(ltr_something_msg);
                            }
                        });

                    }
                });
        } else {
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/change_status",
                data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'status': $(this).attr('data-status') },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(ltr_status_msg);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.create_ppr_popup').hide();
                    $(".checkOneRow").prop("checked", false);
                    $(".checkAllAttendance").prop("checked", false);
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                }
            });
        }

    });
    $(document).on('change', '.changeCategory', function() {
        var table = $(this).attr('data-table');
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/change_category",
            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'category': $(this).val() },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(ltr_category_changed_msg);
                    if (table == 'extra_classes') {
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    $('.cnfmlogOutBtn').on('click', function() {
        $.magnificPopup.open({
            items: {
                src: '#logoutPopup',
            },
            type: 'inline'
        });
    });

    $('.logOutBtn, .logoutBtnCncl').on('click', function() {
        if ($(this).hasClass('logOutBtn')) {
            window.location.href = base_url + "front_ajax/logout";
        }
        $('#logoutPopup').find('.mfp-close').trigger('click');
    });

    $('.dobpicker').on('change', function() {
        var mybirthdate = $(this).val();
        var mybirthdate_arr = mybirthdate.split('-');
        var dat = new Date();
        var curday = dat.getDate();
        var curmon = dat.getMonth() + 1;
        var curyear = dat.getFullYear();
        var calday = mybirthdate_arr[0];
        var calmon = mybirthdate_arr[1];
        var calyear = mybirthdate_arr[2];
        var curd = new Date(curyear, curmon - 1, curday);
        var cald = new Date(calyear, calmon - 1, calday);
        var diff =
            Date.UTC(curyear, curmon, curday, 0, 0, 0) - Date.UTC(calyear, calmon, calday, 0, 0, 0);
        var dife = datediff(curd, cald);
        if (dife[0] == 0 && dife[1] == 0 && curmon != calmon) {
            var dayss = parseInt(dife[2]) + parseInt(2);
            $('#age_year').val(dife[0] + ' years');
            $('#age_month').val(dife[1] + ' months');
            $('#age_day').val(dayss + ' days');
        } else if (dife[0] < 0 || dife[1] < 0) {
            toastr.error(ltr_invalid_birth_msg, 'Date Error');
            return false;
        } else {
            $('#age_year').val(dife[0] + ' years');
            $('#age_month').val(dife[1] + ' months');
            $('#age_day').val(dife[2] + ' days');
        }
    });

    function datediff(date1, date2) {
        var y1 = date1.getFullYear(),
            m1 = date1.getMonth(),
            d1 = date1.getDate(),
            y2 = date2.getFullYear(),
            m2 = date2.getMonth(),
            d2 = date2.getDate();
        if (d1 < d2) {
            m1--;
            d1 += DaysInMonth(y2, m2);
        }
        if (m1 < m2) {
            y1--;
            m1 += 12;
        }
        return [y1 - y2, m1 - m2, d1 - d2];
    }

    function DaysInMonth(Y, M) {
        with(new Date(Y, M, 1, 12)) {
            setDate(0);
            return getDate();
        }
    }

    function validate_form(target) {
        var check = 'valid';
        target.find('input , textarea , select').each(function() {
            var email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
            var url = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
            var websiteUrl = /^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/;
            var image = /\.(jpe?g|gif|png|PNG|SVG|svg|JPE?G)$/;
            var images = /\.(jpe?g|png|PNG|JPE?G)$/;
            var video = /\.(flv|avi|mov|mpg|wmv|m4v|mp4|mp3|wma|3gp)$/;
            var mobile = /((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/;
            var facebook = /^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/;
            var twitter = /^(https?:\/\/)?(www\.)?twitter.com\/[a-zA-Z0-9(\.\?)?]/;
            var google_plus = /^(https?:\/\/)?(www\.)?plus.google.com\/[a-zA-Z0-9(\.\?)?]/;
            var number = /^[\s()+-]*([0-9][\s()+-]*){1,20}$/;
            var password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#])[A-Za-z\d$@$!%*?&#]{8,}$/;
            var pdfimage = /\.(pdf|PDF)$/;
            var float_num = /^[-+]?[0-9]+\.[0-9]+$/;
            var youtube = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var vimeo = /^.*((http|https)?:\/\/(www\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|)(\d+)(?:|\/\?)).*/;
            var TagReg = /[<>`;&=+/()|^%*+]/g;
            var text_only = /^[a-zA-Z ]*$/g;

            var dropbox = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?([a-z0-9]+([\-\.]dropboxusercontent)|dropbox)\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            var embed = /embed/g;
            var excel = /\.(xlsx)$/;
            if ($(this).hasClass('require')) {

                if ((typeof $(this).val() == 'object' && isEmpty($(this).val()) == true) || (typeof $(this).val() != 'object' && $(this).val().trim() == '')) {
                    toastr.error('Some required fields are missing.');
                    $(this).addClass('error').focus();
                    if ($('.edu_accord_parent').length)
                        $(this).closest('.edu_accord_parent').addClass('error');
                    check = 'novalid';
                    return false;
                } else {
                    $(this).removeClass('error');
                    if ($('.edu_accord_parent').length)
                        $(this).closest('.edu_accord_parent').removeClass('error');
                    check = 'valid';
                }
            }

            if ((typeof $(this).val() == 'object' && isEmpty($(this).val()) == true) || (typeof $(this).val() != 'object' && $(this).val().trim() != '')) {
                var valid = $(this).attr('data-valid');
                if (typeof valid != 'undefined') {
                    if (!eval(valid).test($(this).val().trim())) {
                        $(this).addClass('error').focus();
                        toastr.error($(this).attr('data-error'));
                        check = 'novalid';
                        return false;
                    } else {
                        $(this).removeClass('error');
                        check = 'valid';
                    }
                }
            }

        });
        return check;
    }

    function isEmpty(obj) {
        for (var key in obj) {
            if (obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

    function parseVideoold(url) {
        url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
        if (RegExp.$3.indexOf('youtu') > -1) {
            var YregEx = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var Ymatch = url.match(YregEx);
            if (Ymatch != null && Ymatch[0].indexOf('youtu') > -1) {
                var src = 'https://www.youtube.com/embed/' + Ymatch[2];
            }
        } else if (RegExp.$3.indexOf('vimeo') > -1) {
            var src = 'https://player.vimeo.com/video/' + RegExp.$6;
        } else {
            var src = url;
        }
        return src;
    }

    function parseVideo(url, type) {
        if (type == "youtube") {
            var YregEx = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var Ymatch = url.match(YregEx);
            if (Ymatch != null && Ymatch[0].indexOf('youtu') > -1) {
                var src = 'https://www.youtube.com/embed/' + Ymatch[2];
            }
        } else if (type == "vimeo") {
            url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
            var src = 'https://player.vimeo.com/video/' + RegExp.$6;
        } else if (type == "dropbox") {
            var src = url.replace("dropbox.com", "dl.dropboxusercontent.com");
        } else if (type == "drive") {
            var src = url.replace("view?usp=sharing", "preview");
        } else {
            var src = url;
        }
        return src;

    }
    $(document).on('click', '.apply_leave_btn', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var startDateArr = $('.from_date').val().split('-');
            var endDateArr = $('.to_date').val().split('-');
            var startDate = startDateArr[1] + '-' + startDateArr[0] + '-' + startDateArr[2];
            var endDate = endDateArr[1] + '-' + endDateArr[0] + '-' + endDateArr[2];

            if (new Date(endDate) <= new Date(startDate)) {
                toastr.error(ltr_to_greater_msg);
                return false;
            } else {
                $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                $.ajax({
                    method: "POST",
                    url: base_url + "ajaxcall/apply_leave",
                    data: { 'from_date': $.trim($('.from_date').val()), 'to_date': $.trim($('.to_date').val()), 'subject': $.trim($('#leave_sub').val()), 'leave_msg': $.trim($('#leave_msg').val()) },
                    success: function(resp) {
                        var resp = $.parseJSON(resp);
                        if (resp['status'] == '1') {
                            toastr.success(resp['msg']);
                            targetTableUrl = $('.server_datatable').attr('data-url');
                            dataTableObj.ajax.url(base_url + targetTableUrl).load();
                            var no_data = $('.eac_page_re').html();
                            if (no_data != undefined) {
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 500);
                            }

                        } else {
                            toastr.error(ltr_something_msg);
                        }
                        $('#leave_apply_popup').find('.mfp-close').trigger('click');
                        $('.edu_preloader').fadeOut();
                    },
                    error: function(resp) {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                    }
                });
            }
        }
    })

    $(document).on('click', '.viewLeave', function() {
        var id = $(this).attr('data-id');
        if (id != '') {
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/get_leave_data",
                data: { 'id': id },
                success: function(resp) {
                    var resp = $.parseJSON(resp);

                    if (resp['status'] == '1') {
                        var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><div class="form-group"><label>Suject :</label><span> ' + resp.data['subject'] + '</span></div><div class="form-group"><label>' + ltr_message + ' :</label><br><span> ' + resp.data['leave_msg'] + '</span></div></div>';

                        $('#view_leave_popup .leaveShow').html(html);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
        $.magnificPopup.open({
            items: {
                src: '#view_leave_popup',
            },
            type: 'inline'
        });
    })

    $('.search_students').select2({
        ajax: {
            url: base_url + "ajaxcall/get_student_name",
            processResults: function(resp) {
                var userName = [];
                var resp = $.parseJSON(resp);
                if (resp.status == '1') {
                    $.each(resp.data, function(index, value) {
                        var dta = { 'id': value.id, 'text': value.name }
                        userName.push(dta)
                    })
                }
                return {
                    results: userName
                };
            }
        }
    });

    $('.search_teachers').select2({
        ajax: {
            url: base_url + "ajaxcall/get_teacher_name",
            processResults: function(resp) {
                var userName = [];
                var resp = $.parseJSON(resp);
                if (resp.status == '1') {
                    $.each(resp.data, function(index, value) {
                        var dta = { 'id': value.id, 'text': value.name }
                        userName.push(dta)
                    })
                }
                return {
                    results: userName
                };
            }
        }
    });

    function common_ajax_funxtion(id, table_name, custom_value) {
        var edit_id = id;
        var edit_table_name = table_name;
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/live_class_edit_common",
            data: {
                'id': edit_id,
                'table': edit_table_name
            },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                console.log(resp[0]['meeting_number']);
                var parentDiv = $('#input_feilds_liveclass');
                parentDiv.find('#classModalLabel').html(ltr_edit_live_class);
                parentDiv.find('#batch').val(custom_value).trigger('change');
                parentDiv.find('#zoom_api_key').val(resp[0]['zoom_api_key']);
                parentDiv.find('#zoom_api_secret').val(resp[0]['zoom_api_secret']);
                parentDiv.find('#meeting_number').val(resp[0]['meeting_number']);
                parentDiv.find('#password').val(resp[0]['password']);
                parentDiv.find('.addLiveClassSetting').attr('data-type', 'edit');
                parentDiv.find('#live_class_id').val(resp[0]['id']);
            }
        });
    }

    $(document).on('click', '.addLiveclass, .edit_live_class', function() {
        var parentDiv = $('#input_feilds_liveclass');
        if ($(this).hasClass('addLiveclass')) {
            parentDiv.find('#classModalLabel').html(ltr_add_live_class);
            parentDiv.find('form').trigger('reset');
            parentDiv.find('.addLiveClassSetting').attr('data-type', 'add');
        } else {
            var id = $(this).attr('data-id');
            var table_name = $(this).attr('data-table-name');
            common_ajax_funxtion(id, table_name, $(this).attr('data-batch'));
        }
        $.magnificPopup.open({
            items: {
                src: '#input_feilds_liveclass',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.edit_video_url', function() {
        var id = $(this).attr('data-id');
        var table_name = $(this).attr('data-table');
        let batch_id = $(this).attr('data-batch_id');
        let subject = $(this).attr('data-subject');
        let topic = $(this).attr('data-topic');
        var parentDiv = $('#add_video_popup');
        parentDiv.find('#myModalLabel1').html("Video");

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/video_edit_manger",
            data: {
                id: id,
                table_name: table_name
            },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                console.log(JSON.parse(resp[0]['batch']));
                // parentDiv.find('#batch').val($(this).attr('data-batch')).trigger('change');
                parentDiv.find('input[name="title"]').val(resp[0]['title']);
                parentDiv.find('input[name="id"]').val(resp[0]['id']);
                parentDiv.find('textarea[name="description"]').val(resp[0]['description']);

                parentDiv.find('[name="batch"]').val(batch_id.split(",")).trigger('change');
                setTimeout(function() {
                    parentDiv.find('[name="subject"]').val(resp[0]['subject']).trigger('change');
                }, 500);
                setTimeout(function() {
                    parentDiv.find('[name="topic"]').val(resp[0]['topic']).trigger('change');
                }, 700);
                let video_type = resp[0]['video_type'];
                parentDiv.find('input[name="video_type"][value="' + video_type + '"]').prop('checked', true);
                let text = resp[0]['url'];
                let result = text.substring(14);
                // alert(result);
                if (video_type == 'video') {
                    parentDiv.find('.video').removeClass('require');
                    parentDiv.find('.video_type_all,.video_url').removeClass('require');
                    parentDiv.find('#inlineRadio5').removeClass('require');
                    parentDiv.find('.video_type_video').removeClass('hide');
                    parentDiv.find('.video_type_all').addClass('hide');
                    parentDiv.find('.fileNameShow').html(result);
                } else {
                    parentDiv.find('.video_type_all').removeClass('hide');
                    parentDiv.find('.video_type_video').addClass('hide');
                    parentDiv.find('input[name="url"]').val(resp[0]['url']);
                }
            }
        });
        $.magnificPopup.open({
            items: {
                src: '#add_video_popup',
            },
            type: 'inline'
        });
    });
    $(document).on('click', '.addLiveClassSetting', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var type = $(this).attr('data-type');
            console.log(type);
            if (type == 'add') {
                var url = 'ajaxcall/add_live_class_setting';
            } else {
                var url = 'ajaxcall/edit_live_class_setting';
            }
            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + url,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }

                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('#input_feilds_liveclass').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.addLiveClassAndroid', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {

            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_live_class_Android",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('#input_feilds_android').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.upload_new_question', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {

            var formdata = new FormData($(this).closest('form')[0]);

            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/insert_excell",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                     setTimeout(function() {
                        window.location.reload(true);
                    }, 500);
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('#questionPopup').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });

        }
    });

    $(document).on('click', '.checkAllAttendance', function() {
        if ($(this).prop('checked') == true) {
            $(this).closest('table').find('.checkOneRow').prop('checked', true);
            $('.create_ppr_popup').show();
        } else {
            $(this).closest('table').find('.checkOneRow').prop('checked', false);
            $('.create_ppr_popup').hide();
        }
    });

    $(document).on('click', '.add_attendance', function() {

        if ($('.tableFullWrapper').find('.checkOneRow:checked').length == 0) {
            toastr.error(ltr_atleast_student_msg);
            return false;
        } else {

            AllIdArray = [];
            $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
                var value = $(this).val();
                if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
            });

            var formdata = new FormData();
            formdata.append('ids', JSON.stringify(AllIdArray))
            $('.tableFullWrapper').find('.checkOneRow').prop('checked', false);
            $('.checkAllAttendance').prop('checked', false);
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_attendance",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {

                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.create_ppr_popup').hide();
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);

                }
            });
        }

    });


    $(document).on('click', '.add_attendance_extra', function() {

        if ($('.tableFullWrapper').find('.checkOneRow:checked').length == 0) {
            toastr.error(ltr_atleast_student_msg);
            return false;
        } else {

            AllIdArray = [];
            $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
                var value = $(this).val();
                if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
            });

            var formdata = new FormData();
            formdata.append('ids', JSON.stringify(AllIdArray))
            $('.tableFullWrapper').find('.checkOneRow').prop('checked', false);
            $('.checkAllAttendance').prop('checked', false);
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_attendance_extra",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {

                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.create_ppr_popup').hide();
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);

                }
            });
        }

    });

    /*Multi delete*/
    $(document).on('click', '.multiDelete', function() {

        var t = $(this).attr('data-table');

        if (t == 'questions') {
            var cnf = ltr_all_test_record_msg;
        } else {
            var cnf = ltr_once_deleted_alert_msg;
        }
        if ($('.tableFullWrapper').find('.checkOneRow:checked').length == 0) {
            toastr.error(ltr_atleast_date_msg);
            return false;
        } else {

            swal({
                    title: ltr_are_deleted_alert_msg,
                    text: cnf,
                    icon: "warning",
                    buttons: [ltr_cancel, ltr_ok],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        AllIdArray = [];
                        $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
                            var value = $(this).val();
                            if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
                        });
                        var formdata = new FormData();
                        formdata.append('ids', JSON.stringify(AllIdArray));
                        formdata.append('table_name', $(this).attr('data-table'));
                        formdata.append('column', $(this).attr('data-column'));
                        $('.tableFullWrapper').find('.checkOneRow').prop('checked', false);

                        $.ajax({
                            method: "POST",
                            url: base_url + "ajaxcall/multiDelete",
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function(resp) {
                                var resp = $.parseJSON(resp);
                                if (resp['status'] == '1') {
                                    toastr.success(resp['msg']);
                                    targetTableUrl = $('.server_datatable').attr('data-url');
                                    $('.create_ppr_popup').hide();
                                    dataTableObj.ajax.url(base_url + targetTableUrl).load();
                                } else {
                                    toastr.error(ltr_something_msg);
                                }
                            },
                            error: function(resp) {
                                toastr.error(ltr_something_msg);

                            }
                        });
                    }
                });


        }

    });


    $(document).on('click', '.paidPreviewVideo', function() {

        var t = $(this).attr('data-table');
        if ($('.tableFullWrapper').find('.checkOneRow:checked').length == 0) {
            toastr.error(ltr_atleast_date_msg);
            return false;
        } else {

            AllIdArray = [];
            $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
                var value = $(this).val();
                if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
            });
            var formdata = new FormData();
            formdata.append('ids', JSON.stringify(AllIdArray));
            formdata.append('table_name', $(this).attr('data-table'));
            formdata.append('column', $(this).attr('data-column'));
            $('.tableFullWrapper').find('.checkOneRow').prop('checked', false);

            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/paidPreviewVideo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.checkAllAttendance').prop('checked', false);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        $('.create_ppr_popup').hide();
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);

                }
            });

        }

    });


    $(document).on('click', '.freePreviewVideo', function() {

        var t = $(this).attr('data-table');
        if ($('.tableFullWrapper').find('.checkOneRow:checked').length == 0) {
            toastr.error(ltr_atleast_date_msg);
            return false;
        } else {

            AllIdArray = [];
            $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
                var value = $(this).val();
                if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
            });
            var formdata = new FormData();
            formdata.append('ids', JSON.stringify(AllIdArray));
            formdata.append('table_name', $(this).attr('data-table'));
            formdata.append('column', $(this).attr('data-column'));
            $('.tableFullWrapper').find('.checkOneRow').prop('checked', false);

            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/freePreviewVideo",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.checkAllAttendance').prop('checked', false);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        $('.create_ppr_popup').hide();
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);

                }
            });

        }

    });



    $(document).on('click', '.certificate', function() {
        // if($('.tableFullWrapper').find('.checkOneRow:checked').length == 0){
        // 	toastr.error(ltr_atleast_date_msg);
        // 	return false;
        // }else{

        //     AllIdArray=[];
        // 	$('.tableFullWrapper').find('.checkOneRow:checked').each(function(){
        // 		var value = $(this).val();
        // 		if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
        // 	});
        var formdata = new FormData();
        // formdata.append('ids',JSON.stringify(AllIdArray));
        formdata.append('id', $(this).attr('data-id'));
        formdata.append('batch_id', $(this).attr('data-batch-id'));
        formdata.append('table_name', $(this).attr('data-table'));
        formdata.append('column', $(this).attr('data-column'));
        // $(this).closest('.tableFullWrapper').find('.checkOneRow').prop('checked',false);
        // $(this).closest('.tableFullWrapper').find('.checkAllAttendance').prop('checked',false);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/generateCertificate",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(resp['msg']);
                    targetTableUrl = $('.server_datatable').attr('data-url');
                    $('.create_ppr_popup').hide();
                    dataTableObj.ajax.url(base_url + targetTableUrl).load();
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);

            }

        });


    });

    $(document).on('click', '.add_live_class', function() {
        var parentDiv = $('#classSettingModal');
        parentDiv.find('#live_class_id').val($(this).attr('data-id'));

        $.magnificPopup.open({
            items: {
                src: '#classSettingModal',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.add_live_class_admin', function() {
        var parentDiv = $('#classSettingModal');
        parentDiv.find('#live_class_id').val($(this).attr('data-id'));
        var formdata = new FormData();

        formdata.append('batch_id', $(this).attr('data-batch'));
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_subject_list",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(resp) {

                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    parentDiv.find('#filter_subject').html(resp['html']);
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);

            }

        });
        $.magnificPopup.open({
            items: {
                src: '#classSettingModal',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.liveClassSetting', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            $("#classForm").submit();
        }
    });

    $('.updateCertificateSetting').on('click', function() {
        var formdata = new FormData($(this).closest('form')[0]);
        var valid_check = validate_form($(this).closest('form'));
        if (valid_check == 'valid') {
            $.ajax({
                method: "POST",
                url: base_url + 'ajaxcall/updateCertificateSetting',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        location.reload();
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $('.updatePrivacyPolicy').on('click', function() {
        var formdata = new FormData($(this).closest('form')[0]);
        var valid_check = validate_form($(this).closest('form'));
        if (valid_check == 'valid') {
            $.ajax({
                method: "POST",
                url: base_url + 'ajaxcall/updatePrivacyPolicy',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        location.reload();
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $('.updatetermscondition').on('click', function() {
        var formdata = new FormData($(this).closest('form')[0]);
        var valid_check = validate_form($(this).closest('form'));
        if (valid_check == 'valid') {
            $.ajax({
                method: "POST",
                url: base_url + 'ajaxcall/updatetermcondition',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        location.reload();
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });


    /*graph */
    if (document.getElementById('chart_area') != null) {
        var ctx = document.getElementById('chart_area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    }
    if (document.getElementById('practice_paper') != null) {
        var ctx1 = document.getElementById('practice_paper').getContext('2d');
        window.myPie = new Chart(ctx1, practice_config);
    }
    if (Array.isArray(mock_config)) {
        for (var gr = 0; gr < graph_count; gr++) {
            if (document.getElementById('mock_paper_' + gr) != null) {
                var ctx2 = document.getElementById('mock_paper_' + gr).getContext('2d');
                window.myPie = new Chart(ctx2, mock_config[gr]);
            }
        }
    } else {
        if (document.getElementById('mock_paper') != null) {
            var ctx2 = document.getElementById('mock_paper').getContext('2d');
            window.myPie = new Chart(ctx2, mock_config);
        }
    }

    if (document.getElementById('chart-area') != null) {
        var ctx = document.getElementById('chart-area').getContext('2d');
        window.myPie = new Chart(ctx, config);
    }
    $("#liveclssPopup").hide();
    $.ajax({
        method: "POST",
        url: base_url + "ajaxcall/checkActiveLiveClass",
        dataType: "json",
        success: function(resp) {

            if (resp['status'] == '1') {
                $("#liveclssPopup").show();
                if (resp['data']['teachImage'] == '') {
                    var src1 = base_url + "assets/images/student_img.png";
                } else {
                    var src1 = base_url + "uploads/teachers/" + resp['data']['teachImage'];

                }

                $(".live_teacher_image").attr("src", src1);
                $('.tname_title').html(resp['data']['name']);
                $('.liveclss_sub').html(resp['data']['subjectName']);
                $('.liveclss_topic').html(resp['data']['chapterName']);
            } else {

                // $("#liveclssPopup").hide();
            }
        },
        error: function(resp) {
            toastr.error(ltr_something_msg);
            $('.edu_preloader').fadeOut();
        }
    });
    $('.summernote').summernote({
        tooltip: false
    });


    // form data value clear			 
    $(document).on('click', '.mfp-close,.edu_admin_btn', function() {
        //$('#add_video_popup').find('form').trigger('reset');
        //$('#add_video_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
        // $('#add_video_popup [name="batch[]"]').select2({placeholder: ltr_select_batch});
        // $('#add_video_popup').find('[name="subject"]').val('').trigger('change');
        // $('#add_video_popup').find('[name="topic"]').val('').trigger('change');
        $('textarea[name="description"]').val('');
        //$('input[name="url"]').val('');
        $('.videoIframeShow iframe').remove();
        $('#newPass').val('');
        $('#confirmPass').val('');
        $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('error');
        $('#input_feilds_teacher').find('[name="name"]').removeClass('error');
    });


    $(document).on('click', '.mfp-close,.edu_admin_btn_video', function() {
        $('#add_video_popup').find('form').trigger('reset');
        $('#add_video_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
        $('#add_video_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
        $('#add_video_popup').find('[name="subject"]').val('').trigger('change');
        $('#add_video_popup').find('[name="topic"]').val('').trigger('change');
        $('textarea[name="description"]').val('');
        $('input[name="url"]').val('');
        $('input[name="title"]').val('');
        $('#newPass').val('');
        $('#confirmPass').val('');
        $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('error');
        $('#input_feilds_teacher').find('[name="name"]').removeClass('error');
    });

    $(document).on('keyup paste keypress Keydown', '.alphaField, input[name="father_designtn"]', function(e) {
        toastr.clear();
        var student_name = $('#add_student_form input[name="name"]').val();
        if (student_name != undefined) {
            if (student_name.length >= 41) {
                e.preventDefault();
                toastr.error(ltr_maximum40_characters_msg);
                $('#add_student_form input[name="name"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="name"]').removeClass("error");
            }
        }

        var father_name = $('#add_student_form input[name="father_name"]').val();
        if (father_name != undefined) {
            if (father_name.length >= 41) {
                toastr.error(ltr_maximum40_characters_msg);
                $('#add_student_form input[name="father_name"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="father_name"]').removeClass("error");
            }
        }
        var father_designtn = $('#add_student_form input[name="father_designtn"]').val();
        if (father_designtn != undefined) {
            if (father_designtn.length >= 50) {
                toastr.error(ltr_maximum40_characters_msg);
                $('#add_student_form input[name="father_designtn"]').addClass('error').focus();
                return false;
            } else {
                $('#add_student_form input[name="father_designtn"]').removeClass("error");
            }
        }

    });


    $('.alphaField, input[name="teach_education"]').on('keyup paste keypress Keydown', function(e) {
        toastr.clear();
        var teacher_name = $('.pxn_amin input[name="name"]').val();
        if (teacher_name != undefined) {
            if (teacher_name.length >= 41) {
                toastr.error(ltr_maximum40_characters_msg);
                $('.pxn_amin input[name="name"]').addClass('error').focus();
                return false;
            } else {
                $('.pxn_amin input[name="name"]').removeClass("error");
            }
        }

        var teach_education = $('.pxn_amin input[name="teach_education"]').val();
        if (teach_education != undefined) {
            if (teach_education.length >= 50) {
                toastr.error(ltr_maximum40_characters_msg);
                $('.pxn_amin input[name="teach_education"]').addClass('error').focus();
                return false;
            } else {
                $('.pxn_amin input[name="teach_education"]').removeClass("error");
            }
        }
    });


    $(document).on('click', '.tc_progress_popup', function() {
        $('.teacher_progres').attr('id', 'scrollGraph');
        if ($('.teacher_progress_popup').hasClass("hide")) {

            $(this).closest('tr').find('td:eq(8)').find('.tc_progress_popup').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
            // //alert(eye);
            var teacher_id = $('#teacher_id').val();
            var batch = $(this).attr('data-tcbid');
            var subject = $(this).attr('data-tcsid');
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/get_progress",
                data: { 'batch': batch, 'subject': subject, 'teacher_id': teacher_id },
                success: function(resp) {
                    $('.teacher_progress_popup').removeClass("hide");
                    $('.teacher_progress_popup').attr('id', 'scrollGraph');

                    var resp = $.parseJSON(resp);
                    console.log(resp);
                    if (resp['status'] == '1') {
                        var config = {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [
                                        resp['complete'],
                                        resp['pending']
                                    ],
                                    backgroundColor: [
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 99, 132)',
                                    ],
                                }],
                                labels: [
                                    'Complete',
                                    'Pending'
                                ]
                            },
                            options: {
                                responsive: true,
                                tooltips: {
                                    enabled: false
                                }
                            }
                        };
                        $('#canvas-holder').html(''); // this is my <canvas> element
                        $('#canvas-holder').append('<canvas id="chart-area"><canvas>');
                        var ctx = document.getElementById('chart-area').getContext('2d');
                        window.myPie = new Chart(ctx, config);
                        $('html, body').animate({
                            scrollTop: $("#scrollGraph").offset().top
                        }, 1500);
                    } else {
                        toastr.error(resp['msg']);
                        var config = {
                            type: 'pie',
                            data: {
                                datasets: [{
                                    data: [
                                        resp['complete'],
                                        resp['pending']
                                    ],
                                    backgroundColor: [
                                        '#109618',
                                        '#ee0808'
                                    ],
                                }],
                                labels: [
                                    'Complete',
                                    'Pending'
                                ]
                            },
                            options: {
                                responsive: true,
                                tooltips: {
                                    enabled: false
                                }
                            }
                        };
                        $('#canvas-holder').html(''); // this is my <canvas> element
                        $('#canvas-holder').append('<canvas id="chart-area"><canvas>');
                        var ctx = document.getElementById('chart-area').getContext('2d');
                        window.myPie = new Chart(ctx, config);
                    }
                    $('.edu_preloader').fadeOut();
                    $('#homeworkPopup').find('.mfp-close').trigger('click');
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        } else {
            $(this).closest('tr').find('td:eq(8)').find('.tc_progress_popup').html('<i class="fa fa-eye" aria-hidden="true"></i>');
            $('.teacher_progress_popup').addClass("hide");
        }
    });

    $(document).on('change', '.doubtStatus', function() {
        var table = $(this).attr('data-table');
        var student_id = $(this).attr('data-userid');
        var apru = $(this).attr('data-apru');
        var batch_id = $(this).attr('data-batchid');
        var s = $(this).val();
        if (s == 1 && apru == 'no') {
            $(this).closest('tr').find('td:eq(8)').find('.appointmentDate').click();
            toastr.error(ltr_double_class_date_msg);
            return false;
        }
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/change_status_doubts",
            data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'status': $(this).val(), 'student_id': student_id, 'batch_id': batch_id },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(ltr_status_msg);
                    if (table == 'extra_classes') {
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    $(document).on('click', '.doubtDeleteData', function() {

        var t = $(this).attr('data-table');

        var cnf = ltr_once_deleted_alert_msg;

        swal({
                title: ltr_are_deleted_alert_msg,
                text: cnf,
                icon: "warning",
                buttons: [ltr_cancel, ltr_ok],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var file = $(this).attr('data-file');
                    if (file != 'undefined' || file != '') {
                        file = file;
                    } else {
                        file = '';
                    }

                    $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
                    $.ajax({
                        method: "POST",
                        url: base_url + "ajaxcall/doubtsDeleteData",
                        data: { 'id': $(this).attr('data-id'), 'table': $(this).attr('data-table'), 'file': file },
                        success: function(resp) {
                            var resp = $.parseJSON(resp);
                            if (resp['status'] == '1') {
                                toastr.success(resp['msg']);
                                targetTableUrl = $('.server_datatable').attr('data-url');
                                dataTableObj.ajax.url(base_url + targetTableUrl).load();

                            } else {
                                toastr.error(ltr_something_msg);
                            }
                            $('.edu_preloader').fadeOut();
                            $('.create_ppr_popup').hide();
                            $(".checkOneRow").prop("checked", false);
                            $(".checkAllAttendance").prop("checked", false);
                        },
                        error: function(resp) {
                            toastr.error(ltr_something_msg);
                            $('.edu_preloader').fadeOut();
                        }
                    });
                }
            });

    });


    $(document).on('click', '.addDoubtsDate', function() {
        var validchk = validate_form($(this).closest('form'));
        var batch_id = $('#batch_id').val();
        var student_id = $('#user_id').val();

        console.log($(this).closest('form'));
        AllIdArray = [];
        $('.tableFullWrapper').find('.checkOneRow:checked').each(function() {
            var value = $(this).val();
            if (AllIdArray.indexOf(value) === -1) AllIdArray.push(value);
        });

        if (validchk == 'valid') {
            var _this = $(this);
            var aurl = "ajaxcall/edit_doubts";

            var formdata = new FormData($(this).closest('form')[0]);
            formdata.append('batch_id', batch_id);
            formdata.append('student_id', student_id);
            formdata.append('ids', JSON.stringify(AllIdArray));
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + aurl,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();

                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                        $('#input_feilds_vacancy').find('.mfp-close').trigger('click');
                    } else {
                        toastr.error(resp['msg']);
                    }
                    $('.edu_preloader').fadeOut();
                    $('.create_ppr_popup').hide();
                    $(".checkOneRow").prop("checked", false);
                    $(".checkAllAttendance").prop("checked", false);
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    //Teacher js
    $(document).on('click', '.viewDoubt,.studentViewDoubt', function() {

        var userName = $(this).closest('tr').find('td:eq(1)').find('a').attr('data-word');
        if (userName != undefined) {
            $('#input_feilds_teacher').find('[name="name"]').val(userName);
        } else {
            $('#input_feilds_teacher').find('[name="name"]').val($(this).closest('tr').find('td:eq(1)').text());
        }
        var batchName = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
        if (batchName != undefined) {
            $('#input_feilds_teacher').find('[name="batch"]').val(batchName);
        } else {
            $('#input_feilds_teacher').find('[name="batch"]').val($(this).closest('tr').find('td:eq(2)').text());
        }
        var subName = $(this).closest('tr').find('td:eq(3)').find('a').attr('data-word');
        if (subName != undefined) {
            $('#input_feilds_teacher').find('[name="subject"]').val(subName);
        } else {
            $('#input_feilds_teacher').find('[name="subject"]').val($(this).closest('tr').find('td:eq(3)').text());
        }
        var charName = $(this).closest('tr').find('td:eq(4)').find('a').attr('data-word');
        if (charName != undefined) {
            $('#input_feilds_teacher').find('[name="chapter"]').val(charName);
        } else {
            $('#input_feilds_teacher').find('[name="chapter"]').val($(this).closest('tr').find('td:eq(4)').text());
        }
        var des = $(this).closest('tr').find('td:eq(5)').find('a').attr('data-word');

        if (des != undefined) {
            $('#input_feilds_teacher').find('[name="studescription"]').val(des);
        } else {
            $('#input_feilds_teacher').find('[name="studescription"]').val($(this).closest('tr').find('td:eq(5)').text());
        }
        if ($(this).hasClass('studentViewDoubt')) {
            $('#input_feilds_teacher').find('.doubts_date').html($(this).attr('data-doubtdate'));

            $('#input_feilds_teacher').find('.doubts_time').html($(this).attr('data-doubttime'));

            $('#input_feilds_teacher').find('.teacdescription').text($(this).attr('data-doubtdes'));
        } else {
            $('#input_feilds_teacher').find('[name="doubts_date"]').val($(this).closest('tr').find('td:eq(7)').find('.appointmentDate').attr('data-doubtdate'));

            $('#input_feilds_teacher').find('[name="doubts_time"]').val($(this).closest('tr').find('td:eq(7)').find('.appointmentDate').attr('data-doubttime'));

            $('#input_feilds_teacher').find('[name="teacdescription"]').val($(this).closest('tr').find('td:eq(7)').find('.appointmentDate').attr('data-doubtdes'));
        }

        $.magnificPopup.open({
            items: {
                src: '#input_feilds_teacher',
            },
            type: 'inline'
        });
    });

    $(document).on('click', '.batchType', function() {
        var chk = $(this).val();
        if (chk == 1) {
            $('.batchPrice').hide();
            $('#batchPrice').removeClass('require');
        } else {
            $('.batchPrice').show();
            $('#batchPrice').addClass('require')
        }
    });

    $(document).on('change', '.filter_subject_doubt', function() {
        var subject = $(this).val();
        if (subject != '') {

            if ($(this).attr('data-teacher') == 'yes') {

                var batchId = $(this).attr('data-batchId');
                get_chapter_tech('filter_chapter', subject, 'filter_teacher', $(this), '', batchId);
                //$(this).closest('.edu_accord_parent').find('.edu_accordion_header span.subjects_name').text($(this).find('option:selected').text());
            } else {
                get_chapter_tech($('.filter_chapter'), subject, '', '', $(this).attr('data-count'));
            }

        }
    });

    function get_chapter_tech(chapter_cls, subject, teacher = '', _this, count = '', batchId = '') {

        if (teacher != '') {
            $('.' + chapter_cls).html("<option> " + ltr_loading_msg + " ... </option>");
            $('.' + teacher).html("<option> " + ltr_loading_msg + " ... </option>");
        } else {
            chapter_cls.html("<option> " + ltr_loading_msg + " ... </option>");
        }

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_chapter_tech",
            data: { 'subject': subject, 'teacher': teacher, 'count': count, 'batchId': batchId },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    if (teacher != '') {
                        $('.' + chapter_cls).html(resp['html']);
                        $('.' + teacher).html(resp['teacherHtml']);
                    } else {
                        chapter_cls.html(resp['html']);
                    }
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });
    }

    $(document).on('keyup paste keypress Keydown', 'input[name="batch_speci_heading[]"]', function(e) {
        toastr.clear();
        var heading_val = $(this).val();
        $(this).closest('.edu_accord_parent').find('.speci_heading').text(heading_val);

    });

    $(document).on('click', '.updateEmailDetails', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var _this = $(this);
            var aurl = "ajaxcall/edit_email_setting";

            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + aurl,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.edu_preloader').fadeOut();
                    } else {
                        toastr.error(resp['msg']);
                        $('.edu_preloader').fadeOut();
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    $(document).on('click', '.updateFirebaseDetails', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var _this = $(this);
            var aurl = "ajaxcall/edit_firebase_setting";

            var formdata = new FormData($(this).closest('form')[0]);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + aurl,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        $('.edu_preloader').fadeOut();
                    } else {
                        toastr.error(resp['msg']);
                        $('.edu_preloader').fadeOut();
                    }
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });


    if ($('.add_edit_question').length > 0) {
        CKEDITOR.replace('question', {
            extraPlugins: 'imageuploader',
            filebrowserBrowseUrl: base_url + 'view_server_image/wiew_image',
            filebrowserUploadUrl: base_url + 'view_server_image/upload_blog_image',
            filebrowserUploadMethod: "form",
            // filebrowserVideoBrowseUrl: base_url+'view_server_image/wiew_video',
            // filebrowserUploadUrl : base_url+'view_server_image/upload_blog_video',
            extraPlugins: 'mathjax',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',

        });

        $('.editor').each(function(e) {

            CKEDITOR.replace(this.id, {
                extraPlugins: 'imageuploader',
                filebrowserBrowseUrl: base_url + 'view_server_image/wiew_image',
                filebrowserUploadUrl: base_url + 'view_server_image/upload_blog_image',
                filebrowserUploadMethod: "form",
                // filebrowserVideoBrowseUrl: base_url+'view_server_image/wiew_video',
                // filebrowserUploadUrl : base_url+'view_server_image/upload_blog_video',
                extraPlugins: 'mathjax',
                mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML',
            });
        });

        if ($('.add_edit_question').attr('data-id') != '') {
            $(".filter_subject").trigger("change");
            console.log($('.add_edit_question').attr('data-id'));
            //$( ".filter_modal_chapter" ).val($(this).attr('data-id')).trigger('change');
            setTimeout(function() {
                $('.add_edit_question').find('select[name="chapter_id"]').val($('.add_edit_question').attr('data-id')).trigger('change');
            }, 500);
        }


    }

    //new update
    $(document).on('click', '.addNewBook,.addNewLibrary', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            if ($(this).hasClass('addNewLibrary')) {
                var url = "ajaxcall/add_library";
            } else {
                var batch = $('.get_teacher_subject').val();
                // alert(batch);
                var sub = $('.teacher_subject').val();
                var id = $('#book_id').val();
                formdata.append('batch', batch);
                formdata.append('subject_id', sub);
                formdata.append('id', id);
                var url = "ajaxcall/add_book";
            }
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + url,
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);

                    if (resp['status'] == '1') {

                        toastr.success(resp['msg']);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }

                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    // $('#add_book_popup').find('.mfp-close').trigger('click');
                    // $('#add_book_popup').find('form').trigger('reset');
                    // $('#add_book_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
                    // $('#add_book_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
                    // $('#add_book_popup').find('[name="subject"]').val('').trigger('change');
                    // $('#add_book_popup').find('[name="topic"]').val('').trigger('change');

                    // $(".fileNameShow").html("");
                    // $('input[name="title"]').val('');

                    // $('.edu_preloader').fadeOut();
                    $('#add_book_popup').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });
    $(document).on('click', '.viewPdf', function() {
        var src = base_url + $(this).attr('data-url');
        var html = '<div class="col-lg-12 col-md-12 col-sm-12 col-12"><iframe width="100%" width="500" height="350" src="' + src + '#toolbar=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        $('#view_video_popup .videoIframeShow').html(html);
        $.magnificPopup.open({
            items: {
                src: '#view_video_popup',
            },
            type: 'inline'
        });
        $('#view_video_popup #viewVideoTopic').html($(this).closest('tr').find('td:eq(2)').text());
        $('#view_video_popup #viewVideoTitle').html($(this).closest('tr').find('td:eq(1)').text());
    });
    $('.searchBook').on('click', function() {
        if ($('.filter_subject').val() != '') {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var subject = $.trim($('.filter_subject').val());
            //$.trim($('.filter_subject option:selected').text());

            dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject).load();
        } else {
            toastr.error(ltr_select_subject_both_msg);
        }
    });

    $(document).on('click', '.addNewNotes', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var sub = $.trim($('.filter_subject option:selected').val());
            var topic = $.trim($('.filter_chapter option:selected').val())
            var id = $('#note_id').val();
            formdata.append('id', id);
            formdata.append('subject', sub);
            formdata.append('topic', topic);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_notes",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {

                        toastr.success(resp['msg']);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        $('#add_note_popup').find('.mfp-close').trigger('click');
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }

                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    // $('#add_book_popup').find('.mfp-close').trigger('click');
                    // $('#add_book_popup').find('form').trigger('reset');
                    // $('#add_book_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
                    // $('#add_book_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
                    // $('#add_book_popup').find('[name="subject"]').val('').trigger('change');
                    // $('#add_book_popup').find('[name="topic"]').val('').trigger('change');

                    // $(".fileNameShow").html("");
                    // $('input[name="title"]').val('');

                    // $('.edu_preloader').fadeOut();
                    $('#add_note_popup').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });
    $('.searchNotes').on('click', function() {
        if ($('.filter_subject').val() != '' && $('.filter_chapter').val() != '') {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var subject = $.trim($('.filter_subject').val());
            var chapter = $.trim($('.get_chapter option:selected').text().replace(ltr_select_chapter, ""));
            dataTableObj.ajax.url(base_url + targetTableUrl + '?subject=' + subject + '&chapter=' + chapter).load();
        } else {
            toastr.error(ltr_select_subject_both_msg);
        }
    });

    function edit_book_library(id, table_name, batch_id) {
        // alert(batch_id);	   
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/edit_library_module",
            data: {
                id: id,
                table_name: table_name
            },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                // console.log(resp);
                $('#add_book_popup').find('form').trigger('reset');
                $('#add_book_popup').find('[name="title"]').val(resp[0]['title']);
                $('#add_book_popup').find('[name="id"]').val(resp[0]['id']);
                // $('#add_book_popup').find('[name="subject"]').val(resp[0]['subject']).trigger('change');
                $('#add_book_popup').find('[name="file"]').val(resp[0]['file_name']);
                $('#add_book_popup').find('.fileNameShow').html(resp[0]['file_name']);
                $('#add_book_popup').find('#book_id').val(resp[0]['id']);
                $('[name="batch_id[]"]').val(batch_id.split(",")).trigger('change');
                setTimeout(function() {
                    $('#subject_id').val(resp[0]['subject']).trigger('change');
                }, 250);

            }
        });
    }
    $(document).on('click', '.addBookPop, .edit_book', function() {
        if ($(this).hasClass('addBookPop')) {
            $('#add_book_popup').find('.mfp-close').trigger('click');
            $('#add_book_popup').find('#myModalLabel1').html(ltr_add_book);
            $('#add_book_popup').find('.addNewBook').val(ltr_add);
            $('#add_book_popup').find('form').trigger('reset');
            $('#add_book_popup').find('[name="batch"]').val('').trigger('change');
            // $('#add_book_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection_choice').remove();
            $('#add_book_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
            $('#add_book_popup').find('[name="subject"]').val('').trigger('change');
            $('#add_book_popup').find('[name="topic"]').val('').trigger('change');
            $(".fileNameShow").html("");
            $('input[name="title"]').val('');
            $('#add_book_popup').find('#book_id').val('');

        } else {
            edit_book_library($(this).attr('data-id'), $(this).attr('data-table'), $(this).attr('data-batch'));
            $('#add_book_popup').find('.file_book').removeClass('require');
            $('#add_book_popup').find('.addNewBook').val(ltr_edit);
            $('#add_book_popup').find('#myModalLabel1').html(ltr_edit_book);
        }
        $.magnificPopup.open({
            items: {
                src: '#add_book_popup',
            },
            type: 'inline'
        });
    });


    //     $(document).on('click', '.addnotePop, .edit_note', function() {
    //         if ($(this).hasClass('addnotePop')) {
    //             $('#add_note_popup').find('.mfp-close').trigger('click');
    // 			$('#add_note_popup').find('#myModalLabel1').html(ltr_add_notes);
    // 			$('#add_note_popup').find('.addNewNotes').val(ltr_add);
    //             $('#add_note_popup').find('form').trigger('reset');
    //             $('#add_note_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection_choice').remove();
    //             //$('#add_note_popup [name="batch[]"]').select2({placeholder: ltr_select_batch});
    //             $('#add_note_popup').find('[name="subject"]').val('').trigger('change');
    //             $('#add_note_popup').find('[name="topic"]').val('').trigger('change');
    //             $(".fileNameShow").html("");
    //             $('input[name="title"]').val('');
    // 			$('#add_note_popup').find('#note_id').val('');

    //         } else {
    //             $('#add_note_popup').find('.file_note').removeClass('require');
    //             $('#add_note_popup').find('.addNewNotes').val(ltr_edit);
    //             $('#add_note_popup').find('#myModalLabel1').html(ltr_edit_notes);
    //             $('#add_note_popup').find('[name="title"]').val($(this).closest('tr').find('td:eq(2)').text());
    //             // $('#add_note_popup').find('[name="batch[]"]').val($(this).closest('tr').find('td:eq(3)').text()).trigger('change');
    // 			$('#add_note_popup').find('[name="subject"]').val($(this).closest('tr').find('td:eq(4)').text()).trigger('change');
    // 			$('#add_note_popup').find('[name="file"]').val($(this).attr('data-file'));
    //             $('#add_note_popup').find('.fileNameShow').html($(this).attr('data-file'));
    // 			$('#add_note_popup').find('#note_id').val($(this).attr('data-id'));

    //             var batch = $(this).attr('data-batch');
    //             // $('[name="batch[]"]').val(batch.split(",")).trigger('change');

    //         }
    //         $.magnificPopup.open({
    //             items: {
    //                 src: '#add_note_popup',
    //             },
    //             type: 'inline'
    //         });
    //     });
    function edit_notes_library(id, table_name, batch_id, subject_id, topic_id) {
        // alert(batch_id);	   
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/edit_library_module",
            data: {
                id: id,
                table_name: table_name
            },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('#add_note_popup').find('[name="batch[]"]').val(batch_id.split(",")).trigger('change');
                setTimeout(function() {
                    $('#add_note_popup').find('[name="subject"]').val(resp[0]['subject']).trigger('change');
                }, 300);
                setTimeout(function() {
                    $('#add_note_popup').find('[name="topic"]').val(resp[0]['topic']).trigger('change');
                }, 350);

                $('#add_note_popup').find('[name="file"]').val(resp[0]['file_name']);
                $('#add_note_popup').find('.fileNameShow').html(resp[0]['file_name']);
                $('#add_note_popup').find('#note_id').val(resp[0]['id']);

            }
        });
    }
    $(document).on('click', '.addnotePop, .edit_note', function() {
        if ($(this).hasClass('addnotePop')) {
            $('#add_note_popup').find('.mfp-close').trigger('click');
            $('#add_note_popup').find('#myModalLabel1').html(ltr_add_notes);
            $('#add_note_popup').find('.addNewNotes').val(ltr_add);
            $('#add_note_popup').find('form').trigger('reset');
            $('#add_book_popup').find('[name="batch[]"]').val('').trigger('change');

            // $('#add_note_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection_choice').remove();
            $('#add_note_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
            $('#add_note_popup').find('[name="subject"]').val('').trigger('change');
            $('#add_note_popup').find('[name="topic"]').val('').trigger('change');
            $(".fileNameShow").html("");
            $('input[name="title"]').val('');
            $('#add_note_popup').find('#note_id').val('');

        } else {
            edit_notes_library($(this).attr('data-id'), $(this).attr('data-table'), $(this).attr('data-batch_id'), $(this).attr('data-subject_id'), $(this).attr('data-topic_id'));
            $('#add_note_popup').find('.file_note').removeClass('require');
            $('#add_note_popup').find('.addNewNotes').val(ltr_edit);
            $('#add_note_popup').find('#myModalLabel1').html(ltr_edit_notes);
            $('#add_note_popup').find('[name="title"]').val($(this).closest('tr').find('td:eq(2)').text());
        }
        $.magnificPopup.open({
            items: {
                src: '#add_note_popup',
            },
            type: 'inline'
        });
    });


    // 	$(document).on('click', '.addoldpaper_popup, .edit_oldpaper', function() {
    //         if ($(this).hasClass('addoldpaper_popup')) {
    //             $('#add_oldpaper_popup').find('.mfp-close').trigger('click');
    // 			$('#add_oldpaper_popup').find('#myModalLabel1').html(ltr_add_old_paper);
    // 			$('#add_oldpaper_popup').find('.addNewOldPaper').val(ltr_add);
    //             $('#add_oldpaper_popup').find('form').trigger('reset');
    //             $('#add_oldpaper_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection_choice').remove();
    //             //$('#add_oldpaper_popup [name="batch[]"]').select2({placeholder: ltr_select_batch});
    //             $('#add_oldpaper_popup').find('[name="subject"]').val('').trigger('change');
    //             // $('#add_oldpaper_popup').find('[name="topic"]').val('').trigger('change');
    //             $(".fileNameShow").html("");
    //             $('input[name="title"]').val('');
    // 			$('#add_oldpaper_popup').find('#oldpaper_id').val('');

    //         } else {
    //             $('#add_oldpaper_popup').find('.file_old_paper').removeClass('require');
    //             $('#add_oldpaper_popup').find('.addNewOldPaper').val(ltr_edit);
    //             $('#add_oldpaper_popup').find('#myModalLabel1').html(ltr_edit_old_paper);
    //             $('#add_oldpaper_popup').find('[name="title"]').val($(this).closest('tr').find('td:eq(2)').text());
    //             // $('#add_oldpaper_popup').find('[name="batch[]"]').val($(this).closest('tr').find('td:eq(3)').text()).trigger('change');
    // 			$('#add_oldpaper_popup').find('[name="subject"]').val($(this).closest('tr').find('td:eq(4)').text()).trigger('change');
    // 			$('#add_oldpaper_popup').find('[name="file"]').val($(this).attr('data-file'));
    //             $('#add_oldpaper_popup').find('.fileNameShow').html($(this).attr('data-file'));
    // 			$('#add_oldpaper_popup').find('#oldpaper_id').val($(this).attr('data-id'));

    //             var batch = $(this).attr('data-batch');
    //             // $('[name="batch[]"]').val(batch.split(",")).trigger('change');

    //         }
    //         $.magnificPopup.open({
    //             items: {
    //                 src: '#add_oldpaper_popup',
    //             },
    //             type: 'inline'
    //         });
    //     });
    function edit_oldpaper_library(id, table_name, batch_id, subject_id) {
        // alert(batch_id);	   
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/edit_library_module",
            data: {
                id: id,
                table_name: table_name
            },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('#add_oldpaper_popup').find('[name="title"]').val(resp[0]['title']);
                $('#add_oldpaper_popup').find('[name="batch[]"]').val(batch_id.split(",")).trigger('change');
                setTimeout(function() {
                    $('#add_oldpaper_popup').find('[name="subject"]').val(resp[0]['subject']).trigger('change');
                }, 300);

                $('#add_oldpaper_popup').find('[name="file"]').val(resp[0]['file_name']);
                $('#add_oldpaper_popup').find('.fileNameShow').html(resp[0]['file_name']);
                $('#add_oldpaper_popup').find('#oldpaper_id').val(resp[0]['id']);

            }
        });
    }

    function resetformcommon() {
        $("select").closest("form").on("reset", function(ev) {
            var targetJQForm = $(ev.target);
            setTimeout((function() {
                this.find("select").trigger("change");
            }).bind(targetJQForm), 0);
        });
    }
    $(document).on('click', '.addoldpaper_popup, .edit_oldpaper', function() {
        if ($(this).hasClass('addoldpaper_popup')) {
            $('#add_oldpaper_popup').find('.mfp-close').trigger('click');
            $('#add_oldpaper_popup').find('#myModalLabel1').html(ltr_add_old_paper);
            $('#add_oldpaper_popup').find('.addNewOldPaper').val(ltr_add);
            $('#add_oldpaper_popup').find('form').trigger('reset');
            $('#add_oldpaper_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection_choice').remove();
            $('#add_oldpaper_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
            $('#add_oldpaper_popup').find('[name="subject"]').val('').trigger('change');
            // $('#add_oldpaper_popup').find('[name="topic"]').val('').trigger('change');
            $(".fileNameShow").html("");
            $('input[name="title"]').val('');
            $('#add_oldpaper_popup').find('#oldpaper_id').val('');

        } else {
            edit_oldpaper_library($(this).attr('data-id'), $(this).attr('data-table'), $(this).attr('data-batch_id'), $(this).attr('data-subject'));
            $('#add_oldpaper_popup').find('.file_old_paper').removeClass('require');
            $('#add_oldpaper_popup').find('.addNewOldPaper').val(ltr_edit);
            $('#add_oldpaper_popup').find('#myModalLabel1').html(ltr_edit_old_paper);
        }
        $.magnificPopup.open({
            items: {
                src: '#add_oldpaper_popup',
            },
            type: 'inline'
        });
    });



    $(document).on('click', '.addNewOldPaper', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var sub = $.trim($('.filter_subject option:selected').val());
            var topic = $.trim($('.filter_chapter option:selected').val())
            formdata.append('subject', sub);
            formdata.append('topic', topic);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_old_paper",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {

                        toastr.success(resp['msg']);
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }


                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    // $('#add_book_popup').find('.mfp-close').trigger('click');
                    // $('#add_book_popup').find('form').trigger('reset');
                    // $('#add_book_popup [name="batch[]"]').next("span.select2-container").find('.select2-selection__choice').remove();
                    // $('#add_book_popup [name="batch[]"]').select2({ placeholder: ltr_select_batch });
                    // $('#add_book_popup').find('[name="subject"]').val('').trigger('change');
                    // $('#add_book_popup').find('[name="topic"]').val('').trigger('change');

                    // $(".fileNameShow").html("");
                    // $('input[name="title"]').val('');

                    // $('.edu_preloader').fadeOut();
                    $('#add_oldpaper_popup').find('.mfp-close').trigger('click');
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });
    $('.enrollNowSubmit').on('click', function() {
        var formdata = new FormData();
        formdata.append('batchId', $(this).attr('data-id'));
        formdata.append('email', $(this).attr('data-email'));
        formdata.append('name', $(this).attr('data-name'));
        formdata.append('mobile', $(this).attr('data-mobile'));

        // 		formdata.append('mobile','');

        var valid_check = validate_form($(this).closest('form'));
        var form = $(this).closest('form');
        if (valid_check == 'valid') {
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + 'front_ajax/enroll_check',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    console.log(resp);
                    if (resp['status'] == '1') {
                        if (resp['payment_type'] == 1) {
                            $('.edu_preloader').fadeOut();
                            var data = resp['data'];
                            razorpay_form(data['amount'], data['batchId'], data['name'], data['email'], data['mobile']);
                        } else {
                            window.setTimeout(function() {
                                window.location.href = resp['url'];
                            }, 1000);
                        }

                    } else if (resp['status'] == '2') {
                        toastr.success("Course purchased successfully.");
                        window.setTimeout(function() {
                            window.location.href = base_url + 'student/my-course';
                        }, 1000);
                    } else {
                        toastr.error(resp['msg']);
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    toastr.error("Something went wrong, please try again.");
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });

    function razorpay_form(totalAmount, product_id, name, email, mobile) {

        var options = {
            "key": rzp_key,
            "amount": totalAmount * 100, // 2000 paise = INR 20
            "name": name,
            "image": site_logo,
            "handler": function(response) {
                console.log(response);
                $.ajax({
                    url: base_url + 'front_ajax/razorPaySuccess',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        razorpay_payment_id: response.razorpay_payment_id,
                        totalAmount: totalAmount,
                        product_id: product_id,
                        name: name,
                        email: email,
                        mobile: mobile
                    },
                    success: function(msg) {
                        toastr.success("Course purchased successfully.");
                        window.setTimeout(function() {
                            // window.location.href = base_url + 'student/courses-data/All';
                            window.location.href = base_url + 'student/my-course';
                        }, 1000);
                    }
                });
            },
            "theme": {
                "color": "#528FF0"
            },
            "prefill": {
                "name": name,
                "email": email,
                "contact": '91' + mobile
            },
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();

    };

    /** Notification**/
    var counting = 0;
    $('.notification-info').on("click", function() {
        var id = $('#student_id').val();
        if (counting == '0') {
            $('.recent-notification').addClass('show');
            counting++;

            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/change_notification_status",
                data: {
                    id: id
                },

                success: function(resp) {

                    var resp = $.parseJSON(resp);

                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                }
            });
        } else {
            $('.recent-notification').removeClass('show');
            counting--;
        }
    });

    $(".recent-notification, .notification-info").on('click', function(event) {
        event.stopPropagation();

    });

    $('body').on("click", function() {
        if (counting == '1') {
            $('.recent-notification').removeClass('show');
            counting--;
        }
    });

    // 	 $('.filter_batches').on('change', function(){
    //             var id = $('.filter_batches').val();

    //             	$.ajax({
    //             			method: "POST",
    //             			url: base_url+"ajaxcall/batch_data",
    //             			data: {
    //             			    id : id
    //             			},

    //             			success: function(resp){

    //             			    var resp = $.parseJSON(resp);
    //             			    $('#allbatchdata').html(resp.data);

    //             			},
    //             			error:function(resp){
    //             				toastr.error(ltr_something_msg);
    //             			}
    //             		});
    // 	 }); 

    $('.filter_batches_teacher').on('change', function() {
        var id = $('.filter_batches_teacher').val();

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/batch_data_teacher",
            data: {
                id: id
            },

            success: function(resp) {

                var resp = $.parseJSON(resp);
                $('#allbatchdata_teacher').html(resp.data);

            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });


    $('.filter_stud_batches').on('change', function() {
        var id = $('.filter_stud_batches').val();

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/batch_data_student",
            data: {
                id: id
            },

            success: function(resp) {

                var resp = $.parseJSON(resp);
                $('#student_batch_data').html(resp.data);

            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });


    $(document).on('click', '.changeprvButton', function() {
        var id = $(this).attr('data-id');
        var preview_type = $(this).val();
        // alert(preview_type);                
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/preview_change",
            data: { 'id': id, 'preview_type': preview_type },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    toastr.success(ltr_status_msg);
                    targetTableUrl = $('.server_datatable').attr('data-url');
                    dataTableObj.ajax.url(base_url + targetTableUrl).load();
                } else {
                    toastr.error(ltr_something_msg);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });

    });


    $('#category_dropdown').on('change', function() {


        if ($(this).hasClass('category_dropdown')) {
            $('#category_dropdown').addClass("require");
            $('#subcategory_dropdown').addClass("require");
        } else {
            $('#category_dropdown').removeClass("require");
            $('#subcategory_dropdown').removeClass("require");
        }
        var category_id = this.value;
        // alert(category_id);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/subcategory_data",
            data: {
                category_id: category_id
            },
            cache: false,
            success: function(result) {
                var resp = $.parseJSON(result);
                if (resp['status'] == '1') {
                    var subcat = '';
                    for (var k = 0; k < resp.data.length; k++) {
                        subcat += '<option value="' + resp.data[k]['id'] + '">' + resp.data[k]['name'] + '</option>';
                    }
                    $("#subcategory_dropdown").html(subcat);
                } else {
                    var subcat = '<option value="">' + ltr_no_result + '</option>';
                    $("#subcategory_dropdown").html(subcat);
                }
            }
        });
    });

    $('.single_batch_sub').on('change', function() {
        var batch_id = this.value;

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/single_batchdata",
            data: { 'batch_id': batch_id },
            success: function(resp) {
                var resp = $.parseJSON(resp);

                $("#subject_dropdown").html(resp.data);


            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });

    $('.courseData').on('click', function() {
        var batch_id = $(this).attr('data-batchId');
        //  alert(batch_id);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/my_batchcourse",
            data: { 'id': batch_id },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                console.log(resp);
                if (resp['status'] == '1') {
                    setTimeout(function() {
                        // 			 	var pageURL = $(location).attr("href");
                        // alert(pageURL);
                        window.location.reload(true);
                    }, 500);
                }
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });
    });


    $(document).on('click', '#search_button', function(e) {
        var course = $('#search_field').val();
        $.ajax({
            method: "POST",
            url: base_url + 'front_ajax/search_student_batch',
            data: { 'course_name': course },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('#search_data_course').html(resp.data);

            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });

    });


    if ($("#search_field").length) {

        var input = document.getElementById("search_field");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();

                $("#search_button").trigger("click");
            }
        });
    }


    $(document).on('click', '.subcatData', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            method: "POST",
            url: base_url + 'front_ajax/search_student_cat',
            data: { 'id': id },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                $('#search_data_course').html(resp.data);
            },
            error: function(resp) {
                toastr.error(ltr_something_msg);
            }
        });

    });


    (function() {
        var
            form = $('.form'),
            cache_width = form.width(),
            a4 = [595.28, 841.89]; // for a4 size paper width and height  

        $('#create_pdf').on('click', function() {
            $('body').scrollTop(0);
            $(this).hide();
            createPDF();
        });
        //create pdf  
        function createPDF() {
            getCanvas().then(function(canvas) {
                var
                    img = canvas.toDataURL("image/png"),
                    doc = new jsPDF({
                        unit: 'px',
                        format: [545.28, 725],
                        orientation: 'landscape'
                    });

                doc.addImage(img, 'JPEG', 20, 20);
                doc.save('<?php echo $this->session->userdata("name");?>"+".pdf');
                form.width(cache_width);
            });
        }

        // create canvas object  
        function getCanvas() {
            form.width((a4[0] * 1)).css('max-width', 'none');
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    }());

    /* 
     * jQuery helper plugin for examples and tests 
     */

    //     $(document).on('click','#dwl_create_pdf',function(){

    //     var pdfu = $(this).attr('data-pdfu');
    //     var pdfb = $(this).attr('data-pdfb');
    //     var base_url = $(this).attr('data-pdf_url');
    //         if(pdfu){
    //         	$.ajax({
    // 				method: "POST",
    // 				url: base_url+'ajaxcall/certificate_pdf_view',
    // 				data: {'pdfb':pdfb, 'pdfu':pdfu},
    // 				success: function(resp){
    // 					var resp = $.parseJSON(resp);
    // 					if(resp['status'] == '1'){
    // 					    var file_path = resp['filesUrl']+resp['fileName'];
    //                         var a = document.createElement('A');
    //                         a.href = file_path;
    //                         a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
    //                         document.body.appendChild(a);
    //                         a.click();
    //                         document.body.removeChild(a);
    // 					}else if(resp['status'] == '2'){
    // 						console.log(resp['msg']);
    // 					}else{
    // 						console.log('Something went wrong, Please try again.');
    // 					}
    // 					$('.edu_preloader').fadeOut();
    // 				},
    // 				error:function(resp){
    // 					console.log('Something went wrong, Please try again.');
    // 					$('.edu_preloader').fadeOut();
    // 				}
    // 			});   
    //         }
    //     });
    //     (function ($) {  
    //         $.fn.html2canvas = function (options) {  
    //             var date = new Date(),  
    //             $message = null,  
    //             timeoutTimer = false,  
    //             timer = date.getTime();  
    //             html2canvas.logging = options && options.logging;  
    //             html2canvas.Preload(this[0], $.extend({  
    //                 complete: function (images) {  
    //                     var queue = html2canvas.Parse(this[0], images, options),  
    //                     $canvas = $(html2canvas.Renderer(queue, options)),  
    //                     finishTime = new Date();  

    //                     $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);  
    //                     $canvas.siblings().toggle();  

    //                     $(window).click(function () {  
    //                         if (!$canvas.is(':visible')) {  
    //                             $canvas.toggle().siblings().toggle();  
    //                             throwMessage("Canvas Render visible");  
    //                         } else {  
    //                             $canvas.siblings().toggle();  
    //                             $canvas.toggle();  
    //                             throwMessage("Canvas Render hidden");  
    //                         }  
    //                     });  
    //                     throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);  
    //                 }  
    //             }, options));  

    //             function throwMessage(msg, duration) {  
    //                 window.clearTimeout(timeoutTimer);  
    //                 timeoutTimer = window.setTimeout(function () {  
    //                     $message.fadeOut(function () {  
    //                         $message.remove();  
    //                     });  
    //                 }, duration || 2000);  
    //                 if ($message)  
    //                     $message.remove();  
    //                 $message = $('<div ></div>').html(msg).css({  
    //                     margin: 0,  
    //                     padding: 10,  
    //                     background: "#000",  
    //                     opacity: 0.7,  
    //                     position: "fixed",  
    //                     top: 10,  
    //                     right: 10,  
    //                     fontFamily: 'Tahoma',  
    //                     color: '#fff',  
    //                     fontSize: 12,  
    //                     borderRadius: 12,  
    //                     width: 'auto',  
    //                     height: 'auto',  
    //                     textAlign: 'center',  
    //                     textDecoration: 'none'  
    //                 }).hide().fadeIn().appendTo('body');  
    //             }  
    //         };  
    //     })(jQuery);   

    $(document).on('click', '#dwl_create_pdf', function() {

        var pdfu = $(this).attr('data-pdfu');
        var pdfb = $(this).attr('data-pdfb');
        var base_url = $(this).attr('data-pdf_url');
        if (pdfu) {
            $.ajax({
                method: "POST",
                url: base_url + 'ajaxcall/certificate_pdf_view',
                data: { 'pdfb': pdfb, 'pdfu': pdfu },
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        var file_path = resp['filesUrl'] + resp['fileName'];
                        var a = document.createElement('A');
                        a.href = file_path;
                        a.download = file_path.substr(file_path.lastIndexOf('/') + 1);
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    } else if (resp['status'] == '2') {
                        console.log(resp['msg']);
                    } else {
                        console.log('Something went wrong, Please try again.');
                    }
                    $('.edu_preloader').fadeOut();
                },
                error: function(resp) {
                    console.log('Something went wrong, Please try again.');
                    $('.edu_preloader').fadeOut();
                }
            });
        }
    });
    (function($) {
        $.fn.html2canvas = function(options) {
            var date = new Date(),
                $message = null,
                timeoutTimer = false,
                timer = date.getTime();
            html2canvas.logging = options && options.logging;
            html2canvas.Preload(this[0], $.extend({
                complete: function(images) {
                    var queue = html2canvas.Parse(this[0], images, options),
                        $canvas = $(html2canvas.Renderer(queue, options)),
                        finishTime = new Date();

                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);
                    $canvas.siblings().toggle();

                    $(window).click(function() {
                        if (!$canvas.is(':visible')) {
                            $canvas.toggle().siblings().toggle();
                            throwMessage("Canvas Render visible");
                        } else {
                            $canvas.siblings().toggle();
                            $canvas.toggle();
                            throwMessage("Canvas Render hidden");
                        }
                    });
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);
                }
            }, options));

            function throwMessage(msg, duration) {
                window.clearTimeout(timeoutTimer);
                timeoutTimer = window.setTimeout(function() {
                    $message.fadeOut(function() {
                        $message.remove();
                    });
                }, duration || 2000);
                if ($message)
                    $message.remove();
                $message = $('<div ></div>').html(msg).css({
                    margin: 0,
                    padding: 10,
                    background: "#000",
                    opacity: 0.7,
                    position: "fixed",
                    top: 10,
                    right: 10,
                    fontFamily: 'Tahoma',
                    color: '#fff',
                    fontSize: 12,
                    borderRadius: 12,
                    width: 'auto',
                    height: 'auto',
                    textAlign: 'center',
                    textDecoration: 'none'
                }).hide().fadeIn().appendTo('body');
            }
        };
    })(jQuery);

    $(document).on('change', '.get_teacher_subject', function() {

        var batchId = $(this).val();
        // alert(batchId);
        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_teacher_subject",
            data: { 'batch_id': batchId },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                // console.log(resp);
                if (resp['status'] == '1') {
                    $('.teacher_subject').html(resp['html']);

                }
                if (val_sub1 != '') {
                    $('#homeworkPopup [name="subject_id"]').val(val_sub1).trigger('change');
                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });


    });


    $(document).on('change', '.get_batch_price', function() {
        var batchId = $(this).val();

        $.ajax({
            method: "POST",
            url: base_url + "ajaxcall/get_batchPrice",
            data: { 'batch_id': batchId },
            success: function(resp) {
                var resp = $.parseJSON(resp);
                if (resp['status'] == '1') {
                    // console.log(resp.data['batch_type']);
                    if (resp.data['batch_type'] == '2') {
                        // 	$('.batchPrice_set').addClass(batch_price);

                        $('.batch_price').val(resp.data['price']);

                    } else if (resp.data['batch_type'] == '1') {
                        $('.batch_price').val('free');
                    } else {
                        toastr.error(ltr_something_msg);
                    }

                }
            },
            error: function(msg) {
                toastr.error(ltr_something_msg);
            }
        });


    });

    $('.add_batch_fileds').on('click', function() {

        function className_bat(length) {
            for (var s = ''; s.length < length; s += 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.charAt(Math.random() * 62 | 0));
            return s;
        }
        var optionArr = $.parseJSON($('.subjectArrayDiv').html());

        var options = '<option value="">' + ltr_select_subject + '</option>';
        if (optionArr.length) {
            var i;
            for (i = 0; i < optionArr.length; ++i) {
                options += '<option value="' + optionArr[i]['id'] + '">' + optionArr[i]['batch_name'] + '</option>';
            }
        }

        var appendHtml = '<div class="parentRow"><div class="col-lg-6 col-md-6 col-sm-12 col-12"><div class="form-group"><select name="batch_id[]" class="form-control require edu_selectbox_with_search get_batch_price" input_class="set_batch_price" data-placeholder="' + ltr_select_batch + '">' + options + '</select></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-12 batch_price"> <input type="text" class="form-control require batchPrice_set" bt_price="' + className_bat(8) + '" maxlength="5"  placeholder="Price" name="price[]" value=""><div class="edu_detele_row_wrapper"><i class="icofont-ui-delete removeRow" title="Remove"></i></div></div></div></div>';

        $('.batch_new_fields_add').append(appendHtml);
        // $(this).closest('.parentFormWrappr').find('.parentRow:first').before(appendHtml);
        $(this).closest('.parentFormWrappr').find('.parentRow:first select').select2({
            placeholder: $(this).attr("data-placeholder"),
            width: '100%'
        });

    });

    $(document).on('click', '.removeRow', function() {
        if ($(this).closest('.parentFormWrappr').find('.parentRow').length == 1) {
            toastr.error(ltr_can_remove_msg);
            return false;
        } else {
            $(this).closest('.parentRow').remove();
        }
    });

    $(document).on('click', '.off_pay_popup', function() {

        $.magnificPopup.open({
            items: {
                src: '#offline_payment_popup',
            },
            type: 'inline'
        });
    });


    /*multi admin start*/
    $(document).on('click', '.addAdmin', function() {
        var validchk = validate_form($(this).closest('form'));
        if (validchk == 'valid') {
            var formdata = new FormData($(this).closest('form')[0]);
            var id = $(this).attr('data-id');
            formdata.append('id', id);
            $('.edu_preloader').css('background-color', 'rgba(255,255,255,0.80)').css('display', 'block');
            $.ajax({
                method: "POST",
                url: base_url + "ajaxcall/add_admin",
                data: formdata,
                processData: false,
                contentType: false,
                success: function(resp) {
                    var resp = $.parseJSON(resp);
                    if (resp['status'] == '1') {
                        toastr.success(resp['msg']);
                        targetTableUrl = $('.server_datatable').attr('data-url');
                        dataTableObj.ajax.url(base_url + targetTableUrl).load();
                        $('#input_feilds_teacher').find('[name="teach_image"]').removeClass('error');
                        var no_data = $('.eac_page_re').html();
                        if (no_data != undefined) {
                            setTimeout(function() {
                                window.location.reload(true);
                            }, 500);
                        }
                    } else if (resp['status'] == '2') {
                        toastr.error(resp['msg']);
                        $('.edu_preloader').fadeOut();
                        return false;
                    } else {
                        toastr.error(ltr_something_msg);
                        $('.edu_preloader').fadeOut();
                        return false;
                    }
                    $('.edu_preloader').fadeOut();
                    $('#input_feilds_admin').find('.mfp-close').trigger('click');

                },
                error: function(resp) {
                    toastr.error(ltr_something_msg);
                    $('.edu_preloader').fadeOut();
                    return false;
                }
            });
        }
    });

    $(document).on('click', '.addAdminPop, .edit_admin', function() {
        if ($(this).hasClass('addAdminPop')) {
            if (($('#input_feilds_admin').find('[name="admin_image"]').hasClass('require')) == false) {
                $('#input_feilds_admin').find('[name="admin_image"]').addClass('require');
            }
            $('#input_feilds_admin').find('form').trigger('reset');
            $('#input_feilds_admin').find('#PopupTitle').html('add user');
            $('#input_feilds_admin').find('.addAdmin').attr('data-id', '').val('add user');
            $('#input_feilds_admin').find('[name="password"]').addClass('require').closest('.form-group').find('label sup').removeClass('hide');
            $('#input_feilds_admin').find('[name="email"]').removeAttr('readonly');
            $('#input_feilds_admin').find('.fileNameShow').html('');
            $('#input_feilds_admin').find('[name="teach_gender"]').val('').trigger('change');
            // 		$('#input_feilds_admin').find('[name="primary_color"]').val('#4267C8');
            // 		$('#input_feilds_admin').find('[name="border_color"]').val('#e7e7e9');
            // 		$('#input_feilds_admin').find('[name="font_color"]').val('#888888');
            // 		$myColorPicker = $('input.color').colorPicker({
            // 			customBG: '#222',

            // 			init: function(elm, colors) { // colors is a different instance (not connected to colorPicker)
            // 				elm.style.backgroundColor = elm.value;
            // 				elm.style.color = colors.rgbaMixCustom.luminance > 0.22 ? '#222' : '#ddd';
            // 			},
            // 		}).each(function(idx, elm) { });
        } else {
            $('#input_feilds_admin').find('form').trigger('reset');
            $('#input_feilds_admin').find('[name="admin_image"]').removeClass('require');
            $('#input_feilds_admin').find('#PopupTitle').html('Edit user');
            $('#input_feilds_admin').find('.addAdmin').attr('data-id', $(this).attr('data-id')).val("update user");
            var ttt = $(this).closest('tr').find('td:eq(2)').find('a').attr('data-word');
            if (ttt != undefined) {
                $('#input_feilds_admin').find('[name="name"]').val(ttt);
            } else {
                $('#input_feilds_admin').find('[name="name"]').val($(this).closest('tr').find('td:eq(2)').text());
            }
            $('#input_feilds_admin').find('[name="email"]').val($(this).closest('tr').find('td:eq(3)').text()).attr('readonly', 'readonly');
            $('#input_feilds_admin').find('[name="teach_gender"]').val($(this).closest('tr').find('td:eq(5)').text()).trigger('change');
            $('#input_feilds_admin').find('[name="password"]').removeClass('require').closest('.form-group').find('label sup').addClass('hide');
            $('#input_feilds_admin').find('.fileNameShow').html($(this).attr('data-img'));
            // 		$('#input_feilds_admin').find('[name="primary_color"]').val($(this).attr('data-primarycolor'));
            // 		$('#input_feilds_admin').find('[name="border_color"]').val($(this).attr('data-bordercolor'));
            // 		$('#input_feilds_admin').find('[name="font_color"]').val($(this).attr('data-fontcolor'));
            // 		$myColorPicker = $('input.color').colorPicker({
            // 			customBG: '#222',
            // 			init: function(elm, colors) { // colors is a different instance (not connected to colorPicker)
            // 				elm.style.backgroundColor = elm.value;
            // 				elm.style.color = colors.rgbaMixCustom.luminance > 0.22 ? '#222' : '#ddd';
            // 			},
            // 		}).each(function(idx, elm) {
            // 		});
        }
        $.magnificPopup.open({
            items: {
                src: '#input_feilds_admin',
            },
            type: 'inline'
        });
    });
    /*multi admin end */


    $('.filter_by_admin').on('click', function() {
        if ($('.filter_admin').val() == '') {
            toastr.error(ltr_select_subject_msg);
            return false;
        } else {
            targetTableUrl = $('.server_datatable').attr('data-url');
            var admin = $('.filter_admin').val();
            dataTableObj.ajax.url(base_url + targetTableUrl + '?admin=' + admin).load();

        }
        $('.create_ppr_popup').hide();
    });

});

$('.filter_by_admin').on('click', function() {
    var admin_id = $('.filter_admin').val();
    var batch_id = $('.filter_batches').val();
    $.ajax({
        method: "POST",
        url: base_url + "ajaxcall/batch_data",
        data: {
            id: batch_id,
            admin_id: admin_id
        },

        success: function(resp) {

            var resp = $.parseJSON(resp);
            $('#allbatchdata').html(resp.data);

        },
        error: function(resp) {
            toastr.error(ltr_something_msg);
        }
    });
});


$('.edit_batch_hide_fileds').hide();
$('.batchPrice').hide();
$('.payMode').on('click', function() {
    var payMode = $(this).val()
    if (payMode == 'Online') {
        $('.edit_batch_hide_fileds').hide();
        $('.batchPrice').hide();
        $('.multibatchAdd').show();
        $('.multibatchr').addClass("require");
    } else {
        $('.edit_batch_hide_fileds').show();
        $('.batchPrice').show();
        $('.multibatchAdd').hide();
        $('.multibatchr').removeClass("require");
    }
    // alert(payMode);
});
$(document).on('click', '.edit_teacher,.edit_admin ', function() {
    var id = $(this).attr('data-id');
    $.ajax({
        method: "POST",
        url: base_url + "ajaxcall/getdatateacher",
        data: { id: id },
        success: function(resp) {

            var resp = $.parseJSON(resp);
            //   console.log(resp);
            if (resp.academics == 1) {
                $('.academics').prop('checked', 'checked')
            } else {
                console.log("hello");
                $('.academics').prop('checked', false)
            }
            if (resp.live_class == 1) {
                $('.live_class').prop('checked', 'checked')
            } else {
                console.log("hello");
                $('.live_class').prop('checked', false)
            }
            if (resp.notice == 1) {
                $('.notice').prop('checked', 'checked')
            } else { $('.notice').prop('checked', false) }
            if (resp.assignment == 1) {
                $('.assignment').prop('checked', 'checked')
            } else { $('.assignment').prop('checked', false) }
            if (resp.video_lecture == 1) {
                $('.video_lecture').prop('checked', 'checked')
            } else { $('.video_lecture').prop('checked', false) }
            if (resp.course_content == 1) {
                $('.course_content').prop('checked', 'checked')
            } else { $('.course_content').prop('checked', false) }
            if (resp.extraclasses == 1) {
                $('.extraclasses').prop('checked', 'checked')
            } else { $('.extraclasses').prop('checked', false) }
            if (resp.doubtsask == 1) {
                $('.doubtsask').prop('checked', 'checked')
            } else { $('.doubtsask').prop('checked', false) }
            if (resp.question_manager == 1) {
                $('.question_manager').prop('checked', 'checked')
            } else { $('.question_manager').prop('checked', false) }
            if (resp.exam == 1) {
                $('.exam').prop('checked', 'checked')
            } else { $('.exam').prop('checked', false) }
            if (resp.student_manage == 1) {
                $('.student_manage').prop('checked', 'checked')
            } else { $('.student_manage').prop('checked', false) }
            if (resp.enquiry == 1) {
                $('.enquiry').prop('checked', 'checked')
            } else { $('.enquiry').prop('checked', false) }
            if (resp.gallary_manage == 1) {
                $('.gallary_manage').prop('checked', 'checked')
            } else { $('.gallary_manage').prop('checked', false) }
            if (resp.library_manager == 1) {
                $('.library_manager').prop('checked', 'checked')
            } else { $('.library_manager').prop('checked', false) }
            if (resp.teacher_manager == 1) {
                $('.teacher_manager').prop('checked', 'checked')
            } else { $('.teacher_manager').prop('checked', false) }
            if (resp.student_leave == 1) {
                $('.student_leave').prop('checked', 'checked')
            } else { $('.student_leave').prop('checked', false) }
        },
        error: function(resp) {
            toastr.error(ltr_something_msg);
            $('.edu_preloader').fadeOut();
        }
    });
});
$(".remove_svg").hover(function(){
  $('.hint').css("display", "block");
  }, function(){
  $('.hint').css("display", "none");
});