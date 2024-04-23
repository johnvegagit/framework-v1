<?php

class Home
{
    use Controller;

    public function index()
    {
        $data = ['title' => 'welcome to framework'];
        $this->header($data);
        $this->view('home');
        $this->footer();
    }

    public function about()
    {
        showPre('Home about page...');
    }
}