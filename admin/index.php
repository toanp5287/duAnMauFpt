<?php
session_start();

// ─── PATHS ───────────────────────────────────────────────────────────────────
// __DIR__ trỏ đến C:\xampp\htdocs\web-ban-hang\admin
$admin = __DIR__;

// ─── CONFIG ──────────────────────────────────────────────────────────────────
require_once dirname($admin) . '/website/config/Database.php';
require_once dirname($admin) . '/shared/Validator.php';
require_once dirname($admin) . '/shared/form_helpers.php';
require_once dirname($admin) . '/shared/upload_helpers.php';

// ─── MODELS ──────────────────────────────────────────────────────────────────
require_once $admin . '/app/models/Model-login-admin.php';
require_once $admin . '/app/models/data-san-pham.php';
require_once $admin . '/app/models/data-loai-hang.php';
require_once $admin . '/app/models/model-khach-hang.php';
require_once $admin . '/app/models/order_details.php';
require_once $admin . '/app/models/Model-user.php';
// ─── CONTROLLERS ─────────────────────────────────────────────────────────────
require $admin . '/app/controllers/san-pham.php';
require_once $admin . '/app/controllers/loai-hang.php';
require_once $admin . '/app/controllers/Controller-login-admin.php';
require_once $admin . '/app/controllers/khach-hang.php';
require_once $admin . '/app/controllers/orders_detail.php';
require_once $admin . '/app/controllers/Users.php';

// ─── ROUTER ──────────────────────────────────────────────────────────────────
require_once $admin . '/routers/router.php';
