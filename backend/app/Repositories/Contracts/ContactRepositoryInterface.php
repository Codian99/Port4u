<?php

namespace App\Repositories\Contracts;

use App\Models\Contact;

interface ContactRepositoryInterface
{
    /**
     * Persist a contact message.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Contact;
}
