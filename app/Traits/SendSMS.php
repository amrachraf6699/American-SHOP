<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SendSMS
{
    public function sendMessage($senderName, $mobile, $content)
    {
        $response = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJpZCI6ImJjN2UyMmZiLWYxZmQtNDk4Ny05MGUxLTA1NzM4MWVlMjUzOSIsImlhdCI6MTczMDgwNDIzOCwiaXNzIjoyMDY0Nn0.J7KBKBbDmKAjD8mJJD68WSiY_DASqJzc6Lxs3X13mBg')
            ->asForm() // Send as form-urlencoded
            ->post('https://api.releans.com/v2/message', [
                'sender' => 'Amr Achraf',
                'mobile' => '+201063153994',
                'content' => 'Moled',
            ]);

        return $response->json(); // Returns the response as JSON
    }
}
