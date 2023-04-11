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
            $dataA['c_id']=$_POST['c_id']; 
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
                        $ckDA = $matchObj->addMatchData($dataM);
                    }

                }
                if(isset($_POST['b_name'])){
                    foreach($_POST['b_name'] as $key => $b){
                        $num = $matchObj->countBad($dataA['b_id']);
                        $dataB['b_id']=$dataA['b_id'];
                        $dataB['b_num']=$num;
                        $dataB['b_name']=$_POST['b_name'][$key];
                        // echo "<br>";
                        // print_r($dataB);
                        $ckB = $matchObj->addBad($dataB);
                    }

                }
            }

        }
    ?>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4> วันที่ <?php echo datethai($_SESSION['date']); ?></h4>
        </div>
        <div class="card mt-2">
            <?php
                $ma_num = $matchObj->getNumCourtMatch($_SESSION['date'],$_SESSION['b_u_id'],$_GET['c_id']);
            ?>
            <h5 class="card-header">4. จัดแมท สนาม <span class="badge bg-danger"><?php echo $_GET['court'];?></span></h5>
            <div class="card-body">
                <p>แมทที่ <?php echo $ma_num;?></p>
                <form action="" method="POST">
                    <div class="form-group mt-2">
                        <input type="hidden" class="form-control" id="" placeholder="" name="ma_date" value="<?php echo $_SESSION['date'];?>">
                        <input type="hidden" class="form-control" id="" placeholder="" name="c_id" value="<?php echo $_GET['c_id'];?>">
                        <input type="hidden" class="form-control" id="" placeholder="" name="ma_num" value="<?php echo $ma_num;?>">
                        <!-- <input type="hidden" class="form-control" id="" placeholder="" name="dm_id" value="<?php //echo uniqid();?>">
                        <input type="hidden" class="form-control" id="" placeholder="" name="b_id" value="<?php //echo uniqid();?>"> -->
                        <input type="hidden" class="form-control" id="" placeholder="" name="u_id" value="<?php echo $_SESSION['b_u_id'];?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="text-primary">ผู้เล่น</label>
                        <ol>
                            <li>
                                <div class="d-flex mb-2">
                                    <div class="">
                                        <select class="form-select" aria-label="Default select example" name="member[]" required>
                                            <?php
                                                $members = $memberObj->getMemberByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                                foreach($members as $m){
                                                    echo "
                                                    <option value='{$m['m_id']}'>{$m['m_name']}</option>
                                                    ";
                                                }
                                            ?>
                                            <option selected>---เลือกผู้เล่น---</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-success mx-2 text-white mbtn-add">เพิ่ม</button>
                                    <button class="btn btn-danger text-white mbtn-remove ">ลบ</button>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <div class="form-group mt-2">
                        <label for="" class="text-primary">ลูกแบด</label>
                        <ol>
                            <li>
                                <div class="d-flex mb-2">
                                    <div class="">
                                        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="ลูกที่" name="b_name[]" required>
                                    </div>
                                    <button class="btn btn-success mx-2 text-white bbtn-add">เพิ่ม</button>
                                    <button class="btn btn-danger text-white bbtn-remove ">ลบ</button>
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
               
            </div>
        </div>
        <br>
        <?php 
            $matchs = $matchObj->getCourtMatch($_SESSION['date'],$_SESSION['b_u_id'],$_GET['c_id']);
            if(count($matchs)>0){                                    
        ?>
        <div class="card mt-2">
            <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">เกมส์ที่</th>
                        <th scope="col">ผู้เล่น</th>
                        <th scope="col">ลูก</th>
                        <th scope="col">เพิ่มลูก</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        foreach($matchs as $match){
                           
                            $dataMembers = $matchObj->getMatchDataById($match['dm_id']);
                            $dataBad = $matchObj->getBadById($match['b_id']);
                            echo "
                                <tr>
                                    <th scope='row'>{$match['ma_num']}</th>
                                    <td>";
                                    $i=0;
                                    foreach($dataMembers as $dm){
                                        $i++;
                                        echo $i.". ";
                                        echo "
                                        {$dm['m_name']}
                                        ";
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
                                        ";
                                        echo "<br>";
                                    }
                                    echo"</td>
                                    <td> <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='{$db['b_id']}'>+</button></td>
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

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ลูกแบด สนาม <?php echo $_GET['court'];?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="bad.php" method="POST">
                        <div class="modal-body">
                            
                            
                                <input type="hidden" class="form-control" id="recipient-name" name="b_id">
                                <input type="hidden" class="form-control" id="recipient-name" name="c_id" value="<?php echo $_GET['c_id'];?>">
                                <input type="hidden" class="form-control" id="recipient-name" name="court" value="<?php echo $_GET['court'];?>">
                            
                            <div class="mb-3">
                                <label for="b_name" class="col-form-label">ลูกแบด:</label>
                                <input type="text" class="form-control" id="b_name" placeholder="ลูกที่" name="b_name" required>
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
            
            $("body").on("click", ".mbtn-add", function(e) {
                if(i < 4){
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
        exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')
        

        // modalTitle.textContent = 'New message to ' + recipient
        modalBodyInput.value = recipient
        // document.getElementById("b_name").focus();
        
        })
    </script>
    
</body>

</html>