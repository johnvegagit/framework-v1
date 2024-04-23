<?php
class App
{
    use Router;

    public function startApp()
    {
        $this->loadController();
    }

}
