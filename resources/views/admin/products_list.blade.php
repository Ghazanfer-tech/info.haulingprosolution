@extends('admin.master')
@section('content')


<div class="container" >
    <div class="row d-flex justify-content-center ">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('admin-products-create')}}" class="btn  my-2"
                style="background-color: #0D6EFD;color: white;">Create</a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success my-2">
                {{Session::get('success')}}
            </div>
        @endif

        <div class="col-md-12" >
            <div class="card border-0 shadow-lg">
                <div class="card-header " style="background-color: #0D6EFD;color: white;">
                    <h3 class="text-white">Products</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @if ($products->isNotEmpty())
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        @if($product->image != "")
                                            <img height="50px" src="{{asset('uploads/products/' . $product->image)}}" alt="">
                                        @endif
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{\Carbon\Carbon::parse($product->created_at)}}</td>
                                    <td>
                                        <a href="{{route('admin-products-edit', $product->id)}}"
                                            class="btn my-1 btn-dark">Edit</a>
                                        <a href="#" onclick="deleteProduct({{$product->id}})" class="btn btn-danger">Delete</a>
                                        <form id="delete-product-form-{{$product->id}}"
                                            action="{{route('admin-products-destroy', $product->id)}}" method="post">
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
    function deleteProduct(id) {
        if (confirm("Are you sure you want to  delelte product?")) {
            document.getElementById('delete-product-form-' + id).submit();
        }
    }
</script>
@endsection
