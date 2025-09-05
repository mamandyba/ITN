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
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Departments</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#carousel">New Departements</a>
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
                            <th>Nom</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Head teacher</th>
                            <th>Logo</th>
                            <th>Creaded at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($departments as $value) {  ?>
    <tr>
        <td><?=$i++;?></td>
        <td><?=$value['name']?></td>
        <td><?=$value['code']?></td>
        <td><?=substr($value['description'], 0,20)?>...</td>
        <td><?=$value['head_teacher_id']?></td>
        <td>
        <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#Image_<?=$value['id']?>">
        <img src="<?=base_url()?>attachments/Departments/<?=$value['logo']?>" style="width:50px; height:50px; border-radius:50%;">
        </a>
        </td>
         <td><?=$value['created_at']?></td>
        <td><?=$value['updated_at']?></td>
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
            <a class="dropdown-item text-primary" href="<?=base_url('detaildepartements/'.$value['id'].'_'.time().'.html')?>">Detail</a>
            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Delete</a>
           </div> 
        </td>
    </tr>


<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('UpdateDepartement')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$value['id_arousel']?>">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Nom :</label>
                    <input type="text" class="form-control" value="<?=$value['name']?>" name="nom" placeholder="name" required="">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">code</label>
                    <input type="text" class="form-control" name="code" placeholder="code" value="<?=$value['code']?>" required="">
                </div>
                </div>
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">logo</label>
                    <input type="file" class="form-control" name="logo">
                    <input type="hidden" name="Hiddenlogo" value="<?=$value['logo']?>">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">head_teacher_id</label>
                    <input type="text" class="form-control" value="<?=$value['head_teacher_id']?>" name="head_teacher_id" required="">
                </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;" required="" name="description"><?=$value['description']?></textarea>
                    <label for="floatingTextarea">Description</label>
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


<div class="modal fade" id="Image_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Image</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
              <img src="<?=base_url()?>attachments/Departements/<?=$value['logo']?>" style="width: 750px; height:500px;">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
            </div>   
        </div>
    </div>
</div>


<div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Do you really wnat to delete this content ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('DeleteDepartement')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Delete</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="detail_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
              <?=$value['description']?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
            </div>   
        </div>
    </div>
</div>

<?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Head teacher</th>
                            <th>Logo</th>
                            <th>Creaded at</th>
                            <th>Update at</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="carousel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New Departement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('CreateDepartement')?>" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" placeholder="Nom" required="">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Code</label>
                    <input type="text" class="form-control" name="code" placeholder="Code" required="">
                </div>
                </div>
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Logo</label>
                    <input type="file" class="form-control" name="logo" required="">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label>Head Teacher</label>
                 <select name="id" class="form-control" required>
                    <option value="">Sélectionnez le users</option>
                        <?php foreach ($users as $value): ?>
                     <option value="<?= $value['id'] ?>"><?= $value['first_name'] ?></option>
                             <?php endforeach; ?>
                 </select>
                </div>
                </div>

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;" required="" name="description"></textarea>
                    <label for="floatingTextarea">Description</label>
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
    <!--plugins-->
    <script src="<?=base_url()?>assets/backend/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    
    <script src="<?=base_url()?>assets/backend/js/index2.js"></script>
    <!--app JS-->
    <script src="<?=base_url()?>assets/backend/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        </script>
</body>
</html>