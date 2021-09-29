<?php
    require_once 'vendor/autoload.php';

    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            'fonts',
        ]),
        'fontdata' => $fontData + [
            'timesnewroman' => [
                'R' => 'times.ttf',
                'B' => 'timesbd.ttf'
            ]
        ],
        'default_font' => 'timesnewroman',
        'format' => 'A4-L'
    ]);

    $stylesheet = file_get_contents('style.css');
    $html = file_get_contents('index.html');

    $mpdf->SetTitle('Отчет о расходах, источником финансового обеспечения которых является грант');

    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

    $mpdf->Output();
?>