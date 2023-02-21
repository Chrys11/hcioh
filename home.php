<?php require('header.php'); ?>

            <!-- row -->
            <div class="row tm-content-row tm-mt-big">
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Performance Graph</h2>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Progress Chart</h2>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <canvas id="pieChart" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
                <!--div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <div class="row">
                            <div class="col-8">
                                <h2 class="tm-block-title d-inline-block">Medals</h2>
                            </div>
                            <div class="col-4 text-right">
                                <a href="awards.php" class="tm-link-black">View All</a>
                            </div>
                        </div>
                        <?php// $awards = ['Piano Awards','Musical Instruments Winner','Key Star']; ?>
                        <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
                            <?php// foreach($awards as $award){?>
                            <li class="tm-list-group-item">
                                <table>
                                    <tr>
                                        <th><i class="fa fa-medal fa-4x" style="color:green"></i></th>
                                        <td><a href="awards.php"><?php// echo $award; ?></a><td>
                                    </tr>
                                </table>
                            </li>
                            <?php// } ?>
                        </ol>
                    </div>
                </div-->
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <?php
                        if($priv=='0'){
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
                        $courseunits = mysqli_stmt_get_result($stmt);?>
                        <div class="row">
                            <div class="col-8">
                                <h2 class="tm-block-title d-inline-block">Course Units</h2>
                            </div>
                            <div class="col-4 text-right">
                                <a href="cu.php" class="tm-link-black">View All</a>
                            </div>
                        </div>
                        <ol class="tm-list-group tm-list-group-alternate-color tm-list-group-pad-big">
                            <?php while($cu = mysqli_fetch_row($courseunits)){?>
                            <li class="tm-list-group-item">
                                <a onclick="document.cookie = 'cid=<?php echo $cu[0];?>'" href="work.php"><?php echo $cu[1]; ?></a>
                            </li>
                            <?php } }elseif($priv=='1'){?>
                        </ol>
                        <div class="row">
                            <div class="col-8">
                                <h2 class="tm-block-title d-inline-block">Topics</h2>
                            </div>
                            <div class="col-4 text-right">
                                <a href="topics.php" class="tm-link-black">View All</a>
                            </div>
                        </div>
                        <table class="table table-hover table-striped mt-3">
                        <tbody>
                        <?php
                            require_once('conn.php');
                            $stmt = mysqli_prepare($conn,'SELECT * FROM topics WHERE teacher = ?');
                            mysqli_stmt_bind_param($stmt,'s',$_COOKIE['stno']);
                            mysqli_execute($stmt);
                            $topic = '';
                            $topics = mysqli_stmt_get_result($stmt);
                            $i=0;
                            while($row = mysqli_fetch_row($topics)){
                        ?>
                            <tr>
                                <td><a href="topics.php?wc_t=<?php echo $row[0]?>"><?php echo $i+1; ?>. <?php echo $row[1];?> </a></td>
                                <td class="tm-trash-icon-cell"><i class="fas fa-eye"></i></td>
                            </tr>
                        <?php $i++;} ?>
                        </tbody>
                        </table>
                    <?php }?>
                    </div>
                </div>
                <!--div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Calendar</h2>
                        <div id="calendar"></div>
                        <div class="row mt-4">
                            <div class="col-12 text-right">
                                <a href="#" class="tm-link-black">View Schedules</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tm-col tm-col-big">
                    <div class="bg-white tm-block h-100">
                        <h2 class="tm-block-title">Upcoming Tasks</h2>
                        <ol class="tm-list-group">
                            <li class="tm-list-group-item">List of tasks</li>
                            <li class="tm-list-group-item">Read reports</li>
                            <li class="tm-list-group-item">Write email</li>
                                
                            <li class="tm-list-group-item">Call customers</li>
                            <li class="tm-list-group-item">Go to meeting</li>
                            <li class="tm-list-group-item">Weekly plan</li>
                            <li class="tm-list-group-item">Ask for feedback</li>
                            
                            <li class="tm-list-group-item">Meet Supervisor</li>
                            <li class="tm-list-group-item">Company trip</li>
                        </ol>
                    </div-->
                </div>
            </div>
<?php require('footer.php'); ?>