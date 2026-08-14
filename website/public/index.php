<?php
session_start();
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../../shared/Validator.php';
require_once __DIR__ . '/../../shared/form_helpers.php';


require_once __DIR__ . '/../../vendor/autoload.php';



require_once __DIR__ . '/../app/models/model-home-page.php';
require_once __DIR__ . '/../app/models/ModelReview.php';
require_once __DIR__ . '/../app/models/model-category.php';
require_once __DIR__ . '/../app/models/model-chi-tiet.php';
require_once __DIR__ . '/../app/models/Model-login-web.php';
require_once __DIR__ . '/../app/models/model-buy.php';

require_once __DIR__ . '/../app/services/MailService.php';

require_once __DIR__ . '/../app/models/model-shopping-cart.php';

require_once __DIR__ . '/../app/controllers/controller-home-page.php';
require_once __DIR__ . '/../app/controllers/controller-category.php';
require_once __DIR__ . '/../app/controllers/controller-chi-tiet.php';
require_once __DIR__ . '/../app/controllers/controller-buy.php';
require_once __DIR__ . '/../app/controllers/Controller-login-web.php';

require_once __DIR__ . '/../app/services/MailService.php';
require_once __DIR__ . '/../app/controllers/controller-shopping-cart.php';


require_once __DIR__ . '/../routers/router.php';
