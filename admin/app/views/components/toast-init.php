<script>
    window.onload = function() {
        <?php if (isset($_SESSION['msg'])) { ?>
            new Toast({
                message: "<?php echo addslashes($_SESSION['msg']); ?>",
                type: "<?php echo $_SESSION['type'] ?? 'info'; ?>",
                timeout: 3000
            });
            <?php
            unset($_SESSION['msg']);
            unset($_SESSION['type']);
            ?>
        <?php } ?>
        <?php
        $validationSuccess = form_success_message();
        if ($validationSuccess !== '') {
            echo 'new Toast({ message: "' . addslashes($validationSuccess) . '", type: "success", timeout: 3000 });';
        }
        ?>
    };
</script>
