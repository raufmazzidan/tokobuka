@extends('layout/main')

@section('app')
<section>
    <div class="flex items-center justify-between h-10">
        <div class="flex items-center gap-2 text-lg">
            <a href="/customer" class="text-purple font-semibold hover:underline">Customer</a>
        </div>
        <a href="/customer/create" class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
            Add Customer
        </a>
    </div>

    <div class="border-b border-grey pb-8 mb-8"></div>
    <table class="w-full">
        <thead>
            <tr>
                <td class="w-10">No.</td>
                <td>Nama</td>
                <td>Tanggal Lahir</td>
                <td>Gender</td>
                <td>Alamat</td>
                <td class="text-center">Foto KTP</td>
                <td>Username</td>
                <td>Password</td>
                <td>Action</td>
        </thead>
        <tbody>
            @if(!count($data))
            <tr>
                <td colspan="9" class="text-center">Data not found</td>
            </tr>
            @endif
            @foreach($data as $index => $d)
            <tr>
                <td class="">{{$index+1}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->dob}}</td>
                <td>{{$d->gender}}</td>
                <td>{{$d->address}}</td>
                <td class="text-center">
                    <span class="text-purple cursor-pointer" onclick="openImage('{{asset('storage/'.$d->ktp)}}')">
                        show
                    </span>
                </td>
                <td>{{$d->username}}</td>
                <td>********</td>
                <td>
                    <div class="flex flex-col gap-2 h-full">
                        <a href="/customer/{{$d->id}}/edit" class="text-yellow flex items-center">
                            <i class="fa fa-pencil" aria-hidden="true"></i><span class="ml-1">Edit</span>
                        </a>
                        <form method="post" action="/customer/{{ $d->id }}">
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