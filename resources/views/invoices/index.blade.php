<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Invoices</title>

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --light: #f9fafb;
            --gray: #6b7280;
            --dark: #111827;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background-color: #f3f4f6;
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }

        .container { max-width: 1200px; margin: 0 auto; }

        h1 { font-size: 2rem; margin-bottom: 1.5rem; color: var(--dark); }

        .filter-form {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .filter-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .filter-form input,
        .filter-form select {
            width: 100%;
            padding: 0.6rem 0.8rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
        }

        .filter-form input:focus,
        .filter-form select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.2rem;
            align-items: flex-end;
        }

        .filter-row > div { flex: 1; min-width: 180px; }

        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover { background: var(--primary-dark); }

        .btn-create {
            padding: 0.7rem 1.4rem;
            font-size: 1.05rem;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        table { width: 100%; border-collapse: collapse; }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f8fafc;
            font-weight: 600;
            color: #374151;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        tr:hover { background-color: #f9fafb; }

        .status-badge {
            display: inline-block;
            padding: 0.35em 0.75em;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-paid    { background: #d1fae5; color: #065f46; }
        .status-unpaid  { background: #fee2e2; color: #991b1b; }
        .status-partial { background: #fef3c7; color: #92400e; }

        .action-links a {
            margin-right: 0.8rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .action-links a:hover { text-decoration: underline; }

        .delete-btn {
            color: var(--danger);
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }

        .delete-btn:hover { text-decoration: underline; }

        .no-data {
            text-align: center;
            padding: 3rem 1rem;
            color: #6b7280;
            font-size: 1.1rem;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            text-decoration: none;
            color: #374151;
        }

        .pagination .active span {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination a:hover:not(.active) { background: #f3f4f6; }

        @media (max-width: 768px) {
            .filter-row { flex-direction: column; }
            .table-container { overflow-x: auto; }
        }

        /* Optional: hide or de-emphasize Filter button since auto-submit is active */
        .filter-btn-wrapper { opacity: 0.7; font-size: 0.9rem; }
    </style>
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
                        <option value="paid"   {{ request('payment_status') == 'paid'   ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="partial"{{ request('payment_status') == 'partial'? 'selected' : '' }}>Partial</option>
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
                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">
                                No invoices found.<br>
                                <a href="{{ route('invoices.create') }}" style="color: var(--primary);">Create your first invoice →</a>
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

    <script>
        // Better practice: add event listener in JS instead of inline onchange
        // (You can remove the onchange attribute from select if you use this)
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('payment_status');
            const form = document.getElementById('filter-form');

            if (statusSelect && form) {
                statusSelect.addEventListener('change', function() {
                    form.submit();
                });
            }

            // Optional: show loading text on filter button during submit
            form?.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Filtering...';
                }
            });
        });
    </script>

</body>
</html>