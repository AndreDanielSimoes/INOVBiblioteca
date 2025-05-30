<?php

use App\Mail\ReturnReminderEmail;
use App\Models\Requisition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('send:return-reminders', function () {
    $requisitions = Requisition::with(['user', 'book'])
        ->whereDate('delivery_date', Carbon::tomorrow())
        ->get();

    foreach ($requisitions as $requisition) {
        if ($requisition->user && $requisition->book) {
            Mail::to($requisition->user->email)
                ->queue(new ReturnReminderEmail($requisition));
        }
    }

    $this->info("Sent return reminders to {$requisitions->count()} users.");
})->purpose('Send reminder emails to users with books due tomorrow.');

Schedule::command('send:return-reminders')->daily();

