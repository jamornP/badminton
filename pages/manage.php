<?php 

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
    .mbtn-remove,
    .bbtn-remove {
        display: none;
    }
    </style>


</head>

<body class="font-sriracha">
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/nav.php"; ?>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/components/botton.php"; ?>
    <?php
        if(isset($_POST['add'])){
            unset($_POST['add']);
            $dataA['ma_date']=$_POST['ma_date']; 
            $dataA['ma_num']=$_POST['ma_num']; 
            $dataA['u_id']=$_POST['u_id']; 
            $dataA['dm_id'] = uniqid();
            $dataA['b_id'] = uniqid();
            
            // print_r($_POST);
            $ckA = $matchObj->addMatch($dataA);
            if($ckA){
                if(isset($_POST['member'])){
                    foreach($_POST['member'] as $key => $mem){
                        $num = $matchObj->countDM($dataA['dm_id']);
                        $dataM['dm_id']=$dataA['dm_id'];
                        $dataM['dm_num']=$num;
                        $dataM['m_id']=$_POST['member'][$key];
                        $dataM['dm_date']=$_SESSION['date'];
                        // echo "<br>";
                        // print_r($dataM);
                        if($_POST['member'][$key]=="0"){
                            // echo $_POST['member'][$key];
                        }else{
                            // echo $num.$_POST['member'][$key];
                            $ckDA = $matchObj->addMatchData($dataM);
                        }
                        
                    }

                }
                if(isset($_POST['b_name'])){
                    foreach($_POST['b_name'] as $key => $b){
                        // if($_POST['b_name'][$key]!="-"){
                            $num = $matchObj->countBad($dataA['b_id']);
                            $dataB['b_id']=$dataA['b_id'];
                            $dataB['b_num']=$num;
                            $dataB['b_name']=$_POST['b_name'][$key];
                            // echo "<br>";
                            // print_r($dataB);
                            $ckB = $matchObj->addBad($dataB);
                        // }
                    }

                }
                if($ckA == true && $ckDA == true){
                    echo "  
                        <script type='text/javascript'>
                            setTimeout(function(){location.href='/badminton/pages/manage.php'} , 1);
                        </script>
                    ";
                    
                }
            }

        }
        if(isset($_POST['addMember'])){
            unset($_POST['addMember']);
            $_POST['m_date']=$_SESSION['date'];
            $_POST['u_id']=$_SESSION['b_u_id'];
            print_r($_POST);
            $ck = $memberObj->addMember($_POST);
            if ($ck) {
                echo "  
                    <script type='text/javascript'>
                        setTimeout(function(){location.href='/badminton/pages/manage.php'} , 1);
                    </script>
                ";
            }
        }
    ?>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4> วันที่ <?php echo datethai($_SESSION['date']); ?></h4>
        </div>
        <div class="card mt-2">
            <?php
                $ma_num = $matchObj->getNumCourtMatch($_SESSION['date'],$_SESSION['b_u_id']);
                // $_SESSION['court']=$_GET['court'];
            ?>
            <h5 class="card-header">3. จัดแมท
            </h5>
            <div class="card-body">
                <p>แมทที่ <?php echo $ma_num;?></p>
                <form action="" method="POST">
                    <div class="form-group mt-2">
                        <input type="hidden" class="form-control" id="" placeholder="" name="ma_date"
                            value="<?php echo $_SESSION['date'];?>">
                        <input type="hidden" class="form-control" id="" placeholder="" name="ma_num"
                            value="<?php echo $ma_num;?>">
                        <!-- <input type="hidden" class="form-control" id="" placeholder="" name="dm_id" value="<?php //echo uniqid();?>">
                        <input type="hidden" class="form-control" id="" placeholder="" name="b_id" value="<?php //echo uniqid();?>"> -->
                        <input type="hidden" class="form-control" id="" placeholder="" name="u_id"
                            value="<?php echo $_SESSION['b_u_id'];?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="text-primary">ผู้เล่น</label>
                        <ol>
                            <?php 
                            for($i=1;$i<=4;$i++){
                                ?>

                            <li>
                                <div class="d-flex mb-2">
                                    <div class="">
                                        <select class="form-select" aria-label="Default select example" name="member[]"
                                            required>
                                            <?php
                                                            $members = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                                            foreach($members as $m){
                                                                $memberMa = $memberObj->countMemberInDay($m['m_id']);
                                                                echo "
                                                                <option value='{$m['m_id']}'>{$m['m_name']}({$memberMa})</option>
                                                                ";
                                                            }
                                                        ?>
                                            <option selected value="0">---เลือกผู้เล่น---</option>
                                        </select>
                                    </div>
                                    <a class="btn btn-success mx-2 text-white mbtn-add">เพิ่ม</a>
                                    <?php
                                                    if($i==1){

                                                    }else{
                                                ?>
                                    <a class="btn btn-danger text-white mbtn1-remove ">ลบ</a>
                                    <?php } ?>
                                    <a class="btn btn-danger text-white mbtn-remove ">ลบ</a>
                                </div>
                            </li>

                            <?php
                            }
                        ?>
                        </ol>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="text-primary">ลูกแบด <b class="text-danger">กรณีที่ใช้ลูกซ่อมให้ใส่
                                "-"</b></label>
                        <ol>
                            <li>
                                <div class="d-flex mb-2">
                                    <div class="">
                                        <input type="text" class="form-control" id="exampleFormControlInput2"
                                            placeholder="ลูกที่" name="b_name[]" required>
                                    </div>
                                    <!-- <button class="btn btn-success mx-2 text-white bbtn-add">เพิ่ม</button>
                                    <button class="btn btn-danger text-white bbtn-remove ">ลบ</button> -->
                                </div>
                            </li>
                        </ol>
                    </div>
                    <hr>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" class="btn btn-primary text-white" name="add">ยืนยัน</button>
                    </div>
                </form>
                <hr>
                <form action="" method="POST">
                    <div class="d-flex mb-2">
                        <div class="">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อผู้เล่นใหม่" name="m_name">
                        </div>
                        <button type="submit" class="btn btn-success mx-2 text-white" name="addMember">เพิ่ม</button>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="card mt-2">
            <div class="card-body">
            <table class="table fs-12">
                    <thead>
                        <tr class='text-center'>
                            <th scope="col">ลูก</th>
                            <th class="text-center">ทีม 1</th>
                            <th scope="col">VS</th>
                            <th scope="col">ทีม 2</th>
                            <!-- <th scope="col">ลูกแบดที่</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $matchs2 = $matchObj->getCourtMatch($_SESSION['date'],$_SESSION['b_u_id']);
                            if(count($matchs2)>0){  
                                // print_r($matchs2);
                                $i = 0;
                                foreach($matchs2 as $match2){
                                   
                                    $i++;
                                    $dataMembers2 = $matchObj->getMatchDataById($match2['dm_id']);
                                    $dataBad2 = $matchObj->getBadById($match2['b_id']);
                                    $McountMath[0] = $memberObj->countMemberInDay($dataMembers2[0]['m_id']);
                                    $McountMath[1] = $memberObj->countMemberInDay($dataMembers2[1]['m_id']);
                                    $McountMath[2] = $memberObj->countMemberInDay($dataMembers2[2]['m_id']);
                                    $McountMath[3] = $memberObj->countMemberInDay($dataMembers2[3]['m_id']);
                                    // echo "<pre>";
                                    // print_r($dataMembers2);
                                    // echo "<br>";
                                    // foreach($dataMembers2 as $m){
                                    //     print_r($m);
                                    // print_r($dataBad2);
                                    // เกิน 2  ลูก
                                    $bb = 0;
                                    $badCount="";
                                    // echo "<pre>";
                                    // print_r($dataBad2);
                                    foreach($dataBad2 as $bad){

                                        $bb++;
                                        if($bb > 1 AND $bb <= count($dataBad2)){
                                            $cc = ",";
                                        }else{
                                            $cc="";
                                        }
                                       
                                        // echo $cc;
                                        // echo $bad['b_name'];
                                        $badCount .= $cc.$bad['b_name'];
                                       
                                        
                                    }
                                    
                                        echo "
                                            <tr class='text-center'>
                                                <td>{$badCount}</td>
                                                <td>{$dataMembers2[0]['m_name']}({$McountMath[0]}) + {$dataMembers2[1]['m_name']}({$McountMath[1]})</td>
                                                <td>VS</td>
                                                <td>{$dataMembers2[2]['m_name']}({$McountMath[2]}) + {$dataMembers2[3]['m_name']}({$McountMath[3]})</td>
                                                
                                            </tr>
                                        ";
                                    // }<td>{$dataBad2[0]['b_name']}</td>
                                }     
                            }      
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <?php 
         
            $matchs = $matchObj->getCourtMatch($_SESSION['date'],$_SESSION['b_u_id']);
            if(count($matchs)>0){                                    
        ?>
        <div class="card mt-2">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ที่</th>
                            <th scope="col">ผู้เล่น</th>
                            <th scope="col">ลูก</th>
                            <th scope="col">เพิ่มลูก</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mmnum =0;
                        foreach($matchs as $match){
                            $mmnum++;
                            $dataMembers = $matchObj->getMatchDataById($match['dm_id']);
                            $dataBad = $matchObj->getBadById($match['b_id']);
                            echo "
                                <tr>
                                    <th scope='row'>{$mmnum}</th>
                                    <td>";
                                    $i=0;
                                    foreach($dataMembers as $dm){
                                        $i++;
                                        echo $i.". ";
                                        echo "
                                        {$dm['m_name']}
                                        "."  <a class='fs-12' data-bs-toggle='modal' data-bs-target='#exampleModal2' data-bs-whatever='{$dm['id']}-{$dm['m_name']}'>edit</a>";
                                        echo "<br>";
                                    }
                                    
                            echo "</td>
                                    <td>";
                                    $i=0;
                                    foreach($dataBad as $db){
                                        $i++;
                                        echo $i.". ";
                                        echo "
                                        {$db['b_name']} 
                                        "."  <a class='fs-12' data-bs-toggle='modal' data-bs-target='#exampleModal3' data-bs-whatever='{$db['id']}'>edit</a>";
                                        echo "<br>";
                                    }
                                    echo"</td>
                                    <td> <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='{$match['b_id']}'>+</button></td>
                                    <td><a href='/badminton/pages/delmatch.php?del=del&ma_id={$match['ma_id']}&dm_id={$match['dm_id']}&b_id={$match['b_id']}' class='fs-12'>del</a></td>
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

        <br><br><br>
        <!-- เพิ่มลูก -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ลูกแบด สนาม <?php echo $_GET['court'];?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="bad.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="recipient-name1" name="b_id" value="">

                            <div class="mb-3">
                                <label for="b_name" class="col-form-label">ลูกแบด <b
                                        class="text-danger">กรณีที่ใช้ลูกซ่อมให้ใส่ "-"</b>:</label>
                                <input type="text" class="form-control" id="b_name" placeholder="ลูกที่" name="b_name"
                                    required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add_bad">เพิ่ม</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- แก้ไข -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ผู้เล่น </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="edit.php" method="POST">
                        <div class="modal-body">

                            <div class="mb-3">
                                <!-- <label for="recipient-name" class="col-form-label">ผู้เล่นเก่า: </label><label id="name_old"></label> -->
                                <input type="hidden" class="form-control" id="recipient-name" name="id">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ผู้เล่นใหม่:</label>
                                <select class="form-select" aria-label="Default select example" name="m_id" required>
                                    <?php
                                        $members = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                        foreach($members as $m){
                                            // $selected =($m['m_id']==$match['m_id']?"selected":"");
                                            echo "
                                            <option value='{$m['m_id']}' >{$m['m_name']}</option>
                                            ";
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div> -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="editMember">save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขลูกแบด</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="edit.php" method="POST">
                        <div class="modal-body">

                            <div class="mb-3">
                                <!-- <label for="recipient-name" class="col-form-label">ผู้เล่นเก่า: </label> -->
                               
                                <input type="hidden" class="form-control" id="recipient-id" name="id">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ลูกแบด:</label>
                                <input type="text" class="form-control" id="recipient-name" name="b_name">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div> -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="editbad">save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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
        let i = 4;

        $("body").on("click", ".mbtn-add", function(e) {
            if (i < 4) {
                i++;
                e.preventDefault();
                let ol = $(this).closest("ol")
                let li = $(this).closest("li").clone()
                li.appendTo(ol)
                li.find("input").val("")
                li.find(".mbtn-remove").show()
                li.find("[name='member[]']").focus()
            }
            console.log(i);
        })

        $("body").on("click", ".mbtn-remove", function(e) {
            i = i - 1;
            e.preventDefault();
            $(this).closest("li").remove()
            console.log(i);
        })
        $("body").on("click", ".mbtn1-remove", function(e) {
            i = i - 1;
            e.preventDefault();
            $(this).closest("li").remove()
            console.log(i);
        })



        let j = 1;
        $("body").on("click", ".bbtn-add", function(e) {


            j++;
            e.preventDefault();
            let ol = $(this).closest("ol")
            let li = $(this).closest("li").clone()
            li.appendTo(ol)
            li.find("input").val("")
            li.find(".bbtn-remove").show()
            li.find("[name='b_name[]']").focus()

            console.log(j);
        })

        $("body").on("click", ".bbtn-remove", function(e) {
            j = j - 1;
            e.preventDefault();
            $(this).closest("li").remove()
            console.log(j);
        })

    })
    </script>
    <script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        console.log(recipient)
        var inp = document.getElementById('recipient-name1')
        inp.value = recipient;
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')


        modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
        // document.getElementById("b_name").focus();

    })
    </script>
    <script>
    var exampleModal2 = document.getElementById('exampleModal2')
    exampleModal2.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button2 = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient2 = button2.getAttribute('data-bs-whatever')
        var res2 = recipient2.split("-", 1);
        var res22 = recipient2.split("-", 2);
        var name21 = res22[1]
        console.log(name21)

        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle2 = exampleModal2.querySelector('.modal-title')
        var modalBodyInput2 = exampleModal2.querySelector('.modal-body input')

        modalTitle2.textContent = ' ผู้เล่นเก่า ' + name21
        modalBodyInput2.value = res2;
    })
    </script>
    <script>
    var exampleModal3 = document.getElementById('exampleModal3')
    exampleModal3.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button3 = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient3 = button3.getAttribute('data-bs-whatever')
        var inp3 = document.getElementById('recipient-id')
        inp3.value = recipient3;

        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle3 = exampleModal3.querySelector('.modal-title')
        var modalBodyInput3 = exampleModal3.querySelector('.modal-body input')

      
    })
    </script>

</body>

</html>
