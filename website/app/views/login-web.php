<script src="https://cdn.tailwindcss.com"></script>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-blue-100 to-indigo-200 p-6">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 p-10">

        <!-- Header -->
        <div class="text-center mb-8">

            <a href="index.php"
                class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-600 text-white flex items-center justify-center">

                <svg xmlns="http://www.w3.org/2000/svg"
                    width="32"
                    height="32"
                    viewBox="0 0 24 24"
                    fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>

            </a>

            <h2 class="text-3xl font-bold text-slate-800">
                Chào mừng trở lại
            </h2>

            <p class="text-slate-500 mt-2">
                Vui lòng đăng nhập
            </p>

        </div>

        <?php if (isset($error)): ?>
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-3 text-center text-red-600 font-medium">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=login&action=xu_ly_dang_nhap"
            method="POST"
            id="formSumit">

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="email w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500"
                    placeholder="name@example.com">

                <p id="emmailErrol" class="text-red-500 text-sm mt-1"></p>

            </div>

            <div class="mb-5">

                <label class="block font-semibold mb-2">
                    Mật khẩu
                </label>

                <input
                    type="password"
                    name="password"
                    class="pass w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500"
                    placeholder="••••••••">

                <p id="passErrol" class="text-red-500 text-sm mt-1"></p>

            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-300 shadow-lg">

                Đăng nhập

            </button>

        </form>

        <div class="relative my-6">

            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-300"></div>
            </div>

            <div class="relative flex justify-center">
                <span class="bg-white px-3 text-slate-500 text-sm">
                    Chưa có tài khoản?
                </span>
            </div>

        </div>

        <a href="index.php?controller=login&action=dang_ky"
            class="w-full flex justify-center items-center py-3 rounded-xl border border-indigo-600 text-indigo-600 font-semibold hover:bg-indigo-50 transition">

            Tạo tài khoản mới

        </a>

    </div>

</body>