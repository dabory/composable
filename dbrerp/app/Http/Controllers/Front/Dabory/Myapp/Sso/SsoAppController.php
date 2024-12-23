<?PHP

namespace App\Http\Controllers\Front\Dabory\Myapp\Sso;

use App\Exceptions\ParameterException;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;

class SsoAppController extends Controller
{
    public function index()
    {
        if (empty(request('bpa'))) { return redirect()->to('/dabory/myapp'); }

        try {
            $formB = new FormB(request('bpa'), null, null, false, 'myapp');
            $ssoAppModal = (new Modal('/search/slip-search/sso-app', null, 'myapp'))->getData();
        } catch (ParameterException $e) {
            return redirect()->to('/dabory/myapp')->with('error', $e->getMessage());
        }

//        dd($formB->getData());
        $menuCode = Utils::bpaDecoding(request('bpa'))['menu_code'];

        return view('front.dabory.myapp.sso.sso-app',
            array_merge(
                compact('ssoAppModal'),
                compact('menuCode'),
                $formB->getData(),
            )
        );
    }
}
