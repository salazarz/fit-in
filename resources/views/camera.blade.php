<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest"></script>
</head>

<body>
    <div class="flex justify-center pt-20">
        <div class="bg-slate-300 flex w-[375px] h-[810px]">
            <div class="mx-auto">
                <div class="bg-gray-700 text-center text-white w-full">
                    <div class="grid grid-cols-3">
                        <a href="/home">Home</a>
                        <a href="/camera">Camera</a>
                        <a href="/profile">Profile</a>
                    </div>
                </div>
                <div class="mx-10">
                    <label for="image-selector">Select a file:</label>
                    <input type="file" id="image-selector" name="image-selector">
                    <div class="mb-5">
                        <img src="" alt="" id="selected-image" style="max-width: 300px; display: none;">
                    </div>
                    <button id="predict-button" class="rounded-md bg-green-600 px-5 py-2 text-white">Predict</button>
                </div>
                <div class="mx-10">
                    <form action="{{route('predict')}}" method="post">
                        @csrf
                        <ol id="prediction-list"></ol>
                    </form>
                </div>
                <div class="progress">Loading Model</div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/predict.js') }}"></script>
<script type="text/javascript">
    let imageLoaded = false;
    $("#image-selector").change(function() {
        imageLoaded = false;
        let reader = new FileReader();
        reader.onload = function() {
            let dataURL = reader.result;
            $("#selected-image").attr("src", dataURL);
            $('#selected-image').show();
            $("#prediction-list").empty();
            imageLoaded = true;
        }
        let file = $("#image-selector").prop('files')[0];
        reader.readAsDataURL(file);
    });
</script>


</html>