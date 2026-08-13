<!doctype html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tài khoản của tôi</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen py-10">
  <div class="max-w-7xl mx-auto px-5">
    <div class="flex gap-8">
      <!-- Sidebar -->
      <aside class="w-72 bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-sky-500 mb-8">Tài khoản</h2>

        <ul class="space-y-3">

          <li class="bg-sky-500 text-white px-5 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg">
            <a href="index.php?controller=login&action=controllerGETuser" class="block">
              Thông tin cá nhân
            </a>
          </li>

          <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
            <a href="index.php?controller=login&action=lichSu" class="block">
              Lịch sử đơn hàng
            </a>
          </li>

          <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
            <a href="index.php?controller=login&action=viuUpdatemkUser" class="block">
              Đổi mật khẩu
            </a>
          </li>

          <li class="px-5 py-3 rounded-xl transition-all duration-300 hover:bg-sky-100 hover:text-sky-600 hover:translate-x-2 hover:shadow-md">
            <a href="index.php?controller=san_pham&action=index" class="block">
              Quay lại trang
            </a>
          </li>

        </ul>
      </aside>

      <!-- Content -->
      <main class="flex-1 space-y-8">
        <!-- Thông tin tài khoản -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
          <h2 class="text-2xl font-bold text-slate-700 mb-8">
            Cập nhật thông tin tài khoản
          </h2>
          <form action="index.php?controller=login&action=controllerUpateUser" method="POST">
            <div class="space-y-5">
              <div>
                <label class="block mb-2 font-medium text-slate-600">
                  Họ và tên
                </label>

                <input
                  type="text"
                  name="name"
                  placeholder="Nhập họ và tên"
                  class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-400"
                  value="<?= $user['name'] ?>" />
              </div>

              <div>
                <label class="block mb-2 font-medium text-slate-600">
                  Email
                </label>

                <input
                  type="email"
                  name="email"
                  placeholder="Nhập email"
                  class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-400"
                  value="<?= $user['email'] ?>" />
              </div>

              <div>
                <label class="block mb-2 font-medium text-slate-600">
                  Số điện thoại
                </label>

                <input
                  type="text"
                  name="phone"
                  placeholder="Nhập số điện thoại"
                  class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-400"
                  value="<?= $user['phone'] ?>" />
              </div>

              <button
                class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-3 rounded-xl font-semibold transition">
                Cập nhật
              </button>

            </div>
          </form>

        </div>

        <!-- Lịch sử đơn hàng -->

      </main>
    </div>
  </div>
</body>

</html>