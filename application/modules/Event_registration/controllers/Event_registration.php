<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_registration extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $sql = "SELECT er.*, e.title as event_title, u.first_name, u.last_name
                FROM event_registrations er
                LEFT JOIN events e ON e.id = er.event_id
                LEFT JOIN users u ON u.id = er.user_id
                ORDER BY er.registration_date DESC";

        $data['Event_registration'] = $this->Model->readQuery($sql);
        $data['events'] = $this->Model->read('events');
        $data['users'] = $this->Model->read('users');

        $this->load->view('Event_registration_view', $data);
    }
	function ChangeStatus(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        
        
        $rsp = $this->Model->update('event_registrations', ['id' => $id], ['status' => $status]);

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
        redirect(base_url('Event_registration'));    
    }



    function Event_registrationDetail($event_registrationsDetail) {
        $idParts = explode('_', $event_registrationsDetail);
        $id = $idParts[0];

        $data['event_registrations'] = $this->Model->readOne('event_registrations',['id'=>$id]);
        $this->load->view('Event_registrationDetail_View', $data);
    }

    function SaveDetailEvent_registration() {
        $id = $this->input->post('id');
        $detail = $this->input->post('notes');

        $rsp = $this->Model->update('event_registrations',['id'=>$id],['notes'=>$detail]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success">Content updated successfully.</div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger">Oups! Error occurred.</div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Event_registration'));
    }

    function CreateEvent_registration() {
        $data = [
            'event_id'          => $this->input->post('event_id'),
            'user_id'           => $this->input->post('user_id'),
            'registration_date' => $this->input->post('registration_date'),
            'status'            => $this->input->post('status') ?? 'registered',
            'notes'             => $this->input->post('notes') ,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $rsp = $this->Model->create('event_registrations',$data);

        $this->session->set_flashdata([
            'sms' => $rsp ? '<div class="alert alert-success">Content created successfully.</div>'
                          : '<div class="alert alert-danger">Oups! Error occurred.</div>'
        ]);
        redirect(base_url('Event_registration'));
    }

    function UpdateEvent_registration() {
        $id = $this->input->post('id');
        $data = [
            'event_id'          => $this->input->post('event_id'),
            'user_id'           => $this->input->post('user_id'),
            'registration_date' => $this->input->post('registration_date'),
            'status'            => $this->input->post('status')  ?? 'registered',
            'notes'             => $this->input->post('notes'),
            'updated_at'        => date('Y-m-d H:i:s')
        ];

        $rsp = $this->Model->update('event_registrations',['id'=>$id],$data);

        $this->session->set_flashdata([
            'sms' => $rsp ? '<div class="alert alert-success">Content updated successfully.</div>'
                          : '<div class="alert alert-danger">Oups! Error occurred.</div>'
        ]);
        redirect(base_url('Event_registration'));
    }

    function DeleteEvent_registration() {
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('event_registrations',['id'=>$id]);

        $this->session->set_flashdata([
            'sms' => $rsp ? '<div class="alert alert-success">Content deleted successfully.</div>'
                          : '<div class="alert alert-danger">Oups! Error occurred.</div>'
        ]);
        redirect(base_url('Event_registration'));
    }
}
