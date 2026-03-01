<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\ShopPageService;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    protected $shopService;

    public function __construct(ShopPageService $shopService)
    {
        $this->shopService = $shopService;
    }

    public function index(Request $request, $slug = null, $subslug = null, $childslug = null, $superchildslug = null)
    {
        $data = $this->shopService->getShopData(
            $request, $slug, $subslug, $childslug, $superchildslug
        );

        if ($request->ajax()) {
            return response()->json([
                'html' => view('frontend.partials.pro_slide_list', ['products' => $data['products']])->render(),
                'pagination' => (string) $data['products']->links('pagination::bootstrap-4'),
            ]);
        }

        return view('frontend.shop', $data);
    }

    public function filterProducts(Request $request)
    {
        $products = $this->shopService->filterProducts($request);

        return response()->json([
            'html' => view('frontend.partials.pro_slide_list', [
                'products' => $products,
            ])->render(),
            'pagination' => (string) $products->links('pagination::bootstrap-4'),
        ]);
    }
}
