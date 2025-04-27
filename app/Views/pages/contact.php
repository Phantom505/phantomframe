<?php
$title = 'Contacts';
$yield = <<<HTML
    <h2>Контакты</h2>
    
    <div class="contact-form">
        <p>If you have any questions or suggestions, please fill out the form below:</p>
        
        <form method="post" action="/contact/send" class="form">
            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
HTML;

include __DIR__ . '/../layout.php';