<?php

class _404
{
    use Controller;

    public function index()
    {
        $data = ['title' => 'Error 404'];
        $this->header($data);
        $this->view('404');
        $this->footer();
    }

}