<div class="modal fade" id="editStoryModal{{ $story->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <form class="modal-content" method="POST"
              action="{{ route('admin.stories.update', $story->id) }}"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Story</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $story->name }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Title *</label>
                    <input type="text" name="title" value="{{ $story->title }}" required class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Story</label>
                    <textarea name="story" id="editor-story" rows="4" class="form-control">{{ $story->story }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category *</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $story->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Video URL</label>
                    <input type="text" name="video_url" value="{{ $story->video_url }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft" {{ $story->status=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ $story->status=='published'?'selected':'' }}>Published</option>
                        <option value="archived" {{ $story->status=='archived'?'selected':'' }}>Archived</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Featured</label>
                    <select name="featured" class="form-control">
                        <option value="0" {{ !$story->featured?'selected':'' }}>No</option>
                        <option value="1" {{ $story->featured?'selected':'' }}>Yes</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Image</label><br>

                    @if($story->image)
                        <img src="{{asset('image/stories')}}/{{ $story->image }}" height="80" class="rounded mb-2">
                    @endif

                    <input type="file" name="image" class="form-control mt-2">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update Story</button>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editor-story'))
        .catch(error => console.error(error));
</script>
@endpush
