<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DeliveryStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\InvoiceNumber;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Traits\CommonTrait;
use PDF;
class OrderController extends Controller
{
     use CommonTrait;

    function vendor_orders(Request $request)
    {
        $whereData = array();
        if ($request->has('fromdate') && !empty($request->fromdate)) {
            array_push($whereData, ['orders.created_at', '>=', date('Y-m-d 00:00:00', strtotime($request->fromdate))]);
        }
        if ($request->has('todate') && !empty($request->todate)) {
            array_push($whereData, ['orders.created_at', '<=', date('Y-m-d 23:59:59', strtotime($request->todate))]);
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
            ->groupBy('order_details.vendor_id')->groupBy('order_details.order_id')
            ->orderBy('orders.created_at', 'desc')
            ->where($whereData)->get();
        return view('orders.orderlist', ['title' => 'Orders - Spicebucket Administrator', 'orders' => $orders]);
    }
    function order_view($id, $vendorid)
    {
		
        $ordersviews = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('orders_extra_charges', function ($joins) {
                $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
                $joins->on('orders_extra_charges.vendor_id', '=', 'order_details.vendor_id');
            })
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->leftjoin('vendors', 'vendors.id', '=', 'order_details.vendor_id')
            ->leftjoin('product_variant_values', 'product_variant_values.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $id)
            ->where('order_details.vendor_id', $vendorid)
            ->select('*', 'products.gst_rate AS productgstrate', 'products.name AS productname', 'customers.name AS customerName', 'orders.id AS idoforder', 'orders_extra_charges.cod_charges AS codAmount', 'customers.emailid AS customerEmail', 'customers.phone AS customerPhone', 'customers.created_at AS createdDate', DB::raw('order_details.total_product_price AS totalOrderPrice'), 'csa.emailid AS csaEmail', 'cba.emailid AS cbaEmail', DB::raw('CONCAT(cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), cba.city, ", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'),  DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"), DB::raw('CONCAT(csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), csa.city,", ",  csa.state,", ",  csa.country,", ",  csa.pincode) as shippingAddress'), DB::raw('order_details.gst_on_product_price AS OrderGSTPrice'), 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders_extra_charges.shipping_charges','order_details.order_status as orderStatus', 'orders_extra_charges.cod_charges', 'orders_extra_charges.discount as discountVendorWise', 'vendors.store_name AS vendor', 'order_details.order_status AS order_status')->orderby('order_details.vendor_id')->get();
        $delivery = DeliveryStatus::all();
        $service = ServiceType::all();
        //dd($ordersviews);
        return view('orders.orderview', ['title' => 'Orders - Spicebucket Administrator', 'orderview' => $ordersviews, 'delivery' => $delivery, 'service' => $service]);
    }
    function downloadInvoice($orderid){
         $vendor_id = Session::get('vendor-loggedin-id');
         if(!empty($vendor_id)){

            $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('pincode_master', 'pincode_master.pincode', '=', 'vendors.shipping_pincode')
            ->leftjoin('orders_extra_charges', function ($joins) {
                $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
                $joins->on('orders_extra_charges.vendor_id', '=', 'vendors.id');
            })
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $orderid)->where('order_details.vendor_id',$vendor_id)->select('*', 'orders.orderid AS orderID', DB::raw('CONCAT("<strong>", cba.firstname, " ", cba.lastname, "</strong><br />", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), ",", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT("<strong>", csa.firstname, " ", csa.lastname, "</strong><br />", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), ",", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode) as shippingAddress'), 'products.name AS productName', 'products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'order_details.gst_on_product_price AS perproductgst', 'order_details.product_price AS productprice', 'orders.discount AS cartDiscount', 'orders.delivery_fee AS cartDeliveryCharge', 'orders.cod_charges AS codOnCart', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders_extra_charges.shipping_charges AS vendorDeliveryFee', 'orders_extra_charges.cod_charges AS vendorCodCharges', 'orders_extra_charges.discount AS vendorDiscount', 'vendors.store_name AS storeName', 'vendors.address AS storeaddress', 'vendors.gst AS storeGST', 'pincode_master.statecode AS storeStateCode', 'pincode_master.gstcode', 'pincode_master.city AS storeCity', 'order_details.invoice_number AS invoiceNumber','order_details.vendor_order_id AS VendorOrderNumber', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();
             

            $vendorWiseDetail = array();
            $orderID = $orderDateTime = $paymentSource = '';
            $codOnCart = $cartDiscount = 0;
            foreach ($orderDetails as $orderDetail) {
                if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                    $vendorWiseDetail[$orderDetail->vendor_id] = array('paymentSource' => $orderDetail->payment_source, 'discount' => $orderDetail->vendorDiscount, 'cod_charges' => $orderDetail->vendorCodCharges, 'shippingFee' => $orderDetail->vendorDeliveryFee, 'invoiceNumber' => $orderDetail->invoiceNumber, 'VendorOrderNumber' => $orderDetail->VendorOrderNumber, 'storeCity' => $orderDetail->storeCity, 'storeStateCode' => $orderDetail->storeStateCode, 'vendor_gst' => $orderDetail->storeGST,'gstcode'=>$orderDetail['gstcode'], 'vendor_alias' => $orderDetail->vendor_alias, 'store_name' => $orderDetail->storeName, 'store_address' => $orderDetail->storeaddress, 'orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => 'niraj4u2@gmail.com', 'products' => array());
                    $orderID = $orderDetail->orderID;
                    $orderDateTime = $orderDetail->order_datetime;
                    $cartDiscount = $orderDetail->cartDiscount;
                    $codOnCart = $orderDetail->codOnCart;
                    $paymentSource = $orderDetail->paymentSource;
                }


                array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'shippingCharge' => $orderDetail['vendorDeliveryFee'], 'perproductgst' => $orderDetail['perproductgst'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee'], 'gst_rate' => $orderDetail['gst_rate'], 'store_name' => $orderDetail['store_name']));
            }
             



            foreach ($vendorWiseDetail as $vendorDetail) {
                 
                $pdf =   PDF::loadView('invoices.VendorPDF', array('vendorDetail' => $vendorDetail, 'orderDetail' => $orderDetails)) ;
            }

            // download here pdf (not save into serve)
            $pdfname = $orderDetail->invoiceNumber.'.pdf';
            return $pdf->download($pdfname);

         }else{
            die('Something is wrong');
         }

         

    }
    function generateReferenceNumber(Request $request)
    {
		if(Session::get('vendor-logged-in') != true) {
			return response()->json(['status' => false, 'message' => 'Please login with vendor.'], 200);
		}
        $custmercode = $request->customercode;
        $serviceType = $request->serviceType;
        $agency = $request->agency;
        $loadType = $request->loadType;
        $orderID = $request->orderID;
        $length = $request->length;
        $width = $request->width;
        $height = $request->height;
        $weight = $request->weight;

        $orderDetails = OrderDetail::join('orders', 'orders.id', '=', 'order_details.order_id')->leftjoin('orders_extra_charges', function ($joins) {
            $joins->on('orders_extra_charges.order_id', '=', 'orders.id');
            $joins->on('orders_extra_charges.vendor_id', '=', 'order_details.vendor_id');
        })->leftjoin('vendors', 'vendors.id', '=', 'order_details.vendor_id')->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')->leftjoin('products', 'products.id', '=', 'order_details.product_id')->where('orders.id', $orderID)->where('order_details.vendor_id', Session::get('vendor-loggedin-id'))->selectRaw('*, orders_extra_charges.cod_charges as cod, order_details.product_qunatity as declaredQuantity, products.name as productName, vendors.address AS vendorAddress, vendors.phone AS vendorsPhone, csa.address_line_1 AS customerAddress1, csa.address_line_2 AS customerAddress2, csa.firstname AS customerFirstName, csa.lastname AS customerLastName, csa.phonenumber AS customerPhone,csa.pincode AS customerPincode,csa.city AS customerCity,csa.state AS customerState')->first();
        if ($orderDetails == null) {
            return response()->json(['status' => false, 'message' => 'Order ID not available.'], 200);
        }

        $consignments = array(
            "consignments" => array(
                array(
                    "customer_code" => $custmercode,
                    "service_type_id" => $serviceType,
                    "load_type" => $loadType,
                    "cod_amount" => ($orderDetails->payment_source == 'cod' ? $orderDetails->total_amount : ''),
                    "cod_favor_of" => "",
                    "cod_collection_mode" => ($orderDetails->payment_source == 'cod' ? "CASH" : ''),
                    "description" => "",
                    "dimension_unit" => "cm",
                    "length" => $length,
                    "width" => $width,
                    "height" => $height,
                    "weight_unit" => "kg",
                    "weight" => $weight,
                    "declared_value" => $orderDetails->declaredQuantity,
                    "eway_bill" => "",
                    "invoice_number" => "",
                    "invoice_date" => "",
                    "commodity_name" => $orderDetails->productName,
                    "consignment_type" => "",
                    "origin_details" => array(
                        "name" => $orderDetails->store_name,
                        "phone" => $orderDetails->vendorsPhone,
                        "alternate_phone" => "",
                        "address_line_1" => $orderDetails->vendorAddress,
                        "address_line_2" => "",
                        "pincode" => $orderDetails->shipping_pincode,
                        "city" => "",
                        "state" => ""
                    ),
                    "destination_details" => array(
                        "name" => $orderDetails->customerFirstName . ' ' . $orderDetails->customerLastName,
                        "phone" => $orderDetails->customerPhone,
                        "alternate_phone" => "",
                        "address_line_1" => $orderDetails->customerAddress1 . ", " . $orderDetails->customerAddress2,
                        "address_line_2" => "",
                        "pincode" => $orderDetails->customerPincode,
                        "city" => $orderDetails->customerCity,
                        "state" => $orderDetails->customerState
                    )
                )
            )
        );
        $postfields = json_encode($consignments);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dtdcapi.shipsy.io/api/customer/integration/consignment/softdata',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'api-key: ' . env('DTDCAPIKEY'),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postfields
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if ($response == false) {
            return response()->json(['status' => false, 'message' => 'Some issue with DTDC right now, Please try again later.'], 200);
        }
        $dtdcdetails = json_decode($response, true);
        if (array_key_exists('data', $dtdcdetails) && array_key_exists('success', $dtdcdetails['data'][0]) && $dtdcdetails['data'][0]['success'] == true) {
            $reference_number = $dtdcdetails['data'][0]['reference_number'];
            $postfields = json_encode(array('reference_number' => $reference_number));
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://dtdcapi.shipsy.io/api/customer/integration/consignment/label/multipiece',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_HTTPHEADER => array(
                    'api-key: ' . env('DTDCAPIKEY'),
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($postfields)
                )
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            if ($response == false) {
                return response()->json(['status' => false, 'message' => 'Some issue with DTDC right now, Please try again later.'], 200);
            }
            $shippingDetail = json_decode($response, true);
            $bin = base64_decode($shippingDetail['data'][0]['label'], true);
            if (strpos($bin, '%PDF') !== 0) {
                return response()->json(['status' => false, 'message' => 'Missing the PDF file signature in the label'], 200);
            }
            $filepath = '/orders-label/' . $reference_number . ".pdf";
            file_put_contents(public_path($filepath), $bin);
            OrderDetail::where('order_id', $orderID)->update(['shipping_label' => $filepath, 'shipping_reference_no' => $reference_number, 'shipping_length' => $length, 'shipping_width' => $width, 'shipping_height' => $height, 'shipping_weight' => $weight, 'shipping_agency' => $agency, 'shipping_service' => $serviceType, 'shipping_carrier_name' => strtoupper($agency), 'shipping_tracking_no' => $reference_number, 'shipping_date' => date('Y-m-d H:i:s'), 'shipping_tracking_url' => 'http://www.dtdc.in/tracking/shipment-tracking.asp']);
            return response()->json(['status' => true, 'message' => "Airway Bill generated.", 'pathfile' => (env('APP_ENV') == "production" ? url('/public' . $filepath) : url($filepath)), 'courier_partner' => $agency, 'courier_partner_reference_number' => $reference_number, 'shpping_tracking_url' => 'http://www.dtdc.in/tracking/shipment-tracking.asp'], 200);
        } else {
            return response()->json(['status' => false, 'message' => json_encode($dtdcdetails), 'consignments' => json_encode($consignments)], 200);
        }
    }

    function cancelledReferenceNumber(Request $request)
    {
        $curl = curl_init();
        $awbno=[$request->awbno];
        $postfields = json_encode(array("AWBNo" =>$awbno, "customerCode" => env('DTDCCLIENTCODE', '')));
         

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://dtdcapi.shipsy.io/api/customer/integration/consignment/cancel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                'api-key: ' . env('DTDCAPIKEY', ''),
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postfields)
            )
        ));

        $response = curl_exec($curl);
         
        curl_close($curl);
        if ($response == false) {
            return response()->json(['status' => false, 'message' => 'Some issue with DTDC right now, Please try again later.'], 200);
        }
        $responseDTDC = json_decode($response);
        if($responseDTDC->success==true) {
            if(File::exists(public_path("/orders-label/" . $request->awbno . ".pdf"))){
                File::delete(public_path("/orders-label/" . $request->awbno . ".pdf"));
            }
            OrderDetail::where('order_id', $request->order_id)->update(['shipping_label' => '', 'shipping_reference_no' => '', 'shipping_length' => '', 'shipping_width' => '', 'shipping_height' => '', 'shipping_weight' => '', 'shipping_agency' => '', 'shipping_service' => '', 'shipping_carrier_name' => '', 'shipping_tracking_no' => '', 'shipping_date' => '', 'shipping_tracking_url' => '']);
            return response()->json(['status' => true, 'message' => "Airway Bill cancelled.", "dtdc-response" => $response], 200);
        }else{ 
            return response()->json(['status' => false, 'message' => $responseDTDC->failures[0]], 200);
        }
    }
    function VendorInvoiceGenerate($order_id,$vendor_id){

        // get here current inovice serial no 
        $inovice_id = 1;
        $nextTransactionId = InvoiceNumber::orderBy('id','desc')->first() ;
        if(!empty($nextTransactionId)){
            $inovice_id = $nextTransactionId->id +1;
        } 
        $nextTransactionId =new InvoiceNumber();
         //get here financial year     
        if ( date('m') > 3 ) {
            $Fyear = date('Y') . (date('y') + 1);
        }
        else {
            $Fyear =(date('Y') - 1). date('y');
        } 
        // get here vendor code 
        $vendor_code = $this->vendorNickNameForder($vendor_id);
        $GenerateInvoice =  str_pad($inovice_id , 7, "0", STR_PAD_LEFT). "-" .$Fyear  ;
        $Invoice = $vendor_code."-".$GenerateInvoice;
        $order_update = OrderDetail::where('order_id', $order_id)->where('vendor_id', $vendor_id)->whereRaw('(invoice_number = "" OR invoice_number IS NULL)')->update(['invoice_number' =>$Invoice]);
        $nextTransactionId->order_id = $order_id;
        $nextTransactionId->save();
 
        return $order_update;

    }

    function update_order(Request $request)
    {
        $this->validate($request, [
            'orderID' => 'required|numeric'
        ]);
        $orderid = $request->orderID;
        $vendor_id = Session::get('vendor-loggedin-id');
        $paymentstatus = $request->paymentstatus;
        $deliverystatus = $request->deliverystatus;
        $notifyemail = $request->notifyemail;
        $notifysms = $request->notifysms;
        $dispatchdate = $request->dispatchdate;
        $deliverydate = $request->deliverydate;
        $remarks = $request->remarks;

        $order = Order::findorFail($orderid);
        $paststatus = $order->order_status;
        $order->payment_status = $paymentstatus;
        $order->tentative_dispatch_date = $dispatchdate;
        $order->tentative_delivery_date = $deliverydate;
        $order->admin_remarks = $remarks;
        $order->save();
        $data = $request->except('_method','_token','submit'); 
  
        OrderDetail::where('order_id', $orderid)->where('vendor_id', Session::get('vendor-loggedin-id'))->update(['order_status' => $deliverystatus]);

        $orderDetails = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
            ->leftjoin('customer_address as cba', 'order_details.billing_customer_address_id', '=', 'cba.id')
            ->leftjoin('customer_address as csa', 'order_details.shipping_customer_address_id', '=', 'csa.id')
            ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
            ->leftjoin('vendors', 'order_details.vendor_id', '=', 'vendors.id')
            ->leftjoin('product_variant_price', 'product_variant_price.id', '=', 'order_details.product_variant_price_id')
            ->leftjoin('product_variant_values AS pvv1', 'product_variant_price.variant_value_id_1', '=', 'pvv1.id')
            ->leftjoin('product_variants AS pv1', 'pv1.id', '=', 'pvv1.variant_id')
            ->leftjoin('product_variant_values AS pvv2', 'product_variant_price.variant_value_id_2', '=', 'pvv2.id')
            ->leftjoin('product_variants AS pv2', 'pv2.id', '=', 'pvv2.variant_id')
            ->leftjoin('product_variant_values AS pvv3', 'product_variant_price.variant_value_id_3', '=', 'pvv3.id')
            ->leftjoin('product_variants AS pv3', 'pv3.id', '=', 'pvv3.variant_id')
            ->where('orders.id', $orderid)->where('order_details.vendor_id',$vendor_id)->select('*', 'orders.orderid AS orderID', DB::raw('CONCAT("<tr><td>", cba.firstname, " ", cba.lastname, "</td></tr><tr><td>", cba.emailid, "</td></tr><tr><td>", cba.phonenumber, "</td></tr><tr><td>", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), "</td></tr><tr><td>", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode, "</td></tr><tr><td>", cba.companyname, "</td></tr>") as billingAddress'), DB::raw('CONCAT("<tr><td>", csa.firstname, " ", csa.lastname, "</td></tr><tr><td>", csa.emailid, "</td></tr><tr><td>", csa.phonenumber, "</td></tr><tr><td>", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), "</td></tr><tr><td>", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode, "</td></tr><tr><td>", csa.companyname, "</td></tr>") as shippingAddress'), 'products.name AS productName', 'products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'products.gst_rate AS perproductgst', 'order_details.product_price AS productprice', 'orders.discount AS cartDiscount', 'orders.delivery_fee AS cartDeliveryCharge', 'orders.cod_charges AS codOnCart', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'vendors.store_name AS storeName', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

        $vendorWiseDetail = array();
        foreach ($orderDetails as $orderDetail) {
            if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                $vendorWiseDetail[$orderDetail->vendor_id] = array('orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => $orderDetail->business_emailid, 'products' => array());
            }
            array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'perproductgst' => $orderDetail['perproductgst'], 'store_name' => @$orderDetail['storeName'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee']));
        }

 
        if ($deliverystatus == 'Processing' && $deliverystatus != $paststatus) {
            $this->VendorInvoiceGenerate($orderid,$vendor_id);
            if (isset($notifyemail)) {
                $email = Customer::findorFail($order->customer_id)->emailid;
                if (!is_null($email) && !empty($email)) {

                    Mail::send('mailtemplate.orderinprocess', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) use ($email) {
                        $message->to($email)->subject('Welcome to SpiceBucket.');
                        $message->from('info@spicebucket.net', 'Spice Bucket');
                    });
                    Mail::send('mailtemplate.orderinprocess', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails), function ($message) {
                        $message->to(['ravendraverma89@gmail.com','niraj4u2@gmail.com', 'itsnoormail@gmail.com', 'madhavsingh.singh25@gmail.com'])->subject('Welcome to SpiceBucket.');
                        $message->from('info@spicebucket.net', 'Spice Bucket');
                    });
                }
            }
        }
        // ['ravendraverma89@gmail.com', 'itsnoormail@gmail.com', 'madhavsingh.singh25@gmail.com']
        if ($deliverystatus == 'Processing' && $deliverystatus != $paststatus) {
            $this->VendorInvoiceGenerate($orderid,$vendor_id);
            if (isset($notifysms)) {
                $phone = Customer::findorFail($order->customer_id)->phone;
                if (!is_null($phone) && !empty($phone)) {

                    $smsmessage = "Dear Customer, Thank you for your order on https://www.spicebucket.com. Your order has been successfully placed. Please do save your order number as to track your order status and it will be referenced in your communication with us. The details of your order are given below.";
                    sendSMS($phone, $smsmessage);
                }
            }
        }
 
        return redirect('/sellers/orders');
    }
}
