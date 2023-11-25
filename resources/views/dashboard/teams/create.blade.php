<!DOCTYPE html>
<html>

<head>
    <title>create</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/form.css') }}">

</head>

<body>
    <div class="main-block">
        <h1>create teams</h1>
        <a class="button" href="{{ route('showTeams') }}">Go back</a>

        <form action="{{ route('Createpageteams') }}" method="Post">
            @csrf
            <hr>
            <input type="text" name="name" id="name" placeholder="name" required />
            <div class="container">
                <div class="select">
                    <select name="sub_category_id" required>
                        <option value="">pls select sub category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <div class="btn-block">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
