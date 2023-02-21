<?php
require_once("conn.php");
$stmt = mysqli_prepare($conn,'SELECT * FROM course_units');
mysqli_execute($stmt);
$courseunits = mysqli_stmt_get_result($stmt);
if(!isset($_GET['wc_c'])){
    if($row = mysqli_fetch_row($courseunits)){
        $cu = $row[0];
    }
    else{
        header('location:home.php');
    }
}
else{
    $cu = $_GET['wc_c'];
}
require_once('header.php');
?>
            <!-- row -->
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <h2 class="tm-block-title d-inline-block">Topics</h2>

                            </div>
                            <!--div class="col-md-4 col-sm-12 text-right">
                                <a href="add-product.html" class="btn btn-small btn-primary">Add New Product</a>
                            </div-->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <thead>
                                    <tr class="tm-bg-gray">
                                        <th scope="col">&nbsp;</th>
                                        <th scope="col">Topic Name</th>
                                        <th scope="col" class="text-center">Credit Units</th>
                                        <th scope="col" class="text-center">Performance</th>
                                        <th scope="col">Coverage Date</th>
                                        <th scope="col">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once("conn.php");
                                    $stmt = mysqli_prepare($conn,'SELECT topics FROM course_units WHERE cid=?');
                                    mysqli_stmt_bind_param($stmt,'i',$cu);
                                    mysqli_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    $topics=[];
                                    if($row = mysqli_fetch_row($result)){
                                        $topics = explode(',',$row[0]);
                                    }
                                    $c=0;
                                    foreach($topics as $topic){
                                        $stm = mysqli_prepare($conn,'SELECT * FROM topics WHERE toid=?');
                                        mysqli_stmt_bind_param($stm,'i',$topic);
                                        mysqli_execute($stm);
                                        $res = mysqli_stmt_get_result($stm);
                                        $t_name='';
                                        if($row = mysqli_fetch_row($res)){
                                            $t_name = $row[1];
                                        }
                                        $stm = mysqli_prepare($conn,'SELECT rating FROM topics_rating WHERE topic=?');
                                        mysqli_stmt_bind_param($stm,'i',$topic);
                                        mysqli_execute($stm);
                                        $res = mysqli_stmt_get_result($stm);
                                        $rating_sum=0;
                                        $rating_number=0;
                                        if($row = mysqli_fetch_row($res)){
                                            $rating_sum += $row[0];
                                            $rating_number++;
                                        }
                                        $average_rating=0;
                                        if($rating_number>0){
                                            $average_rating = $rating_sum / $rating_number;
                                        }
                                        $star1=$average_rating>=1;
                                        $star2=$average_rating>=2;
                                        $star3=$average_rating>=3;
                                        $star4=$average_rating>=4;
                                        $star5=$average_rating>=5;
                                    ?>
                                    <tr style="background-color:lightgreen">
                                        <th scope="row">
                                            <?php if($rating_number==0){?>
                                                <i class="fa fa-check" style="color:green"></i>
                                            <?php } else { ?>
                                                <i class="fa fa-star" style="color:<?php if($star1){echo 'gold';}else{echo 'black';}?>"></i>
                                                <i class="fa fa-star" style="color:<?php if($star2){echo 'gold';}else{echo 'black';}?>"></i>
                                                <i class="fa fa-star" style="color:<?php if($star3){echo 'gold';}else{echo 'black';}?>"></i>
                                                <i class="fa fa-star" style="color:<?php if($star4){echo 'gold';}else{echo 'black';}?>"></i>
                                                <i class="fa fa-star" style="color:<?php if($star5){echo 'gold';}else{echo 'black';}?>"></i>
                                            <?php } ?>
                                        </th>
                                        <td class="tm-product-name"><a onclick="document.cookie = 'cid=<?php echo $cu;?>';document.cookie = 't_pt=<?php echo $topic;?>'" href="work.php">P<?php echo $topic.'. '.$t_name;?></a></td>
                                        <td class="text-center">12</td>
                                        <td class="text-center">60</td>
                                        <td>2022-10-28</td>
                                        <td class="tm-tick-icon-cell"><i class="fa fa-comments" style="color:yellow"></i></td>
                                    </tr>
                                    <?php $c++; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Your Courses</h2>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <?php
                                require_once("conn.php");
                                $cu1=NULL;
                                $cu2 = NULL;
                                $stmt = mysqli_prepare($conn,'SELECT cu1,cu2 FROM students WHERE sid=?');
                                mysqli_stmt_bind_param($stmt,'s',$stno);
                                mysqli_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                if($ro = mysqli_fetch_row($result)){
                                    $cu1 = $ro[0];
                                    $cu2 = $ro[1];
                                }
        
                                $stmt = mysqli_prepare($conn,'SELECT * FROM course_units WHERE cid=? OR cid=?');
                                mysqli_stmt_bind_param($stmt,'ii',$cu1,$cu2);
                                mysqli_execute($stmt);
                                $courseunits = mysqli_stmt_get_result($stmt);
                                $i=0;
                                while($row = mysqli_fetch_row($courseunits)){
                                ?>
                                
                                <tr>
                                    <td><a href="cu.php?wc_c=<?php echo $row[0]?>"><?php echo $i+1; ?>. <?php echo $row[1];?></a></td>
                                    <td class="tm-trash-icon-cell"><i class="fas fa-check"></i></td>
                                </tr>
                                
                                <?php $i++;} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
require('footer.php');
?>