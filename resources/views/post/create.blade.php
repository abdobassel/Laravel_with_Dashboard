<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="{{ route('store') }}">
    @csrf
    <label for="title">Post Title</label>

    <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror">

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <label for="body">Post body</label>

    <input id="body" type="text" name="body" class="@error('body') is-invalid @enderror">

    @error('body')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit">save</button>
</form>
