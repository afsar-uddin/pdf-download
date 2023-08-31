<?php
use Dompdf\Dompdf;
use Dompdf\Options;
 
add_action('admin_init', 'pdf_gen');
function pdf_gen() {
    if (isset($_POST['download-pdf']) && $_POST['download-pdf'] == 1) {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $htmlFilePath = IC_CORE_PATH . 'pdf-content.php';

        ob_start();
        include $htmlFilePath;
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $pdfContent = $dompdf->output();

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="generated_pdf.pdf"');
        header('Content-Length: ' . strlen($pdfContent));

        echo $pdfContent;

        exit;
    }
}
