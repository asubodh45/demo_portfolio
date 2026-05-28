<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactSubmission;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    use ApiResponse;

    public function store(ContactRequest $request): JsonResponse
    {
        ContactSubmission::create($request->validated());

        return $this->success(null, 'Your message has been sent. Thank you!', 201);
    }
}
