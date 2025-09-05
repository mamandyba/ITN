<?php include VIEWPATH.'includes/backend/Header.php' ;?>
<?php include VIEWPATH.'includes/backend/Sidebar.php' ;?>  
<?php include VIEWPATH.'includes/backend/Topheader.php' ;?>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#newUser">New User</a>
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
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Email Verified</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($users as $u) {  ?>
    <tr>
        <td><?=$i++;?></td>
        <td>
            <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#photo_<?=$u['id']?>">
                <img src="<?=base_url()?>attachments/Users/<?=$u['profile_photo']?>" style="width:50px; height:50px; border-radius:50%;">
            </a>
        </td>
        <td><?=$u['first_name'].' '.$u['last_name']?></td>
        <td><?=$u['email']?></td>
        <td><?=$u['phone']?></td>
        <td>
            <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#status_<?=$u['id']?>">
                <?=$u['status']==1?'Active':'Inactive'?>
            </a>
        </td>
        <td><?=$u['email_verified']==1?'<span class="text-success">Yes</span>':'<span class="text-danger">No</span>'?></td>
        <td><?=$u['role_id']?></td>
        <td><?=$u['created_at']?></td>
        <td>
            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">Options</button>
            <div class="dropdown-menu">
                <a class="dropdown-item text-info" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#update_<?=$u['id']?>">Update</a>
                <a class="dropdown-item text-danger" href="javascript:void()" data-bs-toggle="modal" data-bs-target="#delete_<?=$u['id']?>">Delete</a>
            </div> 
        </td>
    </tr>

<!-- Update Modal -->
<div class="modal fade" id="update_<?=$u['id']?>" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('UpdateUser')?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$u['id']?>">
        <div class="modal-header">
            <h4 class="modal-title">Update User</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">First Name</label><input type="text" name="first_name" value="<?=$u['first_name']?>" class="form-control" required></div>
              <div class="col-md-6 mb-3"><label class="form-label">Last Name</label><input type="text" name="last_name" value="<?=$u['last_name']?>" class="form-control" required></div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Email</label><input type="email" name="email" value="<?=$u['email']?>" class="form-control" required></div>
              <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input type="text" name="phone" value="<?=$u['phone']?>" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" value="<?=$u['date_of_birth']?>" class="form-control"></div>
              <div class="col-md-6 mb-3"><label class="form-label">Role</label><input type="text" name="role_id" value="<?=$u['role_id']?>" class="form-control"></div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Profile Photo</label><input type="file" name="profile_photo" class="form-control"><input type="hidden" name="HiddenPhoto" value="<?=$u['profile_photo']?>"></div>
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
<div class="modal fade" id="delete_<?=$u['id']?>" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('DeleteUser')?>" method="POST">
        <input type="hidden" name="id" value="<?=$u['id']?>">
        <div class="modal-header">
            <h4 class="modal-title">Do you really want to delete this user?</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Status Modal -->
<div class="modal fade" id="status_<?=$u['id']?>" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('ChangeUserStatus')?>" method="POST">
        <input type="hidden" name="id" value="<?=$u['id']?>">
        <input type="hidden" name="status" value="<?=$u['status']?>">
        <div class="modal-header">
            <h4 class="modal-title">Do you want to change the status?</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Photo Modal -->
<div class="modal fade" id="photo_<?=$u['id']?>" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header"><h4 class="modal-title">Profile Photo</h4><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body text-center"><img src="<?=base_url()?>attachments/Users/<?=$u['profile_photo']?>" style="width:400px;height:400px;border-radius:10px;"></div>
        <div class="modal-footer"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></div>
    </div>
  </div>
</div>

<?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Email Verified</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="newUser" tabindex="-1" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?=base_url('CreateUser')?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
            <h4 class="modal-title">New User</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">First Name</label><input type="text" name="first_name" class="form-control" required></div>
              <div class="col-md-6 mb-3"><label class="form-label">Last Name</label><input type="text" name="last_name" class="form-control" required></div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
              <div class="col-md-6 mb-3"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control"></div>
              <div class="col-md-6 mb-3"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control"></div>
            </div>
            <div class="row">
              <label>Roles</label>
                 <select name="id" class="form-control" required>
                    <option value="">Sélectionnez le role</option>
                        <?php foreach ($roles as $value): ?>
                     <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
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

<!-- JS -->
<script src="<?=base_url()?>assets/backend/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/backend/js/jquery.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?=base_url()?>assets/backend/js/app.js"></script>
</body>
</html>
