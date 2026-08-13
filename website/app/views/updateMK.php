<script src="https://cdn.tailwindcss.com"></script>

<main class="min-h-screen bg-sky-50 flex items-center justify-center p-6">

  <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

    <!-- Tiêu đề -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-sky-600">
        Đổi mật khẩu
      </h1>

      <p class="text-gray-500 mt-2">
        Vui lòng nhập mật khẩu hiện tại và mật khẩu mới.
      </p>
    </div>


    <!-- Form -->
    <form
      action="index.php?controller=login&action=updateMKuser"
      method="POST"
      class="space-y-6">

      <!-- Mật khẩu hiện tại -->
      <div>

        <label class="block text-gray-700 font-medium mb-2">
          Mật khẩu hiện tại
        </label>

        <input
          type="password"
          name="currentPassword"
          placeholder="Nhập mật khẩu hiện tại"
          required
          class="
                        w-full
                        border border-gray-300
                        rounded-xl
                        px-4 py-3
                        outline-none
                        focus:border-sky-500
                        focus:ring-2
                        focus:ring-sky-200
                        transition
                    ">

        <?php if (!empty($errolcurrentPassword)): ?>

          <p class="mt-2 text-sm text-red-500">
            <?= $errolcurrentPassword ?>
          </p>

        <?php endif; ?>

      </div>


      <!-- Mật khẩu mới -->
      <div>

        <label class="block text-gray-700 font-medium mb-2">
          Mật khẩu mới
        </label>

        <input
          type="password"
          name="newPassword"
          placeholder="Nhập mật khẩu mới"
          required
          class="
                        w-full
                        border border-gray-300
                        rounded-xl
                        px-4 py-3
                        outline-none
                        focus:border-sky-500
                        focus:ring-2
                        focus:ring-sky-200
                        transition
                    ">

      </div>


      <!-- Xác nhận mật khẩu -->
      <div>

        <label class="block text-gray-700 font-medium mb-2">
          Xác nhận mật khẩu mới
        </label>

        <input
          type="password"
          name="ConfirmPassword"
          placeholder="Nhập lại mật khẩu mới"
          required
          class="
                        w-full
                        border border-gray-300
                        rounded-xl
                        px-4 py-3
                        outline-none
                        focus:border-sky-500
                        focus:ring-2
                        focus:ring-sky-200
                        transition
                    ">

        <?php if (!empty($errolConfirmPassword)): ?>

          <p class="mt-2 text-sm text-red-500">
            <?= $errolConfirmPassword ?>
          </p>

        <?php endif; ?>

      </div>


      <!-- Nút -->
      <div class="flex flex-col sm:flex-row gap-3 pt-3">

        <!-- Cập nhật -->
        <button
          type="submit"
          class="
                        flex-1
                        h-12
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        rounded-xl
                        bg-sky-500
                        text-white
                        text-sm
                        font-bold
                        shadow-sm
                        hover:bg-sky-600
                        hover:shadow-md
                        active:scale-[0.98]
                        transition-all
                        duration-200
                    ">

          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M5 13l4 4L19 7" />
          </svg>

          Cập nhật mật khẩu

        </button>


        <!-- Hủy -->
        <a
          href="index.php?controller=login&action=controllerGETuser"
          class="
                        flex-1
                        h-12
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        rounded-xl
                        border
                        border-gray-200
                        bg-white
                        text-gray-700
                        text-sm
                        font-bold
                        hover:bg-gray-50
                        hover:border-gray-300
                        active:scale-[0.98]
                        transition-all
                        duration-200
                    ">

          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>

          Hủy

        </a>

      </div>

    </form>

  </div>

</main>