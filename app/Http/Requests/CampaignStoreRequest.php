<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tab = $this->route('tab');
        $rules = [];

        $map = array_merge([
            'name' => null,
            'subject' => null,
            'email_list_id' => null,
            'template_id' => null,
            'body' => null,
            'track_click' => null,
            'track_open' => null,
            'sent_at' => null,
        ], request()->all());

        if (blank($tab)) {

            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:40'],
                'email_list_id' => ['nullable'],
                'template_id' => ['nullable'],
                'body' => ['nullable'],
                'track_click' => ['nullable'],
                'track_open' => ['nullable'],
                'sent_at' => ['nullable'],
            ];
        }

        if ($tab == 'template') {

            $rules = [
                'body' => ['required'],
            ];
        }

        if ($tab == 'schedule') {
            $rules = [
                'sent_at' => ['required', 'date'],
            ];

        }

        $session = session('campaigns::create', [
            'name' => null,
            'subject' => null,
            'email_list_id' => null,
            'template_id' => null,
            'body' => null,
            'track_click' => null,
            'track_open' => null,
            'sent_at' => null,
        ]);

        foreach ($session as $key => $value) {
            $newValue = data_get($map, $key);

            if (filled($newValue)) {
                $session[$key] = $newValue;
            }
        }

        session()->put('campaigns::create', $session);

        return $rules;
    }

    public function getToRoute(): string
    {
        $tab = $this->route('tab');

        if (blank($tab)) {
            return route('campaigns.create', ['tab' => 'template']);
        }
        if ($tab == 'template') {
            return route('campaigns.create', ['tab' => 'schedule']);
        }

        return route('campaigns.index');

    }

    public function getData() {
        $session = session('campaigns::create');
        unset($session['_token']);
        return $session;
    }
}
