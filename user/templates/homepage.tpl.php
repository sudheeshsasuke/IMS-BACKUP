    
    <?php ob_start();?>
   
    <!-- Services -->
    <section id="interviews" >
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center">
            <?php if(isset($_SESSION['id'])):?> 
            <h1 class="section-heading text-uppercase">Welcome to zyxware careers 
              <span style="color: red;">
                <?php echo strtoupper(htmlentities($_SESSION['username']));?>
              </span>
            </h1>
            <?php else:?>
            <h1 class="section-heading text-uppercase">Zyxware Interviews</h1>
            <h3 class="section-subheading text-muted">
              Explore a world of opportunities with Zyxware. Learn, grow, and build a great career!
            </h3>
            <?php endif;?>
            
            <hr>

            <!--interview list-->
            <div class="row">
               
              <?php if(isset($_SESSION['id'])):?> 
              <!--applied interviews-->
              <div class="col-xs-12 appliedinterviews">              
                <div class="appliedinterviews" >

                  <h2 class="section-heading text-uppercase" style="color: black;">Applied interviews</h2>                                      
                    <div class="printhere">
                      <input type="hidden" id="statusresult" value="<?=$result2?>">
                      <ol>
                        <?php foreach($result as $results):?>
                          <li > 
                            <div class="list-interview">
                              <h3 class="interviewtitle">
                                <a class ="<?= $results['int_id'];?>" href="http://ims.com/user/applied_for_interview?interview_id=<?php echo $results['id']?>&flag=1">
                                    <?php echo strtoupper(htmlentities($results['title']));?> - 
                                    <?php echo htmlentities($results['location']);?> - 
                                    <?php echo htmlentities($results['start_date']);?> 
                                </a>
                              </h3>
                              <div class="interviewstatus">
                                <input type="hidden" id="status" value="<?= $results['int_id']?>">
                                <button class="statusdetails"id="<?= $results['int_id']?>" value="<?= $results['int_id']?>" data-toggle="modal" data-target="#myModal"><?php echo strtoupper(htmlentities($results['status']));?></button>
                              </div>

                              <!-- Modal -->
                              <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Status</h4>
                                    </div>
                                    <div class="modal-body">
                                      
                                   </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                              

                              <!--social media sharing-->
                              <div id="share-buttons">
                                <ul class="list-inline social-buttons">
                                  <li class="list-inline-item facebook">
                                    <!-- Facebook -->
                                    <a href="http://www.facebook.com/sharer.php?u=http://ims.com/user/apply_for_interview?interview_id=<?php 
                                  echo $results['int_id']?>" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                  </li>
                                  <li class="list-inline-item gplus">
                                    <!-- Google+ -->
                                    <a href="https://plus.google.com/share?url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                                  echo $results['int_id']?>" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                  </li>
                                  <li class="list-inline-item linkedin">
                                    <!-- LinkedIn -->
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                                  echo $results['int_id']?>" target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                  </li>
                                  <li class="list-inline-item twitter">
                                    <!-- Twitter -->
                                    <a href="https://twitter.com/share?url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                                  echo $results['int_id']?>&amp;text=Zyxware%20Interview&amp;hashtags=ZyxwareInterview" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </li>
                          <?php endforeach; ?> 
                      </ol>                     
                  
                    </div>

                </div>                  
              </div>              
              <div class="col-xs-12">
                <hr>
              </div>
              <?php endif?>

              <!--all interviews-->
              <div id="getheight" class="col-xs-12">
                <h2 class="section-heading text-uppercase" style="color: grey;">All Interviews</h2>
                <ol> 
                <?php $count = 0;?>
                <?php foreach($interviews as $interview):?>
                  <li class ="<?= $interview['id'];?>">
                    <div class="list-interview">
                      <h3 class="interviewtitle">
                        <a class ="<?= $interview['id'];?>" href="http://ims.com/user/apply_for_interview?interview_id=<?php 
                        echo $interview['id']?>">
                          <?php echo strtoupper(htmlentities($interview['title']));?> -
                          <?php echo htmlentities($interview['location']);?> - 
                          <span style="color:red !important;">
                            <?php echo htmlentities($interview['start_date']);?>
                          </span>
                          </a>
                      </h3>                      
                      <?php if(isset($_SESSION['id'])): ?>
                        <button class="homeapply apply btn " type="button" class="<?= $interview['id'];?>" value="<?= $interview['id'];?>"> APPLY </button> 
                      <?php else :?>
                      <button class="homeapply homepageapply btn " type="button" class="<?= $interview['id'];?>" value="<?= $interview['id'];?>"> APPLY </button> 
                      <?php endif;?>
                      <!--social media sharing-->
                      <div id="share-buttons">
                        <ul class="list-inline social-buttons">
                          <li class="list-inline-item facebook">
                            <!-- Facebook -->
                            <a href="http://www.facebook.com/sharer.php?u=http://ims.com/user/apply_for_interview?interview_id=<?php 
                          echo $interview['id']?>" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                          </li>
                          <li class="list-inline-item gplus">
                            <!-- Google+ -->
                            <a href="https://plus.google.com/share?url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                          echo $interview['id']?>" target="_blank">
                                <i class="fa fa-google-plus"></i>
                            </a>
                          </li>
                          <li class="list-inline-item linkedin">
                            <!-- LinkedIn -->
                            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                          echo $interview['id']?>" target="_blank">
                                <i class="fa fa-linkedin"></i>
                            </a>
                          </li>
                          <li class="list-inline-item twitter">
                            <!-- Twitter -->
                            <a href="https://twitter.com/share?url=http://ims.com/user/apply_for_interview?interview_id=<?php 
                          echo $interview['id']?>&amp;text=Zyxware%20Interview&amp;hashtags=ZyxwareInterview" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                  </div>
                  </li>
                <?php endforeach;?>
                </ol>
              </div>
              
          </div>
        </div>
      </div>
    </section >
    <?php
    
    //set hompage bol variable
    $GLOBALS['isHome'] = true;
    $content = ob_get_clean();
    require 'layout.tpl.php';
    ?>
