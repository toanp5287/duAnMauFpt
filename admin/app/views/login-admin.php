<script src="https://cdn.tailwindcss.com"></script>


<body class="bg-gradient-to-br from-indigo-100 to-blue-200 min-h-screen flex items-center justify-center p-4">

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
                đăng nhập admin
            </h2>

            <p class="text-gray-500 mt-2">
                Đăng nhập vào tài khoản admin của bạn
            </p>

        </div>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-300 text-red-600 rounded-lg p-3 mb-4 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="index.php?controller=auth&action=login"
            method="POST"
            id="formSumit">

            <div class="mb-4">
                <label class="block mb-2 font-medium text-gray-700">
                    Email
                </label>

                <input type="email"
                    name="email"
                    class="email w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
                    placeholder="name@example.com">

                <p id="emmailErrol" class="text-red-500 text-sm mt-1"></p>
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-medium text-gray-700">
                    Mật khẩu
                </label>

                <input type="password"
                    name="password"
                    class="pass w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
                    placeholder="••••••••">

                <p id="passErrol" class="text-red-500 text-sm mt-1"></p>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 transition duration-300 text-white py-3 rounded-lg font-semibold shadow-lg">

                Đăng nhập

            </button>

        </form>

    </div>

</body>