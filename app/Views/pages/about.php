<?php
// Подключаем шаблон
$title = 'About us';
$yield = <<<HTML
    <h2>About PhantomFrame Framework</h2>
    
    <div class="about-content">
        <p>PhantomFrame is a lightweight PHP framework that demonstrates the basic principles of the MVC (Model-View-Controller) architecture.</p>
        <br/>
        <h3>Features of the framework:</h3>
        <br/>
        <ul>
            <li>Simple and clear architecture</li>
            <li>Flexible routing system</li>
            <li>Working with databases via PDO</li>
            <li>Easily extensible structure</li>
            <li>Minimal dependencies</li>
        </ul>
        
    </div>
HTML;

include __DIR__ . '/../layout.php';