<!-- Modal Edit -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" id="form_edit" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name_edit" id="name_edit" class="form-control form-control-sm" required>
                    <br>
                    <label>Menu</label>
                    <?php foreach ($menus as $menu): ?>
                        <div class="form-check">
                            <input class="form-check-input menu_id_edit" type="checkbox" value="<?= $menu->id ?>" name="menu_id[]" id="menu_edit_<?= $menu->id ?>" data-id="<?= $menu->id ?>">
                            <label class="form-check-label" for="menu_edit_<?= $menu->id ?>"><?= $menu->name ?></label>
                        </div>
                        <div class="alert alert-secondary">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions_edit action_edit_<?= $menu->id ?> action_check_<?= $menu->id ?>_create" type="checkbox" value="create" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-success" for="<?= $menu->id ?>">Create</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions_edit action_edit_<?= $menu->id ?> action_check_<?= $menu->id ?>_update" type="checkbox" value="update" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-warning" for="<?= $menu->id ?>">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input actions_edit action_edit_<?= $menu->id ?> action_check_<?= $menu->id ?>_delete" type="checkbox" value="delete" name="<?= $menu->id ?>_action[]" id="<?= $menu->id ?>">
                                <label class="form-check-label text-danger" for="<?= $menu->id ?>">Delete</label>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm" id="btn-edit">Save</button>
                    <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal Edit -->
