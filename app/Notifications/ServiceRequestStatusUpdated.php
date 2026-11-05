<?php

namespace App\Notifications;

use App\Models\ServiceRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ServiceRequestStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public ServiceRequest $serviceRequest
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Service Request Updated',
            'message' => 'Your service request status has been updated to ' . $this->serviceRequest->status . '.',
            'reference_number' => $this->serviceRequest->reference_number,
            'status' => $this->serviceRequest->status,
            'service_request_id' => $this->serviceRequest->id,
        ];
    }
}
