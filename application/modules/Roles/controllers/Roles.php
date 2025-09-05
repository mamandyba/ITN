<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    niyodon paci
 * Email:     niyodonpaci@gmail.com
 * Date :     Le 26/08/2025
 * GitHub:    https://github.com/niyodon3564
*/
class Roles extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    // 📌 Liste des rôles
    public function index()
    {
        $data['roles'] = $this->Model->read('roles', null, 'id');
        $this->load->view('Roles_View', $data);
    }

    // 📌 Créer un rôle
    function CreateRole(){
        $name         = $this->input->post('name');
        $display_name = $this->input->post('display_name');
        $description  = $this->input->post('description');
        $created_at   = date('Y-m-d H:i:s');

        $data = array(
            'name'         => $name,
            'display_name' => $display_name,
            'description'  => $description,
            'created_at'   => $created_at,
            'updated_at'   => $created_at,
        );

        $rsp = $this->Model->create('roles', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Role created successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> Error creating role.
                           </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Roles'));
    }

    // 📌 Modifier un rôle
    function UpdateRole(){
        $id           = $this->input->post('id');
        $name         = $this->input->post('name');
        $display_name = $this->input->post('display_name');
        $description  = $this->input->post('description');
        $updated_at   = date('Y-m-d H:i:s');

        $data = array(
            'name'         => $name,
            'display_name' => $display_name,
            'description'  => $description,
            'updated_at'   => $updated_at,
        );

        $rsp = $this->Model->update('roles', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Role updated successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> Error updating role.
                           </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Roles'));
    }

    // 📌 Supprimer un rôle
    function DeleteRole(){
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('roles', ['id' => $id]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                Role deleted successfully.
                           </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                                <strong class="text-danger">Oups!</strong> Error deleting role.
                           </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Roles'));
    }

    // 📌 Détail d’un rôle
    function RoleDetail($RoleDetail){
        $id = explode('_', $RoleDetail);
        $data['detail'] = $this->Model->readOne('roles', ['id' => $id[0]]);
        $this->load->view('RoleDetail_View', $data);
    }
}
