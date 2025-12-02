@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-700">Edit Contact</h1>
            <a href="{{ route('people.show', $contact->person_id) }}" class="text-gray-500 hover:text-gray-700 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Cancel
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="{{ route('contacts.update', $contact) }}" method="POST">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="country_code">
                        Country (DDI)
                    </label>

                    <select id="country_code" name="country_code" class="block w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline focus:border-emerald-500" required>
                        <option value="">Select a country...</option>
                        @foreach($countries as $country)
                            <option value="{{ $country['code'] }}"
                                {{ (old('country_code', $contact->country_code) === $country['code']) ? 'selected' : '' }}>
                                {{ $country['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                        Phone Number (9 Digits)
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                           id="number" name="number" type="text"
                           value="{{ old('number', $contact->number) }}"
                           required maxlength="9" pattern="\d{9}" title="Must contain exactly 9 numeric digits">
                </div>

                <div class="flex items-center justify-end">
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition" type="submit">
                        Update Contact
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
