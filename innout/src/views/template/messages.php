<?php

if($exception) {
    $message = [
        'type' => 'error',
        'message' => $exception->getMessage()
    ];
}

?>

<?php if($message): ?>
    <div role = "alert" class = "mx-3 alert alert-<?= $message['type'] === 'error' ? 'danger' : 'success' ?>">
        <?= $message['message'] ?>
    </div>
<?php endif ?>