<!DOCTYPE html>
<html>

<head>
    <title>edit</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/form.css') }}">

</head>

<body>
    <div class="main-block">
        <h1>edit categories</h1>
        <a class="button" href="{{ route('showcategories') }}">Go back</a>

        <form action="{{ route('Editcategories', $channel->id) }}" method="Post">
            @csrf
            <hr>
            <input type="text" name="name" id="name" placeholder="name" value="{{ $channel->name }}"
                required />
            <input type="text" name="description" id="name" placeholder="description" value="{{ $channel->description }}"
                required />
            <hr>
            <div class="btn-block">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
