<?php

namespace App\Services;

use TCPDF;

class PdfService
{
    protected TCPDF $pdf;

    public function __construct()
    {
        // إنشاء كائن TCPDF مع إعدادات افتراضية
        $this->pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            PDF_PAGE_FORMAT,
            true,              // Unicode
            'UTF-8',           // Encoding
            false              // Disk cache
        );

        // إعدادات الوثيقة
        $this->pdf->SetCreator(config('app.name'));
        $this->pdf->SetAuthor(config('app.name'));
        $this->pdf->SetTitle('');
        $this->pdf->SetSubject('');
        $this->pdf->SetKeywords('');

        // هوامش
        $this->pdf->SetMargins(15, 27, 15);
        $this->pdf->SetHeaderMargin(5);
        $this->pdf->SetFooterMargin(10);

        // إيقاف طباعة الرأس والتذييل الافتراضي
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);

        // الخط الافتراضي (يدعم العربية)
        $this->pdf->SetFont('dejavusans', '', 12);
    }

    /**
     * يولّد PDF من HTML ويرجعه كرد HTTP للعرض في المتصفح
     *
     * @param string $html محتوى HTML
     * @param string $filename اسم الملف الناتج
     * @return \Illuminate\Http\Response
     */
    public function outputHtml(string $html, string $filename = 'document.pdf')
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html, true, false, true, false, '');

        // إخراج محتوى PDF كسلسلة وحزمته في استجابة
        $pdfContent = $this->pdf->Output($filename, 'S');

        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "inline; filename=\"{$filename}\"");
    }

    /**
     * ينشئ PDF من HTML ويخزنه في مسار محدد على الخادم
     *
     * @param string $html محتوى HTML
     * @param string $path مسار الحفظ داخل storage/app (مثل 'pdfs/file.pdf')
     */
    public function saveHtml(string $html, string $path): void
    {
        $this->pdf->AddPage();
        $this->pdf->writeHTML($html, true, false, true, false, '');
        $this->pdf->Output(storage_path("app/{$path}"), 'F');
    }
}
