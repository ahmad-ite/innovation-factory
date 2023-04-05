<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Users') }}
            </h2>
            <x-button class="items-center justify-center max-w-xs gap-2" href="{{ route('users.create') }}">
                <span>{{ __('Create New User') }}</span>
            </x-button>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Username</th>
                <th>Photo</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($users as $key=>$user)
            <tr>
                <td>{{ ++$i}}</td>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    <img src="{{ $user->avatar}}" style=" height: 100px; width: 150px;">
                </td>
                <td>

                    <form class="delete" action="{{ route('users.destroy',$user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title='Delete'>Delete</button>


                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {!! $users->links() !!}
    </div>


</x-app-layout>