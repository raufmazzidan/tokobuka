@extends('layout/main')

@section('app')
<form method="post" action="/product" enctype="multipart/form-data">
    @csrf
    <section>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-lg">
                <a href="/product" class="text-purple font-semibold hover:underline">Product</a>
                <span>/</span>
                <span class="text-grey-dark">Add Product</span>
            </div>
            <button type="submit" class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
                Submit
            </button>
        </div>
        <div class="border-b border-grey pb-8 mb-8"></div>

        <div class="w-1/2 mt-10">
            <div class="form-container">
                <label @error('name') class="label-error" @enderror for="name">Nama Barang</label>
                <input @error('name') class="input-error" @enderror type="text" id="name" name="name"
                    value="{{old('name')}}" placeholder="Masukkan Nama Barang">
                @error('name')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('description') class="label-error" @enderror for="description">Deskripsi</label>
                <textarea @error('description') class="input-error" @enderror type="text" id="description"
                    name="description" value="{{old('description')}}" rows="4"
                    placeholder="Masukkan Deskripsi"></textarea>
                @error('description')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('category') class="label-error" @enderror for="category">Jenis Barang</label>
                <input @error('category') class="input-error" @enderror type="text" id="category" name="category"
                    value="{{old('category')}}">
                @error('category')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container w-24">
                <label @error('stock') class="label-error" @enderror for="stock">Stok</label>
                <input @error('stock') class="input-error" @enderror type="number" id="stock" name="stock"
                    value="{{old('stock')}}">
                @error('stock')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('buy_price') class="label-error" @enderror for="buy_price">Harga Beli</label>
                <input @error('buy_price') class="input-error" @enderror type="text" id="buy_price" name="buy_price"
                    value="{{old('buy_price')}}">
                @error('buy_price')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('sell_price') class="label-error" @enderror for="sell_price">Harga Jual</label>
                <input @error('sell_price') class="input-error" @enderror type="text" id="sell_price" name="sell_price"
                    value="{{old('sell_price')}}">
                @error('sell_price')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('image') class="label-error" @enderror for="image">Gambar</label>
                <div class="border rounded border-grey p-5">
                    <label role="button" for="image"
                        class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
                        Upload Image
                        <input @error('image') class="input-error" @enderror type="file" hidden accept="image"
                            id="image" name="image" value="{{old('image')}}">
                    </label>
                    <img onerror="this.style.display='none'" id="image-preview" src="{{asset('storage/'.old('image'))}}"
                        class="mt-4 h-40 w-fit">
                </div>
                @error('image')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
        </div>
    </section>
</form>
@endsection