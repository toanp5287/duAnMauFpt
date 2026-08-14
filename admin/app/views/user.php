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

        <main class="flex-1 lg:ml-64 pt-14 lg:pt-0 p-4 sm:p-6 lg:p-8 w-full min-w-0">
            <header class="mb-6 sm:mb-8">
                <nav class="text-sm text-slate-500 mb-2">
                    <span>Trang chủ</span> / <span class="text-slate-700">Tài khoản</span>
                </nav>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Bảng tài khoản</h1>
                <p class="text-slate-500 mt-1 text-sm">Quản lý người dùng hệ thống</p>
            </header>
            <div class="adm-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px] border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-4 text-center align-middle text-sm font-semibold text-slate-700">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-center align-middle text-sm font-semibold text-slate-700">
                                    Name
                                </th>

                                <th class="px-6 py-4 text-center align-middle text-sm font-semibold text-slate-700">
                                    Email
                                </th>

                                <th class="px-6 py-4 text-center align-middle text-sm font-semibold text-slate-700">
                                    Loại tài khoản
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            <?php if (empty($user)) { ?>
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-16 text-center align-middle text-slate-400">
                                        Chưa có tài khoản nào
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php foreach ($user as $row) { ?>
                                <tr class="hover:bg-slate-50 transition-colors duration-200">

                                    <td class="px-6 py-4 text-center align-middle">
                                        <span class="font-medium text-slate-900">
                                            #<?php echo $row['id']; ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle">
                                        <span class="font-medium text-slate-900">
                                            <?php echo htmlspecialchars($row['name']); ?>
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle text-slate-600">
                                        <?php echo htmlspecialchars($row['email']); ?>
                                    </td>

                                    <td class="px-6 py-4 text-center align-middle">
                                        <?php if ($row['role'] == 1) { ?>

                                            <span class="inline-flex items-center justify-center
                                    rounded-full px-3 py-1
                                    text-xs font-medium
                                    bg-blue-50 text-blue-600
                                    border border-blue-100">
                                                Admin
                                            </span>

                                        <?php } else { ?>

                                            <span class="inline-flex items-center justify-center
                                    rounded-full px-3 py-1
                                    text-xs font-medium
                                    bg-green-50 text-green-600
                                    border border-green-100">
                                                Người dùng
                                            </span>

                                        <?php } ?>
                                    </td>

                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <?php include __DIR__ . '/components/toast-init.php'; ?>
</body>

</html>