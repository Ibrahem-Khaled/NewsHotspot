<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS Hotspot</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/content.css') }}">
</head>

<body>
    <!-- create nav bar start -->
    <div class="topnav">
        <a href="{{ route('showmainSources') }}">main sources</a>
        <a class="active" href="{{ route('showSources') }}">sources</a>
        <a href="{{ route('showcategories') }}">category</a>
        <a href="{{ route('showSubcategories') }}">sub-category</a>
        <a href="{{ route('showLivechanels') }}">live channels</a>
        <a href="{{ route('showUsers') }}">users</a>
        <a href="{{ route('showTeams') }}">teams</a>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <!-- end nav bar start -->

    <!--Content page-->
    <section>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th><a href="{{ route('showCreatepageSources') }}">create</a></th>
                        <th>name</th>
                        <th>url</th>
                        <th>language</th>
                        <th>country</th>
                        <th>category</th>
                        <th>sub category</th>
                        <th>main_sources</th>
                        <th>edit</th>
                        <th>delete</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->language }}</td>
                            <td>{{ $item->country }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->subcategory?->name }}</td>
                            <td>{{ $item->mainsources?->name }}</td>
                            <td><a href="{{ route('showEditepageSources', $item->id) }}">Edit</a></td>
                            <form method="POST" action="{{ route('DeleteSources', $item->id) }}">
                                @csrf
                                <td><button type="submit">Delete</button></td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>



</body>

</html>
