<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *@author:    Dushime Paul
 * Email:     dushimepaul@gmail.com
 * Date :     Le 26/08/2025
 * Github:    https://github.com/pauldushime
*/

class Users extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->not_logged_in();
    }

    // Liste des utilisateurs
    public function index()
    {   
        $sql = "SELECT u.*, r.name 
                FROM users u
                JOIN roles r ON r.Id = u.Id";

        $data['users'] = $this->Model->readQuery($sql);

        $data['roles'] = $this->Model->read('roles');

        $this->load->view('Users_View', $data);
    }

    // Changer le statut d’un utilisateur (actif/inactif)
    public function ChangeStatus()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $new_status = ($status == 1) ? 0 : 1;

        $rsp = $this->Model->update('users', ['id' => $id], ['status' => $new_status]);

        if ($rsp) {
            $sms['sms']='<div class="alert alert-success fade show mt-1 message" role="alert">
                             Statut modifié avec succès.
                         </div>';
        } else {
            $sms['sms']='<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Erreur!</strong> Veuillez contacter l’admin.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Users'));
    }

    // Détail utilisateur
    public function UserDetail($UserDetail)
    {
        $id = explode('_', $UserDetail);
        $data['detail'] = $this->Model->readOne('users', ['id' => $id[0]]);
        $this->load->view('UserDetail_View', $data);
    }

    // Créer un utilisateur
    public function CreateUser()
    {
        $id       = $this->input->post('id');
        $email         = $this->input->post('email');
        $password_hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $first_name    = $this->input->post('first_name');
        $last_name     = $this->input->post('last_name');
        $phone         = $this->input->post('phone');
        $dob           = $this->input->post('date_of_birth');
        $status        = 1;
        $email_verified= 0;
        $created_at    = date("Y-m-d H:i:s");
        $updated_at    = date("Y-m-d H:i:s");

        $profile_photo = null;
        if (!empty($_FILES['profile_photo']['name'])) {
            $profile_photo = $this->upload_document($_FILES['profile_photo']['tmp_name'], $_FILES['profile_photo']['name']);
        }

        $data = array(
            'role_id'        => $id,
            'email'          => $email,
            'password_hash'  => $password_hash,
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'phone'          => $phone,
            'date_of_birth'  => $dob,
            'profile_photo'  => $profile_photo,
            'status'         => $status,
            'email_verified' => $email_verified,
            'created_at'     => $created_at,
            'updated_at'     => $updated_at
        );

        $rsp = $this->Model->create('users', $data);

        if ($rsp) {
            $sms['sms']='<div class="alert alert-success fade show mt-1 message" role="alert">
                             Utilisateur créé avec succès.
                         </div>';
        } else {
            $sms['sms']='<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Erreur!</strong> Impossible de créer l’utilisateur.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Users'));
    }

    // Mettre à jour un utilisateur
    public function UpdateUser()
    {
        $id            = $this->input->post('id');
        $role_id       = $this->input->post('role_id');
        $email         = $this->input->post('email');
        $first_name    = $this->input->post('first_name');
        $last_name     = $this->input->post('last_name');
        $phone         = $this->input->post('phone');
        $dob           = $this->input->post('date_of_birth');
        $updated_at    = date("Y-m-d H:i:s");

        if (!empty($_FILES['profile_photo']['name'])) {
            $profile_photo = $this->upload_document($_FILES['profile_photo']['tmp_name'], $_FILES['profile_photo']['name']);
        } else {
            $profile_photo = $this->input->post('HiddenImage');
        }

        $data = array(
            'role_id'       => $role_id,
            'email'         => $email,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'phone'         => $phone,
            'date_of_birth' => $dob,
            'profile_photo' => $profile_photo,
            'updated_at'    => $updated_at
        );

        // si l’admin veut aussi changer le mot de passe
        if (!empty($this->input->post('password'))) {
            $data['password_hash'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }

        $rsp = $this->Model->update('users', ['id' => $id], $data);

        if ($rsp) {
            $sms['sms']='<div class="alert alert-success fade show mt-1 message" role="alert">
                             Utilisateur mis à jour avec succès.
                         </div>';
        } else {
            $sms['sms']='<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Erreur!</strong> Mise à jour impossible.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Users'));
    }

    // Supprimer un utilisateur
    public function DeleteUser()
    {
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('users', ['id' => $id]);

        if ($rsp) {
            $sms['sms']='<div class="alert alert-success fade show mt-1 message" role="alert">
                             Utilisateur supprimé avec succès.
                         </div>';
        } else {
            $sms['sms']='<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Erreur!</strong> Suppression impossible.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Users'));
    }

    // Upload image de profil
    public function upload_document($nom_file, $nom_champ)
    {
        $ref_folder = FCPATH.'attachments/Users/';
        $code = date("YmdHis").uniqid();
        $fichier = basename($code);
        $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
        $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

        if(!is_dir($ref_folder)) {
            mkdir($ref_folder,0777,TRUE);                                        
        }  

        move_uploaded_file($nom_file, $ref_folder.$fichier.".".$file_extension);
        $image_name = $fichier.".".$file_extension;
        return $image_name;
    }

}
