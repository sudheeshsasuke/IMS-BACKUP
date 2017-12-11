<?php ob_start()?>
<div class="box box-warning">
<div class="box-header with-border">
  <h3 class="box-title">New Registration</h3>
</div>
<?php 
  $acad_counter=1;
  $skill_counter=1;
  $exp_counter=1;

?>
<!-- /.box-header -->
<div class="box-body">
  <form role="form" action="http://ims.com/admin/new_registration" onsubmit="return validate()" method="POST"  enctype="multipart/form-data">
    <!-- text input -->
    <div class="container">
				<h1 class="well">Personal Info</h1>
				<div class="col-lg-12 well">
					<div class="row">		
						<div class="col-sm-12">     
							<div class="row">
								<div class="col-sm-12 form-group">
									<label>Name</label>
									<input type="text" placeholder="Enter Name Here.." name="name"  class="form-control" required>
								</div>
							</div>	
							<div class="row">
								<div class="col-sm-6 form-group">
										<label>Phone Number</label>
										<input type="text" placeholder="Enter Phone Number Here.." name="phone"  class="form-control">
								</div>		
								<div class="col-sm-6 form-group">
									<label>Email Address</label>
									<input type="text" placeholder="Enter Email Address Here.." name="email"  class="form-control" required>
								</div>
							</div>	
							<div class="row">													
								<div class="col-sm-6 form-group">
									<label for="fileToUpload">Upload resume</label></td>
									<input type="file" name="fileToUpload"  class="form-control" required>
								</div>	
							</div>	  																	
						</div>
					</div>
				</div>
			</div>
		
			<div class="container">
				<h1 class="well">Academics</h1>
					<div class="col-lg-12 well">
						<div class="row">					
							<div class="col-sm-12">
								<div class="row">
									<table id="academicsTable" class=" table order-list">
										<thead>
											<tr>
												<td>Course</td>
												<td>Board/Course</td>
												<td>Math score</td>
												<td>Percentage</td>
												<td>Year</td>
											</tr>
										</thead>
										<tbody>
   
												<tr id="academics">
													<td class="col-sm-4">
														<select class="form-control" name="course<?=$acad_counter?>">
															<option value="10" <?= $academics['course']=='10'? 'selected ="selected"' : ' ';?>>10</option>		
															<option value="12" <?= $academics['course']=='12'? 'selected ="selected"' : ' ';?>>12</option>
															<option value="UG"<?= $academics['course']=='UG'? 'selected ="selected"' : ' ';?>>UG</option>	
															<option value="PG"<?= $academics['course']=='PG'? 'selected ="selected"' : ' ';?>>PG</option>																				
														</select>																	
													</td>
													<td class="col-sm-3">
														<input type="text" placeholder="Board/Course" name="course_name<?=$acad_counter?>" value="<?= htmlentities($academics['course_name'])?>" class="form-control"/>													
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Score in maths" name="math_score<?=$acad_counter?>" class="form-control"/>													
													</td>
													<td class="col-sm-2">
														<input type="mail" placeholder="Enter Percentage" name="percentage<?=$acad_counter?>" class="form-control"/>													
													</td>
													<td class="col-sm-4">
														<input type="text" placeholder="Enter year" name="year_of_passout<?=$acad_counter?>" class="form-control"/>													
													</td>
													<input type="hidden" id="findid" name="id<?=$acad_counter?>" class="form-control" />	
													<input type="hidden" id="removedid" name="removedid" value=""/>	
													
													<td class="col-sm-2">
														<input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">
													</td>
												</tr> 
											<input type="hidden" id="acad_counter" name="acad_counter" value="<?=$acad_counter?>">									
										</tbody>
										<tfoot>
											<tr>
												<td colspan="5" style="text-align: left;">
													<input type="button" id="acadaddrow" class="btn btn-lg btn-block "  value="Add Row" />
												</td>
											</tr>
											<tr>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>				
						</div>
					</div>
				</div>

			<div class="container">
				<h1 class="well">Work Experience</h1>
					<div class="col-lg-12 well">
						<div class="row">				
							<div class="col-sm-12">
								<div class="row">
									<table id="experienceTable" class=" table order-list">
										<thead>
											<tr>
												<td>From</td>
												<td>To</td>
												<td>Company</td>
												<td>Location</td>
												<td>Designation</td>
												<td>Reason for leaving</td>
											</tr>
										</thead>
										<tbody>   
												<tr>
													<td class="col-sm-1">
														<input type="text" placeholder="Date" name="start_date<?=$exp_counter?>"  class="form-control" />
													</td>
													<td class="col-sm-1">
														<input type="text" placeholder="Date" name="end_date<?=$exp_counter?>" class="form-control" />
													</td>
													<td class="col-sm-3">
														<input type="text" placeholder="Enter Company Name Here.." name="company<?=$exp_counter?>" class="form-control"/>															
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter company location Here.." name="location<?=$exp_counter?>" class="form-control"/>
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter Designation Here.." name="position<?=$exp_counter?>" class="form-control"/>
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter Reason Here.." name="reason_for_leaving<?=$exp_counter?>" class="form-control"/>
													</td>
													<input type="hidden" id="exp_findid" name="exp_id"  class="form-control" />	
													<input type="hidden" id="exp_removedid" name="exp_removedid" value=""/>	
													
													<td class="col-sm-2">
														<input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">
													</td>
												</tr>	
											<input type="hidden" id="exp_counter" name="exp_counter" value="<?=$exp_counter?>">			 
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7" style="text-align: left;">
													<input type="button" class="btn btn-lg btn-block " id="addrow" value="Add Row" />
												</td>
											</tr>
											<tr>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>				
						</div>
					</div>
				</div>

			<div class="container">
				<h1 class="well">Skills</h1>
				<div class="col-lg-12 well">
					<div class="row">					
						<div class="col-sm-12">
							<div class="row">
								<table id="skillTable" class=" table order-list">
									<thead>
										<tr>
											<td>Skill</td>
											<td>Rating</td>										
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="col-sm-4">
												<input type="text" placeholder="Mention skill" name="title<?=$skill_counter?>" class="form-control" />
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="1" >Low</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="2">Medium</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="3">High</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="4">Very high</label>
											</td>	
											<input type="hidden" id="skill_findid" name="skill_id" class="form-control" />	
											<input type="hidden" id="skill_removedid" name="skill_removedid" value=""/>												
											<td class="col-sm-2">
												<input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">
											</td>
										</tr> 		
                    <input type="hidden" id="skill_counter" name="skill_counter" value="<?=$skill_counter?>" >			
									</tbody>
									<tfoot>
										<tr>
											<td colspan="6" style="text-align: left;">
												<input type="button" class="btn btn-lg btn-block " id="skill_addrow" value="Add Row" />
											</td>
										</tr>
										<tr>
										</tr>
									</tfoot>
								</table>	
							</div>
						</div>				
					</div>
				</div>
			</div>
		<input type="hidden" name="intid" value=<?=$_GET['intid']?>>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </div>
  </form>
</div>
<!-- /.box-body -->
</div>
<?php $content = ob_get_clean() ?>
<?php include 'layout.tpl.php' ?>