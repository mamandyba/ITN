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
                    <li class="breadcrumb-item active" aria-current="page">Event</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#Event">New Event</a>
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <!-- <th>Location</th> -->
                            <th>Status</th>
                            <th>Fees</th>
                            <th>Max_participants</th>
                            <th>created_at</th>

                            <!-- <th>Created At</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($Event as $value) {  ?>
    <tr>
        <td><?=$i++;?></td>
        <td>
        <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#Image_<?=$value['id']?>">
        <img src="<?=base_url()?>attachments/Event/<?=$value['featured_image']?>" style="width:50px; height:50px; border-radius:50%;">
        </a>

        </td>
        <td><?=$value['title']?></td>
        <td><?=$value['type_name']?></td>
        <td><?=$value['start_date']?></td>
        <td><?=$value['end_date']?></td>
        <td><?=$value['location']?></td>
         <td>
              <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#Status_<?=$value['id']?>">
              <?= $value['status'] ?></a>
        </td>
        <td><?=$value['fees']?></td>
        <td><?=$value['max_participants']?></td>
        <td><?=$value['created_at']?></td> 
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
            <a class="dropdown-item text-primary" href="<?=base_url('EventDetail/'.$value['id'].'_'.time().'.html')?>">Detail</a>
            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Delete</a>
           </div> 
        </td>
    </tr>


<!--  Modal Update -->
<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?=base_url('UpdateEvent')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?=$value['id']?>">
                <div class="modal-header">
                    <h4 class="modal-title">Update Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="<?=$value['title']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" value="<?=$value['slug']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Type</label>
                        <select class="form-control" name="event_type_id" required>
                            <option value="">-- Select Type --</option>
                            <?php foreach ($event_types as $et): ?>
                                <option value="<?=$et['id']?>" <?=($et['id']==$value['event_type_id'])?'selected':''?>><?=$et['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" value="<?=$value['start_date']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" name="end_date" value="<?=$value['end_date']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" value="<?=$value['location']?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Participants</label>
                        <input type="number" class="form-control" name="max_participants" value="<?=$value['max_participants']?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Required</label>
                        <select class="form-control" name="registration_required">
                            <option value="1" <?=($value['registration_required']==1)?'selected':''?>>Yes</option>
                            <option value="0" <?=($value['registration_required']==0)?'selected':''?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Deadline</label>
                        <input type="datetime-local" class="form-control" name="registration_deadline" value="<?=$value['registration_deadline']?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fees</label>
                        <input type="text" class="form-control" name="fees" value="<?=$value['fees']?>">
                    </div>
                   <!-- <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="upcoming" <?= ($value['status'] == 'upcoming') ? 'selected' : '' ?>>Upcoming</option>
                            <option value="ongoing" <?= ($value['status'] == 'ongoing') ? 'selected' : '' ?>>Ongoing</option>
                            <option value="completed" <?= ($value['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= ($value['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>-->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Featured?</label>
                        <select class="form-control" name="is_featured">
                            <option value="1" <?=($value['is_featured']==1)?'selected':''?>>Yes</option>
                            <option value="0" <?=($value['is_featured']==0)?'selected':''?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description"><?=$value['description']?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content"><?=$value['content']?></textarea>
                    </div>
                    <div class="mb-3 position-relative col-md-6">
                      <label class="form-label">Image</label>
                         <input type="file" class="form-control" name="featured_image">
                         <input type="hidden" name="HiddenImage" value="<?=$value['featured_image']?>">
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
              <img src="<?=base_url()?>attachments/Event/<?=$value['featured_image']?>" style="width: 750px; height:500px;">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
            </div>   
        </div>
    </div>
</div>
<div class="modal fade" id="Status_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment changer le statut ?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('Event/ChangeStatus')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
            <label>status</label>
           
                <select class="form-select" name="status">
                        <option value="upcoming" <?=$value['status']=='new'?'selected':''?>>upcoming</option>
                        <option value="ongoing" <?=$value['status']=='ongoing'?'selected':''?>>ongoing</option>
                        <option value="completed" <?=$value['status']=='completed'?'selected':''?>>completed</option>
                        <option value="cancelled" <?=$value['status']=='cancelled'?'selected':''?>>cancelled</option>  
            </select>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-info">Enregistrer</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('DeleteEvent')?>" method="POST">
                <input type="hidden" name="id" value="<?=$value['id']?>">
                <div class="modal-header">
                    <h4 class="modal-title">Do you really want to delete this event?</h4>
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

<?php } ?>
                    </tbody>
                    <tfoot>
                          <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Location</th>
                            <!-- <th>Location</th> -->
                            <th>Status</th>
                            <th>Fees</th>
                            <th>Max_participants</th>
                            <th>created_at</th>

                            <!-- <th>Created At</th> -->
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!--  Modal Create -->
<div class="modal fade" id="Event" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="<?=base_url('CreateEvent')?>" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">New Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control" name="slug" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Event Type</label>
                        <select class="form-control" name="event_type_id" required>
                            <option value="">-- Select Type --</option>
                            <?php foreach ($event_types as $et): ?>
                                <option value="<?=$et['id']?>"><?=$et['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" name="start_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" name="end_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Max Participants</label>
                        <input type="number" class="form-control" name="max_participants">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Required</label>
                        <select class="form-control" name="registration_required">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Registration Deadline</label>
                        <input type="datetime-local" class="form-control" name="registration_deadline">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fees</label>
                        <input type="text" class="form-control" name="fees">
                    </div>
                    <!--<div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="upcoming" selected>Upcoming</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>-->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Featured?</label>
                        <select class="form-control" name="is_featured">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content"></textarea>
                    </div>
                    <div class="mb-3 position-relative col-md-6">
                      <label class="form-label">Image</label>
                      <input type="file" class="form-control" name="featured_image" required="">
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