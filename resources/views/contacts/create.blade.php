@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-700">New contact for: {{ $person->name }}</h1>
            <a href="{{ route('people.show', $person) }}" class="text-gray-500 hover:text-gray-700">Go back</a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('people.contacts.store', $person) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="country_code">
                        Country (code)
                    </label>

                    <select id="country_code" name="country_code" class="block w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline focus:border-emerald-500" required>
                        <option value="">Select a country...</option>
                        @foreach($countries as $country)
                            <option value="{{ $country['code'] }}" {{ old('country_code') === $country['code'] ? 'selected' : '' }}>
                                {{ $country['label'] }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-gray-500 text-xs italic mt-1">e.g Portugal (351)</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                        Phone Number
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                           id="number" name="number" type="text" placeholder=""
                           value="{{ old('number') }}" required maxlength="9" pattern="\d{9}">
                </div>

                <div class="flex items-center justify-end">
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition" type="submit">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
