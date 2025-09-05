<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *@author:    niyodon paci
 * Email:     niyodonpaci@gmail.com
 * Date :     Le 26/08/2025
 * Gitgub:    https://github.com/niyodon3564
*/

class Backend extends My_Controller
{
    /**

     * @method __construct
     */
    public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();
    }


    public function index()
    {
        $this->load->view('Dashboard_View');
    }

    public function AboutUs(){
        $this->load->view('AboutUs_View');
    }

    public function ContactUs(){
        $this->load->view('ContactUs_View');
    }
}
