<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Invoice</title>
    <link rel="stylesheet" href="{{ asset('css/invoices.css') }}">
</head>
<body>

    <div class="container">
        <header>
            <h1>Create New Invoice</h1>
        </header>

        <main>
            <form method="POST" action="{{ route('invoices.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="invoice_number">Invoice Number</label>
                    <input type="text" id="invoice_number" name="invoice_number" required value="{{ old('invoice_number') }}">
                    @error('invoice_number')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="customer_name">Customer Name</label>
                    <input type="text" id="customer_name" name="customer_name" required value="{{ old('customer_name') }}">
                    @error('customer_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="date" id="invoice_date" name="invoice_date" required value="{{ old('invoice_date') }}">
                    @error('invoice_date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="total_amount">Total Amount (₦)</label>
                    <input type="number" step="0.01" id="total_amount" name="total_amount" required value="{{ old('total_amount') }}">
                    @error('total_amount')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status" required>
                        <option value="paid"   {{ old('payment_status') == 'paid'   ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : (old('payment_status') ? '' : 'selected') }}>Unpaid</option>
                        <option value="partial"{{ old('payment_status') == 'partial'? 'selected' : '' }}>Partial</option>
                    </select>
                    @error('payment_status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="file">Attach File (optional – PDF, image)</label>
                    <input type="file" id="file" name="file" accept=".pdf,.jpg,.jpeg,.png">
                    <div class="file-preview"></div>
                    @error('file')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary back-link">← Back to List</a>
                    <button type="submit" class="btn btn-primary">Save Invoice</button>
                </div>
            </form>
        </main>
    </div>

    <script src="{{ asset('js/invoice-create.js') }}"></script>

</body>
</html>