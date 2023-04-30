@extends('layout/main')

@section('app')
<section>
    <div class="flex items-center justify-between h-10">
        <div class="flex items-center gap-2 text-lg">
            <a href="/my-order" class="text-purple font-semibold hover:underline">My Order</a>
        </div>
    </div>

    <div class="border-b border-grey pb-8 mb-8"></div>
    <table class="w-full">
        <thead>
            <tr>
                <td class="w-10">No.</td>
                <td>Nama</td>
                <td>Deskripsi</td>
                <td>Harga</td>
                <td class="text-center">Preview</td>
                <td class="text-center">Status</td>
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
                <td>Rp{{number_format($d->sell_price, 0, ',', '.')}}</td>
                <td class="text-center">
                    <span class="text-purple cursor-pointer" onclick="openImage('{{asset('storage/'.$d->image)}}')">
                        show
                    </span>
                </td>
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
            </tr>
            @endforeach

        </tbody>
    </table>
</section>
@endsection