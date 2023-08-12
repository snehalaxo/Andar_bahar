<?php

if (!function_exists('render')) {

    function template($view, $data) {
        $title['title'] = $data['title'];
        $ci = &get_instance();
        $ci->load->view('src/header', $title);
        $ci->load->view('src/nav', $title);
        $ci->load->view('src/sidebar',$data);
        $ci->load->view('src/notification', $title);
        $ci->load->view($view, $data);
        $ci->load->view('src/footer', $data);
    }
    function website($view, $data) {
        $title['title'] = $data['title'];
        $ci = &get_instance();
        $ci->load->view('website/src/header', $data);
        $ci->load->view('website/src/nav', $title);
        $ci->load->view($view, $data);
        $ci->load->view('website/src/footer', $data);
    }
  
}