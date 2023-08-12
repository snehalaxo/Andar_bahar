<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // $post = $this->Post_model->LastPost();
        // $data = [
        //     'title' => 'Homepage',
        //     'keyword' => $post->keyword,
        //     'meta' => $post->meta,
        //     'post' => $post,
        //     'all_post' => $this->Post_model->LatestPost(),
        //     'state' => $this->Post_model->PostState($post->id),
        //     'city' => $this->Post_model->PostCity($post->id),
        //     'post_para' => $this->Post_model->PostPara($post->id)
        // ];
        // website('website/home', $data);
        redirect('/backend');
    }
    
    public function post($id) {
        // $post = $this->Post_model->PostInfo($id);
        // $data = [
        //     'title' => 'Post',
        //     'keyword' => $post->keyword,
        //     'meta' => $post->meta,
        //     'post' => $post,
        //     'all_post' => $this->Post_model->LatestPost(),
        //     'state' => $this->Post_model->PostState($id),
        //     'city' => $this->Post_model->PostCity($id),
        //     'post_para' => $this->Post_model->PostPara($id)
        // ];
        // website('website/home', $data);
    }

}
