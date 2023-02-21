<?php
require_once('auth_admin.php');
require_once("conn.php");
$type='';
$cu=NULL;
if(!isset($_GET['wc_c'])){
    if(!isset($_GET['wc_t'])){
        header('location:home.php');
    }
    else{
        $cu = $_GET['wc_t'];
        $type='t';
    }
}
else{
    $cu = $_GET['wc_c'];
    $type='cu';
}
require_once('header.php');
?>
            <!-- row -->
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Your Topics</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <form action="aat.php" method="post">
                                    <input type="hidden" name="wc_c" value="<?php echo $cu;?>">
                                    <input type="hidden" name="wc_type" value="<?php echo $type;?>">
                                <?php
                                $topics=NULL;
                                $stmt = mysqli_prepare($conn,'SELECT * FROM topics');
                                mysqli_execute($stmt);
                                $topics = mysqli_stmt_get_result($stmt);
                                $i=0;
                                while($row = mysqli_fetch_row($topics)){
                                    $stmt=NULL;
                                    if($type=='cu'){
                                        $stmt = mysqli_prepare($conn,'SELECT topics FROM course_units WHERE cid=?');
                                        mysqli_stmt_bind_param($stmt,'i',$cu);
                                    }
                                    elseif($type=='t'){
                                        $stmt = mysqli_prepare($conn,'SELECT topics FROM teachers WHERE tid=?');
                                        mysqli_stmt_bind_param($stmt,'s',$cu);
                                    }
                                    mysqli_execute($stmt);
                                    $i_topics = mysqli_stmt_get_result($stmt);
                                    $skip = false;
                                    $its=[];
                                    while($r = mysqli_fetch_row($i_topics)){
                                        if($r[0]!=''){
                                            $its = explode(',',$r[0]);
                                        }
                                    }
                                    foreach($its as $it){
                                        if($it == $row[0]){
                                            $skip = true;
                                            break;
                                        }
                                    }
                                    if(!($skip)){
                                ?>
                                <tr id="<?php echo $row[0]?>">
                                    <td class="tm-trash-icon-cell"><input type="checkbox" name="<?php echo $row[0]?>" value="1" onchange="document.cookie='wc_c=<?php echo $cu;?>';upbgcolors()"></td>
                                    <td><a href="topics.php?wc_t=<?php echo $row[0]?>"><?php echo $i+1; ?>. <?php echo $row[1];?> </a></td>
                                </tr>
                                <?php $i++;}} ?>
                                <tr>
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="addtopics" type="submit" class="btn btn-primary" value="memedan">Add Topics</button>
                                    </div>
                                </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require('footer.php');
?>