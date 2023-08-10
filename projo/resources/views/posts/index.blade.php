<x-layout>
  {{-- <x-slot name="content">
    @foreach($posts as $post)
      <article>
        <h1><a href="/posts/{{ $post->slug; }}">{!! $post->title; !!}</a></h1>
        <p>
          By <a href="/authors/{{$post->author->username}}">{{ $post->author->name }}</a> in 
          <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>
        <div>{{ $post->excerpt }}</div>
      </article>
    @endforeach
  </x-slot> --}}

  @include('posts._header')

  <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    @if ($posts->count())
      <x-post-grid :posts="$posts" />

      {{ $posts->links() }}
    @else
      <p class="text-center">No posts yet. Please check back later.</p> 
    @endif
    
  </main>
</x-layout>