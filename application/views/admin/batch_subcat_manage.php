<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_subject_manager">			
		<div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
           <a href="#subcategoryPopup" class="edu_admin_btn openPopupLink addsubcatPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_subcategory'));?></a>
	    </div>
	    <?php if($_SESSION['super_admin'] == '1'){ ?>
  <div class="edu_table_wrapper mb_30">
      <div class="edu_admin_informationdiv sectionHolder">
         
      </div>
  </div>
  <?php } ?>
	       <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary" data-placement="top" title="Delete" data-table="batch_subcategory" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if(!empty($subcat_data) && $subcat_data>=1){
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/subcategory_table">
                        <thead>
                            <tr>  
                            <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_subCategory_name'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_actions'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_added_by'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_subcat_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	    
	    
					</div>
			</section>
			            
			
<!-- Add SubCategory Pop Up Start  -->
<div id="subcategoryPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_subcategory'));?></h4>
            <form method="post" class="pxn_amin form" action="javascript:void(0)" autocomplete="off"> 
                <div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_category'));?> <sup>*</sup></label>								
							<select class="form-control require edu_selectbox_with_search" name="category" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_category'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_category'));?></option>
								<?php foreach($category_data as $cat){
									echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
								}?>
							</select>								
						</div>	
					</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subCategory_name'));?><sup>*</sup></label>
                            <input type="text" name="subcategory" id="subcategoryName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subCategory_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" name="addcategory" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addsubCategory" data-id="" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>

<!-- Edit SubCategory Pop Up Start  -->

<div id="subcategoryEditPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_edit_subcategory'));?></h4>
            <form method="post" class="pxn_amin form" action="" autocomplete="off"> 
                <div class="row">
                    	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="form-group">
							<label><?php echo html_escape($this->common->languageTranslator('ltr_category'));?> <sup>*</sup></label>								
							<select class="form-control require edu_selectbox_with_search" id="categoryData" name="category" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_category'));?>">
								<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_category'));?></option>
								<?php foreach($category_data as $cat){
									echo '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
								}?>
							</select>								
						</div>	
					</div>
                    	
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_subCategory_name'));?><sup>*</sup></label>
                            <input type="text" name="subcategory" id="subcategoryEditName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_subCategory_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_update'));?>" class="edu_admin_btn editsubCategory"/>
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>