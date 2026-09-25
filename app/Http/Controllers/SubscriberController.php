<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(EmailList $emailList)
    {

        $search = request('search');
        $showTrash = request()->input('show_trash', false);

        return view("subscriber.index", [
            'emailList' => $emailList,
            'subscribers' => $emailList->subscribers()
                ->when($showTrash, fn($query) => $query->withTrashed())
                ->when($search, fn($query) => $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('id', '=', $search))
                ->paginate(8)
                ->withQueryString(),
            'search' => $search,
            'showTrash' => $showTrash,

        ]);
    }

    public function destroy(mixed $list, Subscriber $subscriber)
    {

        $subscriber->delete();
        return back()->with('messsage', __('Subscriber deleted from the list!'));
    }

}
