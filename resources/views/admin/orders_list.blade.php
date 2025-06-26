@extends('admin.master')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center  mt-5">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-success " style="color: white;">
                        <h3 class="text-white">Orders</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if ($orders->isNotEmpty())
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at) }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin-products-edit', $order->id) }}"
                                                class="btn my-1 btn-dark">Edit</a> --}}
                                            <a href="#" onclick="deleteOrder({{ $order->id }})"
                                                class="btn btn-danger">Delete</a>
                                            <form id="delete-order-form-{{ $order->id }}"
                                                action="{{ route('admin-order-destroy', $order->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        function deleteOrder(id) {
            if (confirm("Are you sure you want to  delete Order?")) {
                document.getElementById('delete-order-form-' + id).submit();
            }
        }
    </script>
@endsection
