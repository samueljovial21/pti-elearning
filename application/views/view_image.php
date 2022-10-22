<html>
	<head>
		<title></title>
		<style>
			.row{
				height:auto;
				widht:100%;
				margin:5px;
			}
			
			.db_img{
				display:none;
				height:250px;
				width:250px;
				border:1px solid;
				margin:5px;
				float:left;
			}
			
			.db_img img{
				height:100%;
				width:100%;
			}
			.loadMoreImg.btn.btn-primary {
				margin: 20px 0;
				color: #fff;
				background-color: #4267C8  !important;
				border-color: #4267C8  !important;
			}
			.btn {
				display: inline-block;
				margin-bottom: 0;
				font-weight: 700;
				text-align: center;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				border: 1px solid transparent;
				white-space: nowrap;
				padding: 8px 34px;
				font-size: 15px;
				line-height: 1.42857143;
				border-radius: 4px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				text-transform: capitalize;
			}
			.clearfix:before, .clearfix:after {
				content: " ";
				display: table;
			}
			.clearfix:after {
				clear: both;
			}
		</style>
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	</head>
	<body> 
		<div class="row">
			<?php 		
			
			foreach($images as $image) {
				?>
				<div class="db_img">
					<img onclick="setLink('<?php echo base_url().'assets/images/'.$image; ?>')" src="<?php echo base_url().'assets/images/'.$image; ?>" />
				</div>
				<?php
			}
			?>
			<div class="clearfix"></div>
			<div style="text-align:center;">
			<button class="loadMoreImg btn btn-primary">Load More</button>
			</div>
		</div>
	</body>
	<script>
		function setLink(url){  
			window.opener.CKEDITOR.tools.callFunction(<?= $_GET['CKEditorFuncNum'];?>, url);
			
			window.close(); 
			
			
			
		}
		
		$("div.db_img").slice(0, 4).show();
		$(document).on('click', '.loadMoreImg', function (e) {
			e.preventDefault();
			$("div.db_img:hidden").slice(0, 4).slideDown();
		   
			$('#all_ImagesToSelect').animate({
				scrollTop: $(this).offset().top
			}, 1500);
		});
</script>
</html>