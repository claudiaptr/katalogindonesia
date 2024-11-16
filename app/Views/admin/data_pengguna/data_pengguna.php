<?= $this->extend('admin/layout'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h1>Data Pengguna</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="row">
            <div class="col-12">
                
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Pengguna</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['no_hp'] ?></td>
                                    <td>
                                        <?= $user['level'] == 1 ? 'Admin' : ($user['level'] == 2 ? 'Penjual' : 'Pembeli') ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="<?= $user['id'] ?>" data-username="<?= $user['username'] ?>" data-email="<?= $user['email'] ?>" data-no_hp="<?= $user['no_hp'] ?>" data-level="<?= $user['level'] ?>">Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="pagination">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->endSection(); ?>

        <!-- Modal Edit User -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Data Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="post" action="<?= base_url('admin/data_pengguna/update') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" id="userId">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" readonly>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" readonly>
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No. HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp" readonly>
                            </div>

                            <div class="form-group">
                                <label for="level">Role</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="1">Admin</option>
                                    <option value="2">Penjual</option>
                                    <option value="3">Pembeli</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<!-- JS Script untuk Modal -->
<?= $this->section('scripts') ?>
<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // tombol yang diklik
        var userId = button.data('id');
        var username = button.data('username');
        var email = button.data('email');
        var no_hp = button.data('no_hp');
        var level = button.data('level');

        // Isi form modal dengan data pengguna
        var modal = $(this);
        modal.find('#userId').val(userId);
        modal.find('#username').val(username);
        modal.find('#email').val(email);
        modal.find('#no_hp').val(no_hp);
        modal.find('#level').val(level);
    });
</script>
<?= $this->endSection() ?>
