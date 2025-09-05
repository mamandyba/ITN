<?php include VIEWPATH.'includes/backend/Header.php' ;?>
<?php include VIEWPATH.'includes/backend/Sidebar.php' ;?>
<?php include VIEWPATH.'includes/backend/Topheader.php' ;?>

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">New_letter</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a class="btn btn-outline-primary" href="<?=base_url('New_letter')?>">Listing</a>
        </div>
    </div>

    <hr/>
    <div class="card">
        <div class="card-body">
            <form action="<?=base_url('SaveDetail')?>" method="POST">
                <input type="hidden" value="<?=$detail['id']?>" name="id">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Categories" style="height: 200px;" name="categories"><?=!empty($detail['categories']) ? $detail['categories'] : ''?></textarea>
                    <label>Categories</label>
                </div>
                <div class="card-footer mt-3">
                  <button type="submit" class="btn btn-info">Save</button>  
                </div>                   
            </form>
        </div>
    </div>
</div>

<?php include VIEWPATH.'includes/backend/Footer.php' ;?>
