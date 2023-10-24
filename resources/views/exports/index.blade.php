<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Exports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <section>
                            <form method="post" action="{{ route('exports.store') }}" class="mt-6 space-y-6">
                                @csrf
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Product Filters') }}
                                    </h2>
                                </header>

                                <div>
                                    <x-input-label for="product-type" :value="__('Type')"/>
                                    <x-select id="product-type" name="type" class="mt-1 block w-full">
                                        @foreach($types as $type)
                                            <option value="{{ strtolower($type->value) }}">
                                                {{ __(ucfirst(Str::replace('_', ' ', $type->value))) }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error :messages="$errors->get('type')" ></x-input-error>
                                </div>

                                <hr class="block w-full">

                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Order Filters') }}
                                    </h2>
                                </header>

                                <div>
                                    <x-input-label for="order-status" :value="__('Status')"/>
                                    <x-select id="order-status" name="status" class="mt-1 block w-full">
                                        @foreach($statuses as $status)
                                            <option value="{{ strtolower($status->value) }}">
                                                {{ __(ucfirst($status->value)) }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-input-error :messages="$errors->get('status')" ></x-input-error>
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Export') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
