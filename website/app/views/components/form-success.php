<?php
$successMessage = $successMessage ?? form_success_message();

if ($successMessage === '') {
    return;
}
?>
<p class="text-sm text-green-600 mb-4" role="status"><?= htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') ?></p>
