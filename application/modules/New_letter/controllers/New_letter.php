<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_letter extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    // Liste des abonnés
    public function index()
    {
        $data['New_letter'] = $this->Model->read('newsletters', null, 'id');
        $this->load->view('New_letter_View', $data);
    }

    // Créer un nouvel abonné
    public function CreateNew_letter()
    {
        $email = $this->input->post('email');
        $categories = $this->input->post('categories'); // ex: ['1','2'] depuis un multiple select
        $categories_json = json_encode($categories);   // transforme en JSON valide


        $data = [
            'email' => $email,
            'categories' => $categories,
            'status' => 'subscribed',
            'subscribed_at' => date('Y-m-d H:i:s')
        ];

        $rsp = $this->Model->create('newsletters', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Newsletter created successfully.
                            </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                            </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('New_letter'));
    }

    // Mettre à jour un abonné
    public function UpdateNew_letter()
    {
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $categories = $this->input->post('categories');

        $data = [
            'email' => $email,
            'categories' => $categories
        ];

        $rsp = $this->Model->update('new_letter', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Newsletter updated successfully.
                            </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                            </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('New_letter'));
    }

    // Supprimer un abonné
    public function DeleteNew_letter()
    {
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('new_letter', ['id' => $id]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Newsletter deleted successfully.
                            </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                            </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('New_letter'));
    }

    // Changer le statut
    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $new_status = $status == 'subscribed' ? 'unsubscribed' : 'subscribed';
        $data = ['status' => $new_status];

        if ($new_status == 'subscribed') {
            $data['subscribed_at'] = date('Y-m-d H:i:s');
            $data['unsubscribed_at'] = null;
        } else {
            $data['unsubscribed_at'] = date('Y-m-d H:i:s');
        }

        $rsp = $this->Model->update('newsletters', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Status updated successfully.
                            </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
                            </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('New_letter'));
    }
}
