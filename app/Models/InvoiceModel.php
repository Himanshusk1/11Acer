<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'invoice_number',
        'user_id',
        'subscription_id',
        'subscription_name',
        'order_id',
        'customer_name',
        'customer_gstin',
        'customer_email',
        'customer_phone',
        'customer_address',
        'amount_before_tax',
        'tax_rate_percent',
        'cgst_amount',
        'sgst_amount',
        'total_tax',
        'grand_total',
        'pdf_path',
        'data',
    ];
    protected $useTimestamps = true;
}
