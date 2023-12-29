<?php

namespace App\Http\Controllers;

use App\Models\DeliveryStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReportController extends Controller
{
    public function __construct()
    {
        if (Session::get('admin-logged-in') == false && Session::get('vendor-logged-in') == false) {
            $panel = Session::get('admin-logged-in') == true ? "administrator" : "sellers";
            return redirect('/' . $panel . '/login')->with('message', "Please logged in.");
        }
    }

    public function order(Request $request)
    {
        $whereData = array();
        if ($request->has('fromdate') && !empty($request->fromdate)) {
            array_push($whereData, ['orders.created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->fromdate))]);
        }
        if ($request->has('todate') && !empty($request->todate)) {
            array_push($whereData, ['orders.created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->todate))]);
        }
        if ($request->has('orderno') && !empty($request->orderno)) {
            array_push($whereData, ["orders.orderid", "like", "%" . $request->orderno . "%"]);
        }
        if ($request->has('paymentmode') && !empty($request->paymentmode)) {
            array_push($whereData, ["orders.payment_source", "=", ($request->paymentmode == 'cash' ? 'cod' : 'upi')]);
        }
        if ($request->has('paymentstatus') && !empty($request->paymentstatus)) {
            array_push($whereData, ["orders.payment_status", "=", ($request->paymentstatus == 'pending' ? 'pending' : 'captured')]);
        }
        if ($request->has('deliverystatus') && !empty($request->deliverystatus)) {
            array_push($whereData, ["order_details.order_status", "=", $request->deliverystatus]);
        }
        if ($request->has('orderstatus') && !empty($request->orderstatus)) {
            array_push($whereData, ["orders.order_status", "=", $request->orderstatus]);
        }

        $orders = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('orders_extra_charges', function ($joins) {
                $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
                $joins->on('orders_extra_charges.vendor_id', '=', 'order_details.vendor_id');
            })
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('customer_address', 'customer_address.id', '=', 'order_details.shipping_customer_address_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->leftjoin('vendors', 'vendors.id', '=', 'order_details.vendor_id')->leftjoin('product_variant_values', 'product_variant_values.id', '=', 'order_details.product_variant_price_id')
            ->when(Session::get('vendor-logged-in') == true, function ($query) {
                return $query->where('order_details.vendor_id', Session::get('vendor-loggedin-id'));
            })
            ->select('*', 'customers.name AS customerName', 'orders.id AS idoforder', DB::raw('sum(order_details.product_price * order_details.product_qunatity) AS totalOrderPrice'),DB::raw('sum(order_details.gst_on_product_price * order_details.product_qunatity) AS OrderGSTPrice'), 'orders_extra_charges.shipping_charges', 'orders_extra_charges.cod_charges','orders_extra_charges.discount','orders.discount as maiDiscount', 'vendors.store_name AS vendor', 'order_details.order_status AS order_status', 'products.gst_rate')
            ->groupBy('order_details.order_id')->groupBy('order_details.vendor_id')
            ->orderBy('orders.created_at', 'desc')
            ->where($whereData)->get();

        $delivery = DeliveryStatus::all();
        return view('reports.order', ['title' => 'Order Report - Spicebucket', 'delivery' => $delivery, 'orders' => $orders]);
    }

    public function invoice_tax(Request $request)
    {
        return view('reports.invoice_tax', ['title' => 'Invoice Tax Report - Spicebucket']);
    }

    public function get_invoice_tax(Request $request)
    {
        $whereData = array();
        if ($request->has('fromdate') && !empty($request->fromdate)) {
            array_push($whereData, ['orders.created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->fromdate))]);
        }
        if ($request->has('todate') && !empty($request->todate)) {
            array_push($whereData, ['orders.created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->todate))]);
        }
        if ($request->has('orderno') && !empty($request->orderno)) {
            array_push($whereData, ["orders.orderid", "like", "%" . $request->orderno . "%"]);
        }

        $orders = Order::leftjoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->leftjoin('orders_extra_charges', function ($joins) {
                $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
                $joins->on('orders_extra_charges.vendor_id', '=', 'order_details.vendor_id');
            })
            ->leftjoin('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftjoin('customer_address', 'customer_address.id', '=', 'order_details.shipping_customer_address_id')
            ->leftjoin('products', 'products.id', '=', 'order_details.product_id')
            ->leftjoin('vendors', 'vendors.id', '=', 'order_details.vendor_id')
			->leftjoin('product_variant_values', 'product_variant_values.id', '=', 'order_details.product_variant_price_id')
			->leftjoin('pincode_master AS pc1', 'pc1.pincode', '=', 'vendors.shipping_pincode')
			->leftjoin('pincode_master AS pc2', 'pc2.pincode', '=', 'customer_address.pincode')
            ->when(Session::get('vendor-logged-in') == true, function ($query) {
                return $query->where('order_details.vendor_id', Session::get('vendor-loggedin-id'));
            })
            ->select('orders.order_datetime', 'order_details.vendor_order_id', 'order_details.invoice_number', DB::raw('SUM(order_details.product_price * order_details.product_qunatity) AS base_price'), 'orders_extra_charges.discount', 'pc1.statecode AS seller_pincode', 'pc2.statecode AS customer_pincode', DB::raw('SUM(order_details.gst_on_product_price * order_details.product_qunatity) AS gst_price'), DB::raw('SUM(order_details.total_product_price) AS total_price'))
            ->groupBy('order_details.order_id')->groupBy('order_details.vendor_id')
            ->orderBy('orders.created_at', 'desc')
            ->where($whereData)->get();
		$html = "";
		foreach($orders as $order){
			$total_price = ($order->total_price - $order->discount);
			if($total_price <= 0)
				$total_price = 0;
			$html .= "<tr>";
			$html .= "<td><a href=''>View</a></td>";
			$html .= "<td data-sort='" . strtotime($order->order_datetime) . "'>" . date('d/m/Y', strtotime($order->order_datetime)) .  "</td>";
			$html .= "<td>" . $order->invoice_number .  "</td>";
			$html .= "<td>" . $order->vendor_order_id .  "</td>";
			$html .= "<td>" . number_format($order->base_price, 2) .  "</td>";
			$html .= "<td>" . number_format($order->discount, 2) .  "</td>";
			$html .= "<td>" . ($order->seller_pincode != $order->customer_pincode ? number_format($order->gst_price, 2) : 0) .  "</td>";
			$html .= "<td>" . ($order->seller_pincode != $order->customer_pincode ? 0 : number_format(round(($order->gst_price / 2), 2), 2)) .  "</td>";
			$html .= "<td>" . ($order->seller_pincode != $order->customer_pincode ? 0 : number_format(round(($order->gst_price / 2), 2), 2)) .  "</td>";
			$html .= "<td>" . number_format($total_price, 2) .  "</td>";
			$html .= "<td>" . number_format(round(($order->base_price * 0.01), 2), 2) .  "</td>";
			$html .= "<td>" . number_format(round(($order->base_price * 0.01), 2), 2) .  "</td>";
			$html .= "</tr>";
		}
        return response()->json([
			'html' => $html
		], 200);
    }

    public function sale_summary(Request $request)
    {
        $orders = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('orders_extra_charges', 'orders.id', '=', 'orders_extra_charges.order_id')
            ->when(Session::get('vendor-logged-in') == true, function ($query) {
                return $query->where('order_details.vendor_id', Session::get('vendor-loggedin-id'));
            })
            ->select(DB::raw("CONCAT(MONTHNAME(orders.order_datetime), '-', YEAR(orders.order_datetime)) AS order_month"), DB::raw('COUNT(orders.id) AS total_orders'), DB::raw("SUM(order_details.product_price) AS order_amount"), DB::raw("SUM(order_details.gst_on_product_price) AS tax_amount"), DB::raw('SUM(orders_extra_charges.shipping_charges) AS shipping_amount'))->groupBy(DB::raw("MONTH(orders.order_datetime), YEAR(orders.order_datetime)"))->get();
        return view('reports.sale_summary', ['title' => 'Sale Summary Report - Spicebucket', 'orders' => $orders]);
    }
}
