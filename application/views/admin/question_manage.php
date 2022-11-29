<section class="edu_admin_content">
	<?php $role = $this->session->userdata('role'); ?>
	<div class="edu_admin_right sectionHolder edu_question_manager">

		<div class="edu_btn_wrapper sectionHolder">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					<?php
					if (!empty($question_data)) {
					?>
						<div class="form-group">
							<span>
								<select class="form-control filter_subject edu_selectbox_with_search" name="filter_subject" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>">
									<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subjects')); ?></option>
									<?php

									if (!empty($subject)) {
										foreach ($subject as $sub) {
											echo '<option value="' . $sub['id'] . '">' . $sub['subject_name'] . '</option>';
										}
									}
									?>
								</select>
							</span>
						</div>
					<?php } ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					<?php
					if (!empty($question_data)) {
					?>
						<div class="form-group">
							<span>
								<select class="form-control filter_chapter edu_selectbox_with_search" name="filter_chapter" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>">
									<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?></option>
								</select>
							</span>
						</div>
					<?php } ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-12">
					<?php
					if (!empty($question_data)) {
					?>
						<div class="form-group">
							<span>
								<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search')); ?>" Class="btn btn-primary filter_question" data-toggle="tooltip" title="Search">
							</span>
						</div>
					<?php } ?>
				</div>

				<!-- <a href="#bulkquestionPopup" class="edu_admin_btn openPopupLink"><i class="icofont-plus"></i>Upload</a>-->
				<!-- <a href="#questionPopup" class="edu_admin_btn openPopupLink addQuestionPopShow" data-placement="botto" ><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_question')); ?></a> -->

				<?php if ($_SESSION['role'] == 1) { ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 text-sm-right">
						<a href="<?php echo base_url(); ?>admin/add-question" class="edu_admin_btn "><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_question')); ?></a>
					</div>
				<?php } else { ?>
					<div class="col-lg-3 col-md-3 col-sm-6 col-12 text-sm-right">
						<a href="<?php echo base_url(); ?>teacher/add-question" class="edu_admin_btn "><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_question')); ?></a>
					</div>
				<?php } ?>




			</div>
		</div>
		<!-- <div class="edu_main_wrapper edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">					
				<div class="edu_filter_wrapper sectionHolder">
					<h4 class="edu_filter_title">Filter</h4>
					<div class="row">
						
					</div>
				</div>
			</div>
		</div>-->
		<div class="createDivWrapper edu_add_question create_ppr_popup hide">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="ppr_popup_inner">
					<div class="row align-items-center text-center">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="questions" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete')); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		if (!empty($question_data)) {
		?>
			<div class="edu_main_wrapper edu_table_wrapper">
				<div class="edu_admin_informationdiv sectionHolder">
					<div class="tableFullWrapper">

						<table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/question_table/question">
							<thead>
								<tr>
									<th><input type="checkbox" class="checkAllAttendance"></th>
									<th>#</th>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_question')); ?></th>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_options')); ?></th>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_answer')); ?></th>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_subject')); ?></th>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_chapter')); ?></th>
									<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_status')); ?></th>
									<!-- <th class="no-sort"><?php/* echo html_escape($this->common->languageTranslator('ltr_category')); */?></th> -->
									<?php echo ($this->session->userdata('role') == 1) ? '<th>' . html_escape($this->common->languageTranslator('ltr_added_by')) . '</th>' : ''; ?>
									<th><?php echo html_escape($this->common->languageTranslator('ltr_added_on')); ?></th>
									<th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_action')); ?></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php
		} else {
			if ($this->session->userdata('role') == 1) {
				echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">' . html_escape($this->common->languageTranslator('ltr_question_no_data_admin')) . '</div>
                            </div>
                        </div>
                    </section>';
			} else {

				echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">' . html_escape($this->common->languageTranslator('ltr_question_no_data_teacher')) . '</div>
                            </div>
                        </div>
                    </section>';
			}
		} ?>
	</div>
</section>

<!-- Pop Up Start  -->
<div id="questionPopup" class="edu_popup_container mfp-hide">
	<div class="edu_popup_wrapper">
		<div class="edu_popup_inner">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" href="#single" role="tab" data-toggle="tab" aria-selected="true">
						<span class="edu_tab_icons">
							<p><?php echo html_escape($this->common->languageTranslator('ltr_single_question')); ?></p>
						</span>
					</a>
				</li>
				<li class="nav-item bulk_upload">
					<a class="nav-link" href="#bulk" role="tab" data-toggle="tab" aria-selected="false">
						<span class="edu_tab_icons">
							<p><?php echo html_escape($this->common->languageTranslator('ltr_bulk_upload')); ?></p>
						</span>
					</a>
				</li>

			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in show" id="single">
					<h4 class="edu_sub_title" id="questionPopupLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_question')); ?></h4>
					<form class="pxn_amin form" enctype="multipart/form-data" method="post" autocomplete="off">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?><sup>*</sup></label>
									<select class="form-control filter_subject modalSubjectCls require edu_selectbox_with_search" name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?></option>
										<?php
										if (!empty($subject)) {
											foreach ($subject as $sub) {

												echo '<option value="' . $sub['id'] . '">' . $sub['subject_name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?><sup>*</sup></label>
									<select class="form-control filter_modal_chapter require edu_selectbox_with_search" name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?></option>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_question')); ?><sup>*</sup></label>
									<textarea name="question" rows="3" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_question')); ?>" class="form-control require"></textarea>
								</div>
								<div id="question_options">
									<div class="row">
										<?php
										$op = '1';
										$cn = 'A';
										for ($i = 1; $i < 5; $i++) {
										?>
											<div class="col-lg-6 col-md-12 col-sm-12 col-12">
												<div class="form-group">
													<label>
														<div class="ans_option"><?php echo html_escape($this->common->languageTranslator('ltr_option_' . $cn)); ?> <sup>*</sup></div>
													</label>
													<input type="text" class="form-control require" name="options[]" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_option_' . $cn)); ?>">
												</div>
											</div>
										<?php
											$op++;
											$cn++;
										} ?>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<label class="ans_option"><?php echo html_escape($this->common->languageTranslator('ltr_right_answer')); ?><sup>*</sup></label>
								<div class="form-group edu_radio_holder_wrapper">
									<div class="edu_radio_holder">
										<label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_a')); ?></label>
										<input type="radio" class="ansRadioChck" name="answer" value="A">
									</div>
									<div class="edu_radio_holder">
										<label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_b')); ?></label>
										<input type="radio" class="ansRadioChck" name="answer" value="B">
									</div>
									<div class="edu_radio_holder">
										<label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_c')); ?></label>
										<input type="radio" class="ansRadioChck" name="answer" value="C">
									</div>
									<div class="edu_radio_holder">
										<label for="radio"><?php echo html_escape($this->common->languageTranslator('ltr_d')); ?></label>
										<input type="radio" class="ansRadioChck" name="answer" value="D">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="edu_btn_wrapper">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_add_question')); ?>" class="btn btn-primary add_Newquestion">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="bulk">
					<form class="pxn_amin form" enctype="multipart/form-data" method="post" autocomplete="off">
						<div class="row">
							<div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?><sup>*</sup></label>
									<select class="form-control filter_subject modalSubjectCls require edu_selectbox_with_search" name="subject_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?>">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_subject')); ?></option>
										<?php
										if (!empty($subject)) {
											foreach ($subject as $sub) {


												echo '<option value="' . $sub['id'] . '">' . $sub['subject_name'] . '</option>';
											}
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?><sup>*</sup></label>
									<select class="form-control filter_modal_chapter require edu_selectbox_with_search" name="chapter_id" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?>">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_chapter')); ?></option>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_excel')); ?><sup>*</sup></label>
									<input type="file" class="form-control require" name="result_file" id="result_file" data-valid="excel" data-error="Upload xlsx format">
									<p class="fileNameShow"></p>
								</div>

							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
								<div class="edu_btn_wrapper">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_upload_question')); ?>" class="btn btn-primary upload_new_question" />
									<a href="<?php echo base_url(); ?>uploads/demo/Multi-Question-Template.xlsx" class="btn btn-primary"><?php echo html_escape($this->common->languageTranslator('ltr_download_demo_file')); ?></a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Pop view characters Start  -->
<div id="charactersViewPopup" class="edu_popup_container mfp-hide">
	<div class="edu_popup_wrapper">
		<div class="edu_popup_inner">
			<h4 class="edu_sub_title" id="charaTitele"></h4>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group">
						<div class="charactersViewResult"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>