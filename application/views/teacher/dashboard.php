<section class="edu_admin_content">
	<div class="sectionHolder edu_admin_right edu_dashboard_wrap">
		<div class="edu_dashboard_widgets">
			<div class="row">

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<a href="<?php echo base_url() ?>teacher/progress">
						<div class="edu_color_boxes box_left box_other">
							<div class="edu_dash_box_data">
								<p><?php echo html_escape($this->common->languageTranslator('ltr_assigned_batches')); ?></p>
								<h3><?php echo (!empty($batch_count)) ? $batch_count : '0'; ?></h3>
							</div>
							<div class="edu_dash_box_icon">
								<svg enable-background="new 0 0 64 64" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
									<g>
										<path d="m56.569 26.895-2.412-.482c-.794-.159-1.411-.775-1.569-1.569l-.443-2.215c.923-.682 1.671-1.583 2.17-2.628h.685c2.206 0 4-1.794 4-4 0-.901-.31-1.724-.815-2.393l.366-1.098c.298-.896.449-1.825.449-2.767 0-4.821-3.922-8.743-8.744-8.743h-2.651c-2.459 0-4.751 1.159-6.208 3.12l-.729.183c-.567.141-1.085.383-1.547.697h-36.121v26h9.719l-1.5 6h-10.219v2h62v-4.262c0-3.8-2.705-7.098-6.431-7.843zm-29.35 4.105 1.5 6h-10.438l1.5-6zm2.062 0h4.659c-.598 1.125-.94 2.399-.94 3.738v2.262h-2.219zm5.719 3.738c0-2.85 2.028-5.324 4.823-5.883l.845-.169 3.779 8.314h-9.447zm9.294-7.473 1.861.93-2.576 2.061-.911-2.004c.623-.198 1.179-.536 1.626-.987zm3.985 3.735h-.558l-.394-1.181.673-.538.673.538zm-2.306 1.081-.42 2.519-1.12-2.465 1.23-.984zm1.874.919h.306l.667 4h-1.64zm2.18-.919.31-.93 1.23.984-1.12 2.465zm3.305-3.828-.911 2.004-2.576-2.061 1.861-.93c.447.45 1.003.788 1.626.987zm-2.705-3.018c.02.1.054.195.081.292l-2.708 1.355-2.709-1.354c.027-.097.061-.192.081-.292l.327-1.632c.722.252 1.494.396 2.301.396s1.579-.144 2.301-.397zm2.373-8.235c0 2.757-2.243 5-5 5s-5-2.243-5-5v-3.877c0-1.374.928-2.567 2.258-2.907.467 1.05 1.52 1.784 2.742 1.784h4c.551 0 1 .448 1 1zm2 1h-.08c.047-.328.08-.66.08-1v-3c1.103 0 2 .897 2 2s-.897 2-2 2zm-13.847-11.758 1.464-.366.214-.321c1.067-1.6 2.852-2.555 4.774-2.555h2.651c3.719 0 6.744 3.025 6.744 6.743 0 .726-.117 1.443-.346 2.133l-.142.425c-.467-.191-.977-.301-1.512-.301h-.184c-.414-1.161-1.514-2-2.816-2h-4c-.551 0-1-.448-1-1s.449-1 1-1h1v-2h-1c-1.374 0-2.536.929-2.889 2.191l-.324.081c-1.855.464-3.229 1.928-3.644 3.728h-.143c-.503 0-.979.104-1.422.273-.265-.921-.578-2.228-.578-3.273 0-1.307.885-2.44 2.153-2.758zm-.153 7.758v3c0 .34.033.672.08 1h-.08c-1.103 0-2-.897-2-2s.897-2 2-2zm-36-7h32.448c-.28.615-.448 1.289-.448 2 0 1.608.565 3.587.871 4.539-.537.681-.871 1.528-.871 2.461 0 2.206 1.794 4 4 4h.685c.499 1.045 1.247 1.946 2.17 2.628l-.443 2.215c-.159.794-.775 1.41-1.569 1.569l-2.412.482c-1.547.309-2.912 1.063-3.987 2.105h-30.444zm9.781 24h2.938l-1.5 6h-2.938zm46.219 6h-9.447l3.779-8.314.845.169c2.795.559 4.823 3.034 4.823 5.883z" />
										<path d="m35 11h-12v4h-4v-6h-12v12h6v6h14v-6h8zm-26 0h8v8h-8zm16 14h-10v-4h4v-4h6zm8-6h-6v-4h-2v-2h8z" />
										<path d="m56.489 53.352c1.559-1.313 2.511-3.266 2.511-5.352v-1c0-3.309-2.691-6-6-6h-2c-3.309 0-6 2.691-6 6v1c0 2.087.953 4.041 2.51 5.352-2.423.691-4.401 2.354-5.517 4.53-1.125-2.174-3.107-3.831-5.499-4.523 1.53-1.285 2.506-3.21 2.506-5.359v-1c0-3.309-2.691-6-6-6h-2c-3.309 0-6 2.691-6 6v1c0 2.149.976 4.074 2.506 5.359-2.395.693-4.378 2.352-5.502 4.53-1.123-2.178-3.108-3.842-5.503-4.536 1.526-1.285 2.499-3.207 2.499-5.353v-2c0-2.757-2.243-5-5-5h-7c-1.103 0-2 .897-2 2v5c0 2.149.976 4.074 2.506 5.359-3.752 1.085-6.506 4.544-6.506 8.641v1h62v-1c0-4.087-2.71-7.564-6.511-8.648zm-2.489 1.648c0 1.103-.897 2-2 2s-2-.897-2-2c0-.1.025-.193.039-.289.631.184 1.292.289 1.961.289s1.331-.105 1.961-.289c.014.096.039.189.039.289zm-7-7v-1c0-2.206 1.794-4 4-4h2c2.206 0 4 1.794 4 4v1c0 1.927-1.129 3.703-2.884 4.528-1.282.617-2.942.621-4.24-.004-1.747-.821-2.876-2.597-2.876-4.524zm-20 0v-1c0-2.206 1.794-4 4-4h2c2.206 0 4 1.794 4 4v1c0 2.757-2.243 5-5 5s-5-2.243-5-5zm3 7h4c3.519 0 6.432 2.614 6.92 6h-17.84c.488-3.386 3.401-6 6.92-6zm-23-7v-5h7c1.654 0 3 1.346 3 3v2c0 2.757-2.243 5-5 5s-5-2.243-5-5zm-3.929 13c.487-3.388 3.408-6 6.929-6h4c3.521 0 6.442 2.612 6.929 6zm40.007 0c.388-2.723 2.328-4.955 4.95-5.718.148 2.072 1.863 3.718 3.972 3.718 2.108 0 3.823-1.645 3.971-3.716 2.623.763 4.571 2.993 4.958 5.716z" />
									</g>
								</svg>
							</div>
							<div class="edu_dash_info">
								<ul>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_active')); ?> <span><?php echo html_escape($active_batch); ?></span></p>
									</li>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_inactive')); ?> <span><?php echo html_escape($inactive_batch); ?></span></p>
									</li>
									<ul>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<a href="<?php echo base_url() ?>teacher/extra-classes">
						<div class="edu_color_boxes box_left">
							<div class="edu_dash_box_data">
								<p><?php echo html_escape($this->common->languageTranslator('ltr_today_extra_class')); ?></p>
								<h3><?php echo html_escape($total_extra_class); ?></h3>
							</div>
							<div class="edu_dash_box_icon">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
									<g>
										<path d="M23.729,1.176H0.271v15.705H8.82l-2.946,5.943h2.271l1.009-2.046h5.266l1.008,2.046h2.299l-2.967-5.94
                            		h8.967V1.176H23.729z M9.903,19.262l1.171-2.378H12.5l1.172,2.378H9.903z M22.717,15.871H1.282V2.187h21.435V15.871z" />
										<rect x="0.922" y="1.604" />
									</g>
								</svg>
							</div>
							<div class="edu_dash_info">
								<ul>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_previous')); ?> <span><?php echo html_escape($total_previous_class); ?></span></p>
									</li>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_upcoming')); ?> <span><?php echo html_escape($total_upcoming_class); ?></span></p>
									</li>
									<ul>
							</div>
						</div>
					</a>
				</div>


				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<a href="<?php echo base_url() ?>teacher/question-manage">
						<div class="edu_color_boxes box_right">
							<div class="edu_dash_box_data">
								<p><?php echo html_escape($this->common->languageTranslator('ltr_total_questions')); ?></p>
								<h3><?php echo html_escape($total_question); ?></h3>
							</div>
							<div class="edu_dash_box_icon">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
									<g>
										<g>
											<g>
												<path d="M248.158,343.22c-14.639,0-26.491,12.2-26.491,26.84c0,14.291,11.503,26.84,26.491,26.84
                                				c14.988,0,26.84-12.548,26.84-26.84C274.998,355.42,262.799,343.22,248.158,343.22z"></path>
												<path d="M252.69,140.002c-47.057,0-68.668,27.885-68.668,46.708c0,13.595,11.502,19.869,20.914,19.869
                                				c18.822,0,11.154-26.84,46.708-26.84c17.429,0,31.372,7.669,31.372,23.703c0,18.824-19.52,29.629-31.023,39.389
                                				c-10.108,8.714-23.354,23.006-23.354,52.983c0,18.125,4.879,23.354,19.171,23.354c17.08,0,20.565-7.668,20.565-14.291
                                				c0-18.126,0.35-28.583,19.521-43.571c9.411-7.32,39.04-31.023,39.04-63.789S297.307,140.002,252.69,140.002z"></path>
												<path d="M256,0C114.516,0,0,114.497,0,256v236c0,11.046,8.954,20,20,20h236c141.483,0,256-114.497,256-256
                                				C512,114.516,397.503,0,256,0z M256,472H40V256c0-119.377,96.607-216,216-216c119.377,0,216,96.607,216,216
                                				C472,375.377,375.393,472,256,472z"></path>
											</g>
										</g>
									</g>
								</svg>
							</div>
							<div class="edu_dash_info">
								<ul>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_vimp')); ?> <span><?php /* echo html_escape($vimp_question); */ ?></span></p>
									</li>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_imp')); ?> <span><?php /*echo html_escape($imp_question);*/ ?></span></p>
									</li>
									<ul>
							</div>
						</div>
					</a>
				</div>

				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<a href="javascript:void(0);">
						<div class="edu_color_boxes box_other">
							<div class="edu_dash_box_data">
								<p><?php echo html_escape($this->common->languageTranslator('ltr_leave_request')); ?></p>
								<h3><?php echo $total_leave_request; ?></h3>
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
										<p><?php echo html_escape($this->common->languageTranslator('ltr_aproved')); ?> <span><?php echo $total_leave_aproved; ?></span></p>
									</li>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_decline')); ?> <span><?php echo $total_leave_decline; ?></span></p>
									</li>
									<ul>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
					<a href="<?php echo base_url() ?>teacher/doubts-class">
						<div class="edu_color_boxes box_other">
							<div class="edu_dash_box_data">
								<p><?php echo html_escape($this->common->languageTranslator('ltr_student_doubts_ask')); ?></p>
								<h3><?php echo $doubts_data; ?></h3>
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
										<p><?php echo html_escape($this->common->languageTranslator('ltr_aproved')); ?> <span><?php echo $doubts_data_aprove; ?></span></p>
									</li>
									<li>
										<p><?php echo html_escape($this->common->languageTranslator('ltr_pending')); ?> <span><?php echo $doubts_data_pending; ?></span></p>
									</li>
									<ul>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<!-- Tambahan -->
</section>