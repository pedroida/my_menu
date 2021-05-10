<?php

namespace App\Http\Controllers;

use App\Models\SingletonStore;

class MenuController extends Controller
{
    private $singletonStore;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SingletonStore $singletonStore)
    {
        $this->singletonStore = $singletonStore;
    }

    public function __invoke()
    {
        $singletonStore = $this->singletonStore;
        if(!current_user())
            $singletonStore->increment('visits_count');
        return view('menu', compact('singletonStore'));
    }
}
