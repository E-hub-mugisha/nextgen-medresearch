<div class="modal fade" id="addStoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('admin.stories.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add Story</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Title *</label>
                    <input type="text" name="title" required class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Story</label>
                    <textarea name="story" rows="4" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category *</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Video URL</label>
                    <input type="text" name="video_url" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Featured</label>
                    <select name="featured" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save Story</button>
            </div>

        </form>
    </div>
</div>
