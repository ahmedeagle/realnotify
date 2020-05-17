<?php

namespace App\Http\Controllers\Offers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public $module_view_folder;

    public function __construct()
    {
        $this->module_view_folder = 'front.offers';
    }

    public function index()
    {
        $offers = Offer::paginate(PAGINATION_COUNT);

        return view($this->module_view_folder . '.index', compact('offers'));
    }

    public function show($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);

        return view($this->module_view_folder . '.details',compact('offer'));
    }


}
