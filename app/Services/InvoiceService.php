<?php

namespace App\Services;

use App\Models\InvoiceModel;
use Mpdf\Mpdf;

class InvoiceService
{
    private const SELLER_NAME = '36 Broking Hub';
    private const SELLER_GSTIN = '23GKXPS6431Q1ZZ';
    private const SELLER_CONTACT = '9131747400';
    private const SELLER_ADDRESS = '255, New Jiwaji Nagar, Thatipur, Gwalior, MP – 474011';

    private InvoiceModel $invoiceModel;

    public function __construct(InvoiceModel $invoiceModel)
    {
        $this->invoiceModel = $invoiceModel;
    }

    public function generate(array $context): array
    {
        $invoiceNumber = $context['invoice_number'] ?? $this->buildInvoiceNumber();
        $amountBeforeTax = round((float) ($context['amount_before_tax'] ?? 0), 2);
        $taxRate = (float) ($context['tax_rate_percent'] ?? 18.0);
        $cgst = round($amountBeforeTax * ($taxRate / 100) / 2, 2);
        $sgst = $cgst;
        $totalTax = round($cgst + $sgst, 2);
        $grandTotal = round($amountBeforeTax + $totalTax, 2);

        $customer = $context['customer'] ?? [];
        $items = $context['items'] ?? [];
        if (empty($items)) {
            $items[] = [
                'description' => $context['subscription_name'] ?? 'Subscription',
                'qty' => 1,
                'rate' => $amountBeforeTax,
                'hsn' => '9983',
            ];
        }

        $html = $this->buildHtml([
            'invoice_number' => $invoiceNumber,
            'invoice_date' => $context['invoice_date'] ?? date('d-m-Y'),
            'order_id' => $context['order_id'] ?? null,
            'customer' => $customer,
            'items' => $items,
            'amount_before_tax' => $amountBeforeTax,
            'cgst' => $cgst,
            'sgst' => $sgst,
            'total_tax' => $totalTax,
            'grand_total' => $grandTotal,
            'tax_rate' => $taxRate,
        ]);

        $pdfPath = $this->buildPdf($invoiceNumber, $html);
        $relativePath = 'writable/invoices/' . basename($pdfPath);

        $recordId = $this->invoiceModel->insert([
            'invoice_number' => $invoiceNumber,
            'user_id' => $context['user_id'],
            'subscription_id' => $context['subscription_id'],
            'subscription_name' => $context['subscription_name'] ?? '',
            'order_id' => $context['order_id'] ?? null,
            'customer_name' => $customer['name'] ?? ($context['customer_name'] ?? 'Unnamed Customer'),
            'customer_gstin' => $customer['gstin'] ?? ($context['customer_gstin'] ?? null),
            'customer_email' => $customer['email'] ?? ($context['customer_email'] ?? null),
            'customer_phone' => $customer['phone'] ?? ($context['customer_phone'] ?? null),
            'customer_address' => $customer['address'] ?? ($context['customer_address'] ?? null),
            'amount_before_tax' => $amountBeforeTax,
            'tax_rate_percent' => $taxRate,
            'cgst_amount' => $cgst,
            'sgst_amount' => $sgst,
            'total_tax' => $totalTax,
            'grand_total' => $grandTotal,
            'pdf_path' => $relativePath,
            'data' => $this->encodeData(array_merge($context, ['items' => $items, 'customer' => $customer])),
        ]);

        $invoice = $this->invoiceModel->find($recordId);

        return [
            'invoice' => $invoice,
            'pdf_path' => $relativePath,
            'grand_total' => $grandTotal,
        ];
    }

    private function buildInvoiceNumber(): string
    {
        $date = date('Ymd');
        $builder = $this->invoiceModel->builder();
        $prefix = sprintf('36BH-%s', $date);
        $builder->like('invoice_number', $prefix, 'after');
        $existing = $builder->countAllResults(false);
        $sequence = $existing + 1;

        return sprintf('36BH-%s-%04d', $date, $sequence);
    }

    private function buildPdf(string $invoiceNumber, string $html): string
    {
        $directory = WRITEPATH . 'invoices';
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $sanitizedNumber = preg_replace('/[^a-zA-Z0-9_-]/', '', $invoiceNumber);
        $fileName = sprintf('invoice-%s.pdf', strtolower($sanitizedNumber));
        $fullPath = $directory . DIRECTORY_SEPARATOR . $fileName;

        $mpdf = new Mpdf([
            'tempDir' => $directory,
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 15,
            'margin_bottom' => 15,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->Output($fullPath, \Mpdf\Output\Destination::FILE);

        return $fullPath;
    }

    private function buildHtml(array $data): string
    {
        $itemsHtml = '';
        foreach ($data['items'] as $item) {
            $description = htmlspecialchars($item['description'] ?? 'Subscription');
            $hsn = htmlspecialchars($item['hsn'] ?? '9983');
            $qty = (int) ($item['qty'] ?? 1);
            $rate = number_format((float) ($item['rate'] ?? 0), 2);
            $amount = number_format((float) ($item['amount'] ?? $item['rate'] ?? 0), 2);
            $itemsHtml .= "<tr><td>{$description}</td><td>{$hsn}</td><td class='text-center'>{$qty}</td><td class='text-right'>₹ {$rate}</td><td class='text-right'>₹ {$amount}</td></tr>";
        }

        $customer = $data['customer'];
        $customerName = htmlspecialchars($customer['name'] ?? 'Retail Customer');
        $customerGstin = htmlspecialchars($customer['gstin'] ?? 'URP');
        $customerAddress = nl2br(htmlspecialchars($customer['address'] ?? ''));
        $invoiceDate = htmlspecialchars($data['invoice_date']);
        $orderId = $data['order_id'] ? htmlspecialchars($data['order_id']) : 'N/A';
        $sellerName = htmlspecialchars(self::SELLER_NAME);
        $sellerGstin = htmlspecialchars(self::SELLER_GSTIN);
        $sellerAddress = nl2br(htmlspecialchars(self::SELLER_ADDRESS));
        $sellerContact = htmlspecialchars(self::SELLER_CONTACT);
        $taxRateHalf = number_format(($data['tax_rate'] / 2), 2);
        $taxableValue = number_format($data['amount_before_tax'], 2);
        $cgstValue = number_format($data['cgst'], 2);
        $sgstValue = number_format($data['sgst'], 2);
        $grandTotal = number_format($data['grand_total'], 2);

        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #222; }
        .header { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .seller, .invoice-meta { font-size: 12px; }
        h1 { margin: 0; font-size: 24px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table thead th { border-bottom: 2px solid #222; padding-bottom: 8px; text-align: left; }
        table tbody td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .summary { margin-top: 20px; display: flex; justify-content: flex-end; }
        .summary table { width: 280px; }
        .summary td { padding: 4px 0; }
        .total-row { font-weight: 700; font-size: 16px; }
        .details { margin-top: 30px; font-size: 12px; }
        .details span { display: inline-block; margin-right: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="seller">
            <strong style="font-size: 18px;">{$sellerName}</strong><br>
            GSTIN: {$sellerGstin}<br>
            {$sellerAddress}<br>
            Contact: {$sellerContact}
        </div>
        <div class="invoice-meta">
            <h1>Tax Invoice</h1>
            <div>Invoice No: <strong>{$data['invoice_number']}</strong></div>
            <div>Invoice Date: <strong>{$invoiceDate}</strong></div>
            <div>Order Ref: <strong>{$orderId}</strong></div>
        </div>
    </div>

    <div class="details">
        <span><strong>Billed To:</strong> {$customerName}</span>
        <span>GSTIN: {$customerGstin}</span>
        <div>{$customerAddress}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>HSN/SAC</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Rate (INR)</th>
                <th class="text-right">Amount (INR)</th>
            </tr>
        </thead>
        <tbody>
            {$itemsHtml}
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr><td>Taxable Value</td><td class="text-right">₹ {$taxableValue}</td></tr>
            <tr><td>CGST ({$taxRateHalf}%)</td><td class="text-right">₹ {$cgstValue}</td></tr>
            <tr><td>SGST ({$taxRateHalf}%)</td><td class="text-right">₹ {$sgstValue}</td></tr>
            <tr class="total-row"><td>Grand Total</td><td class="text-right">₹ {$grandTotal}</td></tr>
        </table>
    </div>

    <div class="details" style="margin-top: 40px;">
        <div>Signature: ___________________________</div>
        <div style="margin-top: 10px;">This is a system generated invoice and does not require a physical signature.</div>
    </div>
</body>
</html>
HTML;
    }

    private function encodeData(array $data): ?string
    {
        $encoded = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return $encoded === false ? null : $encoded;
    }
}
