<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center pt-20">
        <div class="bg-slate-300 flex w-[375px] h-[810px]">
            <div class="w-full">
                <div class="bg-gray-700 text-center text-white w-full">
                    <div class="grid grid-cols-3">
                        <a href="/home">Home</a>
                        <a href="/camera">Camera</a>
                        <a href="/profile">Profile</a>
                    </div>
                </div>
                <div class="w-[90%] mx-auto">
                    <div class="mt-16">
                        <p class="text-5xl">Good Morning</p>
                        <p>Hello, {{$data->user->name}}</p>
                        <div class="bg-green-300 w-full p-10 rounded-md mt-5">
                            <p class="flex justify-center">{{ $data->calories }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>