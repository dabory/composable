<?php

namespace App\Http\Controllers;

class CountryCodeController extends \Illuminate\Routing\Controller
{
    public function store()
    {
        session()->put('user.CountryCode', request('code'));

        return redirect()->back();
    }
}
