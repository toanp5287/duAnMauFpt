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
    <?php include 'sitebar.php'; ?>
    <div class="container">
        <h2>sua san pham</h2>

        <form method="POST" id="formAdd" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $san_pham_update['id'] ?>">
            <input type="text" id="ten_tour" name="ten_san_pham" placeholder="Tên san pham" value="<?php echo $san_pham_update['ten_san_pham'] ?>">
            <small id="errorName"></small>

            <input type="number" id="gia" name="gia" placeholder="Giá san pham" value="<?php echo $san_pham_update['gia'] ?>">
            <small id="errorPrice"></small>

            <input type="number" id="so_luong" name="so_luong" placeholder="Giá so luong" value="<?php echo $san_pham_update['so_luong'] ?>">
            <small id="errorSoLuong"></small>

            <textarea id="mo_ta" name="mo_ta" placeholder="Mô tả ">
            <?php echo $san_pham_update['mo_ta'] ?>
            </textarea>
            <small id="errorMoTa"></small>


            <select name="loai_hang_id" id="ten_danh_muc">

                <option value="">-- Chọn loại hàng --</option>

                <?php foreach ($list_loai as $row) { ?>

                    <option
                        value="<?php echo $row['id'] ?>"

                        <?php
                        if ($row['id'] == $san_pham_update['loai_hang_id']) {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $row['ten_loai'] ?>
                    </option>

                <?php } ?>

            </select>
            <div class="my-4 text-center">
                <p class="mb-3 font-bold text-gray-700">
                    Ảnh hiện tại
                </p>

                <img
                    src="./uploads/<?php echo $san_pham_update['hinh_anh']; ?>"
                    alt=""
                    class="mx-auto h-64 w-full max-w-[300px] rounded-2xl border-2 border-blue-100 object-cover shadow-lg">
            </div>
            <input type="file" id="hinh_anh" name="hinh_anh" placeholder="hinh anh" value="<?php echo $san_pham_update['hinh_anh'] ?>">
            <button type="submit">Thêm tour</button>

        </form>
        <button class="btn1"><a href="./index.php">quay lai trang</a></button>
    </div>
    <script>
        function validateForm() {
            let name = document.getElementById("ten_tour").value.trim();

            let description = tinymce.get("mo_ta").getContent().trim();

            let price = document.getElementById("gia").value.trim();

            let so_luong = document.getElementById("so_luong").value.trim();

            const ten_danh_muc = document.getElementById("ten_danh_muc").value;

            let validate = true;

            document.getElementById("errorName").innerText = "";
            document.getElementById("errorMoTa").innerText = "";
            document.getElementById("errorPrice").innerText = "";
            document.getElementById("errorSoLuong").innerText = "";
            document.getElementById("errorChon").innerText = "";

            if (name === "") {
                document.getElementById("errorName").innerText = "Không được để trống";
                validate = false;
            } else if (name.length < 3) {
                document.getElementById("errorName").innerText = "Tên tối thiểu 3 ký tự";
                validate = false;
            }

            if (description === "") {
                document.getElementById("errorMoTa").innerText = "Không được để trống";
                validate = false;
            } else if (description.length < 10) {
                document.getElementById("errorMoTa").innerText = "Mô tả tối thiểu 10 ký tự";
                validate = false;
            }

            if (price === "") {
                document.getElementById("errorPrice").innerText = "Không được để trống";
                validate = false;
            } else if (price <= 0) {
                document.getElementById("errorPrice").innerText = "Giá phải lớn hơn 0";
                validate = false;
            }

            if (so_luong === "") {
                document.getElementById("errorSoLuong").innerText = "Không được để trống";
                validate = false;
            } else if (so_luong <= 0) {
                document.getElementById("errorSoLuong").innerText = "Số lượng phải lớn hơn 0";
                validate = false;
            }

            if (ten_danh_muc == "") {
                document.getElementById("errorChon").innerText = "phai chon danh muc";
                validate = false;
            }

            return validate;
        }

        document.getElementById("formAdd").addEventListener("submit", function(e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    </script>

</body>

</html>