<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $search = request("search", null);
        $showTrash = request()->input('show_trash', false);

        return view('campaign.index', [
            'campaigns' => Campaign::query()
                ->when($showTrash, fn($query) => $query->withTrashed())
                ->when($search, fn(Builder $query) => $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('id', '=', $search))

                ->paginate(5)
                ->withQueryString()
                ->appends(compact('search')),
            'search' => $search,
            'showTrash' => $showTrash,
        ]);
    }

    public function destroy(Campaign $campaign)
    {

        $campaign->delete();
        return back()->with('message', __('Campaign deleted from the list!'));
    }

    public function restore($campaign)
    {

        $campaign = Campaign::withTrashed()->findOrFail($campaign);
        $campaign->restore();
        return back()->with('message', __('Campaign restored successfully!'));
    }

}
