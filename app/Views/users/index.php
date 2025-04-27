<?php
$usersHtml = '';

if (empty($users)) {
    $usersHtml = '<div class="alert">Users not found</div>';
} else {
    $usersHtml = '<table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
    
    foreach ($users as $user) {
        $usersHtml .= "<tr>
                        <td>{$user['id']}</td>
                        <td>{$user['name']}</td>
                        <td>{$user['email']}</td>
                        <td>
                            <a href='users/{$user['id']}' class='btn btn-view'>View</a>
                            <a href='users/{$user['id']}/edit' class='btn btn-edit'>Edit</a>
                            <form method='post' action='users/{$user['id']}/delete' class='inline'>
                                <button type='submit' class='btn btn-delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
    }
    
    $usersHtml .= '</tbody></table>';
}

$yield = <<<HTML
    <div class="page-header">
        <h2>{$title}</h2>
        <a href="/users/create" class="btn btn-primary">Add new user</a>
    </div>
    
    {$usersHtml}
HTML;

include __DIR__ . '/../layout.php';
