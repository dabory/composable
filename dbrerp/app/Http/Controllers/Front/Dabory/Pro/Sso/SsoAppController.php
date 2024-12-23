<?PHP

namespace App\Http\Controllers\Front\Dabory\Pro\Sso;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\Pro\FormB;
use App\Models\Parameter\Pro\Modal;

class SsoAppController extends Controller
{
    public function index()
    {
        if (empty(request('bpa'))) { return redirect()->route('my-app.index'); }

        try {
            $formB = new FormB(request('bpa'));
            $ssoAppModal = (new Modal('/search/slip-search/sso-app'))->getData();
        } catch (ParameterException $e) {
            return redirect()->route('my-app.index')->with('error', 'ErrorMessage: '.$e->getMessage().
                ' 경로에 Parameter 형식에 맞춰서 넣어주세요.');
        }

//        dd($formB->getData());
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.pro.my-app.sso.sso-app',
            array_merge(
                compact('ssoAppModal'),
                compact('menuCode'),
                $formB->getData(),
            )
        );
    }
}
