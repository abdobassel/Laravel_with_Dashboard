<h1>All Posts</h1>
@foreach ($posts as $post)
    <h1>{{ $post->title }}</h1>


    <h1>{{ $post->body }}</h1>

    <h1>{{ $post->id }}</h1>
@endforeach
