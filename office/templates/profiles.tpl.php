<?php ob_start() ?>
    
        <form action = "http://ims.com/index.php/user/submit_profile" method = "post" enctype="multipart/form-data">
            <div class="container">
                <h1 class="well">Personal Info</h1>
                <div class="col-lg-12 well">
                    <div class="row">       
                        <div class="col-sm-12">
                        <?php foreach($personal_details as $personalinfo): ?>      
                                <div class="row">
                                    <div class="col-sm-12 form-group">
                                        <label>Name</label><br>
                                        <?= htmlentities($personalinfo['name'])?>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                            <label>Phone Number</label><br>
                                            <?= htmlentities($personalinfo['phone'])?>
                                    </div>      
                                    <div class="col-sm-6 form-group">
                                        <label>Email Address</label><br>
                                        <?= htmlentities($personalinfo['email'])?>
                                    </div>
                                </div>  
                                <div class="row">                                                   
                                    <div class="col-sm-6 form-group">
                                    
                                    <a href = "http://ims.com/<?=htmlentities($personalinfo['resume'])?>"><button type="button" class=" btn-danger"> download resume </button></a>
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
                                                        <?= htmlentities($academics['course'])?>                              
                                                    </td>
                                                    <td class="col-sm-2">
                                                        <?= htmlentities($academics['course_name'])?>                              
                                                    </td>
                                                    <td class="col-sm-2">
                                                        <?= htmlentities($academics['math_score'])?>                                                  
                                                    </td>
                                                    <td class="col-sm-2">
                                                    <?= htmlentities($academics['percentage'])?>                                              
                                                    </td>
                                                    <td class="col-sm-4">
                                                    <?= htmlentities($academics['year_of_passout'])?>                                             
                                                    </td>
                                                    <td class="col-sm-2"><a class="deleteRow"></a>
                                                    </td>    
                                                </tr>
                                                <?php $acad_counter++; ?>
                                            <?php endforeach; ?>   
                                            <input type="hidden" name="initial_acad_counter" value="<?=$acad_counter?>"/>       
                                            <input type="hidden" id="acad_counter" name="acad_counter" value="<?=$acad_counter?>">                                  
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <script type ="text/javascript" src = "http://ims.com/user/profile/academics.js"></script>  
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
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['start_date'])?>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['end_date'])?>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['company'])?>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['location'])?>
                                                        </td>
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['position'])?>
                                                        <td class="col-sm-2">
                                                            <?= htmlentities($experience['reason_for_leaving'])?>
                                                        </td>     
                                                    </tr>
                                                <?php endforeach; ?>  
                                                <input type="hidden" name="initial_exp_counter" value="<?=$exp_counter?>"/>     
                                                <input type="hidden" id="exp_counter" name="exp_counter" value="<?=$exp_counter?>">          
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                        <script type ="text/javascript" src = "http://ims.com/user/profile/experience.js"></script> 
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
                                            <?php foreach($skill_details as $skill): ?>  
                                                <tr>
                                                    <td class="col-sm-2">
                                                        <?= $skill['title']?>
                                                    </td>
                                                    <?php if ($skill['score'] == 1) : ?>
                                                        <td class="col-sm-2">
                                                            low
                                                        </td>
                                                    <?php elseif ($skill['score'] == 2):?>
                                                        <td class="col-sm-2">
                                                            medium
                                                        </td>
                                                    <?php elseif ($skill['score'] == 3):?>
                                                        <td class="col-sm-2">
                                                            high
                                                        </td>
                                                    <?php elseif ($skill['score'] == 3):?>
                                                        <td class="col-sm-2">
                                                            very high
                                                        </td>
                                                    <?php endif; ?>
                                                
                                                </tr>
                                            <?php endforeach; ?>   
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                <script type ="text/javascript" src = "http://ims.com/user/profile/skill.js"></script>  
                            </div>
                        </div>              
                    </div>
                </div>
            </div>

            
        </form> 
<?php $content = ob_get_clean() ?>
<?php include 'layout.tpl.php' ?>