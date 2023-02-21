<?php 
require_once('auth_admin.php');
if(!isset($_GET['wc_c'])){
    header('location:acu.php');
}
$cu = $_GET['wc_c'];
require_once('conn.php');

$t_name='';
$ans=[];
$rans=0;
if(isset($_GET['wc_qu'])){
    $stmt = mysqli_prepare($conn,"SELECT * from questions WHERE queid = ?");
    mysqli_stmt_bind_param($stmt,'i',$_GET['wc_qu']);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_row($result)){
        $question = $row[1];
        $ans = explode('|&;',$row[2]);
        $rans= $row[3];
    }
    else{
        header('location:home.php');
    }
}
require_once('header.php');
?>

<div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Author Question</h2>
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
                            <form action="update.php" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
                                <input type="hidden" name="wc_que" value="<?php if(isset($_GET['wc_qu'])){echo $_GET["wc_qu"];}?>">
                                <input type="hidden" name="wc_t" value="<?php echo $topic;?>">
                                <input type="hidden" name="wc_q" value="<?php echo $quiz;?>">
                                <div class="input-group mb-3">
                                    <label for="description" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 mb-2">Question:</label>
                                    <textarea name="question" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" rows="3" required><?php echo $question;?></textarea>
                                </div>
                                <table class="table table-hover table-striped mt-3">
                                <tbody>
                                    <?php
                                    $c=0;
                                    foreach($ans as $a){?>
                                    <tr>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="radio" name="rans" value="<?php echo $c+1;?>" <?php if($rans==$c+1){echo 'checked';}?>>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <textarea name="ans<?php echo $c+1;?>" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" rows="3" required><?php echo $a;?></textarea>
                                            </div>
                                        </td>
                                        <td class="tm-trash-icon-cell">
                                            <a href="editquestion.php?wc_qu=<?php echo $q[0];?>"><i class="fas fa-arrow-up"></i></a></td>
                                        </td>
                                        <td class="tm-trash-icon-cell">
                                            <a href=""><i class="fas fa-arrow-down"></i></a></td>
                                        </td>
                                        <td class="tm-trash-icon-cell">
                                            <a href="delete_answer.php?wc_q=<?php echo $quiz;?>$wc_t=<?php echo $topic;?>&wc_que=<?php echo $_GET['wc_qu'];?>&wc_a=<?php echo $c;?>"><i class="fas fa-trash"></i></a></td>
                                        </td>

                                    </tr>
                                    <?php $c++;} ?>
                                </tbody>
                                </table>

                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="update_question" type="submit" class="btn btn-primary" value="memedan">Update Question</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Actions</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <?php if(isset($_GET['wc_qu'])){?>
                                <tr>
                                    <td><a href="add_answer.php?wc_q=<?php echo $quiz;?>&wc_que=<?php echo $_GET['wc_qu'];?>">Add Answer</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-plus"></i></td>
                                </tr>
                                <tr>
                                    <td><a href="delete_answer.php?wc_q=<?php echo $quiz;?>$wc_t=<?php echo $topic;?>&wc_que=<?php echo $_GET['wc_qu'];?>">Clear All Answers</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-trash"></i></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><a href="editnotes.php?wc_t=<?php echo $topic;?>">View Quiz</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-arrow-back"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require('footer.php');
?>