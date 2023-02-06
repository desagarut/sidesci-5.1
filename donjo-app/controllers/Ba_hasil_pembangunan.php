<?php defined('BASEPATH') || exit('No direct script access allowed');

require_once APPPATH . 'controllers/ba_rencana_pembangunan.php';

class Ba_hasil_pembangunan extends ba_rencana_pembangunan
{
    protected $tipe = 'hasil';

    public function __construct()
    {
        parent::__construct();
        $this->modul_ini     = 300;
        $this->sub_modul_ini = 330;
    }
}
