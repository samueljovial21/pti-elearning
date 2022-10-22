<section class="edu_admin_content">
    <div class="edu_admin_right sectionHolder edu_course_manager">
        <div class="createDivWrapper edu_add_question create_ppr_popup hide">
            <div class="edu_admin_informationdiv sectionHolder">
                <div class="ppr_popup_inner">
                    <div class="row align-items-center text-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="blog_comments" data-column="id"><?php echo html_escape($this->common->languageTranslator('ltr_delete'));?></button>
                </div>
                    </div>
                </div>
            </div>
        </div>
            
        <div class="edu_main_wrapper edu_table_wrapper">
            <div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                     <a href="<?php echo base_url('/blog/').$blog[0]['id']; ?>" class="edu_sglblog_title" target="_blank"><?php if(!empty($blog[0]['title'])){ echo $blog[0]['title'] ; } ?></a>
                    <table class="basic_datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" >
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="checkAllAttendance"></th>
                                <th>#</th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_username'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_email'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_description'));?></th>
                                <th><?php echo html_escape($this->common->languageTranslator('ltr_date'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_status'));?></th>
                                <th class="no-sort"><?php echo html_escape($this->common->languageTranslator('ltr_action'));?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=0;
                             foreach($comments as $value){ 
                                $count++;
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="checkOneRow" value="<?=$value['id']?>"></td>
                                    <td><?=$count;?></td>
                                    <td><?=$value['user_name']?></td>
                                    <td><?=$value['user_email']?></td>
                                    <td><?=$value['comments']?></td>
                                    <td><?=date('d-m-Y',strtotime($value['create_at']))?></td>
                                    <td>
                                        <select data-id="<?=$value['id']?>" data-table ="blog_comments" class="form-control changeStatus datatableSelect">
                                            <option value="1" <?=(($value['status'] == 1) ? 'selected':'')?> ><?=$this->lang->line('ltr_approved')?></option>
                                            <option value="2" <?=(($value['status'] == 2) ? 'selected':'')?> ><?=$this->lang->line('ltr_decline')?></option>
                                            <option value="0" <?=(($value['status'] == 0) ? 'selected':'')?> ><?=$this->lang->line('ltr_pending')?></option>
                                        </select>
                                    </td>
                                    <td>
                                       <a class="deleteDataBlogComment btn_delete" data-id="<?=$value['id']?>" data-table="blog_comments"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                <?php $reply = $this->db_model->select_data('*','blog_comments_reply',array('comment_id'=>$value['id']));

                                if(!empty($reply)){
                                    foreach($reply as $rvalue){ 
                                        $count++;
                                        ?>
                                <tr>
                                    <td><input type="checkbox" class="checkOneRow" value="<?=$rvalue['id']?>"></td>
                                    <td><?=$count;?></td>
                                    <td><?=$rvalue['name']?></td>
                                    <td><?=$rvalue['email']?></td>
                                    <td><?=$rvalue['reply']?></td>
                                    <td><?=date('d-m-Y',strtotime($rvalue['create_at']))?></td>
                                    <td>
                                        <select data-id="<?=$rvalue['id']?>" data-table ="blog_comments_reply" class="form-control changeStatus ">
                                            <option value="1" <?=(($rvalue['status'] == 1) ? 'selected':'')?> ><?=$this->lang->line('ltr_approved')?></option>
                                            <option value="2" <?=(($rvalue['status'] == 2) ? 'selected':'')?> ><?=$this->lang->line('ltr_decline')?></option>
                                            <option value="0" <?=(($rvalue['status'] == 0) ? 'selected':'')?> ><?=$this->lang->line('ltr_pending')?></option>
                                        </select>
                                    </td>
                                    <td>
                                       <a class="deleteDataBlogComment btn_delete" data-id="<?=$rvalue['id']?>" data-table="blog_comments_reply"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                                    <?php  }}
                                ?>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>  


<!-- Pop Up Start  -->
<div id="courseModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="blogModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_add_blog'));?></h4>
            <form method="post" autocomplete="off" id="blogForm">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_title'));?><sup>*</sup></label>
                            <input type="text" class="form-control require"  placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_title'));?>" name="blog_title"  id="blogTitle" >        
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_image'));?><sup>*</sup></label>
                            <input type="file" class="form-control require" name="image"  id="c_crsImg" >
                            <p class="fileNameShow"></p>        
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label><?php echo html_escape($this->common->languageTranslator('ltr_description'));?><sup>*</sup></label>
                            <textarea name="description" class="form-control summernote require" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_description'));?>" id="c_desc"  rows="6"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="edu_btn_wrapper">
                            <input type="hidden" name="course_id" id="course_id" value="">
                            <input type="button" value="<?php echo html_escape($this->common->languageTranslator('ltr_save'));?>" class="edu_admin_btn addEditBlog" data-type="add" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="stImgModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="stImgModalLabel"><?php echo html_escape($this->common->languageTranslator('ltr_course_image'));?></h4>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group text-center">
                        <img id="std_img" src="" alt="Course Image"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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