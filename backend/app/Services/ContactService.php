<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function __construct(
        private readonly ContactRepositoryInterface $contacts,
    ) {}

    /**
     * Store a new contact message.
     *
     * @param  array<string, mixed>  $data
     */
    public function submit(array $data): Contact
    {
        $contact = $this->contacts->create($data);

        // Admin-ready hook: dispatch a notification / queue a job here later.
        Log::info('New portfolio contact message.', ['contact_id' => $contact->id]);

        return $contact;
    }
}
