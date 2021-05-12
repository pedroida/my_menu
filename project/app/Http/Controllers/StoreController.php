<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuProductResource;
use App\Models\Product;
use App\Models\SingletonStore;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Criterias\Common\OrderBy;
use App\Repositories\Criterias\Common\When;
use App\Repositories\Criterias\Common\WhereHas;
use App\Repositories\Criterias\Common\With;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
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
        $this->middleware('auth')->only(['index', 'updateWhatsapp', 'bannerUpdate']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $singletonStore = $this->singletonStore;
        return view('home', compact('singletonStore'));
    }

    public function updateWhatsapp(Request $request)
    {
        $whatsapp = $request->get('whatsapp');
        $this->singletonStore->update(['whatsapp' => $whatsapp]);
        Cache::forget('store-data');

        return $this->chooseReturn('success', _m('common.success.update'));
    }

    public function bannerUpdate(Request $request)
    {
        $this->singletonStore->addMediaFromRequest('banner')->toMediaCollection('banner');
        Cache::forget('store-data');
        return $this->chooseReturn('success', _m('common.success.update'), route('home'));
    }

    public function getBanner()
    {
        return response($this->singletonStore->banner, 200, ['Content-Type:image/*']);

    }

    public function getCategories()
    {
        $categories = (new CategoryRepository())->pushCriteria([
            new OrderBy('name'),
            new WhereHas('products')
        ])->all();

        return response()->json($categories);
    }

    public function pagination()
    {
        $category = request()->get('category');
        $pagination = pagination()
            ->repository(new BaseRepository(Product::class))
            ->resource(MenuProductResource::class)
            ->criterias([
                new With(['category', 'unit', 'promotion']),
                new When($category, function ($query) use ($category) {
                    return $query->where('category_id', $category);
                })
            ])
            ->perPage(100)
            ->defaultOrderBy('name', 'asc');

        return $pagination->build();
    }
}
