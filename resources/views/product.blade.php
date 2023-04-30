@extends('layout/main')

@section('app')
<section>
    <div class="flex items-center justify-between h-10">
        <div class="flex items-center gap-2 text-lg">
            <a href="/product" class="text-purple font-semibold hover:underline">Product</a>
        </div>
        <a href="/product/create" class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
            Add Product
        </a>
    </div>

    <div class="border-b border-grey pb-8 mb-8"></div>
    <table class="w-full">
        <thead>
            <tr>
                <td class="w-10">No.</td>
                <td>Nama</td>
                <td>Deskripsi</td>
                <td>Jenis</td>
                <td>Stok</td>
                <td>Harga Beli</td>
                <td>Harga Jual</td>
                <td class="text-center">Preview</td>
                <td>Action</td>
        </thead>
        <tbody>
            @if(!count($data))
            <tr>
                <td colspan="9" class="text-center">Data not found</td>
            </tr>
            @endif
            @foreach ($data as $index => $d)
            <tr>
                <td class="">{{$index + 1}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->description}}</td>
                <td>{{$d->category}}</td>
                <td class="text-center">{{$d->stock}}</td>
                <td>Rp{{number_format($d->buy_price,0,',','.')}}</td>
                <td>Rp{{number_format($d->sell_price,0,',','.')}}</td>
                <td class="text-center">
                    <span class="text-purple cursor-pointer" onclick="openImage('{{asset('storage/'.$d->image)}}')">
                        show
                    </span>
                </td>
                <td>
                    <div class="flex flex-col gap-2 h-full">
                        <a href="/product/{{$d->id}}/edit" class="text-yellow flex items-center">
                            <i class="fa fa-pencil" aria-hidden="true"></i><span class="ml-1">Edit</span>
                        </a>
                        <form method="post" action="/product/{{ $d->id }}">
                            @method('delete')
                            @csrf
                            <button class="text-red flex items-center" onclick="confirm('are you sure?')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i><span class="ml-1">Delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</section>
@endsection