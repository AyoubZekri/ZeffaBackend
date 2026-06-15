<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    Illuminate\Support\Facades\Mail::raw('Test email from Zeffa', function ($message) {
        $message->to('codedev39@gmail.com')
                ->subject('Test Email');
    });
    echo "Mail sent successfully.\n";
} catch (\Exception $e) {
    echo "Mail sending failed: " . $e->getMessage() . "\n";
}
