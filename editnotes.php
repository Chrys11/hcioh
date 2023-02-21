<?php 
if(!isset($_GET['wc_t'])){
    header('location:topics.php');
}
$topic= $_GET['wc_t'];
require_once('conn.php');
$stmt = mysqli_prepare($conn,"SELECT notes,name from topics WHERE toid = ?");
mysqli_stmt_bind_param($stmt,'i',$topic);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$t_name = '';
$t_notes = '';
if($row = mysqli_fetch_row($result)){
    $t_name = $row[1];
    $t_notes = $row[0];
}
else{
    header('location:home.php');
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
                            <iframe src="<?php echo $t_notes;?>" height="600px" width="600px"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Actions</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <tr>
                                    <td><a href="u_notes.php?wc_t=<?php echo $topic;?>">Update Notes</a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-pen"></i></td>
                                </tr>
                                <tr>
                                    <td><a href="editquiz.php?wc_t=<?php echo $topic;?>">View Quiz</a></td>
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