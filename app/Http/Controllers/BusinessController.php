<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\BusinessPhoto;
use App\Models\BusinessTip;
use App\Models\BusinessReview;

class BusinessController extends Controller
{
    public function getBusiness($locale, $business_id)
    {
        $results = Business::where('business_id', $business_id)
            ->first();
        $photos = BusinessPhoto::where('business_id', $business_id)
            ->with(['user'])
            ->get()
            ->toArray();
        $photos_response = array_slice($photos, 0, 5);
        $tips = BusinessTip::where('business_id', $business_id)
            ->with(['user'])
            ->get()
            ->toArray();
        $tips_response = array_slice($tips, 0, 5);
        $reviews = BusinessReview::where('business_id', $business_id)
            ->with(['user'])
            ->get()
            ->toArray();
        $reviews_response = array_slice($reviews, 0, 5);
        return view('business/business_detail')
            ->with('biz', $results)
            ->with('photos', $photos_response)
            ->with('tips', $tips_response)
            ->with('reviews', $reviews_response);
    }

    public function addBusinessPhoto(Request $request, $business_id)
    {
        try {
            $photo = $request->file('file');
            $file_name = $business_id . "_" . $photo->getClientOriginalName();
            $photo->move(public_path() . '/upload/business_photos', $file_name);
            $b_photo = new BusinessPhoto;
            $b_photo->photo_uri = $file_name;
            $b_photo->business_id = $business_id;
            $b_photo->user_id = session('user')['user_id'];
            $b_photo->save();
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 'success';
    }

    public function getBusinessTips(Request $request, $business_id)
    {
        $results = Business::where('business_id', $business_id)
            ->first();
        $tips = BusinessTip::where('business_id', $business_id)
            ->with(['user'])
            ->get();
        return view('business/business_tips')
            ->with('biz', $results)
            ->with('tips', $tips);
    }

    public function addBusinessTip(Request $request, $business_id)
    {
        $b_tip = new BusinessTip;
        $b_tip->tip_content = $request->get('businessTip');
        $b_tip->business_id = $business_id;
        $b_tip->user_id = session('user')['user_id'];
        $b_tip->save();
        return redirect()->route('business-tips', $business_id);
    }

    public function getBusinessReviews(Request $request, $business_id)
    {
        $results = Business::where('business_id', $business_id)
            ->first();
        $reviews = BusinessReview::where('business_id', $business_id)
            ->with(['user'])
            ->get();
        return view('business/business_reviews')
            ->with('biz', $results)
            ->with('reviews', $reviews);
    }

    public function addBusinessReview(Request $request, $business_id) {
        $b_rev = new BusinessReview;
        $b_rev->review_content = $request->get('review');
        $b_rev->rating = '4';
        $b_rev->business_id = $business_id;
        $b_rev->user_id = session('user')['user_id'];
        $b_rev->save();
        return redirect()->route('business-reviews', $business_id);
    }
}
