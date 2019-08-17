@extends('layouts.app')

@section('content')
    <div class="row">
        <h3 class="text-center">Продукты</h3>
        <div class="col-md-6 col-md-offset-3">
            <div class="table-responsive">
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>Поставщик</th>
                        <th>Цена</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($products as $product)
                        <tr>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->vendor->name }}
                            </td>
                            <td>
                                <edit-price-product :price="{{ $product->price }}" endpoint="{{ route('products.update', $product) }}"></edit-price-product>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection