@extends('layouts/admin')
@section('body')
    <div class="card-footer small text mutter">
        <h3>Product List</h3>
        <a href="{{ route('admin.product.create')}}" class="btn btn-primary mb-3">Add Product</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">IDCategory</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($products) && count($products) > 0)
                    @foreach ($products as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->idCategory }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if(Str::startsWith($item->image, 'http'))
                                <img src="{{ $item->image }}" width="100">
                            @else
                                <img src="{{ asset('images/' . $item->image) }}" width="100">
                            @endif
                        </td>                        
                        <td>{{ number_format($item->price) }} VNĐ</td>
                        <td>{{ $item->description }}</td>
                        <td class="text-center">
                            @if ($item->status == 1)
                                <i class="fas fa-check-circle text-success" style="font-size: 1.2rem;"></i>
                            @else
                                <i class="fas fa-times-circle text-danger" style="font-size: 1.2rem;"></i>
                            @endif
                        </td>
                        
                           <td>
                                <a href="{{route('admin.product.edit', $item->id)}}">
                                    <i class="fa-solid fa-pen-to-square text-warning"></i>
                                </a>
                            </td>
                            <td>
                            <form action="{{ route('admin.product.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm: {{ $item->name }} không ?')">
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" class="btn btn-link p-0" style="border: none; background: none;">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Chưa có sản phẩm nào.</td>
                    </tr>
                @endif
                </tbody>
        </table>
    </div>
@endsection