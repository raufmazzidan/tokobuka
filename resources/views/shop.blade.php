@extends('layout/main')

@section('app')
<div class="grid grid-cols-3 gap-4">
    @foreach($product as $key => $p)
    <div class="border border-grey rounded p-4 bg-white">
        <div class="aspect-square w-full cursor-pointer"
            style="background: url({{asset('storage/'.$p->image)}});background-position:center;background-size:cover;"
            onclick="openImage('{{asset('storage/'.$p->image)}}')">
        </div>
        <h4 class="font-semibold text-2xl my-4 text-center text-purple">
            Rp{{number_format($p->sell_price,0,',','.')}}</h4>
        <h4 class="font-semibold text-lg">{{$p->name}}</h4>
        <p class="text-purple-light text-xs my-2 italic">Stok : {{$p->stock}}</p>
        <p class="text-grey-dark">{{$p->description}}</p>
        <form method="post" action="/order">
            @csrf
            <input type="hidden" value="{{$p->id}}" name="product_id">
            <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
            <button {{!$p->stock ? 'disabled' : ''}} class="mt-4 px-6 w-full bg-purple py-3 text-xs text-white
                uppercase font-bold rounded">
                Order
            </button>
        </form>
    </div>
    @endforeach
</div>
<div id="myModal" class="modal">
    <span class="close">&times;</span>
    <div class="modal-content">
        <img id="image">
    </div>
</div>
@endsection