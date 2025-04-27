<?php
$yield = <<<HTML
    <div class="page-header">
        <h2>{$title}</h2>
        <div class="actions">
            <a href="/users" class="btn">Back</a>
            <a href="/users/{$user['id']}/edit" class="btn btn-edit">Edit</a>
            <form method="post" action="/users/{$user['id']}/delete" class="inline">
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </div>
    </div>
    
    <div class="user-profile">
        <div class="field">
            <span class="label">ID:</span>
            <span class="value">{$user['id']}</span>
        </div>
        <div class="field">
            <span class="label">Name:</span>
            <span class="value">{$user['name']}</span>
        </div>
        <div class="field">
            <span class="label">Email:</span>
            <span class="value">{$user['email']}</span>
        </div>
        <div class="field">
            <span class="label">Date:</span>
            <span class="value">{$user['created_at']}</span>
        </div>
    </div>
HTML;

include __DIR__ . '/../layout.php';
