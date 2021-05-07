<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function updateWhatsapp(Request $request)
    {
        $whatsapp = $request->get('whatsapp');
        store()->update(['whatsapp' => $whatsapp]);

        return $this->chooseReturn('success', _m('common.success.update'));
    }

    public function bannerUpdate(Request $request)
    {
        store()->addMediaFromRequest('banner')->toMediaCollection('banner');
        return $this->chooseReturn('success', _m('common.success.update'), route('home'));
    }

    public function getBanner()
    {
        return response(store()->banner, 200, ['Content-Type:image/*']);

    }
}
