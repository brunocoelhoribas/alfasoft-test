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

class ContactController extends Controller {
    /**
     * Show the form for creating a new resource.
     */
    public function create(Person $person): Factory|View|Application {
        return view('contact.create', compact('person'));
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
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact): Factory|View|Application {
        return view('contact.edit', compact('contact'));
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
}
