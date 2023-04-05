<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Show User') }}
            </h2>
            <x-button class="items-center justify-center max-w-xs gap-2" href="{{ route('users.index') }}">
                <span>{{ __('Back') }}</span>
            </x-button>
        </div>
    </x-slot>


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>Prefixname:</strong>
                    {{ $user->prefixname }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>firstname:</strong>
                    {{ $user->firstname }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>middlename:</strong>
                    {{ $user->middlename }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>lastname:</strong>
                    {{ $user->lastname }}
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>suffixname:</strong>
                    {{ $user->suffixname }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>username:</strong>
                    {{ $user->username }}
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group col-sm-6">
                    <strong>type:</strong>
                    {{ $user->type }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group col-sm-12">
                    <strong>Photo:</strong>
                    <img src="{{ $user->avatar}}" style=" height: 100px; width: 150px;">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>