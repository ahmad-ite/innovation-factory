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
                <th>Name</th>
                <th>Email</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($users as $key=>$user)
            <tr>
                <td>{{ ++$i}}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>

                    <form class="delete" action="{{ route('users.destroy',$user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                            title='Delete'>Delete11</button>

                        <!-- <button type="submit" class="btn btn-danger show_confirm">Delete</button> -->
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        {!! $users->links() !!}
    </div>


</x-app-layout>

<script type="text/javascript">
$(".delete").on("submit", function() {
    return confirm("Are you sure?");
});
var form = document.getElementById("form-id");
document.getElementById("your-id").addEventListener("click", function() {
    // form.submit();
    alert(33);
});
$('.show_confirm').click(function(event) {
    alert(111);
    var form = $(this).closest("form");
    var name = $(this).data("email");
    event.preventDefault();
    swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});
</script>