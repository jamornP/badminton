<?php 
ini_set('session.gc_maxlifetime', 86400);
session_start();?>
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
                                $bsum = $matchObj->countSQL("select * from tb_bad where b_id='{$mb['b_id']}' AND b_name <>'-'");
                                $bad_count += $bsum;
                            }
                            foreach($mem as $m){
                                $matchM = $matchObj->countMember($_SESSION['date'],$m['m_id']);
                                $dataB = $matchObj->getSQL("select ma.b_id 
                                from tb_data_match as dm
                                left join tb_match as ma on ma.dm_id = dm.dm_id
                                where dm.m_id={$m['m_id']}");
                                $bad = 0;
                                foreach($dataB as $b){
                                    $matchB = $matchObj->countSQL("select * from tb_bad where b_id='{$b['b_id']}' AND b_name <>'-'");
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
                                    <th class='text-end'>{$match_count}</th>
                                    <th class='text-end'>{$bad_count}</th>
                                </tr>
                            ";
                        ?>
                        

                    </tbody>
                </table>
                <hr>
                <form action="" method="POST">
                    <div class="d-flex">

                        <div class="">
                            <input type="hidden" class="form-control"  name="n_match" value="<?php echo $match_count;?>">
                            <input type="hidden" class="form-control"  name="n_bad" value="<?php echo $bad_count;?>">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ราคาลูกแบด/ลูก" name="c_bad" autofocus required>
                        </div>
                        <div class="">
                            <input type="text" class="form-control mx-1" id="exampleFormControlInput2" placeholder="ค่าสนามทั้งหมด" name="c_court" required>
                        </div>
                        <div class="mx-2">
                            <select class="form-select" aria-label="Default select example" name="cal">
                                <!-- <option selected>แบบคำนวน</option> -->
                                <option value="4" selected>บุฟเฟ่ต์สนาม</option>
                                <!-- <option value="2">ตามจริง</option> -->
                                <!-- <option value="3">ไม่แยกเดี๋ยว</option> -->
                            </select>
                        </div>
                       
                    </div>
                    <button type="submit" class="btn btn-success text-white mt-2" name="calulate">คำนวน</button>
                </form>
            </div>
        </div>
       
        
        <?php
            if(isset($_POST['calulate'])){
                // print_r($_POST);

                ?>
                    <div class="card mt-5">
                        <h5 class="card-header">คำนวนค่าใช้จ่ายใหม่ วันที่ <?php echo datethai($_SESSION['date']);?></h5>
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
                                        <th scope="col" class='text-end'>สนาม</th>
                                        <th scope="col" class='text-end'>ลูก</th>
                                        <th scope="col" class='text-end'>รวม</th>
                                    </tr>
                                </thead>
                                <form action="database.php" method="POST">
                                    <input type="hidden" name="bi_date" id="" value="<?php echo $_SESSION['date'];?>">    
                                    <input type="hidden" name="bi_court" id="" value="<?php echo $_POST['c_court'];?>">    
                                    <input type="hidden" name="bi_game" id="" value="<?php echo $_POST['n_match'];?>">    
                                    <input type="hidden" name="bad_one" id="" value="<?php echo $_POST['c_bad'];?>">    
                                    <input type="hidden" name="bad_count" id="" value="<?php echo $_POST['n_bad'];?>">    
                                    <input type="hidden" name="bad_sum" id="" value="<?php echo $sum;?>">  
                                    <input type="hidden" name="u_id" id="" value="<?php echo $_SESSION['b_u_id'];?>">  
                                <tbody>
                                    <?php
                                        // $_POST['cal']=2;
                                        if($_POST['cal']==1){
                                            $i=0;
                                            $mem = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                            // $sumMatch =0;
                                            // $sumBad =0;
                                            $count_member_all=count($mem);
                                            // จำนวน ขีด ของ เกมส์การเล่น (เล่น 4 คน = 1ขีด , เล่น 2 คน = 2 ขีด)/เกมส์
                                            $count_match_sum = 0;
                                            $sum_cal_court = 0;
                                            $sum_cal_bad = 0;
                                            $sum_cal_all = 0;
                                            $sum_all = 0;
                                            $sum_member_day=0;
                                            $court_bufe=0;
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
                                                $count_bad_i=0;
                                                foreach($data_match as $d_ma){
                                                    $count_match++;
                                                    $sql ="
                                                        select * 
                                                        from tb_data_match 
                                                        where dm_id = '{$d_ma['dm_id']}'
                                                    ";
                                                    
                                                    // จำนวน คน ในแมทนี้
                                                    $count_member = $matchObj->countSQL($sql);
                                                    // ขีด แมท และ ลูกแบด
                                                    $count_match_i = 1;
                                                    $sql_bad = $matchObj->countSQL("select * from tb_bad where b_id='{$d_ma['b_id']}' AND b_name <>'-'");
                                                    for($j=1;$j<=$sql_bad;$j++){
                                                        $count_bad_i += (4/$count_member);
                                                    }
                                                    
                                                }
                                                $sum_member_day +=$count_match_i;
                                                $count_match_sum +=$count_match_i;
                                                // $cal_court ค่าคอร์ด
                                                $cal_court = number_format($_POST['c_court']/$count_member_all,2);
                                                $cal_bad = number_format($count_bad_i*($_POST['c_bad']/4),2);
                                                $cal_all = number_format($cal_court+$cal_bad,2);
                                                $sum_cal_court += $cal_court;
                                                $sum_cal_bad += $cal_bad;
                                                $sum_cal_all += $cal_all;
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$d_m['m_name']}</td>
                                                    <td class='text-end'>{$cal_court}</td>
                                                    <td class='text-end'>{$cal_bad}({$count_bad_i})</td>
                                                    <td class='text-end'>{$cal_all}</td>
                                                </tr>
                                                ";
                                                
                                            }
                                           
                                            echo "
                                                <tr>
                                                    <th scope='row'></th>
                                                    <th>รวม</th>
                                                    <th class='text-end'>{$sum_cal_court}</th>
                                                    <th class='text-end'>{$sum_cal_bad}</th>
                                                    <th class='text-end'>{$sum_cal_all}</th>
                                                </tr>
                                            ";
                                            
                                            $court_bufe=number_format($_POST['c_court']/$count_member_all,2);
                                            echo "
                                            <br>
                                            <p>ค่าสนามคนละ {$court_bufe} บาท</p>
                                            ";
                                        }elseif($_POST['cal']==2){
                                            $i=0;
                                            // จำนวน ขีด ของ เกมส์การเล่น (เล่น 4 คน = 1ขีด , เล่น 2 คน = 2 ขีด)/เกมส์
                                            $count_match_sum = 0;
                                            $sum_cal_court = 0;
                                            $sum_cal_bad = 0;
                                            $sum_cal_all = 0;
                                            $sum_all = 0;
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
                                                $count_bad_i=0;
                                                foreach($data_match as $d_ma){
                                                    $count_match++;
                                                    $sql ="
                                                        select * 
                                                        from tb_data_match 
                                                        where dm_id = '{$d_ma['dm_id']}'
                                                    ";
                                                    
                                                    // จำนวน คน ในแมทนี้
                                                    $count_member = $matchObj->countSQL($sql);
                                                    // ขีด แมท และ ลูกแบด
                                                    $count_match_i += 4/$count_member;
                                                    $sql_bad = $matchObj->countSQL("select * from tb_bad where b_id='{$d_ma['b_id']}' AND b_name <>'-'");
                                                    for($j=1;$j<=$sql_bad;$j++){
                                                        $count_bad_i += (4/$count_member);
                                                    }
                                                    
                                                }
                                                $count_match_sum +=$count_match_i;
                                                // $cal_court ค่าคอร์ด
                                                $cal_court = number_format($count_match_i*$_POST['c_court']/($_POST['n_match']*4),2);
                                                $cal_bad = number_format($count_bad_i*($_POST['c_bad']/4),2);
                                                $cal_all = number_format($cal_court+$cal_bad,2);
                                                $sum_cal_court += $cal_court;
                                                $sum_cal_bad += $cal_bad;
                                                $sum_cal_all += $cal_all;
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$d_m['m_name']}</td>
                                                    <td class='text-end'>{$cal_court}({$count_match_i})</td>
                                                    <td class='text-end'>{$cal_bad}({$count_bad_i})</td>
                                                    <td class='text-end'>{$cal_all}</td>
                                                </tr>
                                                ";
                                            }
                                            echo "
                                                <tr>
                                                    <th scope='row'></th>
                                                    <th>รวม</th>
                                                    <th class='text-end'>{$sum_cal_court}</th>
                                                    <th class='text-end'>{$sum_cal_bad}</th>
                                                    <th class='text-end'>{$sum_cal_all}</th>
                                                </tr>
                                            ";
                                        }elseif($_POST['cal']==3){
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
                                                    $matchB = $matchObj->countSQL("select * from tb_bad where b_id='{$b['b_id']}' AND b_name <>'-'");
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
                                                    <td class='text-end'>{$s_match}{}</td>
                                                    <td class='text-end'>{$s_bad}{}</td>
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
                                        }elseif($_POST['cal']==4){
                                            $i=0;
                                            $mem = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                            // $sumMatch =0;
                                            // $sumBad =0;
                                            $count_member_all=count($mem);
                                            // จำนวน ขีด ของ เกมส์การเล่น (เล่น 4 คน = 1ขีด , เล่น 2 คน = 2 ขีด)/เกมส์
                                            $count_match_sum = 0;
                                            $sum_cal_court = 0;
                                            $sum_cal_bad = 0;
                                            $sum_cal_all = 0;
                                            $sum_all = 0;
                                            $sum_member_day=0;
                                            $court_bufe=0;
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
                                                $count_bad_i=0;
                                                foreach($data_match as $d_ma){
                                                    $count_match++;
                                                    $sql ="
                                                        select * 
                                                        from tb_data_match 
                                                        where dm_id = '{$d_ma['dm_id']}'
                                                    ";
                                                    
                                                    // จำนวน คน ในแมทนี้
                                                    $count_member = $matchObj->countSQL($sql);
                                                    // ขีด แมท และ ลูกแบด
                                                    $count_match_i = 1;
                                                    $sql_bad = $matchObj->countSQL("select * from tb_bad where b_id='{$d_ma['b_id']}' AND b_name <>'-'");
                                                    for($j=1;$j<=$sql_bad;$j++){
                                                        $count_bad_i += (4/$count_member);
                                                    }
                                                    
                                                }
                                                $sum_member_day +=$count_match_i;
                                                $count_match_sum +=$count_match_i;
                                                // $cal_court ค่าคอร์ด
                                                $cal_court = number_format($_POST['c_court']/$count_member_all,2);
                                                $cal_bad = number_format($count_bad_i*($_POST['c_bad']/4),2);
                                                $cal_all = number_format($cal_court+$cal_bad,2);
                                                $sum_cal_court += $cal_court;
                                                $sum_cal_bad += $cal_bad;
                                                $sum_cal_all += $cal_all;
                                                echo "
                                                <tr>
                                                    <td>{$i}</td>
                                                    <td>{$d_m['m_name']}<input type='hidden' name='m_name[{$i}]' id='' value='{$d_m['m_name']}'> </td>
                                                    <td class='text-end'>{$cal_court}<input type='hidden' name='court_cal[{$i}]' id='' value='{$cal_court}'></td>
                                                    <td class='text-end'>{$cal_bad}({$count_bad_i})<input type='hidden' name='bad_cal[{$i}]' id='' value='{$cal_bad}'><input type='hidden' name='bad_m[{$i}]' id='' value='{$count_bad_i}'></td>
                                                    <td class='text-end'>{$cal_all}<input type='hidden' name='bi_sum[{$i}]' id='' value='{$cal_all}'></td>
                                                </tr>
                                                ";
                                                
                                            }
                                        
                                            echo "
                                                <tr>
                                                    <th scope='row'></th>
                                                    <th>รวม</th>
                                                    <th class='text-end'>{$sum_cal_court}</th>
                                                    <th class='text-end'>{$sum_cal_bad}</th>
                                                    <th class='text-end'>{$sum_cal_all}</th>
                                                </tr>
                                            ";
                                            
                                            $court_bufe=number_format($_POST['c_court']/$count_member_all,2);
                                            echo "
                                            <br>
                                            <p>ค่าสนามคนละ {$court_bufe} บาท</p>
                                            ";
                                               
                                        }
                                    ?>
                                    

                                </tbody>
                                <?php
                                if($_POST['cal']==4){
                                    echo "
                                        <button type='submit' class='btn btn-danger text-white' name='adddatabase'>บันทึก</button>
                                    ";
                                }
                                ?>
                                
                                </form>
                            </table>
                        </div>
                    </div>
                <?php
            }
        ?>
        <?php
            $ckCountBill = $matchObj->getBillByDate("count",$_SESSION['date'],$_SESSION['b_u_id']);
            $dataLine = "";
            if($ckCountBill > 0){
                $dataLine = "บิล ".datethai($_SESSION['date'])."\n";
                $CountBill = $matchObj->getBillByDate("data",$_SESSION['date'],$_SESSION['b_u_id']);
                ?>
                <div class="card mt-5">
                    <h5 class="card-header">บิลเก่า วันที่ <?php echo datethai($_SESSION['date']);?></h5>
                    <div class="card-body">
                        <?php
                            // $sum = $_POST['c_bad']*$_POST['n_bad'];
                            echo "
                            <P>ค่าสนาม {$CountBill['bi_court']} บาท เล่นไป {$CountBill['bi_game']} เกมส์</P>
                            <P>ค่าลูกละ {$CountBill['bad_one']} บาท ใช้ไป {$CountBill['bad_count']} ลูก เป็นเงิน {$CountBill['bad_sum']} บาท</P>
                            ";
                            
                        ?>
                        <hr>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อ</th>
                                    <th scope="col" class='text-end'>สนาม</th>
                                    <th scope="col" class='text-end'>ลูก</th>
                                    <th scope="col" class='text-end'>รวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    $dataBills = $matchObj->getDataBillById($CountBill['bi_id']);
                                    $ib = 0;
                                    foreach($dataBills as $bill){
                                        $ib++;
                                        $ccc = ceil($bill['court_cal']);
                                        $sss = ceil($bill['bi_sum']);
                                        $dataLine .= $ib.". ".$bill['m_name']." = ".$sss." บาท"."\n";
                                        echo "
                                            <tr>
                                                <td>{$ib}</td>
                                                <td>{$bill['m_name']}</td>
                                                <td class='text-end'>{$ccc}</td>
                                                <td class='text-end'>{$bill['bad_cal']}({$bill['bad_m']})</td>
                                                <td class='text-end'>{$sss}</td>
                                            </tr>
                                        ";

                                    }
                                ?>
                            </tbody>
                            <form action="line.php" method="POST">
                                <input type="hidden" name="dataLine" value="<?php echo $dataLine;?>">
                                <?php
                                    if($_SESSION['b_line']!=""){
                                        ?>
                                        <button type='submit' class='btn btn-primary text-white' name='line'>ส่ง line</button>
                                        <?php
                                    }
                                ?>
                                
                            </form>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
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