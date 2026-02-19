<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <link rel="stylesheet" href="{{ asset('css/invoices.css') }}">
</head>
<body>

    <div class="container">
        <header class="detail-header">
            <h1>Invoice Details</h1>
            <p style="margin-top: 0.5rem; opacity: 0.9;">#{{ $invoice->invoice_number }}</p>
        </header>

        <div class="detail-card">
            <div class="detail-body">
                <div class="detail-row">
                    <div class="detail-label">Invoice Number</div>
                    <div class="detail-value">{{ $invoice->invoice_number }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Customer Name</div>
                    <div class="detail-value">{{ $invoice->customer_name }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Invoice Date</div>
                    <div class="detail-value">{{ $invoice->invoice_date }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Total Amount</div>
                    <div class="detail-value">
                        ₦{{ number_format($invoice->total_amount, 2) }}
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Payment Status</div>
                    <div class="detail-value">
                        <span class="status-display status-{{ $invoice->payment_status }}">
                            {{ ucfirst($invoice->payment_status) }}
                        </span>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Attached File</div>
                    <div class="detail-value">
                        @if ($invoice->file_path)
                            <a href="{{ Storage::url($invoice->file_path) }}" target="_blank" class="file-link">
                                View / Download File → ({{ basename($invoice->file_path) }})
                            </a>
                        @else
                            No file attached
                        @endif
                    </div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('invoices.index') }}" class="btn btn-secondary">← Back to List</a>
                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-primary">Edit Invoice</a>
            </div>
        </div>
    </div>

</body>
</html>