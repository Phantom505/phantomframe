<?php
$yield = <<<HTML
    <h2>{$title}</h2>
    <p>{$content}</p>
    
    <div class="features">
        <div class="feature">
            <h3>MVC architecture</h3>
            <p>Clear separation of business logic, data and presentation.</p>
        </div>
        <div class="feature">
            <h3>Routing</h3>
            <p>Simple and flexible routing system.</p>
        </div>
        <div class="feature">
            <h3>Database</h3>
            <p>Convenient work with databases via PDO.</p>
        </div>
    </div>
HTML;

include __DIR__ . '/../layout.php';
?>