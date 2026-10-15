<?php

namespace App\Http\Requests;

use App\Models\Template;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
{
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
            'send_at' => null,
        ], request()->all());

        if (blank($tab)) {

            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'subject' => ['required', 'string', 'max:40'],
                'email_list_id' => ['required', 'exists:email_lists,id'],
                'template_id' => ['required', 'exists:templates,id'],
                'body' => ['nullable'],
                'track_click' => ['nullable'],
                'track_open' => ['nullable'],
                'send_at' => ['nullable'],
            ];
        }

        if ($tab == 'template') {

            $rules = [
                'body' => ['required'],
            ];
        }

        if ($tab == 'schedule') {
            $rules = [
                'send_at' => ['required', 'date'],
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
            'send_at' => null,
        ]);

        $previousTemplateId = $session['template_id'] ?? null;

        foreach ($session as $key => $value) {
            $newValue = data_get($map, $key);

            if ($key == 'track_click' || $key == 'track_open') {
                if (blank($tab)) {
                    $session[$key] = $this->boolean($key);
                }
            } elseif (filled($newValue)) {
                $session[$key] = $newValue;
            }
        }

        $templateId = $session['template_id'] ?? null;
        $templateChanged = (string) $templateId !== (string) $previousTemplateId;

        if ($templateChanged || blank($session['body'])) {
            $template = Template::find($templateId);

            if ($template !== null) {
                $session['body'] = $template->body;
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

    public function getData()
    {
        $session = session('campaigns::create');
        unset($session['_token']);
        $session['track_click'] = $session['track_click'] ?? false;
        $session['track_open'] = $session['track_open'] ?? false;

        return $session;
    }
}
