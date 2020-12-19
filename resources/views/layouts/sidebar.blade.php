<div class="col-md-4">
    @if(auth()->user())
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            Create Post</a>
@endif
    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <form class="card-body" action="{{route('posts.index')}}" method="GET" role="search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." name="q">
                <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
        </form>
    </div>
    <!-- Tags Widget -->
    <div class="card my-4">
        <h5 class="card-header">Tags</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">
                        @foreach($tags as $tag)
                            <li>
                                <a href="{{url('tags/'.$tag->id.'/posts')}}">{{$tag['name']}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
