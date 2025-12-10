<div class="modal fade" id="deleteTestimonialModal{{ $testimonial->id }}" tabindex="-1">
    <div class="modal-dialog">

        <form class="modal-content" method="POST"
              action="{{ route('admin.testimonials.destroy', $testimonial->id) }}">

            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title">Delete testimonial</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Are you sure you want to delete?
            </div>

            <div class="modal-footer">
                <button class="btn btn-danger">Yes, Delete</button>
            </div>

        </form>
    </div>
</div>
