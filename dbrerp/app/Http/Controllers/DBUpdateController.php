<?php

namespace App\Http\Controllers;

use App\Services\CallApiService;
use Illuminate\Http\Request;

class DBUpdateController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index()
    {
        $dbupdateProc = $this->callApiService->callApi([
            'url' => 'dbupdate-proc',
            'data' => [
                'IsRun' => request('is_run', '0'),
                'IsSkipUpdate' => env('IS_SKIP_DBUPDATE')
            ],
        ]);

        if (empty($dbupdateProc['Page'])) {
            return $this->redirectDashboard();
        }

        return view('pages.dbupdate-dashboard', ['dbupdateProc' => $dbupdateProc])
            ->with('codeTitle', [ "sort('dbupdate')" ]);
    }

    public function store()
    {
        $dbupdateProc = $this->callApiService->callApi([
            'url' => 'dbupdate-proc',
            'data' => [
                'IsRun' => request('is_run', '0'),
                'IsSkipUpdate' => env('IS_SKIP_DBUPDATE')
            ],
        ]);

        if (empty(request('is_run'))) {
            return redirect()->route('db-update.index');
        }

        if ($this->callApiService->verifyApiError($dbupdateProc)) {
            notify()->error(_e('Action failed'), 'Error', 'bottomRight');
            return redirect()->route('db-update.index');
        }

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return $this->redirectDashboard();
    }

    public function redirectDashboard()
    {
        session()->put('user.is_member', true);
        return redirect()->route('dashboard');
    }
}
