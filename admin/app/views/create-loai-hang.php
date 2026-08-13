<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm danh mục tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <?php include __DIR__ . '/sitebar.php'; ?>
        <div class="ml-64 flex-1 p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Thêm danh mục tour</h2>

            <form method="POST" id="formAdd" class="space-y-4">
                <div>
                    <input type="text" id="ten_loai" name="ten_loai"
                        placeholder="Tên loại hang"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="ten_loai_err" class="text-red-500 text-sm mt-1"></p>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors">
                    Thêm loai hang
                </button>
            </form>

            <a href="./index.php"
                class="block text-center mt-6 text-gray-700 hover:text-gray-900 underline">
                ← Quay lại trang
            </a>
        </div>
        <script>
            function validate() {
                let ten_loai = document.getElementById("ten_loai").value.trim();
                let isValidate = true;

                document.getElementById("ten_loai_err").innerText = "";

                if (ten_loai === "") {
                    document.getElementById("ten_loai_err").innerText = "Tên loại không được để trống";
                    isValidate = false;
                }

                return isValidate;
            }

            document.getElementById("formAdd").addEventListener("submit", function(e) {
                if (!validate()) {
                    e.preventDefault();
                }
            });
        </script>
</body>

</html>