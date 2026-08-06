<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contacts,
    ) {}

    /**
     * POST /contact
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = $this->contacts->submit($request->validated());

        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(201);
    }
}
