<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStoreRequest;
use App\Models\Campaign;
use App\Models\EmailList;
use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Traits\Conditionable;

class CampaignController extends Controller
{

    use Conditionable;
    public function index()
    {
        $search = request('search', null);
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

    public function create(?string $tab = null)
    {
        // session()->forget('campaigns::create');
        return view('campaign.create', array_merge(
            $this->when(blank($tab), fn() => [
                'emailLists' => EmailList::query()->select(['id', 'title'])->orderBy('title')->get(),
                'template' => Template::query()->select(['id', 'name'])->orderBy('name')->get(),
            ], fn() => []),
            [
                'tab' => $tab,



                'form' => match ($tab) {
                    'template' => '_template',
                    'schedule' => '_schedule',
                    default => '_config',
                },
                'data' => session()->get('campaigns::create', [
                    'name' => null,
                    'subject' => null,
                    'email_list_id' => null,
                    'template_id' => null,
                    'body' => null,
                    'track_click' => null,
                    'track_open' => null,
                    'send_at' => null,
                ]),
            ]
        ));
    }

    public function store(CampaignStoreRequest $request, ?string $tab = null)
    {

        $data = $request->getData();
        $toRoute = $request->getToRoute();

        if ($tab == 'schedule') {
            Campaign::create($data);
        }

        return response()->redirectTo($toRoute);
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
