<?php
session_start();

// ─── PATHS ───────────────────────────────────────────────────────────────────
// __DIR__ trỏ đến C:\xampp\htdocs\web-ban-hang
// website/ là thư mục chứa toàn bộ logic frontend
$website = __DIR__ . '/website';

// ─── CONFIG ──────────────────────────────────────────────────────────────────
require_once $website . '/config/Database.php';


// ─── VENDOR ──────────────────────────────────────────────────────────────────
require_once __DIR__ . '/vendor/autoload.php';

// ─── MODELS ──────────────────────────────────────────────────────────────────
require_once $website . '/app/models/model-home-page.php';
require_once $website . '/app/models/ModelReview.php';
require_once $website . '/app/models/model-category.php';
require_once $website . '/app/models/model-chi-tiet.php';
require_once $website . '/app/models/Model-login-web.php';
require_once $website . '/app/models/model-buy.php';
require_once $website . '/app/models/model-shopping-cart.php';
require_once $website . '/app/models/PaymentModel.php';
// ─── SERVICES ────────────────────────────────────────────────────────────────
require_once $website . '/app/services/MailService.php';

// validate
require_once __DIR__ . '/shared/form_helpers.php';
// require_once __DIR__ . '/shared/test_admin_product_category.php';
// require_once __DIR__ . '/shared/test_auth_register_login.php';
// require_once __DIR__ . '/shared/test_cart_checkout.php';
// require_once __DIR__ . '/shared/test_review_forms.php';
// require_once __DIR__ . '/shared/test_validator.php';
require_once __DIR__ . '/shared/upload_helpers.php';
require_once __DIR__ . '/shared/Validator.php';
// ─── CONTROLLERS ─────────────────────────────────────────────────────────────
require_once $website . '/app/controllers/controller-home-page.php';
require_once $website . '/app/controllers/controller-category.php';
require_once $website . '/app/controllers/controller-chi-tiet.php';
require_once $website . '/app/controllers/controller-buy.php';
require_once $website . '/app/controllers/Controller-login-web.php';
require_once $website . '/app/controllers/controller-shopping-cart.php';
require_once $website . '/app/controllers/Payment.php';

// ─── ROUTER ──────────────────────────────────────────────────────────────────
require_once $website . '/routers/router.php';
