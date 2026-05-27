<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWebhook;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceiveWebhookController extends Controller
{
    public function __invoke(Request $request): Response
    {
        ProcessWebhook::dispatch($request->all());

        return response()->noContent(Response::HTTP_ACCEPTED);
    }
}
