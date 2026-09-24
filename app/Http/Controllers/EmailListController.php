<?php

namespace App\Http\Controllers;

use App\Models\EmailList;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class EmailListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request("search");
        $emailLists = EmailList::query()
            ->withCount('subscribers')
            // $value, $callback and default
            ->when($search, fn($query) => $query
                ->where('title', 'like', "%$search%")->orWhere('id', '=', $search))

            ->paginate(8)
            ->appends(compact('search'));
        return view('email-list.index', [
            'emailLists' => $emailLists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('email-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'file' => ['required', 'file', 'mimes:csv'],
        ]);

        $emails = $this->getEmailsFromCsvFile($request->file('file'));

        DB::transaction(function () use ($emails, $request) {
            $emailList = EmailList::query()->create([
                'title' => $request->title,
            ]);

            $emailList->subscribers()->createMany($emails);
        });

        return to_route('email-list.index');
    }

    private function getEmailsFromCsvFile(UploadedFile $file): array
    {
        $fileHandle = fopen($file->getRealPath(), 'r');
        $items = [];

        while (($line = fgetcsv($fileHandle, null, ',')) !== false) {
            if ($line[0] === 'name' && $line[1] === 'email') {
                continue;
            }

            $items[] = [
                'name' => $line[0],
                'email' => $line[1],
            ];
        }

        fclose($fileHandle);

        return $items;
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailList $emailList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailList $emailList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailList $emailList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailList $emailList)
    {
        //
    }
}
