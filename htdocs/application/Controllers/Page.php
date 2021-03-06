<?php

namespace App\Controllers;

use Scabbia\Extensions\Helpers\Arrays;
use Scabbia\Extensions\Helpers\Date;
use Scabbia\Extensions\Mime\Mime;
use Scabbia\Extensions\Validation\Validation;
use Scabbia\Extensions\I18n\I18n;
use Scabbia\Extensions\Http\Http;
use Scabbia\Extensions\Session\Session;
use Scabbia\Extensions\Helpers\String;
use Scabbia\Io;
use Scabbia\Request;
use App\Includes\PmController;

/**
 * @ignore
 */
class Page extends PmController
{
    /**
     * @ignore
     */
    public $authOnly = false;

    /**
     * @ignore
     */
    public function __construct()
    {
        parent::__construct();        
    }

    /**
     * @ignore
     */
    public function otherwise()
    {
		$this->load('App\\Models\\PageModel');
        $tPagee = $this->pageModel->getByName($this->route['action'], array('unlisted', 'menu'));
		if ($tPagee === false) {
			return false;
		}
		
		$this->breadcrumbs[$tPagee['title']] = array(null, 'page/' . $tPagee['name']);
		
		$this->set('pagee', $tPagee);
		
		$this->view('page/show.cshtml');
    }

}
