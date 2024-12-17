<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\FilmModel;
use App\Models\SerieModel;

class HomeController extends Controller {
    private $filmModel;
    private $serieModel;

    public function __construct() {
        $this->filmModel = new FilmModel();
        $this->serieModel = new SerieModel();
    }

    public function index() {
        $films = $this->filmModel->getRecent();
        $series = $this->serieModel->getRecent();
        
        return $this->view('home/index', [
            'films' => $films,
            'series' => $series
        ]);
    }
} 