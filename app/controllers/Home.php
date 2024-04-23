<?php

class Home
{
    use Controller;

    public function index()
    {
        $this->view('home');
    }

    public function about()
    {
        showPre('Home about page...');
    }
}