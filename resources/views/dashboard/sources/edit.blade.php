<!DOCTYPE html>
<html>

<head>
    <title>edit</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/form.css') }}">
    <style>
        .urgent-news {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 5px;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <div class="main-block">
        <h1>edit Main-Sources</h1>
        <a class="button" href="{{ route('showSources') }}">Go back</a>

        <form action="{{ route('EditSources', $channel->id) }}" method="Post">
            @csrf
            <hr>
            <input type="text" name="name" id="name" placeholder="name" value="{{ $channel->name }}"
                required />
            <input type="text" name="url" id="name" value="{{ $channel->url }}" placeholder="url"
                required />
            <input type="text" name="language" id="name" value="{{ $channel->language }}" placeholder="language"
                required />
            <input type="text" name="country" id="name" value="{{ $channel->country }}" placeholder="country"
                required />
            <div class="urgent-news">
                <input type="checkbox" id="top_storis" name="top_storis" />
                <label for="top_storis">هل هو خبر عاجل</label>
            </div>
            <div class="container">
                <div class="select">
                    <select name="category_id" required>
                        <option value="{{ $channel->category_id }}">{{ $channel->category?->name }}</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="container">
                <div class="select">
                    <select name="subcategory_id">
                        <option value="{{ $channel?->subcategory_id }}">{{ $channel->subcategory?->name }}</option>
                        @foreach ($subcategory as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="container">
                <div class="select">
                    <select name="main_sources_id" required>
                        <option value="{{ $channel->main_sources_id }}">{{ $channel->mainsources->name }}</option>
                        @foreach ($main_sources as $item)
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
