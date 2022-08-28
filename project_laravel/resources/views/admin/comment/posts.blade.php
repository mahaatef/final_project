<option value="">Choose Post</option>
@foreach($posts as $post)
    <option value="{{$post->id}}">{{$post->title}}</option>
@endforeach
