<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author     Pacy
 * @Date       15/08/2025
 * @email    niyodonpaci@gmail.com
 *
 */

class Home extends My_Controller
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
        $this->load->view('Home_View');
    }

    public function AboutUs(){
        $this->load->view('AboutUs_View');
    }

    public function ContactUs(){
        $this->load->view('ContactUs_View');
    }
}
