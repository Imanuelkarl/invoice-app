<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice #{{ $invoice->invoice_number }}</title>
    <link rel="stylesheet" href="{{ asset('css/invoices.css') }}">
</head>

<body>

    <div class="container">
        <header>
            <h1>Edit Invoice #{{ $invoice->invoice_number }}</h1>
        </header>

        <main>
            <form method="POST" action="{{ route('invoices.update', $invoice) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" id="invoice_number" name="invoice_number" required
                        value="{{ old('invoice_number', $invoice->invoice_number) }}">
                    @error('invoice_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" required
                        value="{{ old('customer_name', $invoice->customer_name) }}">
                    @error('customer_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="date" id="invoice_date" name="invoice_date" required
                        value="{{ old('invoice_date', $invoice->invoice_date) }}">
                    @error('invoice_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_amount">Total Amount (₦)</label>
                    <input type="number" step="0.01" id="total_amount" name="total_amount" required
                        value="{{ old('total_amount', $invoice->total_amount) }}">
                    @error('total_amount')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status" required>
                        <option value="paid" {{ old('payment_status', $invoice->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ old('payment_status', $invoice->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="partial" {{ old('payment_status', $invoice->payment_status) == 'partial' ? 'selected' : '' }}>Partial</option>
                    </select>
                    @error('payment_status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">Replace File (optional)</label>
                    <input type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="file-preview"></div>

                    <div class="current-file">
                        Current file:
                        @if ($invoice->file_path)
                            <a href="{{ Storage::url($invoice->file_path) }}" target="_blank">
                                {{ basename($invoice->file_path) }}
                            </a>
                        @else
                            None
                        @endif
                    </div>

                    @error('file')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary back-link">← Back to List</a>
                    <button type="submit" class="btn btn-primary">Update Invoice</button>
                </div>
            </form>
        </main>
    </div>

    <script src="{{ asset('js/invoice-edit.js') }}"></script>

</body>

</html>