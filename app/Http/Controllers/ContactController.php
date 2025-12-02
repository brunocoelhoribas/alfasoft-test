<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\Person;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller {
    /**
     * Show the form for creating a new resource.
     */
    public function create(Person $person): Factory|View|Application {
        $countries = Cache::remember('countries_list', 60, function () {
            return $this->getCountries();
        });

        return view('contacts.create', compact('person', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request, Person $person): RedirectResponse {
        $person->contacts()->create($request->validated());
        return redirect()->route('people.show', $person)->with('success', 'Successfully created contact');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): Factory|View|Application {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): Factory|View|Application {
        $countries = Cache::remember('countries_list', 86400, function () {
            return $this->getCountries();
        });

        return view('contacts.edit', compact('contact', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact): RedirectResponse {
        $contact->update($request->validated());
        return redirect()->route('people.show', $contact)->with('success', 'Successfully updated contact');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse {
        $person = $contact->person_id;
        $contact->delete();

        return redirect()->route('people.show', $person)->with('success', 'Successfully deleted contact');
    }

    /**
     * @return array
     */
    public function getCountries(): array {
        $response = Http::get('https://restcountries.com/v3.1/all?fields=name,idd');

        if ($response->failed()) {
            return [];
        }

        $data = $response->json();
        $formattedCountries = [];

        foreach ($data as $country) {
            $root = $country['idd']['root'] ?? '';
            $suffixes = $country['idd']['suffixes'] ?? [''];
            $suffix = count($suffixes) > 0 ? $suffixes[0] : '';
            $callingCode = $root . $suffix;

            if (empty($callingCode)) {
                continue;
            }

            $formattedCountries[] = [
                'name' => $country['name']['common'],
                'code' => str_replace('+', '', $callingCode),
                'label' => $country['name']['common'] . ' (' . $callingCode . ')'
            ];
        }

        usort($formattedCountries, static function ($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $formattedCountries;
    }
}
