<?php
/**
 *
 */
class Index_Controller extends Controller
{

  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->view->render('base');

  }
}
