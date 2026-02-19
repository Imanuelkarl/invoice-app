<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    // List all invoices with filtering
    public function index(Request $request)
    {
        $query = Invoice::query();

        // Filter by date range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('invoice_date', [$request->start_date, $request->end_date]);
        }

        // Filter by payment status
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $invoices = $query->paginate(10);  // Pagination for listing

        return view('invoices.index', compact('invoices'));
    }

    // Show create form
    public function create()
    {
        return view('invoices.create');
    }

    // Store new invoice
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|unique:invoices',
            'customer_name' => 'required',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid,partial',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',  // File validation
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('invoices', 'public');
            $validated['file_path'] = $path;
        }
        echo "Validated Data: " . print_r($validated, true); // Debugging line
        Invoice::create($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    // Show single invoice
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    // Show edit form
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    // Update invoice
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|unique:invoices,invoice_number,' . $invoice->id,
            'customer_name' => 'required',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'payment_status' => 'required|in:paid,unpaid,partial',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($invoice->file_path) {
                Storage::disk('public')->delete($invoice->file_path);
            }
            $path = $request->file('file')->store('invoices', 'public');
            $validated['file_path'] = $path;
        }

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    // Delete invoice
    public function destroy(Invoice $invoice)
    {
        if ($invoice->file_path) {
            Storage::disk('public')->delete($invoice->file_path);
        }
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }
}