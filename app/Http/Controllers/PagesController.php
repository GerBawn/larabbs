<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function root()
    {
        return view('pages.root');
    }

    public function permissionDenied()
    {
        if (config('administrator.permission')()) {
            Log::debug('hehe');
            return redirect(url(config('administrator.uri')), 302);
        }

        return view('pages.permission_denied');
    }
}
