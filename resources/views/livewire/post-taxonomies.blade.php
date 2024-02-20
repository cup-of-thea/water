<ul class="list-none p-0 flex justify-end space-x-4">

    <li class="m-0 p-0">
        <a href="/categories/{{ $category->slug }}">
            {{ $category->title }}
        </a>
    </li>

    @foreach($tags as $tag)
        <li class="m-0 p-0">
            <a href="/tags/{{ $tag->slug }}">
                #{{ $tag->title }}
            </a>
        </li>
    @endforeach


</ul>
