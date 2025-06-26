@extends('admin.master')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center g-0">

            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('admin-products-index') }}" class="btn my-2"
                    style="background-color: #0D6EFD;color: white;">Back</a>
            </div>

                </div>
            <div class="col-md-10 border">
                <div class="card border-0" style="background-color: #0D6EFD;color: white;">
                    <div class="card-header">
                        <h3 class="text-white">Create Product</h3>
                    </div>
                </div>

                <form enctype='multipart/form-data' action="{{ route('admin-products-store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label h5" for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter your Name"
                                class="form-control form-control-lg">
                        </div>

                        <div class="mb-3">
                            <label for="sku" class="form-label h5">SKU</label>
                            <input value="" type="text" name="sku" id="sku"
                                class="form-control form-control-lg" placeholder="Enter SKU">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label h5">Price</label>
                            <input value="" placeholder="Enter Price" type="text" name="price" id="price"
                                class=" form-control form-control-lg">
                        </div>

                        <div class="mb-3">
                            <label for="Description" class="form-label h5">Description</label>
                            <textarea placeholder="Enter description" cols="30" rows="5" name="description" id="description"
                                class="form-control form-control-lg"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label h5">Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
