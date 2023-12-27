@section('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create_post.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <script src="{{ asset('js/create_post.js') }}" defer></script>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>
    <div style="padding: 7rem 0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="p-6 bg-white border-b border-gray-200 w-full rounded-md">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('posts.store')}}" method="post" class="position-relative" id="posts"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">{{ __('Category') }}: </label>
                        <select class="form-control" name='category'>
                            <option value="">-- {{ __('Pick one') . ' ' . __('category') }} --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="thumbnail">{{ __('Thumbnail') }}: </label>
                        <div class="upload-container relative flex items-center justify-between w-full">
                            <div
                                class="drop-area w-full rounded-md border-2 border-dotted border-gray-200 transition-all hover:border-blue-600/30 text-center">
                                <label style="font-size: 14px;"
                                    for="file-input"
                                    class="block w-full h-full text-gray-500 p-4 text-sm cursor-pointer">
                                    {{ __('Drop file or click to choose') }}
                                </label>
                                <input
                                    name="file"
                                    type="file"
                                    id="file-input"
                                    accept="image/*"
                                    class="hidden"
                                />
                                <!-- Image upload input -->
                                <div class="preview-container hidden items-center justify-center flex-col">
                                    <div class="preview-image w-36 h-36 bg-cover bg-center rounded-md"></div>
                                    <span class="file-name my-4 text-sm font-medium"></span>
                                    <p class="close-button cursor-pointer transition-all mb-4 rounded-md px-3 py-1 border text-xs text-red-500 border-red-500 hover:bg-red-500 hover:text-white">
                                        {{ __('Delete') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="title">{{ __('Title') }}: </label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="description">{{ __('Description') }}: </label>
                        <textarea name="description" id="description" class="form-control" cols="30"
                            rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="mt-4" for="content">{{ __('Content') }}: </label>
                        <textarea name="content" id="content" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hashtag">{{ __('Hashtag') }}:
                            ({{ __('Press Back Until Empty Input To Remove Box Tag Or Click Outside The Search Block') }}
                            )</label>
                        <input type="text" class="form-control" name="hashtag">
                        <ul id="tagList">
                        </ul>
                        <input type="text" class="form-control" id="newTag">
                        <ul class="hashtag-result">
                            @foreach ($hashtags as $hashtag)
                                <li data-slug="{{ $hashtag->slug }}"
                                    data-id="{{ $hashtag->id }}">{{ $hashtag->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a class="btn btn-lg btn-danger mt-4" href="{{ route('posts.index') }}">{{ __('Back') }}</a>
                    <button type="submit" class="btn btn-lg btn-primary mt-4">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
