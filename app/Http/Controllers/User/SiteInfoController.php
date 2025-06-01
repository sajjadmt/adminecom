<?php

namespace App\Http\Controllers\User;

use App\Models\SiteInfo;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function AllSiteInfo()
    {
        $result = SiteInfo::first();
        return $result;
    }

    public function AboutUs()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.about-us', compact('info'));
    }

    public function UpdateAboutUs(Request $request)
    {
        $about = SiteInfo::first();
        $about->update([
            'about' => $request->aboutUs
        ]);
        $notification = array(
            'message' => 'About Us Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function RefundPolicy()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.refund-policy', compact('info'));
    }

    public function UpdateRefundPolicy(Request $request)
    {
        $refund = SiteInfo::first();
        $refund->update([
            'refund' => $request->refundPolicy
        ]);
        $notification = array(
            'message' => 'Refund Policy Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function PurchasePolicy()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.purchase-policy', compact('info'));
    }

    public function UpdatePurchasePolicy(Request $request)
    {
        $purchase = SiteInfo::first();
        $purchase->update([
            'purchase' => $request->purchasePolicy
        ]);
        $notification = array(
            'message' => 'Purchase Policy Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function PrivacyPolicy()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.privacy-policy', compact('info'));
    }

    public function UpdatePrivacyPolicy(Request $request)
    {
        $privacy = SiteInfo::first();
        $privacy->update([
            'privacy' => $request->privacyPolicy
        ]);
        $notification = array(
            'message' => 'Privacy Policy Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function Address()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.address', compact('info'));
    }

    public function UpdateAddress(Request $request)
    {
        $address = SiteInfo::first();
        $address->update([
            'address' => $request->address
        ]);
        $notification = array(
            'message' => 'Address Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function Links()
    {
        $info = SiteInfo::first();
        return view('admin.site-information.links', compact('info'));
    }

    public function UpdateLinks(Request $request)
    {
        $links = SiteInfo::first();
        $links->update([
            'android_app_link' => $request->android_app_link,
            'ios_app_link' => $request->ios_app_link,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'telegram_link' => $request->telegram_link,
            'twitter_link' => $request->twitter_link,
            'copyright' => $request->copyright,
        ]);
        $notification = array(
            'message' => 'Links Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
