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
                    <div class="pb-5">
                        <p>Hello, {{$data->user->name}}</p>
                    </div>
                    <div class="pb-5">
                        <a href="{{route('actionLogout')}}" class="rounded-md bg-red-500 px-5 py-2 text-white">Logout</a>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-300 rounded-md p-6">
                            <p>body weight</p>
                            <p>{{ $data->user->weight }} kg</p>
                        </div>
                        <div class="bg-green-300 rounded-md p-6">
                            <p>body height</p>
                            <p>{{ $data->user->height }} cm</p>
                        </div>
                    </div>
                    <div class="bg-green-300 w-full p-10 rounded-md mt-5">
                        <p class="flex justify-center">{{ $data->calories }}</p>
                    </div>
                    <table id="table_id" class="divide-y divide-gray-200 w-[90%] table-auto mx-auto my-6">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Food</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Calories</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->history as $row)
                            <tr class="bg-white">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $row->calories }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 break-all">{{ $row->food }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>