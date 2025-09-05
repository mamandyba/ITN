<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    nihimbazwe egide
 * Email:     nihimbazweegide3@gmail.com
 * Date:      Le27/08/2025
*/
class Contact_message extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    
    public function index()
    {
        $data['contact_messages'] = $this->Model->read('contact_messages', null, 'id');
        $this->load->view('Contact_message_View', $data);
    }


    function ChangeStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        
        
        $rsp = $this->Model->update('contact_messages', ['id' => $id], ['status' => $status]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Statut mis à jour avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Contact_message'));    
    }

    function Contact_messageDetail($Contact_messageDetail){
        $id = explode('_', $Contact_messageDetail);
        $data['detail'] = $this->Model->readOne('contact_messages', ['id' => $id[0]]);
        $this->load->view('Contact_messageDetail_View', $data);
    }

    function SaveDetail(){
        $id = $this->input->post('id');
        $reply = $this->input->post('reply'); 
        
        $rsp = $this->Model->update('contact_messages', ['id' => $id], [
            'reply' => $reply,
            'replied_at' => date('Y-m-d H:i:s') 
        ]);
        
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Réponse enregistrée avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Contact_message'));
    }

    function CreateContact_message(){
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $type = $this->input->post('type');
        
        // Valeurs par défaut
        $status = 'new'; // Au lieu de is_active
        $ip_address = $this->input->ip_address();
        $user_agent = $this->input->user_agent();
        $created_at = date('Y-m-d H:i:s');

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'type' => $type,
            'status' => $status,
            'ip_address' => $ip_address,
            'user_agent' => $user_agent,
            'created_at' => $created_at
        );
        
        $rsp = $this->Model->create('contact_messages', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Message envoyé avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur est survenue, veuillez réessayer.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Contact_message'));
    }

    function UpdateContact_message(){ 
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $assigned_to = $this->input->post('assigned_to');
        $updated_at = date('Y-m-d H:i:s');

        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'type' => $type,
            'status' => $status,
            'assigned_to' => $assigned_to,
            'updated_at' => $updated_at
        );
        
        $rsp = $this->Model->update('contact_messages', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Message mis à jour avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Contact_message'));
    }

    function DeleteContact_message(){
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('contact_messages', ['id' => $id]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Message supprimé avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'admin!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Contact_message'));
    }

    // La fonction upload_document peut être conservée si vous voulez permettre l'upload de pièces jointes
    public function upload_document($nom_file, $nom_champ)
    {
        $ref_folder = FCPATH . 'attachments/contact_messages/';
        $code = date("YmdHis") . uniqid();
        $fichier = basename($code);
        $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        $valid_ext = array('gif', 'jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG', 'pdf', 'doc', 'docx');

        if(!is_dir($ref_folder)) {
            mkdir($ref_folder, 0777, TRUE);                                        
        }  
        
        if(in_array($file_extension, $valid_ext)) {
            move_uploaded_file($nom_file, $ref_folder . $fichier . "." . $file_extension);
            return $fichier . "." . $file_extension;
        }
        
        return null;
    }
}