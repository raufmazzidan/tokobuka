@extends('layout/main')

@section('app')
<section>
    <div class="flex items-center justify-between h-10">
        <div class="flex items-center gap-2 text-lg">
            <a href="/order" class="text-purple font-semibold hover:underline">Order</a>
        </div>
    </div>
    <div class="border-b border-grey pb-8 mb-8"></div>
    <table class="w-full">
        <thead>
            <tr>
                <td class="w-10">No.</td>
                <td>Nama Barang</td>
                <td>Nama Pembeli</td>
                <td>Order Date</td>
                <td class="text-center">Status</td>
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
                <td>{{$d->product_name}}</td>
                <td>{{$d->user_name}}</td>
                <td>{{$d->created_at}}</td>
                <td class="text-center">
                    @if($d->status == 'pending')
                    <span class="text-yellow p-2 uppercase font-bold">
                        {{$d->status}}
                    </span>
                    @endif

                    @if($d->status == 'rejected')
                    <span class="text-red p-2 uppercase font-bold">
                        {{$d->status}}
                    </span>
                    @endif

                    @if($d->status == 'completed')
                    <span class="text-green p-2 uppercase font-bold">
                        {{$d->status}}
                    </span>
                    @endif
                </td>
                <td>
                    @if($d->status == 'pending')
                    <div class="flex flex-col gap-2 h-full">
                        <form method="post" action="/order_update/{{$d->id}}">
                            @method('put')
                            @csrf
                            <input name="status" value="completed" type="hidden">
                            <input name="product_id" value="{{$d->product_id}}" type="hidden">
                            <button class="text-green flex items-center">
                                <i class="fa fa-check" aria-hidden="true"></i><span class="ml-1">Approve</span>
                            </button>
                        </form>
                        <form method="post" action="/order_update/{{$d->id}}">
                            @method('put')
                            @csrf
                            <input name="status" value="rejected" type="hidden">
                            <input name="product_id" value="{{$d->product_id}}" type="hidden">
                            <button class="text-red flex items-center">
                                <i class="fa fa-times" aria-hidden="true"></i><span class="ml-1">Reject</span>
                            </button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</section>
@endsection