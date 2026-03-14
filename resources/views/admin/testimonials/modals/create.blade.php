<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Add Testimonial</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role *</label>
                    <input type="text" name="role" required class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Organization *</label>
                    <input type="text" name="organization" required class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Testimonial/Message</label>
                    <textarea name="testimonial" id="editor-testimonial" rows="4" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Rating *</label>
                    <select name="rating" class="form-control" required>
                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
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
                    <label>Photo</label>
                    <input type="file" name="photo" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save info</button>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editor-testimonial'))
        .catch(error => console.error(error));
</script>
@endpush