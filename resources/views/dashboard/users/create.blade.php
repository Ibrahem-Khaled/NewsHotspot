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
        <h1>create New User</h1>
        <a class="button" href="{{ route('showUsers') }}">Go back</a>

        <form action="{{ route('CreatepageUsers') }}" method="Post">
            @csrf
            <hr>
            <input type="text" name="username" id="name" placeholder="username" required />
            <input type="text" name="email" id="name" placeholder="email" required />
            <input type="text" name="displayname" id="name" placeholder="displayname" />
            <input type="password" name="password" id="name" placeholder="password" required/>
            <input type="password" name="password_confirmation" id="name" placeholder="password_confirmation" required/>
            <hr>
            <div class="btn-block">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
