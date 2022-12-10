<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        if($req->file('setting_logo')){
            if($req->oldImage){
                Storage::delete('public/setting_images'.$req->oldImage);
            }
            
            $filenamewithextension = $req->file('setting_logo')->getClientOriginalName();

            $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            $extension = $req->file('setting_logo')->getClientOriginalExtension();

            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            $req->file('setting_logo')->storeAs('public/setting_images', $fileNameToStore);

            $setting->logo = '/' . $fileNameToStore;
        }
        $setting->whatsapp = $req->setting_whatsapp;
        $setting->phone = $req->setting_phone;

        $setting->save();

        return redirect('/setting');
    }
    public function destroy(Request $req, $id)
    {
        $setting = Setting::find($id)->delete();
        return redirect('/setting');
    }
   
}
