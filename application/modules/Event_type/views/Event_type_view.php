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
                    <li class="breadcrumb-item active" aria-current="page">Event_type</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#Event_type">New Event</a>
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
                             <!-- <th>Image</th>  -->
                            <th>Name</th>
                            <th>Description</th>
                           <th>Color</th> 
                            
                             <!-- <th>Detail</th>  -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($Event_type as $value) {  ?>
    <tr>
        <td><?=$i++;?></td>
        <td><?=$value['name']?></td>
        <td><?=substr($value['description'], 0,20)?>...</td>
        <td><?=$value['color']?></td>
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="Event_typeSaveDetail:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
            <a class="dropdown-item text-primary" href="<?=base_url('Event_typeDetail/'.$value['id'].'_'.time().'.html')?>">Detail</a>
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
            <form action="<?=base_url('UpdateEvent_type')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" value="<?=$value['name']?>" name="name" placeholder="name" required="">
                </div>
                <div class="mb-3 position-relative col-md-6">
                   <label class="form-label">Color</label>
                   <input type="color" class="form-control form-control-color" name="color" value="<?=$value['color']?>" required="">

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
              <img src="<?=base_url()?>attachments/Carousel/<?=$value['image_path']?>" style="width: 750px; height:500px;">
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
            <form action="<?=base_url('DeleteEvent_type')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Delete</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="Status_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">  
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Do you really wnat to change the status ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('ChangeStatus')?>" method="POST">
            <input type="hidden" name="id_arousel" value="<?=$value['id']?>">
            <input type="hidden" name="is_active" value="<?=$value['is_active']?>">
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Save</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>-->

 <div class="modal fade" id="detail_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static"> 
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
              <?=$value['detail']?>
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
                            <!-- <th>Image</th>  -->
                            <th>Name</th>
                            <th>Description</th>
                            <th>color</th>
                           <!-- <th>Detail</th>  -->
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Event_type" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New Event_type</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('CreateEvent_type')?>" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="name" required="">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Color</label>
                    <input type="color" class="form-control form-control-color" name="color" value="#007bff" required="">
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
</body>
</html>