<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý tài khoản | Tech Store Admin</title>

    <meta name="robots" content="noindex, nofollow">

    <?php include __DIR__ . '/components/head-resources.php'; ?>

</head>


<body>

    <div class="flex min-h-screen">

        <?php include __DIR__ . '/sitebar.php'; ?>


        <!-- =====================================================
         MAIN
    ====================================================== -->

        <main
            class="
            flex-1
            lg:ml-64
            pt-14
            lg:pt-0
            p-4
            sm:p-6
            lg:p-8
            w-full
            min-w-0
        ">

            <!-- =================================================
             HEADER
        ================================================== -->

            <header class="mb-6 sm:mb-8">

                <nav class="text-sm text-slate-500 mb-2">

                    <span>
                        Trang chủ
                    </span>

                    <span class="mx-1">
                        /
                    </span>

                    <span class="text-slate-700">
                        Tài khoản
                    </span>

                </nav>


                <h1
                    class="
                    text-xl
                    sm:text-2xl
                    font-bold
                    text-slate-900
                ">
                    Bảng tài khoản
                </h1>


                <p
                    class="
                    text-slate-500
                    mt-1
                    text-sm
                ">
                    Quản lý người dùng hệ thống
                </p>

            </header>


            <!-- =================================================
             TABLE
        ================================================== -->

            <div class="adm-card overflow-hidden">

                <div class="overflow-x-auto">

                    <table
                        class="
                        adm-table
                        w-full
                        min-w-[800px]
                    ">

                        <!-- ==============================
                         TABLE HEAD
                    =============================== -->

                        <thead>

                            <tr>

                                <th>
                                    ID
                                </th>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Email
                                </th>

                                <th>
                                    Loại tài khoản
                                </th>

                                <th class="text-center">
                                    Thao tác
                                </th>

                            </tr>

                        </thead>


                        <!-- ==============================
                         TABLE BODY
                    =============================== -->

                        <tbody>

                            <?php if (empty($user)) { ?>

                                <tr>

                                    <td
                                        colspan="5"
                                        class="
                                    py-16
                                    text-center
                                    text-slate-400
                                ">
                                        Chưa có tài khoản nào
                                    </td>

                                </tr>

                            <?php } else { ?>


                                <?php foreach ($user as $row) { ?>

                                    <tr>

                                        <!-- ==========================
                                     ID
                                =========================== -->

                                        <td
                                            class="
                                        font-medium
                                        text-slate-900
                                        whitespace-nowrap
                                    ">

                                            #<?= htmlspecialchars($row['id']); ?>

                                        </td>


                                        <!-- ==========================
                                     NAME
                                =========================== -->

                                        <td
                                            class="
                                        font-medium
                                        text-slate-900
                                    ">

                                            <?= htmlspecialchars($row['name']); ?>

                                        </td>


                                        <!-- ==========================
                                     EMAIL
                                =========================== -->

                                        <td
                                            class="
                                        text-slate-600
                                    ">

                                            <?= htmlspecialchars($row['email']); ?>

                                        </td>


                                        <!-- ==========================
                                     ROLE
                                =========================== -->

                                        <td>

                                            <?php if ((int)$row['role'] === 1) { ?>

                                                <!-- ADMIN -->

                                                <span
                                                    class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                rounded-full
                                                px-3
                                                py-1
                                                text-xs
                                                font-medium
                                                bg-blue-50
                                                text-blue-600
                                                border
                                                border-blue-100
                                            ">
                                                    Admin
                                                </span>

                                            <?php } else { ?>

                                                <!-- USER -->

                                                <span
                                                    class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                rounded-full
                                                px-3
                                                py-1
                                                text-xs
                                                font-medium
                                                bg-green-50
                                                text-green-600
                                                border
                                                border-green-100
                                            ">
                                                    Người dùng
                                                </span>

                                            <?php } ?>

                                        </td>


                                        <!-- ==========================
                                     ACTION
                                =========================== -->

                                        <td class="text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-2">

                                                <!-- Xem -->
                                                <button
                                                    type="button"
                                                    onclick='showUser(<?= json_encode(
                                                                            $row,
                                                                            JSON_HEX_TAG |
                                                                                JSON_HEX_APOS |
                                                                                JSON_HEX_QUOT |
                                                                                JSON_HEX_AMP
                                                                        ); ?>)'
                                                    class="
                inline-flex items-center justify-center
                px-3 py-1.5
                rounded-lg
                bg-slate-100
                text-slate-700
                text-xs font-medium
                border border-slate-200
                hover:bg-slate-200
                hover:text-slate-900
                transition
                duration-200
            ">
                                                    Xem
                                                </button>


                                                <!-- Xóa -->
                                                <a
                                                    href="index.php?controller=user&action=xoamem&id=<?= $row['id'] ?>"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng này không?')"
                                                    class="
                inline-flex items-center justify-center
                px-3 py-1.5
                rounded-lg
                bg-red-50
                text-red-600
                text-xs font-medium
                border border-red-100
                hover:bg-red-100
                hover:text-red-700
                transition
                duration-200
            ">
                                                    Xóa
                                                </a>

                                            </div>
                                        </td>

                                    </tr>

                                <?php } ?>


                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>


    <!-- =====================================================
     OVERLAY
====================================================== -->

    <div
        id="userOverlay"

        class="
        fixed
        inset-0
        bg-black/30
        backdrop-blur-sm
        z-40
        hidden
    "

        onclick="closeUser()">
    </div>


    <!-- =====================================================
     DETAIL PANEL
====================================================== -->

    <div
        id="userPanel"

        class="
        fixed
        top-0
        right-0
        h-full
        w-full
        sm:w-[420px]
        bg-white
        shadow-2xl
        z-50
        transform
        translate-x-full
        transition-transform
        duration-300
        overflow-y-auto
    ">


        <!-- =================================================
         PANEL HEADER
    ================================================== -->

        <div
            class="
            sticky
            top-0
            bg-white
            border-b
            border-slate-200
            px-5
            py-4
            flex
            items-center
            justify-between
        ">

            <div>

                <h2
                    class="
                    text-lg
                    font-bold
                    text-slate-900
                ">
                    Chi tiết tài khoản
                </h2>


                <p
                    class="
                    text-xs
                    text-slate-500
                    mt-1
                ">
                    Thông tin người dùng
                </p>

            </div>


            <!-- CLOSE -->

            <button
                type="button"

                onclick="closeUser()"

                class="
                w-9
                h-9
                rounded-lg
                flex
                items-center
                justify-center
                text-slate-500
                hover:bg-slate-100
                hover:text-slate-900
                transition
            ">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />

                </svg>

            </button>

        </div>


        <!-- =================================================
         CONTENT
    ================================================== -->

        <div class="p-5">


            <!-- =================================================
             AVATAR + NAME
        ================================================== -->

            <div
                class="
                flex
                flex-col
                items-center
                text-center
                mb-8
            ">

                <div
                    id="detailAvatar"

                    class="
                    w-20
                    h-20
                    rounded-full
                    bg-slate-900
                    text-white
                    flex
                    items-center
                    justify-center
                    text-2xl
                    font-bold
                    mb-4
                ">
                    ?
                </div>


                <h3
                    id="detailName"

                    class="
                    text-xl
                    font-bold
                    text-slate-900
                ">
                </h3>


                <div
                    id="detailRole"
                    class="mt-2">
                </div>

            </div>


            <!-- =================================================
             INFORMATION
        ================================================== -->

            <div class="space-y-4">


                <!-- ID -->

                <div
                    class="
                    bg-slate-50
                    rounded-xl
                    p-4
                    border
                    border-slate-200
                ">

                    <p
                        class="
                        text-xs
                        text-slate-500
                    ">
                        ID tài khoản
                    </p>


                    <p
                        id="detailId"

                        class="
                        font-semibold
                        text-slate-900
                        mt-1
                    ">
                    </p>

                </div>


                <!-- NAME -->

                <div
                    class="
                    bg-slate-50
                    rounded-xl
                    p-4
                    border
                    border-slate-200
                ">

                    <p
                        class="
                        text-xs
                        text-slate-500
                    ">
                        Họ tên
                    </p>


                    <p
                        id="detailFullName"

                        class="
                        font-semibold
                        text-slate-900
                        mt-1
                    ">
                    </p>

                </div>


                <!-- EMAIL -->

                <div
                    class="
                    bg-slate-50
                    rounded-xl
                    p-4
                    border
                    border-slate-200
                ">

                    <p
                        class="
                        text-xs
                        text-slate-500
                    ">
                        Email
                    </p>


                    <p
                        id="detailEmail"

                        class="
                        font-semibold
                        text-slate-900
                        mt-1
                        break-all
                    ">
                    </p>

                </div>

                <div
                    class="
        bg-slate-50
        rounded-xl
        p-4
        border
        border-slate-200
    ">

                    <p class="text-xs text-slate-500">
                        Số điện thoại
                    </p>

                    <p
                        id="detailPhone"
                        class="
            font-semibold
            text-slate-900
            mt-1
        ">
                        Chưa cập nhật
                    </p>

                </div>
                <!-- ROLE -->

                <div
                    class="
                    bg-slate-50
                    rounded-xl
                    p-4
                    border
                    border-slate-200
                ">

                    <p
                        class="
                        text-xs
                        text-slate-500
                    ">
                        Loại tài khoản
                    </p>


                    <p
                        id="detailRoleText"

                        class="
                        font-semibold
                        text-slate-900
                        mt-1
                    ">
                    </p>

                </div>


                <!-- STATUS -->

                <div
                    class="
                    bg-slate-50
                    rounded-xl
                    p-4
                    border
                    border-slate-200
                ">

                    <p
                        class="
                        text-xs
                        text-slate-500
                    ">
                        Trạng thái
                    </p>


                    <span
                        id="detailStatus"

                        class="
                        inline-flex
                        rounded-full
                        px-3
                        py-1
                        text-xs
                        font-medium
                        mt-2
                        bg-green-50
                        text-green-600
                        border
                        border-green-100
                    ">
                        Đang hoạt động
                    </span>

                </div>


            </div>


            <!-- =================================================
             KICK
        ================================================== -->

            <div id="kickContainer" class="mt-6">
            </div>

            <!-- XÓA TÀI KHOẢN -->
            <div id="deleteContainer" class="mt-3">
            </div>

        </div>

    </div>


    <!-- =====================================================
     JAVASCRIPT
====================================================== -->

    <script>
        // ========================================================
        // SHOW USER
        // ========================================================

        function showUser(user) {


            // ====================================================
            // ID
            // ====================================================

            document.getElementById('detailId').textContent =
                '#' + (user.id ?? '');


            // ====================================================
            // NAME
            // ====================================================

            const name =
                user.name ?? 'Không có tên';


            document.getElementById('detailName').textContent =
                name;


            document.getElementById('detailFullName').textContent =
                name;


            // ====================================================
            // EMAIL
            // ====================================================

            document.getElementById('detailEmail').textContent =
                user.email ?? 'Không có email';

            document.getElementById('detailPhone').textContent =
                user.phone ?? 'Chưa cập nhật';
            // ====================================================
            // AVATAR
            // ====================================================

            document.getElementById('detailAvatar').textContent =
                name.trim().charAt(0).toUpperCase() || '?';


            // ====================================================
            // ROLE
            // ====================================================

            const role =
                Number(user.role ?? 0);


            if (role === 1) {


                // ------------------------------------------------
                // ADMIN BADGE
                // ------------------------------------------------

                document.getElementById('detailRole').innerHTML = `

            <span
                class="
                    inline-flex
                    rounded-full
                    px-3
                    py-1
                    text-xs
                    font-medium
                    bg-blue-50
                    text-blue-600
                    border
                    border-blue-100
                "
            >
                Admin
            </span>

        `;


                // ------------------------------------------------
                // ROLE TEXT
                // ------------------------------------------------

                document.getElementById('detailRoleText').textContent =
                    'Quản trị viên';


                // ------------------------------------------------
                // ADMIN KHÔNG KICK
                // ------------------------------------------------

                document.getElementById('kickContainer').innerHTML = `

            <div
                class="
                    w-full
                    rounded-xl
                    px-4
                    py-3
                    bg-blue-50
                    border
                    border-blue-100
                    text-blue-600
                    text-sm
                    font-medium
                    text-center
                "
            >
                🔒 Tài khoản Admin được bảo vệ
            </div>

        `;


            } else {


                // ------------------------------------------------
                // USER BADGE
                // ------------------------------------------------

                document.getElementById('detailRole').innerHTML = `

            <span
                class="
                    inline-flex
                    rounded-full
                    px-3
                    py-1
                    text-xs
                    font-medium
                    bg-green-50
                    text-green-600
                    border
                    border-green-100
                "
            >
                Người dùng
            </span>

        `;


                // ------------------------------------------------
                // ROLE TEXT
                // ------------------------------------------------

                document.getElementById('detailRoleText').textContent =
                    'Người dùng';


                // ------------------------------------------------
                // KICK USER
                // ------------------------------------------------

                document.getElementById('kickContainer').innerHTML = `

            <form
                action="index.php?controller=user&action=kick&id=${user.id}"
                method="POST"

                onsubmit="
                    return confirm(
                        'Bạn có chắc muốn kick tài khoản này không?'
                    );
                "
            >

                <button
                    type="submit"

                    class="
                        w-full
                        inline-flex
                        items-center
                        justify-center
                        rounded-xl
                        px-5
                        py-3
                        text-sm
                        font-semibold
                        bg-red-50
                        text-red-600
                        border
                        border-red-200
                        hover:bg-red-100
                        transition-colors
                    "
                >
                    Kick tài khoản
                </button>

            </form>

        `;

            }


            // ====================================================
            // STATUS
            // ====================================================

            const statusElement =
                document.getElementById('detailStatus');


            if (
                user.status !== undefined &&
                Number(user.status) === 0
            ) {


                statusElement.textContent =
                    'Đã bị kick';


                statusElement.className = `

            inline-flex
            rounded-full
            px-3
            py-1
            text-xs
            font-medium
            mt-2
            bg-red-50
            text-red-600
            border
            border-red-100

        `;


            } else {


                statusElement.textContent =
                    'Đang hoạt động';


                statusElement.className = `

            inline-flex
            rounded-full
            px-3
            py-1
            text-xs
            font-medium
            mt-2
            bg-green-50
            text-green-600
            border
            border-green-100

        `;

            }


            // ====================================================
            // HIỆN OVERLAY
            // ====================================================

            document
                .getElementById('userOverlay')
                .classList
                .remove('hidden');


            // ====================================================
            // HIỆN PANEL
            // ====================================================

            setTimeout(() => {

                document
                    .getElementById('userPanel')
                    .classList
                    .remove('translate-x-full');

            }, 10);

        }


        // ========================================================
        // CLOSE USER
        // ========================================================

        function closeUser() {


            // ĐẨY PANEL RA NGOÀI

            document
                .getElementById('userPanel')
                .classList
                .add('translate-x-full');


            // ẨN OVERLAY

            setTimeout(() => {

                document
                    .getElementById('userOverlay')
                    .classList
                    .add('hidden');

            }, 300);

        }


        // ========================================================
        // ESC
        // ========================================================

        document.addEventListener(
            'keydown',
            function(event) {

                if (event.key === 'Escape') {

                    closeUser();

                }

            }
        );
    </script>


    <?php include __DIR__ . '/components/toast-init.php'; ?>


</body>

</html>