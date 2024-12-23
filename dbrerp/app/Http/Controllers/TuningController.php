<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class TuningController extends Controller
{
    public function registerTuningRoutes()
    {
        // dd(env('APP_GATETOKEN'));
        // dd(session()->all());
        $data = Utils::getAllMainMenu();
        // dd($data);
        // dump(session('GateToken'));
        Route::get('/dabory/erp/list-type/type1', '\App\Http\Controllers\Front\Dabory\Erp\ListType\Type1Controller@index');
    }
}
// <iframe src="https://kibana-seoul-a.daboryhost.com:5601/app/kibana#/dashboard/6c35f280-2481-11ee-9456-e3fd09483c50?embed=true&_g=(refreshInterval:(pause:!t,value:0),time:(from:now-15m,to:now))&_a=(description:'',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),panels:!((embeddableConfig:(title:''),gridData:(h:21,i:d118a472-1894-4785-9d79-dcb98a87901e,w:48,x:0,y:0),id:'61201020-251b-11ee-b5e4-43d55004d94d',panelIndex:d118a472-1894-4785-9d79-dcb98a87901e,type:visualization,version:'7.6.1')),query:(language:kuery,query:''),timeRestore:!f,title:'%5BDashboard%5DSales%20analysis%20by%20optician',viewMode:view)" height="600" width="800"></iframe>
    // <iframe src="https://kibana-seoul-a.daboryhost.com:5601/app/kibana#/dashboard/5abce2c0-2d3c-11ee-abf5-498f427d0ccd?embed=true&_g=(refreshInterval:(pause:!t,value:0),time:(from:now-7y,to:now))&_a=(description:'',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),panels:!((embeddableConfig:(),gridData:(h:26,i:f953ed05-bb60-49b0-8d34-f38c8e8bb1eb,w:48,x:0,y:0),id:fa60e460-2d33-11ee-abf5-498f427d0ccd,panelIndex:f953ed05-bb60-49b0-8d34-f38c8e8bb1eb,type:visualization,version:'7.6.1')),query:(language:kuery,query:''),timeRestore:!f,title:'%5BDashboard%5DSales%20analysis%20by%20optician%20chart%204',viewMode:view)" height="600" width="800"></iframe>
        // <iframe src="https://kibana-seoul-a.daboryhost.com:5601/app/kibana#/dashboard/55a72890-2d3c-11ee-abf5-498f427d0ccd?embed=true&_g=(refreshInterval:(pause:!t,value:0),time:(from:now-7y,to:now))&_a=(description:'',filters:!(),fullScreenMode:!f,options:(hidePanelTitles:!f,useMargins:!t),panels:!((embeddableConfig:(),gridData:(h:25,i:'242c985e-08e8-4ab7-aa81-7b860261157b',w:48,x:0,y:0),id:'82ff88a0-2d37-11ee-abf5-498f427d0ccd',panelIndex:'242c985e-08e8-4ab7-aa81-7b860261157b',type:visualization,version:'7.6.1')),query:(language:kuery,query:''),timeRestore:!f,title:'%5BDashboard%5DSales%20analysis%20by%20optician%20chart%203',viewMode:view)" height="600" width="800"></iframe>
