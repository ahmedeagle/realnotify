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

        return view($this->module_view_folder . '.index', compact('offers')) ;
    }

    public function show($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);

        if (request('id') && request('resourcePath')) {
             $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
              if (isset($payment_status['id'])) { //success payment id -> transaction bank id
                  $showSuccessPaymentMessage = true;

                  //save order in orders table with transaction id  = $payment_status['id']
                return view($this->module_view_folder . '.details',compact('offer'))-> with(['success' =>  'تم الدفغ بنجاح']);
            } else {
                $showFailPaymentMessage = true;
                 return view($this->module_view_folder . '.details',compact('offer'))-> with(['fail'  => 'فشلت عملية الدفع']);
            }

        }
        return view($this->module_view_folder . '.details',compact('offer'));
    }

    private function getPaymentStatus($id, $resourcepath)
    {
        $url = "https://test.oppwa.com/";
        $url .= $resourcepath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return json_decode($responseData, true);

    }

}
