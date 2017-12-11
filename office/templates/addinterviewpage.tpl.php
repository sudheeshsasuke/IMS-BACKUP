<?php ob_start();?>
<html>
<body>
  <?php $pid = $_GET['id'];?>
  
    <div class="container">
	  <h1 class="well">Interview Info:</h1>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<form id="jobpostform" method="post" action="/admin/interview/addinterview">
						<!-- /.box-header -->
							<div class="box-body">							
								<table  class="table table-bordered table-striped">
									<?php if($interview) { ?>
										<tr>
												<td><input type="hidden" name="jobid" value = <?=$_GET['id']?>></td>
										</tr>
						
										<tr>
												<td>Job Post</td>
												<td><input type="text" name="jobpost" value = <?=htmlentities($interview['title'])?> class="form-control"   required></td>
										</tr>
		
										<tr>
												<td>Location</td>
												<td><input type="text" name="location" value = <?=htmlentities($interview['location'])?> class="form-control"   required></td>
										</tr>
										<tr>
												<td>Department</td>
												<td><input type="text" name="department" value = <?=htmlentities($interview['department'])?> class="form-control"   required></td>
										</tr>
										<tr>
												<td>Start Date</td>
												<td><input type="date" name="startdate" value = <?=htmlentities($interview['start_date'])?> class="form-control"   required></td>
										</tr>
										<tr>
												<td>End Date</td>
												<td><input type="date" name="enddate" value = <?=htmlentities($interview['end_date'])?> class="form-control"   required></td>
										</tr>
										<tr>
										<td>Description</td>
										<td>
										<textarea id="description" name="description" rows="10" cols="80"><?=$interview_det['body']?>
										</textarea></td>
									</tr>
									<tr>
										<td>Criteria(each crieteria seperated by ' - ')</td>
										<td>
										<textarea id="criteria" name="criteria" rows="10" cols="80" ><?=$interview_det['criteria']?>
										</textarea></td>
									</tr>
						
								<?php }        
								else { ?>
										<tr>
										<div class="col-sm-12 form-group">
												<td>Job Post</td>
												<td><input type="text" id="jobpost" name="jobpost" class="form-control"   required ></td>
										</div>
										</tr>
										<tr>
												<td>Location</td>
												<td><input type="text" name="location" class="form-control"  required ></td>
										</tr>
										<tr>
												<td>Department</td>
												<td><input type="text" name="department" class="form-control"  required ></td>
										</tr>
										<tr>
												<td>Start Date</td>
												<td><input type="date" name="startdate" class="form-control"   required></td>
										</tr>
										<tr>
												<td>End Date</td>
												<td><input type="date" name="enddate" class="form-control"   required ></td>
										</tr>
										<tr>
										<td>Description </td>
										<td>
										<textarea id="description" name="description" rows="10" cols="80">
										</textarea></td>
									</tr>
									<tr>
										<td>Criteria (each crieteria seperated by ' - ')</td>
										<td>
										<textarea id="criteria" name="criteria" rows="10" cols="80">
										</td>
										</textarea>
									</tr>
									<?php } ?>
								
									<tr>
											<td colspan="2" ><input type="submit" class="btn btn-lg btn-info" value="Submit" onclick="return validate('#jobpostform')"></td>
											<td id="formerror"></td>
									</tr>
								</table>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>
		<!-- /.content -->
    </div>
  </form>   
</body>

</html>
<?php $content = ob_get_clean();?>
<?php include 'layout.tpl.php' ?>