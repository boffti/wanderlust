<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;

class TipController extends Controller
{
    public function addTip(Request $request) {
        $tipContent = $request->get('tip');
        $tip = new Tip;
        $tip->tip_content = $tipContent;
        $tip->user_id = session('user')['user_id'];
        $tip->city_id = session('user_loc')['city_id'];
        $tip->save();
        return redirect()->route('all-tips');
    }

    public function deleteTip(Request $request, $tip_id, $loc) {
        $tip = Tip::where('tip_id', $tip_id)->first();
        $tip -> delete();
        if($loc == '1') {
            return redirect()->route('super-admin');
        } elseif($loc == '3') {
            return redirect()->route('profile');
        } else {
            return redirect()->route('country-admin');
        }
    }
}
