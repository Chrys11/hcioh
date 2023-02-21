<?php
$topic='';
if(isset($_GET['wc_t'])){
    $topic = $_GET['wc_t'];
}
else{
    header('location:quiz.php');
}
$mks=0;
if(isset($_COOKIE['wc_m'])){
    echo $_COOKIE['wc_m'];
    $mks = $_COOKIE['wc_m'];
}
else{
    setcookie('wc_m',0);
}
require_once('conn.php');
$stmt = mysqli_prepare($conn,'SELECT quiz FROM topics WHERE toid=?');
mysqli_stmt_bind_param($stmt,'i',$topic);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$quiz=0;
if($row = mysqli_fetch_row($result)){
    $quiz = $row[0];
}

$stmt = mysqli_prepare($conn,'SELECT * FROM quizzes WHERE qid=?');
mysqli_stmt_bind_param($stmt,'i',$quiz);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$q_no=0;
$questions=[];
if($row = mysqli_fetch_row($result)){
    $q_no = $row[1];
    for($i=0;$i<$q_no;$i++){
        $question = $row[2+$i];
        $stm = mysqli_prepare($conn,'SELECT * FROM questions WHERE queid=?');
        mysqli_stmt_bind_param($stm,'i',$question);
        mysqli_execute($stm);
        $res = mysqli_stmt_get_result($stm);
        if($r = mysqli_fetch_row($res)){
            array_push($questions,$r[0],$r[1],$r[2],$r[3]);
        }
    }
}
$pos=0;
if(isset($_GET['wc_p'])){
    $pos=$_GET['wc_p'];
}
require_once('header.php');
?>
            <!-- row -->
            <input type="hidden" id="wc_cm" value="<?php echo $mks;?>">
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                <input type="hidden" id="wc_ca" value="<?php echo $questions[$pos*4+3];?>">
                    <?php
                    if($pos==0){
                        echo '<script> document.cookie="wc_m=0"; </script>';
                    }
                    ?>
                    <?php if($pos<$q_no-1){?>
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block"><?php echo $questions[$pos*4+1];?></h2>

                            </div>
                            <div class="col-md-4 col-sm-12 text-right">
                                <a onclick="next_q()" style="background-color:yellow;" href="assess.php?wc_t=<?php echo $topic?>&wc_p=<?php echo $pos+1;?>" class="btn btn-small btn-primary">Next</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <!--iframe src="" height="600px" width="600px"></iframe-->
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <tbody>
                                <?php
                                    $answers=explode('|&;',$questions[$pos*4+2]);
                                    $ac=1;
                                    foreach($answers as $ans){
                                ?>
                                <tr>
                                    <td class="tm-product-name"><input type="radio" name="wc_cc" value="<?php echo $ac;?>"></td>
                                    <td class="tm-product-name"><?php echo $ans;?></td>
                                </tr>
                                <?php $ac++;}?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-12 text-left">
                                <a onclick="next_q()" style="background-color:yellow;" href="assess.php?wc_t=<?php echo $topic?>&wc_p=<?php echo $pos+1;?>" class="btn btn-small btn-primary">Next</a>
                            </div>
                    </div>
                    <?php }elseif($pos==$q_no-1){?>
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block"><?php echo $questions[$pos*4+1];?></h2>

                            </div>
                            <div class="col-md-4 col-sm-12 text-right">
                                <a onclick="next_q()" style="background-color:green" href="assesser.php?wc_t=<?php echo $topic?>&wc_q=<?php echo $quiz;?>" class="btn btn-small btn-primary">Finish</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <!--iframe src="" height="600px" width="600px"></iframe-->
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <tbody>
                                <?php
                                    $answers=explode('|&;',$questions[$pos*4+2]);
                                    $ac=1;
                                    foreach($answers as $ans){
                                ?>
                                <tr>
                                    <td class="tm-product-name"><input type="radio" name="wc_cc" value="<?php echo $ac;?>"></td>
                                    <td class="tm-product-name"><?php echo $ans;?></td>
                                </tr>
                                <?php $ac++;}?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 col-sm-12 text-left">
                                <a onclick="next_q()" href="assesser.php?wc_t=<?php echo $topic?>&wc_q=<?php echo $quiz;?>" style="background-color:green" class="btn btn-small btn-primary">Finish</a>
                            </div>
                    </div>
                    <?php }?>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Questions</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <?php
                                /*$cid=1;
                                require_once("conn.php");
                                $stmt = mysqli_prepare($conn,'SELECT topics FROM course_units WHERE cid=?');
                                mysqli_stmt_bind_param($stmt,'i',$cid);
                                mysqli_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $topics=[];
                                if($row = mysqli_fetch_row($result)){
                                    $topics = explode(',',$row[0]);
                                }*/
                                //print_r($topics);
                                for($c=0;$c<$q_no;$c++){
                                    //echo $name;
                                ?>
                                <tr>
                                    <td><!--a href="assess.php?wc_t=<?php //echo $topic;?>&wc_p=<?php //echo $c;?>"--><?php echo ($c+1).'. '.$c+1 . ' / '.$q_no; ?></a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-check"></i></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require('footer.php');
?>