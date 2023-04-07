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
            <h4> วันที่ <?php echo datethai($_SESSION['date']); ?></h4>
        </div>
        <div class="card mt-2">
            <h5 class="card-header">แมท<?php //echo $i;
                                        ?></h5>
            <div class="card-body">

                <form action="" method="POST">
                    <div class="form-group mt-2">
                        <label for="" class="text-primary">สนาม</label>
                        <div class="d-flex mb-2">
                            <div class="col-8">
                                <select class="form-select form-select" aria-label="form-select-sm example" name="c_id">
                                    <option selected>เลือก</option>
                                    <?php
                                    $court = $courtObj->getCourtByDateUserStatus($_SESSION['date'], $_SESSION['b_u_id'], 0);
                                    // print_r($court);
                                    $i = 0;
                                    foreach ($court as $c) {
                                        $i++;
                                        $selected = ($c['c_id'] == $_POST['c_id'] ? "selected" : "");
                                        echo "
                                            <option value='{$c['c_id']}' {$selected}>{$c['c_name']}</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mx-2 text-white" name="court">จัดการ</button>
                        </div>
                    </div>
                </form>
                <hr>
        <?php
        if (isset($_POST['court'])) {
            if($_POST['court']!= "1"){
            // }else{
            // print_r($_POST);
            $num = $matchObj->getNumCourtMatch($_SESSION['date'], $_SESSION['b_u_id'], $_POST['c_id']);
            $court = $courtObj->getCourtById($_POST['c_id']);
            // echo $num;
            $match['c_id'] = $_POST['c_id'];
            $match['ma_num'] = $num;
            $match['ma_date'] = $_SESSION['date'];
            $match['ma_status'] = 1;
            $match['u_id'] = $_SESSION['b_u_id'];
            // print_r($match);
            // if()
            $ma_id = $matchObj->addMatch($match);
            $_SESSION['ma_id']=$ma_id;
            $courtU['c_id']=$match['c_id'];
            $courtU['c_status']=1;
            $ckC = $courtObj->updateCourt($courtU);
        }
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">สนาม</th>
                        <th scope="col">แมทที่</th>
                        <th scope="col">แก้ไข</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data_match = $matchObj->getMatchByDateUser($_SESSION['date'], $_SESSION['b_u_id']);
                    // print_r($data_match);
                    $i = 0;
                    foreach ($data_match as $dm) {
                        $i++;
                        echo "
                            <tr>
                                <th scope='col'>{$i}</th>
                                <th>{$dm['c_name']}</th>
                                <th>{$dm['ma_num']}</th>
                                <th>{$dm['ma_status']}</th>
                            </tr>
                        ";
                    }
                    ?>

                </tbody>
            </table>
            <hr>
            <div class="card mt-2">
                <h5 class="card-header">สนาม <?php echo $court['c_name'] . " คู่ที่ " . $num;
                                                ?></h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ผู้เล่น</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $dataMD=$matchObj->getMatchDataByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                                $i=0;
                                foreach($dataMD as $dmd){
                                $i++;
                                    echo "
                                    <tr>
                                        <th scope='row'>{$i}</th>
                                        <td>{$dmd['m_name']}</td>
                                        <td>del</td>
                                    </tr>
                                    ";
                                }
                            ?>
                           


                        </tbody>
                    </table>
                    <hr>

                    <form action="" method="POST">
                        <div class="form-group mt-2">
                            <label for="" class="text-primary">ผู้เลาน</label>
                            <div class="d-flex mb-2">
                                <div class="col-8">
                                    <select class="form-select form-select" aria-label=".form-select-sm example" name="m_id">
                                        <option selected>เลือก</option>
                                        <?php
                                        // $court = $courtObj->getCourtByDateUserStatus($_SESSION['date'], $_SESSION['b_u_id'],0);
                                        $member = $memberObj->getMemberByDateUserStatus($_SESSION['date'], $_SESSION['b_u_id'], 0);
                                        // print_r($court);
                                        $i = 0;
                                        foreach ($member as $m) {
                                            $i++;
                                            $selected = ($m['m_id'] == $_POST['m_id'] ? "selected" : "");
                                            echo "
                                            <option value='{$m['m_id']}' {$selected}>{$m['m_name']}</option>
                                        ";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="court" value="1">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="c_id" value="<?php echo $_POST['c_id'];?>">
                                <button type="submit" class="btn btn-success mx-2 text-white" name="add_member">เพิ่ม</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['add_member'])) {
        // unset($_POST['add_member']);
        $dataM['ma_id']=$_SESSION['ma_id'];
        $dataM['m_id']=$_POST['m_id'];
        $dataM['md_date']=$_SESSION['date'];
        $dataM['u_id']=$_SESSION['b_u_id'];
        print_r($dataM);
        $md_id = $matchObj->addMatchData($dataM);
        $dataMU['m_id']=$_POST['m_id'];
        $dataMU['m_status']=1;
        $ckUM = $memberObj->updateMember($dataMU);
    }
    ?>
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