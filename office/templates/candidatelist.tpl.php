
<?php ob_start() ?>
<?php $count = 0;?>
<!-- TABLE: LATEST ORDERS -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Candidate list
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="#">candiadtes</a></li>
  </ol>
</section>
<div class="row">
  <div class="col-xs-12">
    <div class="box box-default collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">Filter</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
  <!-- /.box-header -->
      <div class="box-body">
        <table>
          <tbody>
            <tr>
              <td>min Math mark:</td>
              <td>max math mark</td>
            </tr>
            <tr>
              <td>
              <input type="text" value="" class="slider" id="min_math">
              </td>
              <td>
              <input type="text" value="" class="slider" id="max_math">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    <!-- /.box-body -->
    </div>
  <!-- /.box -->
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Full list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="candidateList" class="table table-bordered table-striped">
            <thead>
              <th><h3>Reg.No</h3></th>
              <th><h3>Name</h3></th>
              <th><h3>Email</h3></th>
              <th><h3>Phone</h3></th>
              <th><h3>Course</h3></th>
              <th><h3>+2 Maths score</h3></th>
              <th><h3>Experience</h3></th>
            </thead>
            <tbody>
              <?php foreach($candidates as $candidate):?>
                <tr>
                  <td><?=$candidate['id']?></td>
                  <td><a href="/admin/score_management/showprofile?pid=<?= $candidate['id']?>"><?= $candidate['name']?></a></td>
                  <td><?= $candidate['email']?></td>
                  <td><?=$candidate['phone']?></td>
                  <?php foreach($acadamics as $acadamic){
                    if($candidate['id']==$acadamic['part_id']){
                      if($acadamic['course']=="UG"){
                        $course_name = $acadamic['course_name'];
                      }
                      if($acadamic['course']=="12"){
                        $math_score = $acadamic['math_score'];
                      }
                    }
                  }
                  ?>
                  <td><?=$course_name?></td>
                  <td><?=$math_score?></td>
                  <?php 
                    $var =new DateTime();
                    $var_temp =new DateTime();
                    $expr = new DateInterval('P0Y0M');
                    foreach($experience as $experiences){
                      if($candidate['id']==$experiences['part_id']){
                        $d1 = date_create($experiences['start_date']);
                        $d2 = date_create($experiences['end_date']);
                        $exp = date_diff($d1,$d2);
                        $var_temp->add($exp);
                        $var_temp->add($expr);
                        $expr = date_diff($var,$var_temp);
                      }
                    } 
                    $exp = $expr->format('%y Year %m Month');
                  ?>  
                  <td><?=$exp?></td>             
                </tr>
              <?php endforeach;?>
            </tbody>
            <tfoot>
              <th><h3>Reg.No</h3></th>
              <th><h3>Name</h3></th>
              <th><h3>Email</h3></th>
              <th><h3>Phone</h3></th>
              <th><h3>Course</h3></th>
              <th><h3>Maths_score</h3></th>
              <th><h3>Experience</h3></th>
            </tfoot>
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
<!-- /.box -->
<?php $content=ob_get_clean();?>
<?php include 'layout.tpl.php'?>