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
                    <li class="breadcrumb-item active" aria-current="page">Messages de Contact</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#contact_message">New Message</a>
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
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Sujet</th>
                            <th>type</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php $i=1; foreach ($contact_messages as $value) {  ?>
    <tr>
        <td><?=$i++;?></td>
        <td><?=$value['name']?></td>
        <td><?=$value['email']?></td>
        <td><?=$value['phone']?></td>
        <td><?=substr($value['subject'], 0,20)?>...</td>
        <td><?=$value['type']?></td>
        <td>
          <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#Status_<?=$value['id']?>">
              <?= $value['status'] ?></a>
        </td>
        <td><?=date('d/m/Y H:i', strtotime($value['created_at']))?></td>
        <td>
           <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
           <div class="dropdown-menu">
            <a class="dropdown-item text-info" href="javascript:void()"  data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
            <a class="dropdown-item text-primary" href="<?=base_url('Contact_message/Contact_messageDetail/'.$value['id'].'_'.time().'.html')?>">Détail</a>
            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Delete</a>
           </div> 
        </td>
    </tr>


<div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update Message</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('Contact_message/UpdateContact_message')?>" method="POST">
                <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" value="<?=$value['name']?>" name="name" placeholder="Nom" required>
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?=$value['email']?>" required>
                </div>
                </div>
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Téléphone" value="<?=$value['phone']?>">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <option value="general" <?=$value['type']=='general'?'selected':''?>>Général</option>
                        <option value="admission" <?=$value['type']=='admission'?'selected':''?>>admission</option>
                        <option value="complaint" <?=$value['type']=='complaint'?'selected':''?>>Réclamation</option>
                        <option value="academic" <?=$value['type']=='academic'?'selected':''?>>academic</option>
                        <option value="technical" <?=$value['type']=='technical'?'selected':''?>>technical</option>
                    </select>
                </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sujet</label>
                    <input type="text" class="form-control" value="<?=$value['subject']?>" name="subject" required>
                </div>
                <!-- <div class="mb-3"> 
                    <label class="form-label">Statut</label>
                    <select class="form-select" name="status">
                        <option value="new" <?=$value['status']=='new'?'selected':''?>>New</option>
                        <option value="read" <?=$value['status']=='read'?'selected':''?>>Read</option>
                        <option value="replied" <?=$value['status']=='replied'?'selected':''?>>Replied</option>
                        <option value="closed" <?=$value['status']=='closed'?'selected':''?>>Closed</option>
                    </select>
                </div>-->
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Message" id="floatingTextarea" style="height: 100px;" required name="message"><?=$value['message']?></textarea>
                    <label for="floatingTextarea">Message</label>
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

<div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Do you really wnat to delete this content?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('Contact_message/DeleteContact_message')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Delete</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Status_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Do you really wnat to change this status?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('Contact_message/ChangeStatus')?>" method="POST">
            <input type="hidden" name="id" value="<?=$value['id']?>">
            <label>status</label>
                <select class="form-select" name="status">
                        <option value="new" <?=$value['status']=='new'?'selected':''?>>new</option>
                        <option value="read" <?=$value['status']=='read'?'selected':''?>>read</option>
                        <option value="replied" <?=$value['status']=='replied'?'selected':''?>>replied</option>
                        <option value="closed" <?=$value['status']=='closed'?'selected':''?>>closeed</option>  
            </select>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Save</button>  
            </div>                   
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detail_<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Détail du Message</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> <?=$value['name']?></p>
                        <p><strong>Email:</strong> <?=$value['email']?></p>
                        <p><strong>Phone:</strong> <?=$value['phone']?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Subject:</strong> <?=$value['subject']?></p>
                        <p><strong>Type:</strong> <?=$value['type']?></p>
                        <p><strong>Status:</strong> <?=$value['status']?></p>
                        <p><strong>Date:</strong> <?=date('d/m/Y H:i', strtotime($value['created_at']))?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p><strong>Message:</strong></p>
                        <p><?=nl2br($value['message'])?></p>
                    </div>
                </div>
                <?php if(!empty($value['reply'])): ?>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p><strong>reply:</strong></p>
                        <p><?=nl2br($value['reply'])?></p>
                        <?php if(!empty($value['replied_at'])): ?>
                        <p><small><strong>replied at:</strong> <?=date('d/m/Y H:i', strtotime($value['replied_at']))?></small></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
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
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Sujet</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot> 
                </table>
            </div>
        </div>
    </div>
 </div> 


<div class="modal fade" id="contact_message" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">New Message Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="<?=base_url('Contact_message/CreateContact_message')?>" method="POST">
            <div class="modal-body">
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom" required>
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                </div>
                <div class="row">
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Téléphone">
                </div>
                <div class="mb-3 position-relative col-md-6">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="type">
                        <option value="general">General</option>
                        <option value="support">Support</option>
                        <option value="complaint">Complaint</option>
                        <option value="suggestion">Suggestion</option>
                        <option value="partnership">Partnership</option>
                    </select>
                </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">subject </label>
                    <input type="text" class="form-control" name="subject" placeholder="Sujet" required>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Message" id="floatingTextarea" style="height: 100px;" required name="message"></textarea>
                    <label for="floatingTextarea">Message </label>
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