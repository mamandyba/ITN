<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *@author:    niyodon paci
 * Email:     niyodonpaci@gmail.com
 * Date :     Le 26/08/2025
 * Gitgub:    https://github.com/niyodon3564
*/
class Model extends CI_Model{


    function create($table, $data) {
        $query = $this->db->insert($table, $data);
        return ($query) ? true : false;
    }

    function read($table, $criteres = array(), $order_by_column = null, $order = 'DESC') {
          // Check if $criteres is specified and not null, and only then add the WHERE clause
        if ($criteres !== null) {
            $this->db->where($criteres);
        }
        // Check if $order_by_column is specified, and only then set the order_by clause
        if ($order_by_column !== null) {
            $this->db->order_by($order_by_column, $order);
        }

      $query = $this->db->get($table);
      return $query->result_array();
    }

    function readWhereIdIn($table, $ids = array()) {
        $this->db->where('isDeleted !=', 1);
        $this->db->where('isApproved !=', 0);
        $this->db->where_in('idAccount', $ids);
        $query = $this->db->get($table);
        return $query->result_array();
    }



    function update($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }


    function updateWhereIdIn($table, $ids = array()) {
    // $this->db->where('isDeleted !=', 1);
    date_default_timezone_set('Africa/Bujumbura');
    $date=date('Y-m-d:H:i:s');
    $this->db->where_in('idAccount', $ids);
    $query = $this->db->get($table);
    $result = $query->result_array();

    // Update isApproved to 0 for matching IDs
    $matchedIds = array_column($result, 'idAccount');
    $updateIds = array_intersect($ids, $matchedIds);

    if (!empty($updateIds)) {
        $this->db->where_in('idAccount', $updateIds);
        $this->db->update($table, array('isTreated' => 1,'dateTreated'=>$date));
    }

    return $result;
}



    function updateReturnAffectedRow($table, $criteres, $data) {
        $this->db->where($criteres);
        $this->db->update($table, $data);
        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            $query = $this->db->get_where($table, $criteres);
            return $query->row_array();
        } else {
            return null;
        }
    }

    // loging with the specific permission
    public function getUserGroupByUserId($idUser){
      $sql = "SELECT * FROM user_group 
      INNER JOIN groups ON groups.idGroup = user_group.idGroup 
      WHERE user_group.idUser = ?";
      $query = $this->db->query($sql, array($idUser));
      $result = $query->row_array();

      return $result;
     }

    public function login($username, $password) {
        if($username && $password) {
          $sql = "SELECT * FROM user_group WHERE username = ?";
          $query = $this->db->query($sql, array($username));

          if($query->num_rows() == 1) {
            $result = $query->row_array();

            $hash_password = password_verify($password, $result['password']);
            if($hash_password === true) {
              return $result; 
            }
            else {
              return false;
            }

            
          }
          else {
            return false;
          }
        }
    }

    public function check_email($email){ // it checks if a specific username exist 
      if($email) {
        $sql = 'SELECT * FROM user_group WHERE username = ?';
        $query = $this->db->query($sql, array($email));
        $result = $query->num_rows();
        return ($result == 1) ? true : false;
      }

      return false;
    }
    
    function delete($table,$criteres){
        $this->db->where($criteres);
        $query = $this->db->delete($table);
        return ($query) ? true : false;
    }

    function readOne($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function readQuery($query,$bindings = null){
      if (!is_null($bindings) && !empty($bindings)) {
            $query=$this->db->query($query, $bindings);
        } else {
            $query=$this->db->query($query);
        }

      if ($query) {
         return $query->result_array();
      }
    }

    function readQueryOne($query,$bindings = null){
      
      if (!is_null($bindings) && !empty($bindings)) {
            $query=$this->db->query($query, $bindings);
        } else {
            $query=$this->db->query($query);
        }
      if ($query) {
        return $query->row_array();
      }
    }


    function createLastId($table, $data) {
        $query = $this->db->insert($table, $data);
       if ($query) {
            return $this->db->insert_id();
        }
    }


    public function Set_History($idUser,$action,$description){
        $this->db->insert('logHistory', array(
                    'idUser' => $idUser,
                    'action' => $action,
                    'actionDescription' =>$description ));
    }

    
    
    function createBatch($table,$data){   
      $query=$this->db->insert_batch($table, $data);
      return ($query) ? true : false;
    }

    function readLimit($table,$limit)
    {
     $this->db->limit($limit);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }
 

    function updateBatch($table, $criteres, $data) {
        $this->db->where($criteres);
        $query = $this->db->update_batch($table, $data);
        return ($query) ? true : false;
    }


    function checkValue($table, $criteres) {
        $this->db->where($criteres);
        $query = $this->db->get($table);
        if($query->num_rows() > 0)
        {
           return true ;
        }
        else{
           return false;
       }
    }

    
    public function getValueSettings($key)
    {
        $query = $this->db->query("SELECT value FROM settings WHERE thekey = ? LIMIT 1", [$key]);
        $value = $query->row_array();
        if(!$value) {
            return null;
        }
        return $value['value'];
    }

     public function setValueStore($key, $value)
    {
        $this->db->where('thekey', $key);
        $query = $this->db->get('settings');
        if ($query->num_rows() > 0) {
            $this->db->where('thekey', $key);
            if (!$this->db->update('settings', array('value' => $value))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('settings', array('value' => $value, 'thekey' => $key))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }

    }
    

    public function get_setting($key) {
        $this->db->where('KeyValue', $key);
        $query = $this->db->get('settings');

        if ($query->num_rows() > 0) {
            return $query->row()->Value;
        }

        return null;
    }


     //global query
     public function execute_query($sql){
      // Exécute la requête
        $query = $this->db->query($sql);

        // Vérifie si la requête retourne des résultats
        if ($query->num_rows() > 0) {
            return $query->result(); // Retourne les résultats sous forme d'objet
        } else {
            return []; // Retourne un tableau vide si aucun résultat
        }
    }










    }
 

