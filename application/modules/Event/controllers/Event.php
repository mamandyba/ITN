<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    NIHIMBAZWE EGIDE
 * Email:     nihimbazweegide3@gmail.com
 * Date :     Le 27/08/2025
*/
class Event extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $sql = "SELECT e.*, et.name as type_name 
                FROM events e
                LEFT JOIN event_types et ON e.event_type_id = et.id
                ORDER BY e.id DESC";
        $data['Event'] = $this->Model->readQuery($sql);

        $data['event_types'] = $this->Model->read('event_types', null, 'id');

        $this->load->view('Event_View', $data);
    }

    function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $rsp = $this->Model->update('events', ['id' => $id], ['status' => $status]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Statut mis à jour avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> Une erreur inconnue, contactez l\'admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event'));    
    }

    function EventDetail($eventDetail)
    {
        $idevents = explode('_', $eventDetail);
        $data['events'] = $this->Model->readOne('events', ['id' => $idevents[0]]);
        $this->load->view('EventDetail_View', $data);
    }

    function SaveDetailEvent()
    {
        $id = $this->input->post('id');
        $description = $this->input->post('description');

        $rsp = $this->Model->update('events', ['id' => $id], ['description' => $detail]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Content updated successfully.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> An unknown error, contact admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event'));
    }

    function CreateEvent()
    {
        $event_type_id = $this->input->post('event_type_id');
        $title = $this->input->post('title');
        $slug = $this->input->post('slug');
        $description = $this->input->post('description');
        $content = $this->input->post('content');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $max_participants = $this->input->post('max_participants');
        $registration_required = $this->input->post('registration_required');
        $registration_deadline = $this->input->post('registration_deadline');
        $fees = $this->input->post('fees');

        // upload image uniquement si existe
        $featured_image = null;
        if (!empty($_FILES['featured_image']['name'])) {
            $featured_image = $this->upload_document(
                $_FILES['featured_image']['tmp_name'],
                $_FILES['featured_image']['name']
            );
        }

        $status = $this->input->post('status') ?? 'upcoming';
        $is_featured = $this->input->post('is_featured') ?? 0;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $data = array(
            'event_type_id' => $event_type_id,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location' => $location,
            'max_participants' => $max_participants,
            'registration_required' => $registration_required,
            'registration_deadline' => $registration_deadline,
            'fees' => $fees,
            'featured_image' => $featured_image,
            'status' => $status,
            'is_featured' => $is_featured,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        );

        $rsp = $this->Model->create('events', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Content created successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> An unknown error, contact admin!.
                           </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event'));
    }

    function UpdateEvent()
    {
        $id = $this->input->post('id');
        $event_type_id = $this->input->post('event_type_id');
        $title = $this->input->post('title');
        $slug = $this->input->post('slug');
        $description = $this->input->post('description');
        $content = $this->input->post('content');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $location = $this->input->post('location');
        $max_participants = $this->input->post('max_participants');
        $registration_required = $this->input->post('registration_required');
        $registration_deadline = $this->input->post('registration_deadline');
        $fees = $this->input->post('fees');
        $status = $this->input->post('status') ?? 'upcoming';
        $is_featured = $this->input->post('is_featured') ?? 0;
        $updated_at = date('Y-m-d H:i:s');

      
        if (!empty($_FILES['featured_image']['name'])) {
            $featured_image = $this->upload_document(
                $_FILES['featured_image']['tmp_name'],
                $_FILES['featured_image']['name']
            );
        } else {
            $featured_image = $this->input->post('HiddenImage');
        }

        $data = array(
            'event_type_id' => $event_type_id,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'content' => $content,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'location' => $location,
            'max_participants' => $max_participants,
            'registration_required' => $registration_required,
            'registration_deadline' => $registration_deadline,
            'fees' => $fees,
            'featured_image' => $featured_image,
            'status' => $status,
            'is_featured' => $is_featured,
            'updated_at' => $updated_at,
        );

        $rsp = $this->Model->update('events', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Content updated successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> An unknown error, contact admin!.
                           </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event'));
    }

    function DeleteEvent()
    {
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('events', ['id' => $id]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Content deleted successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> An unknown error, contact admin!.
                           </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Event'));
    }

    // upload images
    public function upload_document($nom_file, $nom_champ)
    {
        $ref_folder = FCPATH . 'attachments/Event/';
        $code = date("YmdHis") . uniqid();
        $fichier = basename($code);
        $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        $valid_ext = array('gif','jpg','png','jpeg','webp');

        if (!in_array($file_extension, $valid_ext)) {
            return null; // extension non valide
        }

        if (!is_dir($ref_folder)) {
            mkdir($ref_folder, 0777, TRUE);                                        
        }

        move_uploaded_file($nom_file, $ref_folder.$fichier.".".$file_extension);
        return $fichier.".".$file_extension;
    }
}
