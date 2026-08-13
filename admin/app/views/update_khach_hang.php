<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm Tour</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin-left: 270px;
        }

        .container {
            width: 420px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        small {
            color: red;
            display: block;
            margin-bottom: 12px;
            font-size: 13px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .btn1 {
            width: 100%;
            padding: 12px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn1 a {
            text-decoration: none;
            color: white;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/8pxelqmcl6ibgm3a2zvie1pcjkdihinxrz7oxsy878q4tzrc/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',

            plugins: 'lists link image table code',

            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table | code',

            menubar: false,

            height: 300
        });
    </script>
</head>

<body>
    <?php include './views/sitebar.php'; ?>
    <div class="container">
        <h2>sua don hang , khach hang</h2>
        <form method="POST" id="formAdd" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php echo $khach_hang_limit['id'] ?>">
            <input type="hidden" name="user_id" value="<?php echo $khach_hang_limit['user_id'] ?>">
            <input type="text" id="ten_tour" name="trang_thai" placeholder="trang thai" value="<?php echo $khach_hang_limit['trang_thai'] ?>">
            <small id="errorName"></small>
            <input type="text" id="ten_tour" name="ten_khach_hang" placeholder="ten khach hang" value="<?php echo $khach_hang_limit['ten_khach_hang'] ?>">

            <input type="text" id="ten_tour" name="so_dien_thoai" placeholder="so dien thoai" value="<?php echo $khach_hang_limit['so_dien_thoai'] ?>">
            <input type="text" id="ten_tour" name="dia_chi" placeholder="dia chi" value="<?php echo $khach_hang_limit['dia_chi'] ?>">

            <input type="text" id="ten_tour" name="cach_thanh_toan" placeholder="cach thanh toan" value="<?php echo $khach_hang_limit['cach_thanh_toan'] ?>">



            <textarea id="mo_ta" name="ghi_chu" placeholder="Mô tả ">
    <?php echo $khach_hang_limit['ghi_chu'] ?>
            </textarea>
            <small id="errorMoTa"></small>
            <input type="number" id="gia" name="tong_tien" placeholder="tong tien" value="<?php echo $khach_hang_limit['tong_tien'] ?>">
            <small id="errorPrice"></small>
            <input type="hidden" name="created_at" value="<?php echo $khach_hang_limit['created_at'] ?>">
            <button type="submit">Thêm tour</button>

        </form>
        <button class="btn1"><a href="./index.php">quay lai trang</a></button>
    </div>
    <script>
        function validateForm() {

            let name = document.getElementById("ten_tour").value.trim();

            let description = tinymce.get("mo_ta").getContent().trim();

            let price = document.getElementById("gia").value.trim();

            let validate = true;

            // reset lỗi
            document.getElementById("errorName").innerText = "";
            document.getElementById("errorMoTa").innerText = "";
            document.getElementById("errorPrice").innerText = "";

            // validate tên
            if (name === "") {

                document.getElementById("errorName").innerText =
                    "Không được để trống";

                validate = false;

            } else if (name.length < 3) {

                document.getElementById("errorName").innerText =
                    "Tên tối thiểu 3 ký tự";

                validate = false;
            }

            // validate mô tả
            if (description === "") {

                document.getElementById("errorMoTa").innerText =
                    "Không được để trống";

                validate = false;

            } else if (description.length < 10) {

                document.getElementById("errorMoTa").innerText =
                    "Mô tả tối thiểu 10 ký tự";

                validate = false;
            }

            // validate tổng tiền
            if (price === "") {

                document.getElementById("errorPrice").innerText =
                    "Không được để trống";

                validate = false;

            } else if (parseFloat(price) <= 0) {

                document.getElementById("errorPrice").innerText =
                    "Tổng tiền phải lớn hơn 0";

                validate = false;
            }

            return validate;
        }

        document.getElementById("formAdd")
            .addEventListener("submit", function(e) {

                if (!validateForm()) {
                    e.preventDefault();
                }
            });
    </script>


</body>

</html>