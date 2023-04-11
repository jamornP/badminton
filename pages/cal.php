<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Badminton</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/link.php"; ?>
    <style>
        .sbtn-remove,
        .nbtn-remove {
            display: none;
        }
    </style>


</head>

<body class="font-sriracha">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/nav.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/botton.php"; ?>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
           <h4> 5.คำนวนค่าเสียหาย วันที่ <?php echo datethai($_SESSION['date']);?></h4>
        </div>
        <div class="card">
            <h5 class="card-header bg-success text-white">ผู้เล่น</h5>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col" class='text-end'>เกมส์</th>
                            <th scope="col" class='text-end'>ลูก</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=0;
                            $mem = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                            $sumMatch =0;
                            $sumBad =0;
                            $match_count = $matchObj->countSQL("select * from tb_match where u_id={$_SESSION['b_u_id']} and ma_date='{$_SESSION['date']}'");
                            $match_bad = $matchObj->getSQL("select * from tb_match where u_id={$_SESSION['b_u_id']} and ma_date='{$_SESSION['date']}'");
                            $bad_count = 0;
                            foreach($match_bad as $mb){
                                $bsum = $matchObj->countSQL("select * from tb_bad where b_id='{$mb['b_id']}'");
                                $bad_count += $bsum;
                            }
                            foreach($mem as $m){
                                $matchM = $matchObj->countSQL("select * from tb_data_match where m_id={$m['m_id']}");
                                $dataB = $matchObj->getSQL("select ma.b_id 
                                from tb_data_match as dm
                                left join tb_match as ma on ma.dm_id = dm.dm_id
                                where dm.m_id={$m['m_id']}");
                                $bad = 0;
                                foreach($dataB as $b){
                                    $matchB = $matchObj->countSQL("select * from tb_bad where b_id='{$b['b_id']}'");
                                    $bad+=$matchB;
                                }
                                $sumMatch+=$matchM;
                                $sumBad+=$bad;
                                $i++;
                                echo "
                                <tr>
                                    <th scope='row'>{$i}</th>
                                    <td>{$m['m_name']}</td>
                                    <td class='text-end'>{$matchM}</td>
                                    <td class='text-end'>{$bad}</td>
                                </tr>
                                ";
                            }
                            echo "
                                <tr>
                                    <th scope='row'></th>
                                    <th>รวม</th>
                                    <th class='text-end'>{$sumMatch}</th>
                                    <th class='text-end'>{$sumBad}</th>
                                </tr>
                            ";
                        ?>
                        

                    </tbody>
                </table>
                <hr>
                <form action="" method="POST">
                    <div class="d-flex mb-2">

                        <div class="">
                            <input type="hidden" class="form-control"  name="n_match" value="<?php echo $match_count;?>">
                            <input type="hidden" class="form-control"  name="n_bad" value="<?php echo $bad_count;?>">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ราคาลูกแบด/ลูก" name="c_bad" autofocus required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mx-1" id="exampleFormControlInput2" placeholder="ค่าสนามทั้งหมด" name="c_court" required>
                        </div>
                        <button type="submit" class="btn btn-success mx-2 text-white" name="calulate">คำนวน</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
            if(isset($_POST['calulate'])){
                

                ?>
                    <div class="card mt-5">
                        <h5 class="card-header">คำนวนค่าใช้จ่าย วันที่ <?php echo datethai($_SESSION['date']);?></h5>
                        <div class="card-body">
                            <?php
                            $sum = $_POST['c_bad']*$_POST['n_bad'];
                                echo "
                                <P>ค่าสนาม {$_POST['c_court']} บาท เล่นไป {$_POST['n_match']} เกมส์</P>
                                <P>ค่าลูกละ {$_POST['c_bad']} บาท ใช้ไป {$_POST['n_bad']} ลูก เป็นเงิน {$sum} บาท</P>
                                ";
                            ?>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col" class='text-end'>เกมส์</th>
                                        <th scope="col" class='text-end'>ลูก</th>
                                        <th scope="col" class='text-end'>รวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $_SESSION['cal']=2;
                                        if($_SESSION['cal']==1){
                                            $i=0;
                                            $mem = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                            // $sumMatch =0;
                                            // $sumBad =0;
                                            $c_court = $_POST['c_court'];
                                            $c_bad = $_POST['c_bad'];
                                            $s_match = 0;
                                            $s_bad = 0;
                                            $sumAll = 0;
                                            $sum_Court =0;
                                            $sum_Bad =0;
                                            $sum_All =0;
                                            foreach($mem as $m){
                                                $matchM = $matchObj->countSQL("select * from tb_data_match where m_id={$m['m_id']}");
                                                $dataB = $matchObj->getSQL("select ma.b_id 
                                                from tb_data_match as dm
                                                left join tb_match as ma on ma.dm_id = dm.dm_id
                                                where dm.m_id={$m['m_id']}");
                                                $bad = 0;
                                                foreach($dataB as $b){
                                                    $matchB = $matchObj->countSQL("select * from tb_bad where b_id='{$b['b_id']}'");
                                                    $bad+=$matchB;
                                                }
                                                
                                                $i++;
                                                $s_match = number_format(($c_court/$sumMatch*$matchM),2);
                                                $s_bad = number_format(($c_bad*($sumBad/4)/$sumBad*$bad),2);
                                                $sumAll = number_format(($s_match + $s_bad),2);
                                                $sum_Court += $s_match;
                                                $sum_Bad += $s_bad;
                                                $sum_All += $sumAll;
                                                $sum_Court =number_format($sum_Court,2);
                                                $sum_Bad =number_format($sum_Bad,2);
                                                $sum_All =number_format($sum_All,2);
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$m['m_name']}</td>
                                                    <td class='text-end'>{$s_match}</td>
                                                    <td class='text-end'>{$s_bad}</td>
                                                    <td class='text-end'>{$sumAll}</td>
                                                </tr>
                                                ";
                                            }
                                            echo "
                                                <tr>
                                                    <th scope='row'></th>
                                                    <th>รวม</th>
                                                    <th class='text-end'>{$sum_Court}</th>
                                                    <th class='text-end'>{$sum_Bad}</th>
                                                    <th class='text-end'>{$sum_All}</th>
                                                </tr>
                                            ";
                                        }else{
                                            $i=0;
                                            // จำนวน ขีด ของ เกมส์การเล่น (เล่น 4 คน = 1ขีด , เล่น 2 คน = 2 ขีด)/เกมส์
                                            $count_match_sum = 0;
                                            $sum_cal_court = 0;
                                            $data_member = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                            foreach($data_member as $d_m){
                                                $i++;
                                                $sql ="
                                                    select ma.dm_id,ma.b_id,dm.* 
                                                    from tb_data_match as dm
                                                    left join tb_match as ma on ma.dm_id = dm.dm_id
                                                    where dm.m_id = {$d_m['m_id']}
                                                ";
                                                $data_match = $matchObj->getSQL($sql);
                                                // จำนวนแมทของ ผู้นเล่น คนนี้
                                                $count_match = 0;
                                                // เก็บจำนวนที่ใช้คำนวน 4/จำนวนผู้เล่นแต่ละแมท 4 คน = 1, 2 คน = 2
                                                $count_match_i=0;
                                                
                                                // print_r($data_match);
                                                foreach($data_match as $d_ma){
                                                    $count_match++;
                                                    $sql ="
                                                        select * 
                                                        from tb_data_match 
                                                        where dm_id = '{$d_ma['dm_id']}'
                                                    ";
                                                    // echo $sql."<br>";
                                                    // จำนวน คน ในแมทนี้
                                                    $count_member = $matchObj->countSQL($sql);
                                                    // echo $count_member;
                                                    $count_match_i += 4/$count_member;
                                                    // echo "->".$count_match_i.",";
                                                    
                                                }
                                                $count_match_sum +=$count_match_i;
                                                // echo "<br>";
                                                $cal_court = number_format($count_match_i*$_POST['c_court']/($_POST['n_match']*4),2);
                                                $sum_cal_court += $cal_court;
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$d_m['m_name']}</td>
                                                    <td class='text-end'>{$cal_court}</td>
                                                    <td class='text-end'>{$count_match}</td>
                                                    <td class='text-end'>{}</td>
                                                </tr>
                                                ";
                                            }
                                            echo "
                                                <tr>
                                                    <th scope='row'></th>
                                                    <th>รวม</th>
                                                    <th class='text-end'>{$sum_cal_court}</th>
                                                    <th class='text-end'>{}</th>
                                                    <th class='text-end'>{}</th>
                                                </tr>
                                            ";
                                        }
                                    ?>
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php
            }
        ?>
        <br>
        <br>
        <br>
    </div>
    <div class="container mt-5">


    </div>

    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/script.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                language: 'th-en',
                format: 'yyyy-mm-dd',
                minDate: 0,
                autoclose: true

            });
            $("#datepicker2").datepicker({
                language: 'th-en',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

        });
    </script>
    <script type="text/javascript">
        $(function() {
            let i = 1;

            $("body").on("click", ".sbtn-add", function(e) {
                i++;
                e.preventDefault();
                let ol = $(this).closest("ol")
                let li = $(this).closest("li").clone()
                li.appendTo(ol)
                li.find("input").val("")
                li.find(".sbtn-remove").show()
                li.find("[name='snam[]']").focus()

                console.log(i);
            })

            $("body").on("click", ".sbtn-remove", function(e) {
                i = i - 1;
                e.preventDefault();
                $(this).closest("li").remove()
                console.log(i);
            })

            let j = 1;
            $("body").on("click", ".nbtn-add", function(e) {


                j++;
                e.preventDefault();
                let ol = $(this).closest("ol")
                let li = $(this).closest("li").clone()
                li.appendTo(ol)
                li.find("input").val("")
                li.find(".nbtn-remove").show()
                li.find("[name='name[]']").focus()

                console.log(j);
            })

            $("body").on("click", ".tbtn-remove", function(e) {
                j = j - 1;
                e.preventDefault();
                $(this).closest("li").remove()
                console.log(j);
            })

        })
    </script>
</body>

</html>