<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        if (!in_array(request('change_language'), ['en', 'it', 'fr'])) {
            abort(400);
        }
        app()->setLocale(request('change_language'));
        $_SESSION['language'] = request('change_language');
        return redirect()->back();
    }
}