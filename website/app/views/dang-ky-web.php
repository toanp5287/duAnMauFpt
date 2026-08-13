<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gradient-to-br from-indigo-100 to-blue-200 min-h-screen flex items-center justify-center py-10 px-4">

    <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-8 w-full max-w-md">

        <div class="text-center mb-6">

            <div class="w-16 h-16 mx-auto bg-indigo-600 rounded-full flex items-center justify-center text-white mb-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="30"
                    height="30"
                    fill="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-800">
                Tạo tài khoản
            </h2>

            <p class="text-gray-500 mt-2">
                Bắt đầu mua sắm ngay hôm nay
            </p>

        </div>
        <?php if (isset($error)): ?>
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-3 text-center text-red-600 font-medium">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form action="index.php?controller=login&action=xu_ly_dang_ky"
            method="POST"
            id="postAdd">

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700">
                    Họ tên
                </label>

                <input id="name"
                    type="text"
                    name="name"
                    placeholder="Nguyễn Văn A"
                    class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none">

                <p id="errorName" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700">
                    Email
                </label>

                <input id="email"
                    type="email"
                    name="email"
                    placeholder="name@example.com"
                    class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none">

                <p id="errorEmail" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700">
                    Số điện thoại
                </label>

                <input id="phone"
                    type="text"
                    name="phone"
                    placeholder="0901234567"
                    class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none">

                <p id="errorPhone" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium text-gray-700">
                    Mật khẩu
                </label>

                <input id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none">

                <p id="errorPassword" class="text-red-500 text-sm mt-1"></p>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 transition text-white py-3 rounded-lg font-semibold shadow-lg">

                Đăng ký ngay

            </button>

        </form>

        <div class="relative my-6">

            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>

            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-gray-500">
                    Đã có tài khoản?
                </span>
            </div>

        </div>

        <a href="index.php?controller=login&action=index"
            class="block text-center w-full border border-indigo-600 text-indigo-600 hover:bg-indigo-50 py-3 rounded-lg font-semibold transition">

            Đăng nhập

        </a>

    </div>

</body>