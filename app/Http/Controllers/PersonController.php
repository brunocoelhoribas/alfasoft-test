<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Session\Store;

class PersonController extends Controller {
    /**
     * Display a listing of the resource.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index(): Factory|View|Application {
        $people = Person::paginate(10);
        return view('people.index', ['people' => $people]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     * @noinspection PhpUndefinedMethodInspection
     */
    public function store(StorePersonRequest $request): RedirectResponse {
        Person::create($request->validated());
        return redirect()->route('people.index')->with('success', 'Person created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person): Factory|View|Application {
        $person->load('contacts');
        return view('people.show', ['person' => $person]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person): Factory|View|Application {
        return view('people.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person): RedirectResponse {
        $person->update($request->validated());
        return redirect()->route('people.index')->with('success', 'Person updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person): RedirectResponse {
        $person->delete();
        return redirect()->route('people.index')->with('success', 'Person deleted.');
    }
}
