<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\LeaveRequest;

class LeaveRequestApprovedByManager extends Notification
{
    use Queueable;

    protected $leaveRequest;

    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Send via email and save to database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Leave Request Approved by Manager')
            ->line('A leave request has been approved by the manager and requires your attention.')
            ->line('Employee: ' . $this->leaveRequest->employee->first_name . ' ' . $this->leaveRequest->employee->last_name)
            ->line('Start Date: ' . $this->leaveRequest->start_date)
            ->line('End Date: ' . $this->leaveRequest->end_date)
            ->action('View Leave Request', url('/hr-leave-requests/' . $this->leaveRequest->id))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'leave_request_id' => $this->leaveRequest->id,
            'message' => 'A leave request has been approved by the manager.',
            'url' => '/hr-leave-requests/' . $this->leaveRequest->id,
        ];
    }
}
