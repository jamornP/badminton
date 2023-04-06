<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Basic Form Elements | Bootstrap Based Admin Template - Material Design</title>
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
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/badminton/function/function.php"; ?>
    <div class="container mt-5">
        <div class="card">
            <h5 class="card-header">สนาม</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">สนาม</th>
                            <th scope="col">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                        </tr>

                    </tbody>
                </table>
                <hr>
                <form action="index.php" method="POST">
                    <div class="d-flex mb-2">

                        <div class="">
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="สนาม" name="court">
                        </div>
                        <button type="submit" class="btn btn-success mx-2 text-white">เพิ่ม</button>
                    </div>
                </form>
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