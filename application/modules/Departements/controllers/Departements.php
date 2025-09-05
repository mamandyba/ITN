<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    Dushime paul
 * Email:     dushimeyesupaulin@gmail.com
 * Date :     Le 26/08/2025
 
*/
class Departements extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    
	public function index()
	{   

		 $sql = "SELECT d.*, u.first_name 
                FROM departments d
               LEFT JOIN users u ON u.Id = d.Id";

        $data['departments'] = $this->Model->readQuery($sql);

        $data['users'] = $this->Model->read('users');

		$this->load->view('Departements_View',$data);
		
	}




	

	function DepartementsDetail($departementsDetail){
	  $iddepartemts=explode('_', $departementsDetail);
	  $data['departments']=$this->Model->readOne('departments',['id'=>$iddepartemts[0]]);
	  $this->load->view('DepartementDetail_View.php',$data);
	}

	function SaveDetailDepartement(){
	  $id=$this->input->post('id');
	  $detail=$this->input->post('Description');
	  $rsp=$this->Model->update('departments',['id'=>$id],['description'=>$detail]);
	  if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content created successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('Departements'));
	}

	function CreateDepartement(){
		$nom=$this->input->post('nom');
		$code=$this->input->post('code');
		$description=$this->input->post('description');
		$head_teacher_id=$this->input->post('id');
		$logo=$this->upload_document($_FILES['logo']['tmp_name'],$_FILES['logo']['name']);

		$data=array('name'=>$nom,
	                'code'=>$code,
	                'description'=>$description,
	                'head_teacher_id'=>$head_teacher_id,
	                'logo'=>$logo,
	               );
		$rsp=$this->Model->create('departments',$data);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content created successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('Departements'));

		// print_r($data);
	}

	function UpdateDepartement(){
		$id=$this->input->post('id');
		$nom=$this->input->post('nom');
		$description=$this->input->post('description');
		$code=$this->input->post('code');
		$head_teacher_id=$this->input->post('head_teacher_id');
		// $HiddenImage=$this->input->post('HiddenImage');
       
		if (!empty($_FILES['logo']['name'])) {
		  $logo=$this->upload_document($_FILES['logo']['tmp_name'],$_FILES['logo']['name']);
		}else{
		  $logo=$this->input->post('Hiddenlogo');
		}
		

		$data=array('name'=>$nom,
	                'code'=>$code,
	                'description'=>$description,
	                'head_teacher_id'=>$head_teacher_id,
	                'logo'=>$logo,
	                
	               );
		$rsp=$this->Model->update('departments',['id'=>$id],$data);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content updated successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('Departements'));
	}


	function DeleteDepartement(){
		$id=$this->input->post('id');
		$rsp=$this->Model->delete('departments',['id'=>$id]);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content deleted successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('Departements'));
	}







	  //upload images
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Departements/';
	      $code=date("YmdHis").uniqid();
	      $fichier=basename($code);
	      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
	      $file_extension = strtolower($file_extension);
	      $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

	      if(!is_dir($ref_folder)) //create the folder if it does not already exists   
	      {
	          mkdir($ref_folder,0777,TRUE);                                        
	      }  
	      move_uploaded_file($nom_file, $ref_folder.$fichier.".".$file_extension);
	      // $pathfile="attachments/shop_images/".$fichier.".".$file_extension;
	      $image_name=$fichier.".".$file_extension;
	      return $image_name;
	}
}
