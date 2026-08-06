<?php

namespace App\Repositories;

use App\Enums\ContactStatus;
use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Persist a contact message.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Contact
    {
        return Contact::create([
            ...$data,
            'status' => ContactStatus::New,
        ]);
    }
}
