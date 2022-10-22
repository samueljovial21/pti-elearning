<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Muhanz
 * @license			MIT License
 * @link			https://github.com/hanzzame/ci3-pdf-generator-library
 *
 */

include_once APPPATH.'/third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdf
{
	public function create($html)
    {
	    $dompdf = new Dompdf();
	    $dompdf->loadHtml($html);
	    $dompdf->set_paper('a3','landscape');
	    $dompdf->render();
	    $output = $dompdf->output();
        return $output;
  }
}