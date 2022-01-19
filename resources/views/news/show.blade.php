<div>

    <h2>{{ $news['title'] }}</h2>
    <h3>{!! $news['description'] !!}</h3>
    <p>{{ $news['author'] . " " . $news['created_at'] }}</p>

    <a href="/news">к новостям</a>

</div>
