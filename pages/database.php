<?php 

session_start();?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/vendor/autoload.php"; ?>
<?php
use App\Model\Badminton\Users;
$usersObj = new Users;

use App\Model\Badminton\Court;
$courtObj = new Court;

use App\Model\Badminton\Member;
$memberObj = new Member;

use App\Model\Badminton\Matchs;
$matchObj = new Matchs;

use App\Model\Badminton\Dates;
$dateObj = new Dates;
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
if(isset($_POST['adddatabase'])){
    $cdata = $matchObj->getBillByDate("count",$_POST['bi_date'],$_POST['u_id']);
    if($cdata>0){        
        $dataB = $matchObj->getBillByDate("data",$_POST['bi_date'],$_POST['u_id']);
        echo "มีบิลแล้ว<br>";
        $data['bi_date']=$_POST['bi_date'];
        $data['bi_court']=$_POST['bi_court'];
        $data['bi_game']=$_POST['bi_game'];
        $data['bad_one']=$_POST['bad_one'];
        $data['bad_count']=$_POST['bad_count'];
        $data['bad_sum']=$_POST['bad_sum'];
        $data['u_id']=$_POST['u_id'];
        echo "1.updatebill<br>";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $ckU = $matchObj->updateBill($data);
        if($ckU){
            echo "2.delete databill<br>";
            echo "bi_id = ".$dataB['bi_id']."<br>";
            $ckD = $matchObj->delDataBillById($dataB['bi_id']);
            if($ckD){
                echo "3.add databill";
                $data_bi['bi_id'] =$dataB['bi_id'];
                $i=0;
                $dataLine="";
                foreach($_POST['m_name'] as $key => $m){
                    $i++;
                    $data_bi['m_name']=$_POST['m_name'][$i];
                    $data_bi['court_cal']=$_POST['court_cal'][$i];
                    $data_bi['bad_cal']=$_POST['bad_cal'][$i];
                    $data_bi['bad_m']=$_POST['bad_m'][$i];
                    $data_bi['bi_sum']=$_POST['bi_sum'][$i];
                    $dataLine .= $i.". ".$data_bi['m_name']." = ".ceil($data_bi['bi_sum'])." บาท"."\n";
                    echo "<pre>";
                    print_r($data_bi);
                    echo "</pre>";
                    $ck = $matchObj->addDataBill($data_bi);
                }
                if($ck){
                //     $da = datethai($data['bi_date']);
                //     $p = "Link : http://sport.science.kmitl.ac.th/badminton/pages/show1.php?bi_id={$dataB['bi_id']}";
                //     $dataL ="บิลวันที่ ".$da."\n";
                //     $dataL .= $dataLine."\n".$p;
                //     echo $dataL;
                //     SentLineBasic($_SESSION['b_line'],$dataL);
                    echo "  
                        <script type='text/javascript'>
                            setTimeout(function(){location.href='/badminton/pages/cal.php'} , 1);
                        </script>
                    ";
                }else{
                    echo "add Data Bill ผิดพลาด";
                }
            }else{
                echo "Delete Data Bill ผิดพลาด";
            }
        }else{
            echo "update bill ผิดพลาด";
        }

    }else{
        echo "ยังไม่มีบิล<br>";
        $data['bi_date']=$_POST['bi_date'];
        $data['bi_court']=$_POST['bi_court'];
        $data['bi_game']=$_POST['bi_game'];
        $data['bad_one']=$_POST['bad_one'];
        $data['bad_count']=$_POST['bad_count'];
        $data['bad_sum']=$_POST['bad_sum'];
        $data['u_id']=$_POST['u_id'];
        echo "1.add bill<br>";
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        $bi_id = $matchObj->addBill($data);
        echo $bi_id."<br>";
        if($bi_id){
            $data_bi['bi_id'] =$bi_id;
            $i=0;
            echo "2.add data bill";
            $dataLine = "";
            foreach($_POST['m_name'] as $key => $m){
                $i++;
                $data_bi['m_name']=$_POST['m_name'][$i];
                $data_bi['court_cal']=$_POST['court_cal'][$i];
                $data_bi['bad_cal']=$_POST['bad_cal'][$i];
                $data_bi['bad_m']=$_POST['bad_m'][$i];
                $data_bi['bi_sum']=$_POST['bi_sum'][$i];
                $ck = $matchObj->addDataBill($data_bi);
                $dataLine .= $i.". ".$data_bi['m_name']." = ".ceil($data_bi['bi_sum'])." บาท"."\n";
                echo "<pre>";
                print_r($data_bi);
                echo "</pre>";
            }
            if($ck){
            //     $da = datethai($data['bi_date']);
            //     $p = "Link : http://sport.science.kmitl.ac.th/badminton/pages/show1.php?bi_id={$bi_id}";
            //     $dataL ="บิลวันที่ ".$da."\n";
            //     $dataL .= $dataLine."\n".$p;
            //     echo $dataL;
            //     SentLineBasic($_SESSION['b_line'],$dataL);
                echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='/badminton/pages/cal.php'} , 1);
                    </script>
                ";
            }
        }else{
            echo "Add bill error";
        }
    }
    
}


?>
