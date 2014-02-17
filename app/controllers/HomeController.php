<?php

class HomeController extends BaseController {

    public function showHomePage() {
        $this->layout->content = View::make('Home/home');
    }

}
