<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Timeline
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card bg-white">
                <div class="card-body">
                    <form action="{{ route('tweets.store') }}" method="post">
                        @csrf
                        <textarea name="content" class="textarea textarea-bordered w-full bg-white text-black"
                            placeholder="Apa yang sedang kamu pikirkan?" rows="3"></textarea>
                        <input type="submit" value="Kirim" class="btn btn-primary">
                    </form>
                </div>
            </div>

            <!-- menampilkan Tweet -->
            @foreach($tweets as $tweet)
            <div class="card my-4 bg-white">
                <div class="card-body">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-bold text-black"> {{$tweet->user->name}}
                        </h2>
                        <!-- user merujuk pada user di tweet.php models -->
                        <p class="text-end text-xs text-black">
                            {{$tweet->created_at->diffForHumans()}}
                        </p>
                    </div>
                    <p class="text-black"> {{$tweet->content}}</p>
                    <div class="action-button flex">
                        @can('update', $tweet)
                        <a href="{{ route('tweets.edit', $tweet->id) }}" class="btn btn-info btn-xs me-2">
                            Edit
                        </a>
                        @endcan

                        @can('delete', $tweet)
                        <form action="{{ route('tweets.destroy', $tweet->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-error btn-xs"
                                onclick="return confirm('Apakah Anda yakin untuk mengahapus tweet?')">
                                Hapus
                            </button>
                        </form>
                        @endcan

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</x-app-layout>