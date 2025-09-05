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
                    <li class="breadcrumb-item active" aria-current="page">Roles</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#role">New Role</a>
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
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($roles as $value) { ?>
    <tr>
        <td><?=$i++;?></td>
        <td><?=$value['name']?></td>
        <td><?=$value['display_name']?></td>
        <td><?=substr($value['description'], 0,40)?>...</td>
        <td><?=$value['created_at']?></td>
        <td><?=$value['updated_at']?></td>
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
            <a class="dropdown-item text-primary" href="<?=base_url('RoleDetail/'.$value['id'].'_'.time().'.html')?>">Detail</a>
            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Delete</a>
           </div>
        </td>
    </tr>

<!-- Modal Update -->
<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Role</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('UpdateRole')?>" method="POST">
                <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?=$value['name']?>" name="name" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Display Name</label>
                        <input type="text" class="form-control" value="<?=$value['display_name']?>" name="display_name" required>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" style="height: 100px;" required name="description"><?=$value['description']?></textarea>
                    <label>Description</label>
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

<!-- Modal Delete -->
<div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Do you really want to delete this role?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('DeleteRole')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
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
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal New Role -->
<div class="modal fade" id="role" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Role</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('CreateRole')?>" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Technical name" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Display Name</label>
                        <input type="text" class="form-control" name="display_name" placeholder="Display name" required>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" style="height: 100px;" required name="description"></textarea>
                    <label>Description</label>
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

<!-- Bootstrap JS -->
<script src="<?=base_url()?>assets/backend/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?=base_url()?>assets/backend/js/index2.js"></script>
<script src="<?=base_url()?>assets/backend/js/app.js"></script>
</body>
</html>
