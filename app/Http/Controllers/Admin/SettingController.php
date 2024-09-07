<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingsServices;
use Illuminate\Http\Request;
use Illuminate\View\View;


class SettingController extends Controller
{
    function index() : View
    {
        return view('admin.setting.index');
    }

    function UpdateGeneralSetting(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validateData = $request->validate([
            'site_name' => ['required', 'max:255'],
            'site_default_currency' => ['required', 'max:4'],
            'site_currency_icon' => ['required', 'max:4'],
            'site_currency_icon_position' => ['required', 'max:255'],
        ]);

        foreach ($validateData as $key => $value) {
            Setting::updateorCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settingsService = app(SettingsServices::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Updated Successfully');

        return redirect()->back();

    }

}
