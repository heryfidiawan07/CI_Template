<!-- Modal Create -->
<div id="modal-create" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" id="form_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Create Role</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Role name" required>
                    <br>
                    <label>Menu</label>
                    <?php foreach ($menus as $menu): ?>
                        <div class="form-check">
                            <input class="form-check-input menu_id" type="checkbox" value="<?= $menu->id ?>" name="menu_id[]" id="menu_<?= $menu->id ?>" data-id="<?= $menu->id ?>">
                            <label class="form-check-label" for="menu_<?= $menu->id ?>"><?= $menu->name ?></label>
                        </div>
                        <div class="alert alert-secondary">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions action_<?= $menu->id ?>" type="checkbox" value="create" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-success" for="<?= $menu->id ?>">Create</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions action_<?= $menu->id ?>" type="checkbox" value="update" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-warning" for="<?= $menu->id ?>">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions action_<?= $menu->id ?>" type="checkbox" value="delete" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-danger" for="<?= $menu->id ?>">Delete</label>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" id="btn-create">Save</button>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal Create -->
