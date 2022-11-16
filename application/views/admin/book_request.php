<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_video_manager">
        <?php $role = $this->session->userdata('role');?>				
	    <div class="edu_table_wrapper sectionHolder">
			<div class="edu_admin_informationdiv">
                <form method="post" action="" autocomplete="off">
                    <div class="edu_manage_studer_filter"> 
                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                <?php 
                    			if(!empty($book_data)){
                    			?>
                                <div class="form-group"> 
                                    <span>
                                        <select class="form-control datatableSelectSrch" id="bookId" name="bookId">
                                            <option value=""> Select book </option>
                                            <?php 
											foreach($book_data as $bvalue){
												?>
												<option value="<?php echo $bvalue['id']; ?>"> <?php echo $bvalue['title'].' - ('.$bvalue['author_name'].')' ;?> </option>
												<?php
											}
											?>
                                        </select>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>	
                            
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <?php 
                    			if(!empty($book_data)){
                    			?>
                                <div class="form-group"> 
                                    <span> 
                                        <input type="button" data-table="library_request" value="Add request" class="btn btn-primary add_request"> 
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                            
                        </div>
                    </div>	
                </form>  
			</div>
		</div>
        <?php if(!empty($notes_data) && $role !='student'){ ?>
        <div class="createDivWrapper edu_add_question create_ppr_popup hide">
    		<div class="edu_admin_informationdiv sectionHolder">
    		    <div class="ppr_popup_inner">
        			<div class="row align-items-center text-center">
        			    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php if($role != 'student'){?>
                    <button class="multiDelete btn_delete btn btn-primary" data-toggle="tooltip" data-placement="top" title="Delete" data-table="library_request" data-column="id">Delete</button>
                    <?php }?>
        		</div>
					</div>
        		</div>
    		</div>
		</div>
		<?php 
		}
    		if(!empty($notes_data)){
    		?> 
	    <div class="edu_table_wrapper">
			<div class="edu_admin_informationdiv sectionHolder">
                <div class="tableFullWrapper">
                    
                    <table class="server_datatable datatable table table-striped table-hover dt-responsive" cellspacing="0" width="100%" data-url="ajaxcall/library_request">
                        <thead>
                            <tr>
                                <?php echo ($role != 'student')?'<th><input type="checkbox" class="checkAllAttendance"></th>':''; ?>
                                <th>#</th>
								<?php echo ($role != 'student')?'<th>Student</th>':''; ?>
                                <th>Book name</th>
								<?php echo ($role === 'student')?'<th>Author name</th>':''; ?>
                                <th>Request</th>
								<th>Response Date</th>
								<th>Status</th>
                                <th>Action</th>
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
			    if($role=='student'){
    		        echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">No library books is available to show.</div>
                            </div>
                        </div>
                    </section>';
    		    }else if($role==3){
    		         echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">You have not added any library yet, feel free to add library by clicking on "Add library" button.</div>
                            </div>
                        </div>
                    </section>';
    		    }else{
			     echo '<section class="edu_admin_content">
                        <div class="edu_admin_right sectionHolder edu_add_users">
                            <div class="edu_admin_informationdiv edu_main_wrapper">
                                <div class="eac_text eac_page_re">You have not added any library yet, feel free to add library by clicking on "Add library" button.</div>
                            </div>
                        </div>
                    </section>';
    		    }
			} ?>
	</div>
</section>


<!-- view Pop Up Start  -->
<div id="view_video_popup" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="viewVideoTopic">view video</h4>
            <div class="row videoIframeShow">
            </div>
        </div>
    </div>
</div>
<!-- view Pop Up student image  -->
<div id="stImgModal" class="edu_popup_container mfp-hide">
    <div class="edu_popup_wrapper">
        <div class="edu_popup_inner">
            <h4 class="edu_sub_title" id="stImgModalLabel">student image</h4>
            <div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="form-group text-center">
						<img id="std_img" class="stdnt_proflie_img" src="" alt="Student Image"/>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>