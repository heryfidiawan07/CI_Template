<!-- Modal Create -->
<div id="modal-create" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form method="POST" id="form_create">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Create User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Name" required>
                    <br>
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="Username" required>
                    <br>
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Email" required>
                    <br>
                    <label>Role</label>
                    <select name="role_id" id="role_id" class="form-control form-control-sm" required>
                        <option value="0">Select Role</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= $role->id ?>"><?= $role->name ?></option>
                        <?php endforeach ?>
                    </select>
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" required>
                    <br>
                    <label>Repeat password</label>
                    <input type="password" name="repeat_password" id="repeat_password" class="form-control form-control-sm" required>
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
