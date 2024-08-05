<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\OrderExport;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user')->simplePaginate(5);
        return view("order.kasir.index", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::all();
        return view("order.kasir.create", compact('medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'medicines' => 'required'
        ]);

        $arrayDistinct = array_count_values($request->medicines);

        $arrayAssocMedicines = [];

        foreach ($arrayDistinct as $id => $count) {
            $medicine = Medicine::where('id', $id)->first();
            $subPrice = $medicine['price'] * $count;

            $arrayItem = [
                'id' => $id,
                'name_medicine' => $medicine['name'],
                'qyt' => $count,
                'price' => $medicine['price'],
                'sub_price' => $subPrice
            ];

            array_push($arrayAssocMedicines, $arrayItem);
        }

        $totalPrice = 0;

        foreach($arrayAssocMedicines as $item) {
            $totalPrice += (int)$item['sub_price'];
        }

        $priceWithPPN = $totalPrice + ($totalPrice *0.1);

        $proses = Order::create([
            'user_id' => Auth::user()->id,
            'medicines' => $arrayAssocMedicines,
            'name_customer' => $request->name_customer,
            'total_price' => $priceWithPPN,
            'created_at'
        ]);

        if ($proses) {
            $order = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->first();

            return redirect()->route('kasir.order.print', $order['id']);
        }else {
            return redirect()->back()->with('failed', 'Gagal membuat data pembelian. silahkan coba kembali dengan data yang sesuai!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
        $order = Order::find($id);
        return view('order.kasir.print', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function createPDF() {
        // ambil data yg akan ditampilkan pada pdf, bisa juga dengan where atau eloquent lainnya dan jangan gunakan pagination
        $data = NamaModel::all()->toArray();
        // kirim data yg diambil kepada view yg akan ditampilkan, kirim dengan inisial
        view()->share('inisial',$data);
        // panggil view blade yg akan dicetak pdf serta data yg akan digunakan
        $pdf = PDF::loadView('pdf_view', $data);
        // download PDF file dengan nama tertentu
        return $pdf->download('pdf_file.pdf');
    }

    public function downloadPDF($id) {
        $order = Order::find($id)->toArray();

        view()->share('order', $order);

        $pdf = PDF::loadView('order.kasir.download-pdf',$order);

        //  return $pdf->download('receipt.pdf');
         return $pdf->stream('receipt.pdf');
    }

    public function search(Request $req) {
        $search = $req->input('filter');

        $req->validate([
            'filter' => 'required|date_format:Y-m-d'
        ]);

        $orders = Order::whereDate('created_at', $search)->get();

        return view('order.kasir.index', compact('orders'));
    }

    public function data() {
        $orders = Order::with('user')->simplePaginate(5);
        return view("order.admin.index", compact('orders'));
    }

    public function exportexcel() {
        $file_name =  'data_pembelian'.'.xlsx';

        return Excel::download(new OrderExport, $file_name);
    }
}
