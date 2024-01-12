<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageUrl() }}"
                        alt="Mario Avatar">
                    <div>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                </div>
                @auth
                    @if (auth()->id() === $user->id)
                        <div>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-secondary"> View </a>
                        </div>
                    @endif
                @endauth
            </div>
            <div class="mt-4">
                <label for="">Profile Picture</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="px-2 mt-4">
                <h5 class="fs-5"> Bio : </h5>
                <textarea name="bio" class="form-control" id="bio" rows="3">{{ $user->bio }}</textarea>
                @error('content')
                    <span class="fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn-dark btn-sm mb-3 mt-2"> Save </button>
                <br>
                <div class="d-flex justify-content-start">
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                        </span> {{ $user->followers()->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-brain me-1">
                        </span> {{ $user->ideas->count() }} </a>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                        </span> {{ $user->comments->count() }} </a>
                </div>
            </div>
        </form>
    </div>
</div>
