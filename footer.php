<footer class="row tm-mt-small">
                <div class="col-12 font-weight-light">
                    <p class="d-inline-block tm-bg-black text-white py-2 px-4">
                        Copyright &copy; 2022 Dashboard .
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- https://jquery.com/download/ -->
    <script src="js/moment.min.js"></script>
    <!-- https://momentjs.com/ -->
    <script src="js/utils.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- http://www.chartjs.org/docs/latest/ -->
    <script src="js/fullcalendar.min.js"></script>
    <!-- https://fullcalendar.io/ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- https://getbootstrap.com/ -->
    <!--script src="js/tooplate-scripts.js"></script-->
    <?php require('js/tooplate-scripts.php'); ?>
    <script>
        let ctxLine,
            ctxBar,
            ctxPie,
            optionsLine,
            optionsBar,
            optionsPie,
            configLine,
            configBar,
            configPie,
            lineChart;
        barChart, pieChart;
        // DOM is ready
        $(function () {
            updateChartOptions();
            drawLineChart(); // Line Chart
            drawBarChart(); // Bar Chart
            drawPieChart(); // Pie Chart
            drawCalendar(); // Calendar

            $(window).resize(function () {
                updateChartOptions();
                updateLineChart();
                updateBarChart();
                reloadPage();
            });
        })
        function next_q(){
            var marks=parseInt(document.getElementById('wc_cm').value);
            var chosen=parseInt(document.querySelector('input[name="wc_cc"]:checked').value);
            var a_true=parseInt(document.getElementById('wc_ca').value);
            if(chosen==a_true){
                marks++;
            }
            //console.log(marks);
            //console.log(chosen);
            //console.log(a_true);
            //console.log("wc_m="+marks.toString());
            document.cookie = "wc_m="+marks.toString();
        }
        function upbgcolors(){
            <?php
            require_once('conn.php');
            $topics=NULL;
            $stmt = mysqli_prepare($conn,'SELECT * FROM topics');
            mysqli_execute($stmt);
            $topics = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_row($topics)){
                $stmt = mysqli_prepare($conn,'SELECT topics FROM course_units WHERE cid=?');
                mysqli_stmt_bind_param($stmt,'i',$_COOKIE['wc_c']);
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
            if(document.querySelector('input[name="<?php echo $row[0];?>"]:checked')){
                document.getElementById('<?php echo $row[0];?>').style.background = "green";
            }
            else{
                document.getElementById('<?php echo $row[0];?>').style.background = "white";
            }
            <?php }} ?>
        }

    </script>
</body>
</html>