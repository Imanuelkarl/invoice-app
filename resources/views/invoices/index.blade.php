<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Invoices</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>

    <div class="container">

        <h1>Sales Invoices</h1>

        <!-- Filter Form with auto-submit on status change -->
        <form method="GET" action="{{ route('invoices.index') }}" id="filter-form" class="filter-form">
            <div class="filter-row">
                <div>
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
                </div>
                <div>
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
                <div>
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status"
                        onchange="document.getElementById('filter-form').submit();">
                        <option value="">All</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid
                        </option>
                        <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Partial
                        </option>
                    </select>
                </div>
                <div class="filter-btn-wrapper">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <div style="margin-bottom: 1.5rem;">
            <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-create">+ Create New Invoice</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Invoice #</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>₦{{ number_format($invoice->total_amount, 2) }}</td>
                            <td>
                                <span class="status-badge status-{{ $invoice->payment_status }}">
                                    {{ ucfirst($invoice->payment_status) }}
                                </span>
                            </td>
                            <td>
                                @if ($invoice->file_path)
                                    <a href="{{ Storage::url($invoice->file_path) }}" target="_blank">View</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="action-links">
                                <a href="{{ route('invoices.show', $invoice) }}">View</a>
                                <a href="{{ route('invoices.edit', $invoice) }}">Edit</a>
                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">
                                No invoices found.<br>
                                <a href="{{ route('invoices.create') }}" style="color: var(--primary);">Create your first
                                    invoice →</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $invoices->links() }}
        </div>

    </div>

    <script src="{{ asset('js/index.js') }}"></script>

</body>

</html>