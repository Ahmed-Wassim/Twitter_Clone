<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageUrl() }}"
                    alt="{{ $idea->user->name }}">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div class="d-flex">
                <a href="{{ route('idea.show', $idea->id) }}" class="ms-1">View</a>
                @if (auth()->id() == $idea->user_id)
                    <a href="{{ route('idea.edit', $idea->id) }}" class="mx-1">Edit</a>
                    <form action="{{ route('idea.destroy', $idea->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"> X </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('idea.update', $idea->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="idea" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class="fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="">
                    <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            @include('ideas.shared.like')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->diffForHumans() }} </span>
            </div>
        </div>
        @include('ideas.shared.comments')
    </div>
</div>
