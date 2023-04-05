<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Add New User') }}
            </h2>
            <x-button class="items-center justify-center max-w-xs gap-2" href="{{ route('users.index') }}">
                <span>{{ __('Back') }}</span>
            </x-button>
        </div>
    </x-slot>


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- <textarea class="form-control" style="height:150px" name="firstname"
                            placeholder="firstname"></textarea> -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">

                        {!! Form::label('name', __('prefixname').':') !!}
                        {!! Form::select('prefixname', App\Enums\User\UserPrefixnameEnum::getKeyValue()?? [], null,
                        ['class' =>
                        'form-control custom-select']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <strong>First Name:</strong>
                        <input type="text" name="firstname" class="form-control" placeholder="firstname" required>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <strong>Middlename:</strong>
                        <input type="text" name="middlename" class="form-control" placeholder="middlename">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <strong>Last Name:</strong>
                        <input type="text" name="lastname" class="form-control" required placeholder="lastname">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <strong>suffixname:</strong>
                        <input type="text" name="suffixname" class="form-control" placeholder="suffixname">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <strong>Username:</strong>
                        <input type="text" name="username" class="form-control" required placeholder="username">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        {!! Form::label('email', 'Password:') !!}
                        {!! Form::text('password', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        {!! Form::label('name', __('Type').':') !!}
                        {!! Form::select('type', App\Enums\User\UserTypeEnum::getKeyValue()?? [], null,
                        ['class' =>
                        'form-control custom-select']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group col-sm-6">
                        <div class="custom-file">
                            {!! Form::file('photo', ['class' => 'custom-file-input']) !!}
                            {!! Form::label('Choose file', '', ['class' => 'custom-file-label']) !!}
                        </div>
                    </div>
                </div>
                <!-- <div class="clearfix"></div> -->

                <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group col-sm-6">
                        <strong>Image:</strong>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div> -->
            </div>

            <div class="row"><br>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
</x-app-layout>