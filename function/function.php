<?php
 function datethai($date){
    $da=explode("-",$date);

    $d=$da[2];
    $m=$da[1];
    $y=$da[0];
    $month=month($date); 
    $year=year($date);   
    $data =intval($d)." ".$month." ".$year;
    return  $data;

}
function datethai_time($date){
    $da_time =explode(" ",$date);
    $date1 = $da_time[0];
    $time1 = $da_time[1];
    $da=explode("-",$date1);

    $d=$da[2];
    $m=$da[1];
    $y=$da[0];
    $month=month($date); 
    $year=year($date);   
    $data =intval($d)." ".$month." ".$year." ".$time1;
    return  $data;

}
 function month($date){
    $da=explode("-",$date);
    $d=$da[2];
    $m=$da[1];
    $y=$da[0];
    switch ($m){
        case "01":
            $month="ม.ค.";
            break;
        case "02":
            $month="ก.พ.";
            break;
        case "03":
            $month="มี.ค.";
            break;
        case "04":
            $month="เม.ย.";
            break;
        case "05":
            $month="พ.ค.";
            break;
        case "06":
            $month="มิ.ย.";
            break;
        case "07":
            $month="ก.ค.";
            break;
        case "08":
            $month="ส.ค.";
            break;
        case "09":
            $month="ก.ย.";
            break;
        case "10":
            $month="ต.ค.";
            break;
        case "11":
            $month="พ.ย.";
            break;
        case "12":
            $month="ธ.ค.";
            break;
        
    }
    return $month;
}
 function day($date){
    $da=explode("-",$date);
    $d=$da[2];
    $m=$da[1];
    $y=$da[0];    
    return  intval($d);

}
 function year($date){
    $da=explode("-",$date);
    $d=$da[2];
    $m=$da[1];
    $y=$da[0];    
    return  $y+543;

}
function bookId_recive($data){
    return sprintf("%06d",$data);
}
function bookId_reciveRe($data){
    return sprintf("%03d",$data);
}
function yearterm($date){
    $da=explode("-",$date);
    $d=$da[2];
    $m=$da[1];
    $y=$da[0]; 
    $dateck = date($y."-10-01");
    if($date >= $dateck){
        $y=$da[0]+1;
        $da="ตรงปี+1 วันที่กรอก :".$date." วันที่เช็ค :".$dateck."<br>ปีงบประมาณ :";
    }else{
        $y=$da[0];
        $da="ตรงปี วันที่กรอก :".$date." วันที่เช็ค :".$dateck."<br>ปีงบประมาณ :";
    }
    // return  $da;
     return  $y+543;

}
function time_dif_EN($begin,$end){
	$remain=intval(strtotime($end)-strtotime($begin));
	$wan=floor($remain/86400);
	$l_wan=$remain%86400;
	$hour=floor($l_wan/3600);
	$l_hour=$l_wan%3600;
	$minute=floor($l_hour/60);
	$second=$l_hour%60;
    if($wan>0){
        $data = $wan." d ".$hour." h ".$minute." m ".$second." seconds ago";
    }elseif($hour >0){
        $data = $hour." h ".$minute." m ".$second." seconds ago";
    }elseif($minute >0){
        $data = $minute." m ".$second." seconds ago";
    }elseif($second >0){
        $data = $second." seconds ago";
    }else{
        $data= "Now";
    }
	return $data;
}
function time_dif_TH($begin,$end){
	$remain=intval(strtotime($end)-strtotime($begin));
	$wan=floor($remain/86400);
	$l_wan=$remain%86400;
	$hour=floor($l_wan/3600);
	$l_hour=$l_wan%3600;
	$minute=floor($l_hour/60);
	$second=$l_hour%60;
    if($wan>0){
        $data = $wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
    }elseif($hour >0){
        $data = $hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
    }elseif($minute >0){
        $data = $minute." นาที ".$second." วินาที";
    }elseif($second >0){
        $data = $second." วินาที";
    }else{
        $data= "Now";
    }
	return $data;
}
function statusRepair($s){
    
    switch ($s['s_id']) {
        
    case "1":
        $da['color']="bg-orange";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>call</i></button>";
        return $da;
        break;
    case "2":
        $da['color']="bg-cyan";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>save</i></button>";
        return $da;
        break;
    case "3":
        $da['color']="bg-light-blue";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>person</i></button>";
        return $da;
        break;
    case "4":
        $da['color']="bg-blue";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>directions_run</i></button>";
        return $da;
        break;
    case "5":
        $da['color']="bg-indigo";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>build</i></button>";
        return $da;
        break;
    case "6":
        $da['color']="bg-deep-orange";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>warning</i></button>";
        return $da;
        break;
    case "7":
        $da['color']="bg-light-green";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12 ' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>mood</i></button>";
        return $da;
        break;
    case "8":
        $da['color']="bg-teal";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>done</i></button>";
        return $da;
        break;
    case "9":
        $da['color']="bg-grey";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>schedule</i></button>";
        return $da;
        break;
    case "10":
        $da['color']="bg-blue-grey";
        $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>monetization_on</i></button>";
        return $da;
        break;
    default:
        
    }
}
function statusIT($s){
    
    switch ($s['s_id']) {
        
        case "1":
            // แจ้ง
            $da['color']="bg-orange";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>call</i></button>";
            return $da;
            break;
        case "2":
            // รับเรื่อง
            $da['color']="bg-cyan";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>save</i></button>";
            return $da;
            break;
        case "3":
            // ดำเนินการซ่อม
            $da['color']="bg-indigo";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>build</i></button>";
            return $da;
            break;
        case "4":
            // ซ่อมไม่ได้
            $da['color']="bg-deep-orange";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>warning</i></button>";
            return $da;
            break;
        case "5":
            // รอดำเนินการครั้งถัดไป
            $da['color']="bg-light-green";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12 ' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>schedule</i></button>";
            return $da;
            break;
        case "8":
            // เรียบร้อย
            $da['color']="bg-teal";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>done</i></button>";
            return $da;
            break;
        case "7":
            // รออะไหล่
            $da['color']="bg-grey";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>schedule</i></button>";
            return $da;
            break;
        case "6":
            // ส่งบริษัท
            $da['color']="bg-blue-grey";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>monetization_on</i></button>";
            return $da;
            break;
        case "9":
            // ไม่ซ่อม
            $da['color']="bg-deep-orange";
            $da['bt']="<button type='button' class='btn btn-xs {$da['color']} waves-effect mb-2'><i class='material-icons fs-12' data-toggle='tooltip' data-placement='top' title='{$s['s_name']}'>highlight_off</i></button>";
            return $da;
            break;
        default:
            
        }
}
function sent($data){
    $code = base64_encode($data);
    return $code;
}
function resive($data){
    $code = base64_decode($data);
    return $code;
}
function btStatus($data){
    $s="";
    foreach($data as $c){
        $ds['s_id'] = $c['s_id'];
        $ds['s_name'] = $c['s_name'];
        $das = statusRepair($ds);
        $s = $s."".$das['bt'];
    
    }
    return $s;
}
function btStatusIT($data){
    $s="";
    foreach($data as $c){
        $ds['s_id'] = $c['s_id'];
        $ds['s_name'] = $c['s_name'];
        $das = statusIT($ds);
        $s = $s."".$das['bt'];
    
    }
    return $s;
}
function SentLine($tb,$datas,$name) {
    $data="{$name}\nชื่อ:{$datas['name_TH']}\nห้อง:{$datas['room']} ชั้น {$datas['floor']}\nอาคาร:{$datas['b_name']}\nเบอร์:{$datas['tel']}\nรายละเอียด:{$datas['r_remark']}\nLink: http://161.246.23.21/repair-sci" ;
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");
        switch ($tb){
            case "building":
                $sToken = "eRPGFqq2xSUZCoULTm0tniHiliZkkULXQ0flEBx9Rig";
                break;
            case "computer":
                $sToken = "hqetKVwQIeBofeRCWQRBnGpOSnxLgUS40hWzVxZflMC";
                break;
            case "room":
                $sToken = "hqetKVwQIeBofeRCWQRBnGpOSnxLgUS40hWzVxZflMC";
                break;
            case "lab":
                $sToken = "hqetKVwQIeBofeRCWQRBnGpOSnxLgUS40hWzVxZflMC";
                break;
            default:
                $sToken = "NEBJNOEsOZKaHi0CtH5DxutkPV9HNGinPgxZTEsrY1W";
        }
        
        $sMessage = "{$data}";


        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 

        //Result error 
        if(curl_error($chOne)) 
        { 
            echo 'error:' . curl_error($chOne); 
        } 
        else { 
            $result_ = json_decode($result, true); 
            // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        } 
        curl_close( $chOne );  
}
function monthInYear_term($year) {
    $y_en = $year -543;
    $y_en_old = $y_en -1;
    $m=array(10,11,12,1,2,3,4,5,6,7,8,9);
    $i=0;
    foreach($m as $n){  
        $n1 = $n+1;
        if($n<10){
            $n1 = $n+1;
            $mn = sprintf("%02d",$n);
            $mn1 = sprintf("%02d",$n1);
            $data[$i]['m_sql']= "BETWEEN '{$y_en}-{$mn}-01' AND '{$y_en}-{$mn1}-01'";
            $data[$i]['m_name']= ($year)."-".$mn;
        }elseif($n==12){
            $mn = sprintf("%02d",$n);
            $data[$i]['m_sql']= "BETWEEN '{$y_en_old}-{$n}-01' AND '{$y_en}-01-01'";
            $data[$i]['m_name']= ($year-1)."-".$mn;
        }elseif($n>9){
            $n1 = $n+1;
            $mn = sprintf("%02d",$n);
            $mn1 = sprintf("%02d",$n1);
            $data[$i]['m_sql']= "BETWEEN '{$y_en_old}-{$mn}-01' AND '{$y_en_old}-{$mn1}-01'";
            $data[$i]['m_name']= ($year-1)."-".$mn;
        }
        $i++;
    }
    return $data;
    
}
function month_TH($m){
    switch ($m){
        case "01":
            $month="ม.ค.";
            break;
        case "02":
            $month="ก.พ.";
            break;
        case "03":
            $month="มี.ค.";
            break;
        case "04":
            $month="เม.ย.";
            break;
        case "05":
            $month="พ.ค.";
            break;
        case "06":
            $month="มิ.ย.";
            break;
        case "07":
            $month="ก.ค.";
            break;
        case "08":
            $month="ส.ค.";
            break;
        case "09":
            $month="ก.ย.";
            break;
        case "10":
            $month="ต.ค.";
            break;
        case "11":
            $month="พ.ย.";
            break;
        case "12":
            $month="ธ.ค.";
            break;
        
    }
    return $month;
}
function AssessmentAswer($num){
    $data="";
    $score = $num;
    if($score > 4.5){
        $data="ดีมาก";
    }elseif($score > 3.5){
        $data="ดี";
    }elseif($score > 2.5){
        $data="ปานกลาง";
    }elseif($score > 1.5){
        $data="น้อย";
    }else{
        if($score == 0 OR $score ==""){
            $data="";
        }else{
        $data="ต้องปรับปรุง";
        }
    }
    return $data;
}
?>