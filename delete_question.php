<?php
    require_once('auth_teacher.php');
    if(isset($_GET['wc_q'])){
        $q_no = 0;
        $questions=[];
        for($p = 0;$p<12;$p++){
            array_push($questions,0);
        }
        require_once('conn.php');
        $stmt = mysqli_prepare($conn,"SELECT * FROM quizzes WHERE qid=?");
        mysqli_stmt_bind_param($stmt,'i',$_GET['wc_q']);
        mysqli_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_row($result)){
            $q_no = $row[1];
            for($i=2;$i<14;$i++){
                $questions[$i-2] = $row[$i];
            }
        }
        if(isset($_GET['wc_qu'])){
            for($i=0;$i<10;$i++){
                if($questions[$i] == $_GET['wc_qu']){
                    $questions[$i] = 0;
                    for($m=$i+1;$m<10;$m++){
                        $questions[$m-1] = $questions[$m];
                        $questions[$m] = 0;
                    }
                    break;
                }
            }
            $q_no--;
        }
        else{
            $questions=[];
            for($p = 0;$p<12;$p++){
                array_push($questions,0);
            }
            $q_no = 0;
        }

        $quiz = (int) $_GET['wc_q'];
        $stmt = mysqli_prepare($conn,"UPDATE quizzes SET q_no=?,q1=?,q2=?,q3=?,q4=?,q5=?,q6=?,q7=?,q8=?,q9=?,q10=?,q11=?,q12=? WHERE qid=?");
        mysqli_stmt_bind_param($stmt,'iiiiiiiiiiiiii',$q_no,$questions[0],$questions[1],$questions[2],$questions[3],$questions[4],$questions[5],$questions[6],$questions[7],$questions[8],$questions[9],$questions[10],$questions[11],$quiz);
        mysqli_execute($stmt);
        header('location:editquiz.php?wc_q='.$_GET['wc_q'].'&wc_qu='.$_GET['wc_qu'].'&wc_t='.$_GET['wc_t']);
    }
    else{
        header('location:home.php');
    }

?>