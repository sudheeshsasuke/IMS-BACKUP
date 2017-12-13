<?php ob_start() ?>
<html>
	<head>		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="http://ims.com/user/css/mystyles.css" rel="stylesheet">	
		
	</head>

	<body>
		<form action = "http://ims.com/user/submit_profile" method = "post" enctype="multipart/form-data">
			<div class="container">
				<h1 class="well">Personal Info</h1>
				<div class="col-lg-12 well">
					<div class="row">		
						<div class="col-sm-12">
							<?php foreach($personal_details as $personalinfo): ?>      
								<div class="row">
									<div class="col-sm-12 form-group">
										<label class="required">Name</label>
										<input type="text" placeholder="Enter Name Here.." name="name" value="<?= htmlentities($personalinfo['name'])?>" class="form-control" required>
									</div>
								</div>	
								<div class="row">
									<div class="col-sm-6 form-group">
											<label class="required">Phone Number</label>
											<input type="text" placeholder="Enter Phone Number Here.." id="phone" name="phone" value="<?= htmlentities($personalinfo['phone'])?>" class="form-control"required>
									</div>		
									<div class="col-sm-6 form-group">
										<label class="required">Email Address</label>
										<input type="text" placeholder="Enter Email Address Here.." id="emailid" name="email" value="<?= htmlentities($personalinfo['email'])?>" class="form-control" required>
									</div>
								</div>	
								<div class="row">													
									<div class="col-sm-6 form-group">
										<label for="fileToUpload">Upload resume</label></td>
										<?php if(!empty($personalinfo['resume'])):?>
										<input type="file" name="fileToUpload" class="form-control">Uploaded resume
										<?php else: ?>
										<input type="file" name="fileToUpload" class="form-control">
										<?php endif; ?>
									</div>	
								</div>	
							<?php endforeach; ?>   																	
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
											<?php $acad_counter = 1; ?>
											<?php foreach($academic_details as $academics): ?>    
												<tr id="academics">
													<td class="col-sm-2">
														<select class="form-control" name="course<?=$acad_counter?>">
															<option value="10" <?= $academics['course']=='10'? 'selected ="selected"' : ' ';?>>10</option>		
															<option value="12" <?= $academics['course']=='12'? 'selected ="selected"' : ' ';?>>12</option>
															<option value="UG" <?= $academics['course']=='UG'? 'selected ="selected"' : ' ';?>>UG</option>	
															<option value="PG" <?= $academics['course']=='PG'? 'selected ="selected"' : ' ';?>>PG</option>																				
														</select>
													</td>
													<td class="col-sm-4">
														<input type="text" placeholder="Board/Course" name="course_name<?=$acad_counter?>" value="<?= htmlentities($academics['course_name'])?>" class="form-control"/>													
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Score in maths" name="math_score<?=$acad_counter?>" value="<?= htmlentities($academics['math_score'])?>" class="form-control"/>													
													</td>
													<td class="col-sm-2">
														<input type="mail" placeholder="Enter Percentage" name="percentage<?=$acad_counter?>" value="<?= htmlentities($academics['percentage'])?>" class="form-control"/>													
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter year" name="year_of_passout<?=$acad_counter?>" value="<?= htmlentities($academics['year_of_passout'])?>" class="form-control"/>													
													</td>
													<input type="hidden" id="findid" name="id<?=$acad_counter?>" value="<?= $academics['id']?>" class="form-control" />	
													<input type="hidden" id="removedid" name="removedid<?=$acad_counter?>" value=""/>													
													<td class="col-sm-1">
														<input type="button" class="ibtnDel btn btnprofile btn-delete"  value="Delete">
													</td>
												</tr>
												<?php $acad_counter++; ?>
											<?php endforeach; ?>   
											<input type="hidden" name="initial_acad_counter" value="<?=$acad_counter?>"/>		
											<input type="hidden" id="acad_counter" name="acad_counter" value="<?=$acad_counter?>">									
										</tbody>
										<tfoot>
											<tr>
												<td colspan="6" style="text-align: left;">
													<input type="button" id="acadaddrow" class="btn btn-lg btn-block btnprofile"  value="Add Row" />
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
											<?php $exp_counter = 1; ?>
											<?php foreach($experience_details as $experience): ?>   
												<tr>
													<td class="col-sm-1">
														<input type="text" placeholder="Date" name="start_date<?=$exp_counter?>" value="<?= htmlentities($experience['start_date'])?>" class="form-control" />
													</td>
													<td class="col-sm-1">
														<input type="text" placeholder="Date" name="end_date<?=$exp_counter?>" value="<?= htmlentities($experience['end_date'])?>" class="form-control" />
													</td>
													<td class="col-sm-3">
														<input type="text" placeholder="Enter Company Name Here.." name="company<?=$exp_counter?>" value="<?= htmlentities($experience['company'])?>" class="form-control"/>															
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter company location Here.." name="location<?=$exp_counter?>" value="<?= htmlentities($experience['location'])?>" class="form-control"/>
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter Designation Here.." name="position<?=$exp_counter?>" value="<?= htmlentities($experience['position'])?>" class="form-control"/>
													</td>
													<td class="col-sm-2">
														<input type="text" placeholder="Enter Reason Here.." name="reason_for_leaving<?=$exp_counter?>" value="<?= htmlentities($experience['reason_for_leaving'])?>" class="form-control"/>
													</td>
													<input type="hidden" id="exp_findid" name="exp_id<?=$exp_counter?>" value="<?= $experience['id']?>" class="form-control" />	
													<input type="hidden" id="exp_removedid" name="exp_removedid<?=$exp_counter?>" value=""/>												
													<td class="col-sm-1">
														<input type="button" class="ibtnDel btn btnprofile btn-delete "  value="Delete">
													</td>
												</tr>
												<?php $exp_counter++; ?>
											<?php endforeach; ?>  
											<input type="hidden" name="initial_exp_counter" value="<?=$exp_counter?>"/>		
											<input type="hidden" id="exp_counter" name="exp_counter" value="<?=$exp_counter?>">			 
										</tbody>
										<tfoot>
											<tr>
												<td colspan="7" style="text-align: left;">
													<input type="button" class="btn btn-lg btn-block btnprofile" id="addrow" value="Add Row" />
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
									<?php $skill_counter = 1; ?>
									<?php foreach($skill_details as $skill): ?>  
										<tr>
											<td class="col-sm-4">
												<input type="text" placeholder="Mention skill" name="title<?=$skill_counter?>" value="<?= htmlentities($skill['title'])?>" class="form-control" />
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="1" <?= $skill['score']=='1'? 'checked ="checked"' : ' ';?> >Low</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="2"<?= $skill['score']=='2'? 'checked ="checked"' : ' ';?>>Medium</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="3"<?= $skill['score']=='3'? 'checked ="checked"' : ' ';?>>High</label>
											</td>
											<td class="col-sm-2">
												<label><input type="radio" name="score<?=$skill_counter?>" value="4"<?= $skill['score']=='4'? 'checked ="checked"' : ' ';?>>Very high</label>
											</td>	
											<input type="hidden" id="skill_findid" name="skill_id<?=$skill_counter?>" value="<?= $skill['id']?>" class="form-control" />	
											<input type="hidden" id="skill_removedid" name="skill_removedid<?=$skill_counter?>" value=""/>																			
											<td class="col-sm-2">
												<input type="button" class="ibtnDel btn btnprofile btn-delete"  value="Delete">
											</td>
										</tr>
										<?php $skill_counter++; ?>
										<?php endforeach; ?>   
										<input type="hidden" name="initial_skill_counter" value="<?=$skill_counter?>"/>		
										<input type="hidden" id="skill_counter" name="skill_counter" value="<?=$skill_counter?>">			
									</tbody>
									<tfoot>
										<tr>
											<td colspan="6" style="text-align: left;">
												<input type="button" class="btn btn-lg btn-block btnprofile " id="skill_addrow" value="Add Row" />
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

			<input type="submit" id="profilesubmit" class="btn btnprofile submitprofile" value="Submit">
		</form> 
	</body>
</html>
<?php $content = ob_get_clean() ?>
<?php include 'user/templates/layout.tpl.php' ?>