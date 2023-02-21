<?php 
if(!isset($_GET['wc_t'])){
    header('location:topics.php');
}
$topic= $_GET['wc_t'];
require_once('conn.php');
$stmt = mysqli_prepare($conn,"SELECT quiz,name from topics WHERE toid = ?");
mysqli_stmt_bind_param($stmt,'i',$topic);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$t_name = '';
$t_quiz = 0;
if($row = mysqli_fetch_row($result)){
    $t_name = $row[1];
    $t_quiz = $row[0];
}
else{
    header('location:home.php');
}
$questions=[];
$stmt = mysqli_prepare($conn,"SELECT * from quizzes WHERE qid = ?");
mysqli_stmt_bind_param($stmt,'i',$t_quiz);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$q_no=0;
if($row = mysqli_fetch_row($result)){
    $q_no = $row[1];
    for($i = 2;$i<$q_no+2;$i++){
        array_push($questions,$row[$i]);
    }
}
$q_map=[];
foreach($questions as $q){
    $stmt = mysqli_prepare($conn,"SELECT * from questions WHERE queid = ?");
    mysqli_stmt_bind_param($stmt,'i',$q);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($result)){
        array_push($q_map,[$q,$row[1]]);
    }
}
require_once('header.php');
?>

<div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block"><?php echo $t_name;?></h2>
                                <!--?php if(!$no_assess){ if((int) $max_m == (int) $latest_m){?>
                                <br><h4 class="tm-block-title d-inline-block" style="color:blue">Score : <?php// echo $max_m;?>%</h4>
                                <?php //}else{ ?>
                                <br><h4 class="tm-block-title d-inline-block" style="color:blue;font-size:20px">Max Score : <?php //echo $max_m;?>%</h4>
                                <h4 class="tm-block-title d-inline-block" style="color:green;font-size:20px">Latest Score : <?php //echo $max_m;?>%</h4>
                                <?php //}} ?> -->
                            </div>
                            <!--div class="col-md-4 col-sm-12 text-right">
                                <a href="assess.php?wc_t=<?php //echo $tpc?>"style="color:<?php //if($no_assess){echo 'green';}else{echo 'blue';}?>" class="btn btn-small btn-primary"><?php //if($no_assess){ echo 'Assessment';}else{ echo 'Re-assess';}?></a>
                            </div-->
                        </div>

                        <div class="table-responsive">
                            <!--iframe src="<?php //echo $t_notes;?>" height="600px" width="600px"></iframe-->
                            <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <?php
                                $bg_colors=['red','yellow','green'];
                                $c=0;
                                foreach($q_map as $q){?>
                                <tr style="background-color:<?php echo $bg_colors[$c%count($bg_colors)];?>">
                                    <td><?php echo 'Q. ' . $q[0]?></td>
                                    <td colspan=3><?php echo ' '.$q[1]?></a></td>
                                </tr>
                                <tr style="background-color:<?php echo $bg_colors[$c%count($bg_colors)];?>">
                                    <td class="tm-trash-icon-cell"><a href="editquestion.php?wc_t=<?php echo $topic;?>&wc_qu=<?php echo $q[0];?>&wc_q=<?php echo $t_quiz;?>"><i class="fas fa-pen"></i></a></td>
                                    <td class="tm-trash-icon-cell"><a href="delete_question.php?wc_t=<?php echo $topic;?>&wc_q=<?php echo $t_quiz;?>&wc_qu=<?php echo $q[0];?>"><i class="fas fa-trash"></i></a></td>
                                    <td class="tm-trash-icon-cell"><a href=""><i class="fas fa-arrow-up"></i></a></td>
                                    <td class="tm-trash-icon-cell"><a href=""><i class="fas fa-arrow-down"></i></a></td>
                                </tr>
                                <?php $c++; }?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Actions</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <tr>
                                    <td><a href="editquestion.php?wc_q=<?php echo $t_quiz;?>&wc_t=<?php echo $_GET['wc_t'];?>">Add Question</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-plus"></i></td>
                                </tr>
                                <tr>
                                    <td><a href="delete_question.php?wc_t=<?php echo $topic;?>&wc_q=<?php echo $t_quiz;?>">Clear Quiz</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-trash"></i></td>
                                </tr>
                                <tr>
                                    <td><a href="u_quiz.php?wc_t=<?php echo $topic;?>">View Performance</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-list-alt"></i></td>
                                </tr>
                                <tr>
                                    <td><a href="editnotes.php?wc_t=<?php echo $topic;?>">View Notes</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-eye"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require('footer.php');
?>