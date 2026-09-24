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

        return view("subscriber.index", [
            'emailList' => $emailList,
            'subscribers' => $emailList->subscribers()
                ->when($search, fn($query) => $query
                    ->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('id', '=', $search))
                ->paginate(8),
            'search' => $search
        ]);
    }

    public function destroy(mixed $list, Subscriber $subscriber)
    {
       
    $subscriber->delete();
        return back()->with('messsage', __('Subscriber deleted from the list!'));
    }

}
