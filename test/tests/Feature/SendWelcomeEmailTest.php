<?php

namespace Tests\Feature;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use App\Models\Client;
use App\Mail\WelcomeEmail;

class SendWelcomeEmailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_email_is_sent(): void
    {
        Mail::fake(); // подменяет реальную отправку писем для тестирования

        // Создание фейкового клиента
        $client = new Client(['email' => 'test@example.com', 'name' => 'Test Name']);

        // Запуск задания
        $job = new SendWelcomeEmail($client);
        $job->handle();

        // Проверяем отправку письма
        Mail::assertSent(WelcomeEmail::class, function ($mail) use ($client) {
            return $mail->hasTo($client->email);
        });
    }
}
