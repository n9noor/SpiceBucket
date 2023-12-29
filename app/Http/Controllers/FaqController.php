<?php

namespace App\Http\Controllers;

use App\Models\Faqs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    function add(Request $request)
    {
		if(Session::get('admin-loggedin-property')['faq-add'] == 0){
			return view('wms.accessdenied');
		}
		$id = $request->addfaqid;
        $data = Faqs::where('id', $id)->first();
        if ($data == null) {
            $data = new Faqs();
        }
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        return redirect('/administrator/faq');
    }
    function list()
    {
		if(Session::get('admin-loggedin-property')['faq-view'] == 0){
			return view('wms.accessdenied');
		}
        $faqs = Faqs::all();
        return view('faq.list', ['title' => 'List FAQ - SpiceBucket Administration', 'faqs' => $faqs]);
    }

    function getFAQ($id)
    {
		if(Session::get('admin-loggedin-property')['faq-edit'] == 0){
			return view('wms.accessdenied');
		}
        $faqData = Faqs::where('id', $id)->first();
        return response()->json(['status' => true, 'faq' => $faqData]);
    }
}
