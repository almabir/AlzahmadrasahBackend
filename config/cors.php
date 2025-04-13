<?php
return [
    'paths' => ['api/*'], // Ensure API routes are covered
    'allowed_methods' => ['*'], // Allow all methods (GET, POST, etc.)
    'allowed_origins' => ['*'], // Change '*' to your Next.js URL for security
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // Set to true if using authentication cookies
];
