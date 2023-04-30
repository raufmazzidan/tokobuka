<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokobuka - {{ $page }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite('resources/css/app.css')
</head>

<body>
    <header
        class="h-24 bg-white flex w-full items-center justify-between lg:px-10 px-8 border-b border-grey fixed z-50">
        <a href="#">
            <img src="{{asset('./img/logo.png')}}" class="h-20">
        </a>
        <div class="flex gap-8">
            @auth
            <form action="/logout" method="post">
                @csrf
                <button type="submit"
                    class="mt-4 px-6 w-full bg-purple py-3 text-xs text-white uppercase font-bold rounded">
                    Logout
                </button>
            </form>
            @endauth
        </div>
    </header>
    <div class="flex pt-24 relative">
        <div class="h-full border-r border-grey w-72 pr-8 fixed bg-white z-50">
            <div class="border-l-4 border-grey ml-4 h-full pt-8 flex flex-col">
                @if(auth()->user()->role != 'customer')
                <a href="/product">
                    <div
                        class="{{ $page == 'Product' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        Product
                    </div>
                </a>
                <a href="/order">
                    <div
                        class="{{ $page == 'Order' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        Order
                    </div>
                </a>
                <a href="/customer">
                    <div
                        class="{{ $page == 'Customer' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        Customer
                    </div>
                </a>
                @endif
                @if(auth()->user()->role == 'admin')
                <a href="/staff">
                    <div
                        class="{{ $page == 'Staff' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        Staff
                    </div>
                </a>
                @endif
                @if(auth()->user()->role == 'customer')
                <a href="/">
                    <div
                        class="{{ $page == 'Shop' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        Shop
                    </div>
                </a>
                <a href="/my-order">
                    <div
                        class="{{ $page == 'My Order' ?  'border-l-4 border-purple bg-purple-light text-purple font-semibold' : 'border-l-4 border-grey bg-white'}} -ml-1 px-4 py-2 text-md tracking-wide hover:border-l-4 hover:border-purple hover:bg-purple-light ease-out duration-300">
                        My Order
                    </div>
                </a>
                @endif
            </div>
        </div>
        <div class="w-full ml-72 p-8">
            @if ($message = Session::get('error'))
            <div class="bg-red text-sm mb-4 text-white px-4 py-2 rounded border">{{$message}}</div>
            @endif
            @if ($message = Session::get('success'))
            <div class="bg-green text-sm mb-4 text-white px-4 py-2 rounded border">{{$message}}</div>
            @endif
            @yield('app')
        </div>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <div class="modal-content">
                <img id="image">
            </div>
        </div>
    </div>
</body>

<script>
    const modal = document.getElementById("myModal");
const modalImg = document.getElementById("image");

function openImage(source) {
    console.log(source);
    modal.style.display = "block";
    modalImg.src = source;
}

const span = document.getElementsByClassName("close")[0];

span.onclick = function () {
    modal.style.display = "none";
};

    const preview = document.getElementById("image-preview");
    const imgField = document.getElementById("image");
    
    imgField.onchange = evt => {
        const [file] = imgField.files
        if (file) {
            preview.src = URL.createObjectURL(file)
            preview.style.display = 'block'
        }
    }

</script>

</html>