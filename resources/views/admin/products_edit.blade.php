@extends('admin.master')
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('admin-products-index')}}" class="btn btn-dark my-2">Back</a>
        </div>
        <div class="col-md-10">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Edit Product</h3>
                </div>
                <form enctype="multipart/form-data" action="{{route('admin-products-update', $product->id)}}"
                    method="post">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label h5" for="name">Name</label>
                            <input value="{{$product->name}}" type="text" name="name" id="name"
                                placeholder="Enter your Name" class=" form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="sku" class="form-label h5">SKU</label>
                            <input value="{{$product->sku}}" type="text" name="sku" id="sku"
                                class=" form-control form-control-lg" placeholder="Enter SKU">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label h5">Price</label>
                            <input value="{{$product->price}}" placeholder="Enter Price" type="text" name="price"
                                id="price" class=" form-control form-control-lg">
                        </div>

                        <div class="mb-3">
                            <label for="Description" class="form-label h5">Description</label>
                            <textarea placeholder="Enter description" cols="30" rows="5" name="description"
                                id="description" class="form-control form-control-lg">
                                {{$product->description}}
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label h5">Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg">
                            @if($product->image != "")
                                <img class="w-25 my-3" src="{{asset("uploads/products/" . $product->image)}}" alt="">
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection