<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateWebsiteSettingsRequest;
use App\Models\WebsiteInfo;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        $website_settings = WebsiteInfo::first();

        return view('manage.website-settings', compact('website_settings'));
    }

    public function update(UpdateWebsiteSettingsRequest $request)
    {
        $website_settings = WebsiteInfo::first();

        $website_settings->update($request->all());

        return redirect()->back()->with('success', 'Website settings updated successfully');
    }
}
