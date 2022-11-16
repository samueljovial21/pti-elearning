<section class="edu_admin_content">
    <?php
    $role = $this->session->userdata('role');
    ?>
    <div class="sectionHolder edu_admin_right edu_dashboard_wrap">
        <div class="edu_dashboard_widgets">
            <div class="row">
                <?php if ($role == '1') {  ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="<?php echo base_url() ?>admin/student-manage">
                            <div class="edu_color_boxes box_left">
                                <div class="edu_dash_box_data">
                                    <p><?php echo html_escape($this->common->languageTranslator('ltr_total_students')); ?></p>
                                    <h3><?php echo html_escape($dashboard_count['total_student']); ?></h3>

                                </div>
                                <div class="edu_dash_box_icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                        <g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.345,25.468c-0.109-0.076-0.215-0.159-0.329-0.229
                                			c-1.589-0.974-3.273-1.72-5.122-2.026c-0.802-0.134-1.621-0.177-2.434-0.233c-0.463-0.033-0.701-0.244-0.701-0.71
                                			c0-0.163,0-0.326,0-0.495c0.199-0.035,0.394-0.056,0.582-0.102c1.106-0.271,1.868-1.242,1.872-2.378
                                			c0.002-0.804,0.001-1.607,0-2.411c-0.002-1.358-0.999-2.414-2.353-2.496c-0.026-0.002-0.052-0.006-0.096-0.012
                                			c0-0.232-0.018-0.464,0.004-0.691c0.028-0.295,0.287-0.52,0.589-0.521c2.788-0.01,5.444,0.521,7.897,1.907
                                			c0.133,0.074,0.132,0.164,0.132,0.28c0,3.372,0,6.745,0,10.117C14.373,25.468,14.359,25.468,14.345,25.468z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.613,25.468c0-3.365,0.002-6.731-0.004-10.097
                                			c0-0.176,0.06-0.26,0.208-0.342c1.664-0.914,3.433-1.498,5.32-1.705c0.805-0.088,1.615-0.121,2.424-0.159
                                			c0.434-0.021,0.678,0.243,0.68,0.681c0,0.171,0,0.34,0,0.515c-0.213,0.036-0.422,0.06-0.623,0.109
                                			c-1.051,0.264-1.822,1.247-1.828,2.331c-0.006,0.824-0.004,1.648-0.002,2.473c0.004,1.329,1.008,2.393,2.334,2.474
                                			c0.031,0.002,0.064,0.006,0.115,0.009c0,0.237,0.018,0.469-0.006,0.696c-0.029,0.311-0.297,0.52-0.631,0.52
                                			c-0.941,0.003-1.873,0.097-2.797,0.288c-1.846,0.385-3.529,1.155-5.114,2.162c-0.015,0.01-0.023,0.03-0.035,0.046
                                			C15.64,25.468,15.626,25.468,15.613,25.468z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.368,4.532c0.224,0.052,0.45,0.093,0.669,0.159
                                			c1.646,0.491,2.75,2.089,2.639,3.808c-0.111,1.682-1.385,3.093-3.058,3.385c-0.054,0.009-0.107,0.012-0.162,0.055
                                			c0.357,0,0.718-0.024,1.072,0.007c0.363,0.032,0.729,0.096,1.082,0.187c0.352,0.091,0.689,0.234,1.033,0.355
                                			c-0.002,0.018-0.006,0.038-0.008,0.056c-0.107,0.033-0.215,0.065-0.322,0.098c-1.096,0.33-2.146,0.767-3.144,1.332
                                			c-0.104,0.06-0.186,0.089-0.312,0.017c-1.073-0.609-2.205-1.083-3.396-1.409c-0.032-0.009-0.062-0.025-0.118-0.049
                                			c1.022-0.541,2.101-0.654,3.214-0.606c-0.769-0.12-1.454-0.414-2.017-0.944c-1.077-1.016-1.472-2.267-1.082-3.693
                                			c0.39-1.427,1.349-2.325,2.798-2.676c0.125-0.03,0.25-0.054,0.375-0.081C14.877,4.532,15.123,4.532,15.368,4.532z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.532,16.636c0.099-0.315,0.235-0.606,0.524-0.799
                                			c0.401-0.267,0.825-0.307,1.254-0.089c0.436,0.223,0.667,0.595,0.672,1.084c0.009,0.817,0.004,1.633,0.002,2.449
                                			c-0.002,0.628-0.439,1.134-1.059,1.23c-0.582,0.092-1.168-0.291-1.348-0.881c-0.014-0.045-0.031-0.089-0.046-0.133
                                			C4.532,18.544,4.532,17.59,4.532,16.636z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M25.469,19.498c-0.1,0.315-0.236,0.607-0.525,0.798
                                			c-0.4,0.267-0.824,0.308-1.254,0.089c-0.436-0.221-0.666-0.593-0.672-1.083c-0.01-0.81-0.004-1.619-0.002-2.429
                                			c0-0.652,0.447-1.172,1.078-1.254c0.59-0.078,1.154,0.305,1.332,0.903c0.012,0.039,0.027,0.075,0.043,0.113
                                			C25.469,17.59,25.469,18.544,25.469,19.498z" />
                                        </g>
                                    </svg>
                                </div>
                                <div class="edu_dash_info">
                                    <ul>
                                        <li>
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_present')); ?> <span><?php echo html_escape($dashboard_count['total_present']); ?></span></p>
                                        </li>
                                        <li>
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_absent')); ?> <span><?php echo html_escape($dashboard_count['total_student'] - $dashboard_count['total_present']); ?></span></p>
                                        </li>
                                        <ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="<?php echo base_url() ?>admin/batch-manage">
                            <div class="edu_color_boxes box_center">
                                <div class="edu_dash_box_data">
                                    <p><?php echo html_escape($this->common->languageTranslator('ltr_total_batches')); ?></p>
                                    <h3><?php echo html_escape($dashboard_count['total_batch']); ?></h3>
                                </div>
                                <div class="edu_dash_box_icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 44.688 44.688" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M25.013,39.119c-0.336,0.475-0.828,0.82-1.389,0.975l-2.79,0.762c-0.219,0.062-0.445,0.094-0.673,0.094
                                				c-0.514,0-1.011-0.157-1.43-0.452c-0.615-0.428-1.001-1.103-1.062-1.834l-0.245-2.881c-0.058-0.591,0.101-1.183,0.437-1.659
                                				l0.103-0.148H8.012c-0.803,0-1.454-0.662-1.454-1.463c0-0.804,0.651-1.466,1.454-1.466h12.046l2.692-3.845H8.012
                                				c-0.803,0-1.454-0.662-1.454-1.465s0.651-1.465,1.454-1.465l16.811-0.043l6.304-9.039V8.497c0-1.1-0.851-1.988-1.948-1.988h-4.826
                                				v3.819c0,1.803-1.474,3.229-3.274,3.229h-9.706c-1.804,0-3.227-1.427-3.227-3.229V6.509H3.268c-1.099,0-1.988,0.889-1.988,1.988
                                				V42.65c0,1.1,0.89,2.037,1.988,2.037h25.909c1.1,0,1.949-0.938,1.949-2.037V30.438L25.013,39.119z M8.012,17.496h16.424
                                				c0.801,0,1.453,0.661,1.453,1.464c0,0.803-0.652,1.465-1.453,1.465H8.012c-0.803,0-1.454-0.662-1.454-1.465
                                				C6.558,18.157,7.209,17.496,8.012,17.496z" />
                                                <path d="M11.4,11.636h9.697c0.734,0,1.331-0.596,1.331-1.332V4.727c0-0.736-0.597-1.332-1.331-1.332h-1.461
                                				C19.626,1.52,18.102,0,16.223,0c-1.88,0-3.402,1.519-3.413,3.395H11.4c-0.736,0-1.331,0.596-1.331,1.332v5.576
                                				C10.069,11.039,10.664,11.636,11.4,11.636z M16.224,1.891c0.835,0,1.512,0.672,1.521,1.505H14.7
                                				C14.71,2.563,15.388,1.891,16.224,1.891z" />
                                                <path d="M43.394,8.978c-0.045-0.248-0.186-0.465-0.392-0.609l-2.428-1.692c-0.164-0.115-0.353-0.17-0.539-0.17
                                				c-0.296,0-0.591,0.14-0.772,0.403L22.064,31.573l3.973,2.771L43.238,9.682C43.38,9.477,43.437,9.224,43.394,8.978z" />
                                                <path d="M19.355,35.6l0.249,2.896c0.012,0.167,0.101,0.316,0.236,0.412c0.096,0.066,0.209,0.104,0.321,0.104
                                				c0.049,0,0.099-0.007,0.147-0.021l2.805-0.768c0.127-0.035,0.237-0.113,0.313-0.22l1.053-1.51l-3.976-2.772l-1.053,1.51
                                				C19.376,35.338,19.341,35.469,19.355,35.6z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="edu_dash_info">
                                    <ul>
                                        <li>
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_active')); ?> <span><?php echo html_escape($dashboard_count['active_batch']); ?></span></p>
                                        </li>
                                        <li>
                                            <p><?php echo html_escape($this->common->languageTranslator('ltr_inactive')); ?> <span><?php echo html_escape($dashboard_count['inactive_batch']); ?></span></p>
                                        </li>
                                        <ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="<?php echo base_url() ?>admin/question-manage">
                            <div class="edu_color_boxes box_right">
                                <div class="edu_dash_box_data">
                                    <p><?php echo html_escape($this->common->languageTranslator('ltr_total_questions')); ?></p>
                                    <h3><?php echo html_escape($dashboard_count['total_question']); ?></h3>
                                </div>
                                <div class="edu_dash_box_icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84
                                        				c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z" />
                                                    <path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869
                                        				c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389
                                        				c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291
                                        				c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z" />
                                                    <path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256
                                        				C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216
                                        				C472,375.377,375.393,472,256,472z" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="edu_dash_info">
                                    <ul>
                                        <li>
                                            <p>Check all Questions</p>
                                        </li>
                                        <li>
                                            <p>Here</p>
                                        </li>
                                        <ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="edu_color_boxes box_other">
                            <div class="edu_dash_box_data">
                                <p><?php echo html_escape($this->common->languageTranslator('ltr_leave_request')); ?></p>
                                <h3><?php echo html_escape($dashboard_count['total_leave']); ?></h3>
                            </div>
                            <div class="edu_dash_box_icon">
                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="m424 0h-286c-36.393 0-66 29.607-66 66v374c0 39.701 32.299 72 72 72h280c8.837 0 16-7.164 16-16s-7.163-16-16-16h-280c-22.056 0-40-17.944-40-40s17.944-40 40-40h280c8.837 0 16-7.164 16-16v-368c0-8.836-7.163-16-16-16zm-320 371.431v-305.431c0-18.778 15.222-34 34-34h1c2.761 0 5 2.239 5 5v326.164c0 2.615-2.013 4.816-4.622 4.983-10.085.643-19.611 3.373-28.152 7.76-3.303 1.696-7.226-.764-7.226-4.476z" />
                                        <path d="m424 424h-280c-8.837 0-16 7.164-16 16s7.163 16 16 16h280c8.837 0 16-7.164 16-16s-7.163-16-16-16z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="edu_dash_info">
                                <ul>
                                    <li>
                                        <p> <a href="<?php echo base_url() ?>admin/manage-student-leave"><?php echo html_escape($this->common->languageTranslator('ltr_student')); ?> <span><?php echo html_escape($dashboard_count['student_leave']); ?></span></a></p>
                                    </li>
                                    <li>
                                        <p> <a href="<?php echo base_url() ?>admin/manage-teacher-leave"><?php echo html_escape($this->common->languageTranslator('ltr_teacher')); ?> <span><?php echo html_escape($dashboard_count['teacher_leave']); ?></span></a></p>
                                    </li>
                                    <ul>
                            </div>
                        </div>
                    </div>
                    <!-- This Should be Doubt Class -->
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="<?php echo base_url()?>admin/doubts-classes">
                        <div class="edu_color_boxes box_other">
                            <div class="edu_dash_box_data">
                                <p><?php echo html_escape($this->common->languageTranslator('ltr_student_doubts_ask'));?></p>
                                <h3><?php echo $doubts_data;?></h3>
                            </div>
                            <div class="edu_dash_box_icon">
                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m424 0h-286c-36.393 0-66 29.607-66 66v374c0 39.701 32.299 72 72 72h280c8.837 0 16-7.164 16-16s-7.163-16-16-16h-280c-22.056 0-40-17.944-40-40s17.944-40 40-40h280c8.837 0 16-7.164 16-16v-368c0-8.836-7.163-16-16-16zm-320 371.431v-305.431c0-18.778 15.222-34 34-34h1c2.761 0 5 2.239 5 5v326.164c0 2.615-2.013 4.816-4.622 4.983-10.085.643-19.611 3.373-28.152 7.76-3.303 1.696-7.226-.764-7.226-4.476z"/><path d="m424 424h-280c-8.837 0-16 7.164-16 16s7.163 16 16 16h280c8.837 0 16-7.164 16-16s-7.163-16-16-16z"/></g></svg>
                            </div>
                            <div class="edu_dash_info">
                                <ul>
                                    <li><p><?php echo html_escape($this->common->languageTranslator('ltr_aproved'));?> <span><?php echo $doubts_data_aprove;?></span></p></li>
                                    <li><p><?php echo html_escape($this->common->languageTranslator('ltr_pending'));?> <span><?php echo $doubts_data_pending;?></span></p></li>
                                <ul>
                            </div>
                        </div>
                        </a>
                    </div>
                    <!-- This Should be payment/revanue -->
                <?php } ?>
            </div>
        </div>
        <!-- Code Here -->
        <div class="sectionHolder score_info_wrap">
            <div class="edu_admin_informationdiv">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $super = $this->session->userdata('super_admin');
                        if ($super == '1') { ?>
                            <div class="edu_table_wrapper mb_30">
                                <div class="edu_admin_informationdiv sectionHolder">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <span>
                                                    <select class="form-control filter_batches edu_selectbox_with_search" name="filter_batches" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?>" data-count="no">
                                                        <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_batch')); ?></option>
                                                        <?php
                                                        if (!empty($all_batches)) {
                                                            foreach ($all_batches as $batch) {
                                                                echo '<option value="' . $batch['id'] . '">' . $batch['batch_name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <span>
                                                    <div class="pxn_admin_btnsection">
                                                        <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>" class="btn btn-primary filter_by_admin" />
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php } ?>
                </div>
                <div id="allbatchdata">
                    <div class="row">
                        <?php if (!empty($top_three)) { ?>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_top_scorer')); ?></h4>
                                <div class="edu_topper_wrapper text-center">
                                    <div class="row">
                                        <?php
                                        $i = 0;
                                        foreach ($top_three as $top_threes) {
                                            $i++;
                                            switch ($i) {
                                                case "1":
                                                    $suffix = "st";
                                                    break;
                                                case "2":
                                                    $suffix = "nd";
                                                    break;
                                                case "3":
                                                    $suffix = "rd";
                                                    break;
                                            }
                                        ?>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                                <div class="edu_topper_section">

                                                    <img src="<?php echo base_url(); ?>uploads/students/<?php echo $top_threes['image']; ?>" alt="" />

                                                    <h4 class="edu_student_name"><?php echo $top_threes['name']; ?></h4>
                                                    <p class="edu_student_standard"><?php echo $top_threes['paper_name']; ?></p>
                                                    <p class="edu_student_scroe ddd"><?php $percentage = $top_threes['percentage'];
                                                                                        if (!empty($percentage)) {
                                                                                            if (is_numeric($percentage)) {
                                                                                                echo number_format($percentage, 2);
                                                                                            } else {
                                                                                                echo number_format($percentage, 2);
                                                                                            }
                                                                                        }
                                                                                        ?>%</p>
                                                    <span class="edu_student_level"><?php echo $i; ?><sup><?php echo $suffix; ?></sup></span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (!empty($top_three)) { ?>
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <?php } else { ?>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <?php } ?>
                                <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_student_performance')); ?></h4>
                                <div class="edu_score_wrapper">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="edu_score_section">
                                                <div class="edu_progress edu_blue_bar" data-progress="<?php if (!empty($good)) {
                                                                                                            echo $good;
                                                                                                        } ?>">
                                                    <svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                                        <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                        <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                    </svg>

                                                    <div class="edu_score_info">
                                                        <div class="edu_score_icon">
                                                            <svg class="score_por" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 106.059 106.059">
                                                                <g>
                                                                    <path d="M90.544,90.542c20.687-20.685,20.685-54.342,0.002-75.024C69.857-5.172,36.199-5.172,15.515,15.513
                                                                C-5.173,36.198-5.171,69.858,15.517,90.547C36.199,111.23,69.857,111.23,90.544,90.542z M21.301,21.3
                                                                C38.794,3.807,67.261,3.805,84.758,21.302c17.494,17.494,17.492,45.962-0.002,63.455c-17.493,17.494-45.961,17.496-63.455,0.002
                                                                C3.803,67.263,3.806,38.794,21.301,21.3z" />
                                                                    <path d="M38.994,44.967c0.134,0.092,0.29,0.138,0.446,0.138c0.159,0,0.318-0.048,0.455-0.145c0.059-0.041,1.456-1.032,2.87-2.467
                                                                c1.985-2.013,2.991-3.856,2.991-5.484c0-1.024-0.365-2.114-1.002-2.988c-0.728-1-1.683-1.551-2.688-1.551
                                                                c-1,0-1.942,0.437-2.626,1.173c-0.683-0.736-1.625-1.173-2.625-1.173c-1.008,0-1.963,0.551-2.691,1.551
                                                                c-0.637,0.874-1.002,1.963-1.002,2.988C33.123,40.898,38.754,44.802,38.994,44.967z" />
                                                                    <path d="M53.089,78.697c10.084,0,19.084-5.742,22.927-14.629c0.657-1.521-0.042-3.287-1.562-3.944
                                                                c-1.521-0.659-3.286,0.043-3.944,1.563c-2.893,6.689-9.729,11.011-17.42,11.011c-7.868,0-14.747-4.318-17.523-11.004
                                                                c-0.479-1.154-1.596-1.85-2.771-1.85c-0.384,0-0.773,0.074-1.149,0.229c-1.531,0.637-2.256,2.393-1.62,3.921
                                                                C33.734,72.927,42.788,78.697,53.089,78.697z" />
                                                                    <path d="M67.113,44.967c0.134,0.092,0.29,0.138,0.445,0.138c0.159,0,0.318-0.048,0.455-0.145c0.06-0.041,1.456-1.032,2.87-2.467
                                                                c1.985-2.013,2.991-3.856,2.991-5.484c0-1.024-0.365-2.114-1.002-2.988c-0.728-1-1.683-1.551-2.688-1.551
                                                                c-1,0-1.942,0.437-2.627,1.173c-0.683-0.736-1.625-1.173-2.625-1.173c-1.008,0-1.963,0.551-2.69,1.551
                                                                c-0.637,0.874-1.002,1.963-1.002,2.988C61.241,40.898,66.873,44.802,67.113,44.967z" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <p class="value">0
                                                        <p>
                                                            <span><?php echo html_escape($this->common->languageTranslator('ltr_good')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="edu_score_section">
                                                <div class="edu_progress edu_yellow_bar" data-progress="<?php if (!empty($avarage)) {
                                                                                                            echo $avarage;
                                                                                                        } ?>">
                                                    <svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                                        <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                        <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                    </svg>
                                                    <div class="edu_score_info">
                                                        <div class="edu_score_icon">
                                                            <svg class="score_avg" height="20px" viewBox="0 0 512 512" width="20px" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="m256 512c-68.38 0-132.667-26.629-181.02-74.98-48.351-48.353-74.98-112.64-74.98-181.02s26.629-132.667 74.98-181.02c48.353-48.351 112.64-74.98 181.02-74.98s132.667 26.629 181.02 74.98c48.351 48.353 74.98 112.64 74.98 181.02s-26.629 132.667-74.98 181.02c-48.353 48.351-112.64 74.98-181.02 74.98zm0-472c-119.103 0-216 96.897-216 216s96.897 216 216 216 216-96.897 216-216-96.897-216-216-216zm93.737 260.188c-9.319-5.931-21.681-3.184-27.61 6.136-.247.387-25.137 38.737-67.127 38.737s-66.88-38.35-67.127-38.737c-5.93-9.319-18.291-12.066-27.61-6.136s-12.066 18.292-6.136 27.61c1.488 2.338 37.172 57.263 100.873 57.263s99.385-54.924 100.873-57.263c5.93-9.319 3.183-21.68-6.136-27.61zm-181.737-135.188c13.807 0 25 11.193 25 25s-11.193 25-25 25-25-11.193-25-25 11.193-25 25-25zm150 25c0 13.807 11.193 25 25 25s25-11.193 25-25-11.193-25-25-25-25 11.193-25 25z" />
                                                            </svg>
                                                        </div>
                                                        <p class="value">0
                                                        <p>
                                                            <span><?php echo html_escape($this->common->languageTranslator('ltr_average')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <div class="edu_score_section">
                                                <div class="edu_progress edu_red_bar" data-progress="<?php if (!empty($poor)) {
                                                                                                            echo $poor;
                                                                                                        } ?>">
                                                    <svg class="noselect" x="0px" y="0px" viewBox="0 0 80 80">
                                                        <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                        <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                                    </svg>
                                                    <div class="edu_score_info">
                                                        <div class="edu_score_icon">
                                                            <svg class="score_god_svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 106.059 106.059">
                                                                <g>
                                                                    <path d="M90.544,90.542c20.687-20.685,20.685-54.342,0.002-75.024C69.858-5.172,36.198-5.172,15.515,15.513
                                                                C-5.173,36.198-5.171,69.858,15.517,90.547C36.198,111.23,69.858,111.23,90.544,90.542z M21.302,21.3
                                                                C38.795,3.807,67.261,3.805,84.759,21.302c17.494,17.494,17.492,45.962-0.002,63.455c-17.494,17.494-45.961,17.496-63.455,0.002
                                                                C3.804,67.263,3.806,38.794,21.302,21.3z M58.857,41.671c0-4.798,3.903-8.701,8.703-8.701c4.797,0,8.699,3.902,8.699,8.701
                                                                c0,1.381-1.119,2.5-2.5,2.5s-2.5-1.119-2.5-2.5c0-2.041-1.66-3.701-3.699-3.701c-2.044,0-3.703,1.66-3.703,3.701
                                                                c0,1.381-1.119,2.5-2.5,2.5C59.976,44.171,58.857,43.051,58.857,41.671z M31.134,41.644c0-4.797,3.904-8.701,8.703-8.701
                                                                c4.797,0,8.701,3.903,8.701,8.701c0,1.381-1.119,2.5-2.5,2.5c-1.381,0-2.5-1.119-2.5-2.5c0-2.041-1.66-3.701-3.701-3.701
                                                                c-2.042,0-3.703,1.66-3.703,3.701c0,1.381-1.119,2.5-2.5,2.5S31.134,43.024,31.134,41.644z M54.089,59.371
                                                                c10.084,0,19.084,5.742,22.927,14.63c0.658,1.521-0.041,3.286-1.562,3.943c-1.521,0.66-3.285-0.042-3.943-1.562
                                                                c-2.894-6.689-9.73-11.012-17.421-11.012c-7.869,0-14.747,4.319-17.522,11.004c-0.48,1.154-1.596,1.851-2.771,1.851
                                                                c-0.385,0-0.773-0.074-1.15-0.23c-1.53-0.636-2.256-2.392-1.619-3.921C34.735,65.143,43.788,59.371,54.089,59.371z M25.204,56.801
                                                                c0.001-3.436,4.556-7.535,4.556-7.535c0.438,2.747,1.52,4.344,1.52,4.344c1.218,1.818,1.218,3.507,1.218,3.507
                                                                c0,3.712-3.692,3.68-3.692,3.68C25.204,60.795,25.204,56.801,25.204,56.801z" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <p class="value">0
                                                        <p>
                                                            <span><?php echo html_escape($this->common->languageTranslator('ltr_poor')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="sectionHolder dasboard_links">
                <div class="edu_admin_informationdiv">
                    <h4 class="edu_title"><?php echo html_escape($this->common->languageTranslator('ltr_choose_want_anage')); ?></h4>
                    <div class="edu_quick_links_wrapper sectionHolder">
                        <?php if ($role == '1') {  ?>
                            <div class="custom_container">
                                <div class="row">
                                    <!--  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">-->
                                    <!--      <a class="edu_quick_links light_red_bg" target="_blank" href="<?php echo base_url(); ?>admin/course-page">-->

                                    <!--   <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"-->
                                    <!--                             viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">-->
                                    <!--                                <g>-->
                                    <!--                                    <g>-->
                                    <!--                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4-->
                                    <!--                                            l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472-->
                                    <!--                                            l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z"/>-->
                                    <!--                                    </g>-->
                                    <!--                                </g>-->
                                    <!--                            </svg> -->
                                    <!--    <?php echo html_escape($this->common->languageTranslator('ltr_course_manager')); ?>-->
                                    <!--</a>-->
                                    <!--  </div>-->
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_yellow_bg" target="_blank" href="<?php echo base_url(); ?>admin/batch-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_batch_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_sky_bg" target="_blank" href="<?php echo base_url(); ?>admin/student-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_student_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_voilate_bg" target="_blank" href="<?php echo base_url(); ?>admin/teacher-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_teacher_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_red_bg" target="_blank" href="<?php echo base_url(); ?>admin/question-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_question_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_yellow_bg" target="_blank" href="<?php echo base_url(); ?>admin/subject-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_subject_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_sky_bg" target="_blank" href="<?php echo base_url(); ?>admin/exam-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_paper_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_voilate_bg" target="_blank" href="<?php echo base_url(); ?>admin/gallery-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_gallery_manager')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_red_bg" target="_blank" href="<?php echo base_url(); ?>admin/video-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_video_lecture')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_yellow_bg" target="_blank" href="<?php echo base_url(); ?>admin/vacancy-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_upcoming_exams')); ?>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                                        <a class="edu_quick_links light_sky_bg" target="_blank" href="<?php echo base_url(); ?>admin/notice-manage">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 448.011 448.011" style="enable-background:new 0 0 448.011 448.011;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path d="M438.731,209.463l-416-192c-6.624-3.008-14.528-1.216-19.136,4.48c-4.64,5.696-4.8,13.792-0.384,19.648l136.8,182.4
                                                        l-136.8,182.4c-4.416,5.856-4.256,13.984,0.352,19.648c3.104,3.872,7.744,5.952,12.448,5.952c2.272,0,4.544-0.48,6.688-1.472
                                                        l416-192c5.696-2.624,9.312-8.288,9.312-14.528S444.395,212.087,438.731,209.463z" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php echo html_escape($this->common->languageTranslator('ltr_notice_manager')); ?>
                                        </a>
                                    </div>
                                    <!-- This Should be Enquiry Shortcut -->
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>