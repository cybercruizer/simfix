<!-- resources/views/menu/edit_modal.blade.php -->

<div class="modal-header">
    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu Item</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <!-- Form for editing menu item goes here -->
    <form action="{{ route('adm.menu.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
        </div>
        <div class="form-group">
            <label for="url">URL</label>
            <input type="text" name="url" class="form-control" value="{{ $menu->url }}">
        </div>
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}">
        </div>
        <div class="form-group">
            <label for="parent_id">Parent ID</label>
            <input type="number" name="parent_id" class="form-control" value="{{ $menu->parent_id }}">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" name="role" class="form-control" value="{{ $menu->role }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<!-- You can add additional modal content or customize as needed -->
