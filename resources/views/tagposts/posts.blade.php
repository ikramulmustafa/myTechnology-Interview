@extends('layouts.app')

@section('content')
    <!-- Blog Post -->
    <div class="container mt-5">

        <div class="row">

            <div class=" col-md 8">

                @foreach($data as $posts)
                    @foreach($posts->posts as $post)
                    <div class="card mb-4">
                        <img class="card-img-top"
                             src="{{asset('images/'.$post->featured_image)}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">{{$post['title']}}</h2>
                            <p class="card-text">{{\Illuminate\Support\Str::limit(strip_tags($post['content']), 200, '...')}}</p>
                            <a href="" class="btn btn-primary">Read More →</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{$post->created_at->format('M d Y')}} by
                            <a href="#">{{$post->user['name']}}</a>
                            @if(auth()->user())
                                @if(auth()->user()->id ==$post->user['id'])
                                    ,
                                    <button type="button"  id="deletePost" class="btn-danger pull-right" value="{{$post->id}}">Delete Post</button>
                                    ,<a class="pull-right mr-4" href="{{route('posts.edit',$post->id)}}">Edit Post</a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
                @endforeach
            </div>

            <!-- Sidebar Widgets Column -->
            @include('layouts.sidebar')
        </div>

        <ul class="pagination justify-content-center mb-4">
{{--            {{$posts->links()}}--}}
        </ul>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var ref = null;
            $("body").on('click', '#deletePost', function (e) {

                e.preventDefault();
                var $this = this;
                ref = this;
                var id = jQuery($this).val();

                var deleted = confirm("You want to delete?");
                if (deleted) {
                    console.log(id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    jQuery.ajax
                    ({
                        type: 'DELETE',
                        url: 'posts/destroy/' + id,
                        success: function (response, textStatus) {
                            console.log(response.message);
                            location.reload();
                            toastr.success(response.message);

                        },
                        error: function (err) {
                            let error = JSON.parse(err.responseText);
                            console.log(error.message);
                        }
                    });

                }
            });
        });
    </script>
@endpush
