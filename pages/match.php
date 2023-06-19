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
            <h5 class="card-header">4.จัดแมท<?php //echo $i;
                                        ?></h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">สนาม</th>
                            <th scope="col">ดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $court = $courtObj->getCourtByDateUser($_SESSION['date'],$_SESSION['b_u_id']);
                            // print_r($court);
                            $i =0;
                            foreach($court as $c){
                                $i++;
                                echo "
                                    <tr>
                                        <th scope='row'>{$i}</th>
                                        <td>{$c['c_name']}</td>
                                        <td><a href='/badminton/pages/manage.php?c_id={$c['c_id']}&court={$c['c_name']}'>จัดผู้เล่น</a></td>
                                    </tr>
                                ";
                            }
                        ?>
                        

                    </tbody>
                </table>
                <hr>
                <!-- <h5 class="card-title">วันที่</h5>
                <div class="">
                    <input type="text" id="datepicker" class="form-control" placeholder="yyyy-mm-dd" name="dateS" autocomplete="off">
                </div> -->
                <!-- <div class="form-group mt-2">
                    <label for="" class="text-primary">สนาม</label>
                    <ol>
                        <li>
                            <div class="d-flex mb-2">

                                <div class="">
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="สนาม" name="snam[]">
                                </div>
                                <button class="btn btn-success mx-2 sbtn-add text-white">เพิ่ม</button>
                                <button class="btn btn-danger sbtn-remove text-white">ลบ</button>
                            </div>
                        </li>
                    </ol>
                </div>
                <div class="form-group mt-2">
                    <label for="" class="text-primary">รายชื่อ</label>
                    <ol>
                        <li>
                            <div class="d-flex mb-2">
                                <div class="">
                                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อ" name="name[]">
                                </div>
                                <button class="btn btn-success mx-2 nbtn-add text-white">เพิ่ม</button>
                                <button class="btn btn-danger nbtn-remove text-white">ลบ</button>
                            </div>
                        </li>
                    </ol>
                </div> -->

            </div>
        </div>
        <br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="/badminton/pages/member.php" class="btn btn-warning text-white me-md-2"><< ย้อนกลับ</a>
            <!-- <a href="/badminton/pages/member.php" class="btn btn-success text-white me-md-2">ต่อไป >></a> -->
        </div>
        <br><br><br>
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