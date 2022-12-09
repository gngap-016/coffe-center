<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        $setting = Setting::select('settings.*')->first();

        return view('admin.setting', compact(['setting']));
    }

    
    public function addSetting(Request $req)
    {
        $setting = new Setting;
        $setting->name = $req->setting_name;
        $setting->address = $req->setting_address;
        $setting->description = $req->setting_description;
        $setting->service_time = $req->setting_service_time;
        $setting->instagram = $req->setting_instagram;
        $setting->facebook = $req->setting_facebook;
        $setting->keywords = $req->setting_keywords;
        $setting->email = $req->setting_email;
        $setting->whatsapp = $req->setting_whatsapp;
        $setting->phone = $req->setting_phone;
        // $setting->logo = $req->setting_logo;
        $setting->save();
   
        return redirect('/setting');
    }
    public function update(Request $req, $id)
    {
        $setting = Setting::find($id);
        $setting->name = $req->setting_name;
        $setting->address = $req->setting_address;
        $setting->description = $req->setting_description;
        $setting->instagram = $req->setting_instagram;
        $setting->facebook = $req->setting_facebook;
        $setting->email = $req->setting_email;
        $setting->whatsapp = $req->setting_whatsapp;
        $setting->phone = $req->setting_phone;

        $setting->save();

        return redirect('/setting');
    }
    public function destroy($id)
    {
        $setting = Setting::find($id)->delete();
        return redirect('/setting');
    }
   
}
