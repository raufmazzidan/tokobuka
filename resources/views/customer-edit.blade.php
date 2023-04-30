@extends('layout/main')

@section('app')
<form method="post" action="/customer/{{$data->id}}" enctype="multipart/form-data">
    @method('put')
    @csrf
    <input type="hidden" value="customer" name="role">
    <section>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-lg">
                <a href="/customer" class="text-purple font-semibold hover:underline">Customer</a>
                <span>/</span>
                <span class="text-grey-dark">Add Customer</span>
            </div>
            <button id="submit" type="submit"
                class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
                Submit
            </button>
        </div>
        <div class="border-b border-grey pb-8 mb-8"></div>

        <div class="w-1/2 mt-10">
            <div class="form-container">
                <label @error('name') class="label-error" @enderror for="name">Nama Lengkap</label>
                <input @error('name') class="input-error" @enderror type="text" id="name" name="name"
                    value="{{old('name', $data->name)}}" placeholder="Masukkan Nama Lengkap">
                @error('name')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container text-left">
                <label @error('dob') class="label-error" @enderror for="dob">Tanggal Lahir</label>
                <input @error('dob') class="input-error" @enderror type="date" id="dob" name="dob"
                    value="{{old('dob', $data->dob)}}">
                @error('dob')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('gender') class="label-error" @enderror for="gender">Jenis Kelamin</label>
                <select @error('gender') class="input-error" @enderror type="text" id="gender" name="gender"
                    value="{{old('gender', $data->gender)}}">
                    <option disabled selected value>Select Gender</option>
                    <option {{$data->gender == 'Laki Laki' ? 'selected' : ''}}>Laki Laki</option>
                    <option {{$data->gender == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                </select>
                @error('gender')
                <span class=" text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('address') class="label-error" @enderror for="address">Alamat</label>
                <textarea @error('address') class="input-error" @enderror placeholder="Masukkan Alamat" type="text"
                    id="address" name="address" rows="4">{{old('address', $data->address)}}</textarea>
                @error('address')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('ktp') class="label-error" @enderror for="image">Gambar</label>
                <div class="border rounded border-grey p-5">
                    <label role="button" for="image"
                        class="px-6 w-fit bg-purple py-3 text-xs text-white uppercase font-bold rounded">
                        Upload KTP
                        <input @error('ktp') class="input-error" @enderror type="file" hidden accept="image" id="image"
                            name="ktp" value="{{old('ktp', $data->ktp)}}">
                    </label>
                    <img onerror="this.style.display='none'" id="image-preview"
                        src="{{asset('storage/'.old('ktp', $data->ktp))}}" class="mt-4 h-40 w-fit">
                </div>
                @error('ktp')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container">
                <label @error('username') class="label-error" @enderror for="username">Username</label>
                <input @error('username') class="input-error" @enderror type="text" id="username" name="username"
                    value="{{old('username', $data->username)}}">
                @error('username')
                <span class="text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container text-left">
                <label @error('password') class="label-error" @enderror for="password">Password</label>
                <input @error('password') class="input-error" @enderror type="password" id="password" name="password"
                    placeholder="Masukkan Password" value="{{old('password')}}" onkeyup="check();">
                @error('password')
                <span class=" text-xs text-red mt-1">{{$message}}</span>
                @enderror
            </div>
            <div class="form-container text-left">
                <label for="re_password">Re-password</label>
                <input type="password" id="re_password" placeholder="Masukkan Ulang Password"
                    value="{{old('password')}}" onkeyup="check();">
                <span id="message" class="text-xs text-red mt-1"></span>
            </div>
        </div>
    </section>
</form>

<script>
    const check = () => {
        const submit = document.getElementById('submit');
        const message = document.getElementById('message');
        const password = document.getElementById('password').value;
        const rePassword = document.getElementById('re_password').value;

        if (password) {
            if (password == rePassword) {
                message.style.color = 'green';
                message.innerHTML = 'Password Match';
                submit.disabled = false;

            } else {
                submit.disabled = true;
                message.style.color = 'red';
                message.innerHTML = 'Password Not Match!. please check your password again';
            }
        } else {
            message.innerHTML = '';
            submit.disabled = true;
        }
}
</script>
@endsection