<?php
require_once('auth_admin.php');

require_once("conn.php");
$stmt = mysqli_prepare($conn,'SELECT cid FROM course_units ORDER BY cid ASC');
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
$c_name='';
$stmt = mysqli_prepare($conn,'SELECT name FROM course_units WHERE cid=?');
mysqli_stmt_bind_param($stmt,'i',$cu);
mysqli_execute($stmt);
$results = mysqli_stmt_get_result($stmt);
if($row = mysqli_fetch_row($results)){
    $c_name = $row[0];
}
require_once('header.php');
?>
            <!-- row -->
            <div class="row tm-content-row tm-mt-big">
                <div class="col-xl-8 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-md-8 col-sm-12">
                                <div id="showell">
                                    <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                        <tr>
                                            <th><h2 class="tm-block-title d-inline-block"><?php if($c_name==''){ echo 'Topics';} else{ echo $c_name;}?></h2></th>
                                            <th><h2 class="tm-block-title d-inline-block"><i onclick="document.getElementById('showell').style.display ='none';document.getElementById('rename_cu').style.display='block';" title="Rename." class="fa fa-pen"></i></h2></th>
                                            <th><h2 class="tm-block-title d-inline-block"><a href="addtopic.php?wc_c=<?php echo $cu?>"><i title="Add topics." class="fa fa-plus"></i></a></h2></th>
                                            <th><h2 class="tm-block-title d-inline-block"><a href="delete_topic.php?wc_c=<?php echo $cu?>"><i title="Clear all topics." class="fa fa-trash"></i></a></h2></th>
                                        </tr>
                                    </table>
                                </div>
                                <div id="rename_cu" style="display:none">
                                    <form action="aac.php" method="post" class="tm-edit-product-form">
                                        <input type="hidden" name="wc_c" value="<?php echo $cu;?>">
                                        <div class="input-group mb-3">
                                            <label for="description" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 mb-2">New name:</label>
                                            <textarea name="cu_name" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" rows="2" required><?php echo $c_name;?></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                                <button name="rename_cu" type="submit" class="btn btn-primary" value="memedan">Rename</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--div class="col-md-4 col-sm-12 text-right">
                                <a href="add-product.html" class="btn btn-small btn-primary">Add New Product</a>
                            </div-->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped tm-table-striped-even mt-3">
                                <thead>
                                    <tr class="tm-bg-gray">
                                        <th colspan=2 scope="col">Topic Name</th>
                                        <th scope="col">Remove</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col" class="text-center">High Performance</th>
                                        <th scope="col" class="text-center">Low Performance</th>
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
                                        if($row[0]!=''){
                                            $topics = explode(',',$row[0]);
                                    
                                        }
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
                                    ?>
                                    <tr style="background-color:lightgreen">
                                        <td colspan=2 class="tm-product-name"><a href="topics.php?wc_t=<?php echo $topic;?>">P<?php echo $topic.'. '.$t_name;?></a></td>
                                        <th scope="row"><a href="delete_topic.php?wc_t=<?php echo $topic;?>&wc_c=<?php echo $cu;?>"><i title="Remove topic." style="color:red" class="fa fa-trash"></i></a></th>
                                        <th scope="row"><a href="topics.php?wc_t=<?php echo $topic;?>"><i title="Edit topic." style="color:blue" class="fa fa-pen"></i></a></th>
                                        <td class="text-center">75</td>
                                        <td class="text-center">34</td>
                                        <td class="tm-tick-icon-cell"><i class="fa fa-comments" style="color:green"></i></td>
                                    </tr>
                                    <?php $c++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-12 tm-md-12 tm-sm-12 tm-col">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title d-inline-block">Course Units</h2>
                        <h2 class="tm-block-title d-inline-block"><i onclick="document.getElementById('new_cu').style.display = 'block';" title="Add Course unit." class="fa fa-plus"></i></h2>
                        <div id="new_cu" style="display:none">
                            <form action="aac.php" method="post" class="tm-edit-product-form">
                                <div class="input-group mb-3">
                                <label for="description" class="col-xl-4 col-lg-4 col-md-4 col-sm-5 mb-2">Course Unit Name:</label>
                                    <textarea name="cu_name" class="form-control validate col-xl-9 col-lg-8 col-md-8 col-sm-7" rows="2" required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="ml-auto col-xl-8 col-lg-8 col-md-8 col-sm-7 pl-0">
                                        <button name="addcu" type="submit" class="btn btn-primary" value="memedan">Add Course Unit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table class="table table-hover table-striped mt-3">
                            <tbody>
                                <?php
                                require_once("conn.php");
                                $stmt = mysqli_prepare($conn,'SELECT * FROM course_units');
                                mysqli_execute($stmt);
                                $courseunits = mysqli_stmt_get_result($stmt);
                                $i=0;
                                while($row = mysqli_fetch_row($courseunits)){
                                ?>
                                
                                <tr style="<?php if($row[0] == $cu){ echo 'background-color:green';}?>">
                                    <td><a href="acu.php?wc_c=<?php echo $row[0]?>"><?php echo $i+1; ?>. <?php echo $row[1];?></a></td>
                                    <td class="tm-trash-icon-cell"><i title="Move up" class="fas fa-arrow-up"></i></td>
                                    <td class="tm-trash-icon-cell"><i title="Move down" class="fas fa-arrow-down"></i></td>
                                    <td class="tm-trash-icon-cell"><a href="delete_topic.php?wc_c=<?php echo $row[0];?>"><i title="Clear all topics." style="color:red" class="fas fa-trash"></i></a></td>
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