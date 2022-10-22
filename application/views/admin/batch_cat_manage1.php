<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_subject_manager">			
		<div class="edu_btn_wrapper sectionHolder padderBottom30 text-right">
		     <?php 
                 // print_r($_SESSION);
               if($this->session->userdata('super_admin')==0 && $this->session->userdata('role')==1){
                    ?>
                     <a href="#categoryPopup" class="edu_admin_btn openPopupLink addcatPop"><i class="icofont-plus"></i><?php echo html_escape($this->common->languageTranslator('ltr_add_category'));?></a>
                    <?php 
                }
            ?>	    
           
	    </div>
	    <?php if($_SESSION['super_admin'] == '1'){ ?>
        <div class="edu_table_wrapper mb_30">
            <div class="edu_admin_informationdiv sectionHolder">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
                        <div class="form-group">
                            <span>
                                <select class="form-control filter_admin edu_selectbox_with_search onchange_fetch" name="admin" data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_select_user'));?>" data-count="no">
                                    <option value=""><?php echo html_escape($this->common->languageTranslator('ltr_select_user'));?></option>
                                    <?php
                                    if(!empty($all_user)){
                                        foreach($all_user as $user){
                                             if($user['super_admin'] == 0 && $user['role']==1){
                                                   $nm = "Sub-Admin";  
                                              }else{
                                                   $nm = "Teacher";  
                                              }
                                            echo '<option value="'.$user['id'].'">'.$user['name'].'  '.'  '.'('.$nm.')'.'</option>';
                                            // echo '<option value="'.$user['id'].'">'.$user['name'].'</option>'; 
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
                                    <input type="button" id="serching_data" value="<?php echo html_escape($this->common->languageTranslator('ltr_search'));?>" class="btn btn-primary filter_by_admin"/>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
	       <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<button class="multiDelete btn_delete btn btn-primary"  data-table="batch_category" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
			if(!empty($cat_data) && $cat_data>=1){ 
			?>
	    <div class="edu_main_wrapper edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/category_table">
                        <thead>
                            <tr>  
                            <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?></th>
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
                                <div class="eac_text eac_page_re">'.html_escape($this->common->languageTranslator('ltr_cat_no_data')).'</div>
                            </div>
                        </div>
                    </section>';
			} ?>
	    
	    
					</div>
			</section>
			            
			
<!-- Add Category Pop Up Start  -->
<div id="categoryPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_add_category'));?></h4>
            <form method="post" class="pxn_amin form" action="javascript:void(0)" autocomplete="off"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?><sup>*</sup></label>
                            <input type="text" name="category" id="categoryName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" name="addcategory" value="<?php echo html_escape($this->common->languageTranslator('ltr_add'));?>" class="edu_admin_btn addCategory" data-id="" />
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Pop Up Start  -->

<div id="categoryEditPopup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="myModalLabel1"><?php echo html_escape($this->common->languageTranslator('ltr_edit_category'));?></h4>
            <form method="post" class="pxn_amin form" action="" autocomplete="off"> 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?><sup>*</sup></label>
                            <input type="text" name="category" id="categoryEditName" class="form-control" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_category_name'));?>" />
                        </div>
    				</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
    					<div class="edu_btn_wrapper">
							<input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_update'));?>" class="edu_admin_btn editCategory"/>
						</div>
    				</div>
				</div>
            </form>
        </div>
    </div>
</div>