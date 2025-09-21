<div class="content-body">
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Libur Tetap</h4>
                    <div id="button-group">
                        <button id="btn-edit" class="btn btn-warning btn-sm">Update</button>
                        <button id="btn-save" class="btn btn-success btn-sm d-none">Save</button>
                        <button id="btn-cancel" class="btn btn-secondary btn-sm d-none">Cancel</button>
                    </div>
                </div>

                <div class="card-body">
                    <form id="form-libur-tetap" method="post" action="<?= base_url('admin/updateLiburTetap'); ?>">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hari</th>
                                        <th>Libur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($libur_tetap as $i => $libur): ?>
                                        <tr>
                                            <td><?= $i + 1; ?></td>
                                            <td>
                                                <input type="hidden" name="libur[<?= $i ?>][id]" value="<?= $libur['id_libur_tetap']; ?>">
                                                <input type="text" class="form-control" name="libur[<?= $i ?>][hari]" value="<?= $libur['hari']; ?>" disabled>
                                            </td>
                                            <td>
                                                <select class="form-control" name="libur[<?= $i ?>][is_active]" disabled>
                                                    <option value="1" <?= $libur['is_active'] ? 'selected' : ''; ?>>Ya</option>
                                                    <option value="0" <?= !$libur['is_active'] ? 'selected' : ''; ?>>Tidak</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    const btnEdit = document.getElementById('btn-edit');
    const btnSave = document.getElementById('btn-save');
    const btnCancel = document.getElementById('btn-cancel');
    const form = document.getElementById('form-libur-tetap');
    const inputs = form.querySelectorAll('input[type="text"], select');

    const originalValues = {};

    // Simpan nilai awal untuk cancel
    inputs.forEach((input, index) => {
        originalValues[index] = input.value;
    });

    btnEdit.addEventListener('click', () => {
        inputs.forEach(input => input.disabled = false);
        btnEdit.classList.add('d-none');
        btnSave.classList.remove('d-none');
        btnCancel.classList.remove('d-none');
    });

    btnCancel.addEventListener('click', () => {
        inputs.forEach((input, index) => {
            input.value = originalValues[index];
            input.disabled = true;
        });
        btnEdit.classList.remove('d-none');
        btnSave.classList.add('d-none');
        btnCancel.classList.add('d-none');
    });

    btnSave.addEventListener('click', () => {
        form.submit();
    });
</script>
