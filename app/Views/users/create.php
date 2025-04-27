<?php
$errorsHtml = '';
if (!empty($errors)) {
    $errorsHtml = '<div class="alert alert-danger"><ul>';
    foreach ($errors as $field => $message) {
        $errorsHtml .= "<li>{$message}</li>";
    }
    $errorsHtml .= '</ul></div>';
}

$oldName = $data['name'] ?? '';
$oldEmail = $data['email'] ?? '';

$yield = <<<HTML
    <div class="page-header">
        <h2>{$title}</h2>
        <a href="/users" class="btn">Назад к списку</a>
    </div>
    
    {$errorsHtml}
    
    <form method="post" action="/users" class="form">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{$oldName}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{$oldEmail}" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
HTML;

include __DIR__ . '/../layout.php';