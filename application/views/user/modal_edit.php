<!-- Modal Edit -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" id="form_edit" action="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name_edit" id="name_edit" class="form-control form-control-sm" required>
                    <br>
                    <label>Username</label>
                    <input type="text" name="username_edit" id="username_edit" class="form-control form-control-sm" required>
                    <br>
                    <label>Email</label>
                    <input type="email" name="email_edit" id="email_edit" class="form-control form-control-sm" required>
                    <br>
                    <label>Role</label>
                    <select name="role_id_edit" id="role_id_edit" class="form-control form-control-sm" required>
                        <option value="0">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>"><?= $role->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <label>Status</label>
                    <select name="status" id="status" class="form-control form-control-sm" required>
                        <option value="1">Active</option>
                        <option value="0">Not Active</option>
                    </select>
                    <br>
                    <label>Password</label>
                    <input type="password" name="password_edit" id="password_edit" class="form-control form-control-sm" required>
                    <br>
                    <label>Repeat password</label>
                    <input type="password" name="repass_edit" id="repass_edit" class="form-control form-control-sm" required>
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
