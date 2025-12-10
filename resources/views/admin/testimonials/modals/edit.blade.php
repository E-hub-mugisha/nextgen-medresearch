<div class="modal fade" id="editTestimonialModal{{ $testimonial->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">

        <form class="modal-content" method="POST"
            action="{{ route('admin.testimonials.update', $testimonial->id) }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit testimonial</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>role *</label>
                    <input type="text" name="role" value="{{ $testimonial->role }}" required class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Organization *</label>
                    <input type="text" name="organization" value="{{ $testimonial->organization }}" required class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Testimonial/Message</label>
                    <textarea name="testimonial" rows="4" class="form-control">{{ $testimonial->testimonial }}</textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Rating *</label>
                    <select name="rating" class="form-control" required>
                        <option value="1" {{ $testimonial->rating=='1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ $testimonial->rating=='2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ $testimonial->rating=='3' ? 'selected' : '' }}>3</option>
                        <option value="4" {{ $testimonial->rating=='4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ $testimonial->rating=='5' ? 'selected' : '' }}>5</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft" {{ $testimonial->status=='draft'?'selected':'' }}>Draft</option>
                        <option value="published" {{ $testimonial->status=='published'?'selected':'' }}>Published</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Featured</label>
                    <select name="featured" class="form-control">
                        <option value="0" {{ !$testimonial->featured?'selected':'' }}>No</option>
                        <option value="1" {{ $testimonial->featured?'selected':'' }}>Yes</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Image</label><br>

                    @if($testimonial->image)
                    <img src="{{ asset('uploads/testimonials/'.$testimonial->image) }}" height="80" class="rounded mb-2">
                    @endif

                    <input type="file" name="image" class="form-control mt-2">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update testimonial</button>
            </div>

        </form>
    </div>
</div>