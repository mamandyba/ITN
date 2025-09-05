<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    nihihimbazweegide
 * Email:     nihimbazweegide3@gmail.com
 * Date :     Le 26/08/2025
*/
class Event_type extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    public function index()
    {
        $data['Event_type'] = $this->Model->read('event_types', null, 'id');
        $this->load->view('Event_type_View', $data);
    }

    function Event_typeDetail($event_typesDetail){
        $idevent_types = explode('_', $event_typesDetail);
        $data['event_types'] = $this->Model->readOne('event_types', ['id' => $idevent_types[0]]);
        $this->load->view('Event_typeDetail_View.php', $data);
    }

    function SaveDetailEvent_type(){
        $id = $this->input->post('id');
        $detail = $this->input->post('Description');
        $rsp = $this->Model->update('event_types', ['id' => $id], ['description' => $detail]);
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Content created successfully.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event_type'));
    }

    function CreateEvent_type(){
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $color = $this->input->post('color');
        if (empty($color)) $color = '#007bff'; 
        $created_at = $this->input->post('created_at');

        $data = array(
            'name' => $name,
            'color' => $color,
            'description' => $description,
            'created_at' => $created_at,
        );

        $rsp = $this->Model->create('event_types', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Content created successfully.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event_type'));
    }

    function UpdateEvent_type(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $color = $this->input->post('color');
        if (empty($color)) $color = '#007bff'; // couleur par défaut
        $created_at = $this->input->post('created_at');

        $data = array(
            'name' => $name,
            'description' => $description,
            'color' => $color,
            'created_at' => $created_at,
        );

        $rsp = $this->Model->update('event_types', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Content updated successfully.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event_type'));
    }

    function DeleteEvent_type(){
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('event_types', ['id' => $id]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Content deleted successfully.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event_type'));
    }

    //upload images
    public function upload_document($nom_file, $nom_champ)
    {
        $ref_folder = FCPATH.'attachments/Event_type/';
        $code = date("YmdHis").uniqid();
        $fichier = basename($code);
        $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

        if(!is_dir($ref_folder)) {
            mkdir($ref_folder, 0777, TRUE);                                        
        }  
        move_uploaded_file($nom_file, $ref_folder.$fichier.".".$file_extension);
        $image_name = $fichier.".".$file_extension;
        return $image_name;
    }
}
