<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_extra_classes"> 
	    <?php 
			if(!empty($eclass_data)){
			?>
	    <div class="edu_main_wrappe edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="edu_title_wrapper">
							<h4 class="edu_sub_title"><?php echo html_escape($this->common->languageTranslator('ltr_upcoming_extra_class'));?></h4>
						</div>
                    </div>
					<?php 
					if(!empty($todayClass)){ 
						foreach($todayClass as $class){
							echo '<div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<div class="edu_extra_class">
									<p class="clstime"><i class="icofont-ui-calendar"></i>'.date('d-m-Y',strtotime($class['date'])).'</p>
									<p class="clstime"><i class="icofont-clock-time"></i>'.date('h:i A', strtotime($class['start_time'])).' - '.date('h:i A', strtotime($class['end_time'])).'</p>
								    <p class="clsdesc"><i class="icofont-law-document"></i>'.$class['description'].'</p>
									<p class="clsby"><i class="icofont-ui-user"></i><span class="boldText"> By - </span>'.$class['name'].(($class['teach_gender'] == 'male')?' Sir':' Mam').' </p>
								</div>
							</div>';
						}
					}else{
						echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="edu_extra_class">
							<p class="clsdesc">'.html_escape($this->common->languageTranslator('ltr_no_extrac')).'</p>
						</div>
						</div>';
					}  ?>	
				</div>
			</div>
		</div>
		<div class="edu_main_wrappe edu_table_wrapper mb_30">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="row">
				    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="edu_title_wrapper">
							<h4 class="edu_filter_title white"><?php echo html_escape($this->common->languageTranslator('ltr_previous_classes'));?></h4>
						</div>
                    </div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
								<input type="text" class="chooseCurrDate form-control filter_date" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_date'));?>">
							</span>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<span>
								<div class="pxn_admin_btnsection">
									<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary searchPRevCls"/>
								</div>
							</span>
						</div>
					</div>
				</div>
			</div> 
		</div>
		<div class="edu_main_wrappe edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
				<div class="tableFullWrapper">
    				<table  class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="front_ajax/extraclass_table">
    					<thead>
    						<tr>
    							<th>#</th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_time'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
    							<th><?php echo html_escape($this->common->languageTranslator('ltr_teacher'));?></th>
    						</tr>
    					</thead>
    					<tbody>
    					</tbody>
    				</table>
    			</div>
			</div>
		</div>
		<?php 
			}else{ 
			    echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_no_extra_available')).'</div>
                            </div>
                        </div>
                    </section>';
			}
		?>
	</div>
</section>
<!-- Pop view characters Start  -->
<div id="charactersViewPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
           .<h4 class="edu_sub_title" id="charaTitele"></h4>
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