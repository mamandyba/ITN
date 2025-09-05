<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    niyodon paci
 * Email:     niyodonpaci@gmail.com
 * Date :     Le 26/08/2025
 * Gitgub:    https://github.com/niyodon3564
*/
class Carousel extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    
	public function index()
	{
		$data['carousel']=$this->Model->read('carousels',null,'id_arousel');
		$this->load->view('Carousel_View',$data);
		// $this->load->view('Carousel_View');
	}


	function ChangeStatus(){
	  $id_arousel=$this->input->post('id_arousel');
	  $is_active=$this->input->post('is_active');
	  if ($is_active==1) {
	  	$status=0;
	  }else{
	  	$status=1;
	  }
	  $rsp=$this->Model->update('carousels',['id_arousel'=>$id_arousel],['is_active'=>$status]);

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
		redirect(base_url('Carousel'));	
	}

	function CarouselDetail($CarouselDetail){
	  $id_arousel=explode('_', $CarouselDetail);
	  $data['detail']=$this->Model->readOne('carousels',['id_arousel'=>$id_arousel[0]]);
	  $this->load->view('CarouselDetail_View',$data);
	}

	function SaveDetail(){
	  $id_arousel=$this->input->post('id_arousel');
	  $detail=$this->input->post('detail');
	  $rsp=$this->Model->update('carousels',['id_arousel'=>$id_arousel],['detail'=>$detail]);
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
		redirect(base_url('Carousel'));
	}

	function CreateCarousel(){
		$title=$this->input->post('title');
		$subtitle=$this->input->post('subtitle');
		$description=$this->input->post('description');
		$video_url=$this->input->post('video_url');
		$image_path=$this->upload_document($_FILES['image_path']['tmp_name'],$_FILES['image_path']['name']);

		$data=array('title'=>$title,
	                'subtitle'=>$subtitle,
	                'description'=>$description,
	                'image_path'=>$image_path,
	                'video_url'=>$video_url,
	               );
		$rsp=$this->Model->create('carousels',$data);

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
		redirect(base_url('Carousel'));

		// print_r($data);
	}

	function UpdateCarousel(){
		$id_arousel=$this->input->post('id_arousel');
		$title=$this->input->post('title');
		$description=$this->input->post('description');
		$subtitle=$this->input->post('subtitle');
		$video_url=$this->input->post('video_url');
		// $HiddenImage=$this->input->post('HiddenImage');
       
		if (!empty($_FILES['image_path']['name'])) {
		  $image_path=$this->upload_document($_FILES['image_path']['tmp_name'],$_FILES['image_path']['name']);
		}else{
		  $image_path=$this->input->post('HiddenImage');
		}
		

		$data=array('title'=>$title,
	                'subtitle'=>$subtitle,
	                'description'=>$description,
	                'image_path'=>$image_path,
	                'video_url'=>$video_url,
	               );
		$rsp=$this->Model->update('carousels',['id_arousel'=>$id_arousel],$data);

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
		redirect(base_url('Carousel'));
	}


	function DeleteCarousel(){
		$id_arousel=$this->input->post('id_arousel');
		$rsp=$this->Model->delete('carousels',['id_arousel'=>$id_arousel]);

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
		redirect(base_url('Carousel'));
	}







	  //upload images
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Carousel/';
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
