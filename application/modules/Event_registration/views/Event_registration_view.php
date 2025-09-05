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
                    <li class="breadcrumb-item active" aria-current="page">Event Registrations</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#newRegistration">
                New Registration
            </a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>

    <div class="card">
        <?php if(!empty($this->session->userdata('sms'))){ echo $this->session->userdata('sms'); } ?>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>User</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($Event_registration)): ?>
                            <?php $i=1; foreach ($Event_registration as $value) { ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$value['event_title']?></td>
                                    <td><?=$value['first_name'].' '.$value['last_name']?></td>
                                    <td><?=$value['registration_date']?></td>
                                    <td>
                                        <a href="javascript:void()" data-bs-toggle="modal" data-bs-target="#Status_<?=$value['id']?>">
                                            <?= $value['status'] ?>
                                        </a>
                                    </td>
                                    <td><?=substr($value['notes'], 0, 16)?></td>
                                    <td><?=$value['created_at']?></td>
                                    <td><?=$value['updated_at']?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">
                                                Options
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item text-info" href="EventSaveDetail:void()" data-bs-toggle="modal" data-bs-target="#update_<?=$value['id']?>">Update</a>
                                                <a class="dropdown-item text-primary" href="<?=base_url('Event_registration/Detail/'.$value['id'].'_'.time())?>">Detail</a>
                                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_<?=$value['id']?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Update -->
                                <div class="modal fade" id="update_<?=$value['id']?>" tabindex="-1" role="dialog" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="<?=base_url('Event_registration/UpdateEvent_registration')?>" method="POST">
                                                <input type="hidden" name="id" value="<?=$value['id']?>">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Update Registration</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label>Event</label>
                                                        <select class="form-control" name="event_id" required>
                                                            <?php foreach($events as $e): ?>
                                                                <option value="<?=$e['id']?>" <?=($e['id']==$value['event_id'])?'selected':''?>><?=$e['title']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>User</label>
                                                        <select class="form-control" name="user_id" required>
                                                            <?php foreach($users as $u): ?>
                                                                <option value="<?=$u['id']?>" <?=($u['id']==$value['user_id'])?'selected':''?>><?=$u['first_name'].' '.$u['last_name']?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Registration Date</label>
                                                        <input type="datetime-local" class="form-control" name="registration_date" value="<?=date('Y-m-d\TH:i', strtotime($value['registration_date']))?>">
                                                    </div>
                                                   <!--  <div class="mb-3">
                                                        <label>Status</label> 
                                                        <select class="form-control" name="status">
                                                            <option value="registered" <?=($value['status']=='registered')?'selected':''?>>Registered</option>
                                                            <option value="confirmed" <?=($value['status']=='confirmed')?'selected':''?>>Confirmed</option>
                                                            <option value="attended" <?=($value['status']=='attended')?'selected':''?>>Attended</option>
                                                            <option value="cancelled" <?=($value['status']=='cancelled')?'selected':''?>>Cancelled</option>
                                                        </select>
                                                    </div>-->
                                                    <div class="mb-3">
                                                        <label>Notes</label>
                                                        <textarea class="form-control" name="notes"><?=$value['notes']?></textarea>
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
                                <div class="modal fade" id="delete_<?=$value['id']?>" tabindex="-1" role="dialog" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="<?=base_url('Event_registration/DeleteEvent_registration')?>" method="POST">
                                                <input type="hidden" name="id" value="<?=$value['id']?>">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Confirm Delete</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Do you really want to delete this registration?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-info">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>User</th>
                            <th>Registration Date</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Change Status (sécurisé) -->
<?php if(!empty($Event_registration)): ?>
    <?php $lastValue = end($Event_registration); ?>
    <div class="modal fade" id="Status_<?=$lastValue['id']?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Voulez-vous vraiment changer le statut ?</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="<?=base_url('Event_registration/ChangeStatus')?>" method="POST">
                    <input type="hidden" name="id" value="<?=$lastValue['id']?>">
                    <label>Status</label>
                    <select class="form-select" name="status">
                        <option value="registered" <?=$lastValue['status']=='registered'?'selected':''?>>registered</option>
                        <option value="confirmed" <?=$lastValue['status']=='confirmed'?'selected':''?>>confirmed</option>
                        <option value="attended" <?=$lastValue['status']=='attended'?'selected':''?>>attended</option>
                        <option value="cancelled" <?=$lastValue['status']=='cancelled'?'selected':''?>>cancelled</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-info">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Modal Create -->
<div class="modal fade" id="newRegistration" tabindex="-1" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=base_url('Event_registration/CreateEvent_registration')?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">New Registration</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Event</label>
                        <select class="form-control" name="event_id" required>
                            <option value="">-- Select Event --</option>
                            <?php foreach($events as $e): ?>
                                <option value="<?=$e['id']?>"><?=$e['title']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>User</label>
                        <select class="form-control" name="user_id" required>
                            <option value="">-- Select User --</option>
                            <?php foreach($users as $u): ?>
                                <option value="<?=$u['id']?>"><?=$u['first_name'].' '.$u['last_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Registration Date</label>
                        <input type="datetime-local" class="form-control" name="registration_date" value="<?=date('Y-m-d\TH:i')?>">
                    </div>
                    <!-- <div class="mb-3"> 
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="registered">Registered</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="attended">Attended</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>-->
                    <div class="mb-3">
                        <label>Notes</label>
                        <textarea class="form-control" name="notes"></textarea>
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
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/backend/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</body>
</html>
