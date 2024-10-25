<?= $this->extend('user/layout'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar Section -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Filter by Location
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#">Profile</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Addresses</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">My Orders</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Vouchers</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content Section -->
            <div class="col-lg-9 col-md-8">
                <div class="card">
                    <div class="card-header">
                        My Profile
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" value="<?= esc($username); ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="store">Store Name</label>
                                <input type="text" id="store" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <div>
                                    <input type="radio" name="gender" value="male"> Male
                                    <input type="radio" name="gender" value="female"> Female
                                    <input type="radio" name="gender" value="other"> Other
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="birthdate">Birth Date</label>
                                <input type="date" id="birthdate" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>
