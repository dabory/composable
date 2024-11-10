<?php

namespace App\Services;

class DbUpdateService
{
    public function checkIsSkipDbUpdate()
    {
        switch (env('IS_SKIP_DBUPDATE')) {
            case '1':
                return $this->redirectDashboard();
            case '0':
            case '9':
                return redirect()->route('db-update.index');
        }
    }

    public function redirectDashboard()
    {
        session()->put('user.is_member', true);
        return redirect()->route('dashboard');
    }
}
