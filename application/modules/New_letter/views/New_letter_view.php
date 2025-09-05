<?php include VIEWPATH.'includes/backend/Header.php'; ?>
<?php include VIEWPATH.'includes/backend/Sidebar.php'; ?>  
<?php include VIEWPATH.'includes/backend/Topheader.php'; ?>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Newsletters</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#newsletterModal">New Newsletter</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <?php if(!empty($this->session->userdata('sms'))){
            echo $this->session->userdata('sms');
        } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Categories</th>
                            <th>Subscribed At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($newsletters as $value) { ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $value['email'] ?></td>
        <td><?= ucfirst($value['status']) ?></td>
        <td>
            <?php 
            $cats = json_decode($value['categories'], true);
            if(!empty($cats)){
                echo implode(', ', $cats);
            } else {
                echo 'None';
            }
            ?>
        </td>
        <td><?= $value['subscribed_at'] ?></td>
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#update_<?= $value['id'] ?>">Update</a>
            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?= $value['id'] ?>">Delete</a>
           </div> 
        </td>
    </tr>

<!-- Update Modal -->
<div class="modal fade" id="update_<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Newsletter</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('UpdateNew_letter') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $value['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="subscribed" <?= $value['status']=='subscribed'?'selected':'' ?>>Subscribed</option>
                            <option value="unsubscribed" <?= $value['status']=='unsubscribed'?'selected':'' ?>>Unsubscribed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select name="categories[]" class="form-control" multiple required>
                            <?php foreach($all_categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= in_array($cat['id'], json_decode($value['categories'], true) ?? []) ? 'selected' : '' ?>>
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>  
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="delete_<?= $value['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('DeleteNew_letter') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Delete</button>  
                </div>
            </form>
        </div>
    </div>
</div>

<?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Categories</th>
                            <th>Subscribed At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- New Newsletter Modal -->
<div class="modal fade" id="newsletterModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Newsletter</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('CreateNew_letter') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select name="categories[]" class="form-control" multiple required>
                            <?php foreach($all_categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>  
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS & Plugins -->
<script src="<?= base_url() ?>assets/backend/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/backend/js/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/backend/js/app.js"></script>
</body>
</html>
<script>
    