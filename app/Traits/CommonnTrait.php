<?php
namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\File;  
use Illuminate\Http\Request; 
use App\Models\Product; 
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; 
use PDF;
use App\Models\OrderDetail;
use App\Models\Vendor;

trait CommonnTrait
{
    // get response 
 

   public function setResponseJson($status, $code = "", $data = [], $message = "", $errors = "")
    {
        return [
            "status" => (int) $status,             
            "data" => $data,
            "message" => $message,
            "errors" => $errors
        ];
    }
   static public function vendorNickNameForder($vendor_id)
    {
        $vendornickname = Vendor::where('id',$vendor_id)->first();
        $Vnickname = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $vendornickname->vendor_alias));
        return substr($Vnickname, 0, 4);
        
    }
    public function generateSlug($title,$id){
        $slug = Str::slug($title);
            // check to see if any other slugs exist that are the same & count them
        if(!empty($id)){
            $count = Product::whereRaw("slug LIKE '^{$slug}'")->whereNotIn('id', [$id])->count();
        }else{
            $count = Product::whereRaw("slug RLIKE '^{$slug}'")->count();
        }
        

        // if other slugs exist that are the same, append the count to the slug
        return  $count ? "{$slug}-{$count}" : $slug;
    }

    public function sendMailForOrderTrait($orderid='',$customerEmail='')
    {
        /*Mailing info*/
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
            ->where('orders.id', $orderid)->select('*', 'orders.orderid AS orderID', DB::raw('CONCAT("<strong>", cba.firstname, " ", cba.lastname, "</strong><br />", cba.address_line_1, ", ", IF(cba.address_line_2 IS NOT NULL, CONCAT(cba.address_line_2, ", "), ""), IF(cba.address_line_3 IS NOT NULL, CONCAT(cba.address_line_3, ", "), ""), ",", cba.city,", ", cba.state, ", ", cba.country, ", ", cba.pincode) as billingAddress'), DB::raw('CONCAT("<strong>", csa.firstname, " ", csa.lastname, "</strong><br />", csa.address_line_1, ", ", IF(csa.address_line_2 IS NOT NULL, CONCAT(csa.address_line_2, ", "), ""), IF(csa.address_line_3 IS NOT NULL, CONCAT(csa.address_line_3, ", "), ""), ",", csa.city,", ", csa.state, ", ", csa.country, ", ", csa.pincode) as shippingAddress'), 'products.name AS productName', 'products.slug AS productslug', 'order_details.product_qunatity AS productquantity', 'order_details.gst_on_product_price AS perproductgst', 'order_details.product_price AS productprice', 'orders.discount AS cartDiscount', 'orders.delivery_fee AS cartDeliveryCharge', 'orders.cod_charges AS codOnCart', 'orders.payment_amount AS paymentAmount', 'orders.gst_on_amount AS totalCartGst', 'orders.total_amount AS totalCartAmount', 'pv1.name AS productvariantname1', 'pvv1.value AS variantvalue1', 'pv2.name AS productvariantname2', 'pvv2.value AS variantvalue2', 'pv3.name AS productvariantname3', 'pvv3.value AS variantvalue3', 'orders_extra_charges.shipping_charges AS vendorDeliveryFee', 'orders_extra_charges.cod_charges AS vendorCodCharges', 'orders_extra_charges.discount AS vendorDiscount', 'vendors.store_name AS storeName', 'vendors.address AS storeaddress', 'vendors.gst AS storeGST', 'pincode_master.state AS storeStateCode', 'pincode_master.city AS storeCity', 'order_details.invoice_number AS invoiceNumber', DB::raw("(SELECT image FROM product_images WHERE product_id=products.id LIMIT 1) AS productImage"))->get();

                



        $vendorWiseDetail = array();
        $orderID = $orderDateTime = $paymentSource = '';
        $codOnCart = $cartDiscount = 0;
        foreach ($orderDetails as $orderDetail) {
            if (!array_key_exists($orderDetail->vendor_id, $vendorWiseDetail)) {
                $vendorWiseDetail[$orderDetail->vendor_id] = array('paymentSource' => $orderDetail->payment_source, 'discount' => $orderDetail->vendorDiscount, 'cod_charges' => $orderDetail->vendorCodCharges, 'shippingFee' => $orderDetail->vendorDeliveryFee, 'invoiceNumber' => $orderDetail->invoiceNumber, 'storeCity' => $orderDetail->storeCity, 'storeStateCode' => $orderDetail->storeStateCode, 'vendor_gst' => $orderDetail->storeGST, 'vendor_alias' => $orderDetail->vendor_alias, 'store_name' => $orderDetail->storeName, 'store_address' => $orderDetail->storeaddress, 'orderID' => $orderDetail->orderID, 'orderDateTime' => $orderDetail->order_datetime,  'customerbillinginfo' => $orderDetail->billingAddress, 'customershippinginfo' => $orderDetail->shippingAddress, 'vendorEmailid' => 'niraj4u22@gmail.com', 'products' => array());
                $orderID = $orderDetail->orderID;
                $orderDateTime = $orderDetail->order_datetime;
                $cartDiscount = $orderDetail->cartDiscount;
                $codOnCart = $orderDetail->codOnCart;
                $paymentSource = $orderDetail->paymentSource;
            }


            array_push($vendorWiseDetail[$orderDetail->vendor_id]['products'], array('producdescription' => $orderDetail['description'], 'productname' => $orderDetail['productName'], 'productvariantname1' => $orderDetail['productvariantname1'], 'variantvalue1' => $orderDetail['variantvalue1'], 'productvariantname2' => $orderDetail['productvariantname2'], 'variantvalue2' => $orderDetail['variantvalue2'], 'productvariantname3' => $orderDetail['productvariantname3'], 'variantvalue3' => $orderDetail['variantvalue3'], 'productImage' => $orderDetail['productImage'], 'productslug' => $orderDetail['productslug'], 'productprice' => $orderDetail['productprice'], 'productqty' => $orderDetail['productquantity'], 'shippingCharge' => $orderDetail['vendorDeliveryFee'], 'perproductgst' => $orderDetail['perproductgst'], 'sku' => $orderDetail['sku'], 'shippingFee' => $orderDetail['delivery_fee'], 'gst_rate' => $orderDetail['gst_rate'], 'store_name' => $orderDetail['store_name']));
        }
          
        PDF::loadView('invoices.orderplaced', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails, 'orderID' => $orderID, 'orderDateTime' => $orderDateTime, 'discountAmount' => $cartDiscount, 'cod_charges' => $codOnCart, 'paymentSource' => $paymentSource))->save(public_path("/invoices/" . $orderDetails[0]->orderID . '.pdf'));


        foreach ($vendorWiseDetail as $vendorDetail) {
            PDF::loadView('invoices.orderplacedvendorwise', array('vendorDetail' => $vendorDetail, 'orderDetail' => $orderDetails))->save(public_path("/backend/invoices/" .  $vendorDetail['invoiceNumber'] . '.pdf'));
        }

        Mail::send('mailtemplate.orderplaced', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails, 'orderID' => $orderID, 'orderDateTime' => $orderDateTime, 'discountAmount' => $cartDiscount, 'cod_charges' => $codOnCart, 'paymentSource' => $paymentSource), function ($message) use ($orderDetails,$customerEmail) {
            $message->to($customerEmail)->subject('Order placed successfully.')->attach(public_path("/invoices/" . $orderDetails[0]->orderID . '.pdf'), [
                'as' => 'Invoice #' . $orderDetails[0]->orderID.'.pdf',
                'mime' => 'application/pdf'
            ]);

            $message->from('info@spicebucket.com', 'Spice Bucket');
        });
        Mail::send('mailtemplate.orderplaced', array('vendorWiseDetail' => $vendorWiseDetail, 'orderDetail' => $orderDetails, 'discountAmount' => $cartDiscount, 'cod_charges' => $codOnCart), function ($message) use ($orderDetails) {
            $message->to('admin1@upcloudglobal.com')->bcc('dusad.nikhil@gmail.com')->subject('New order request generated.')->attach(public_path("/invoices/" . $orderDetails[0]->orderID . '.pdf'), [
                'as' => 'Invoice #' . $orderDetails[0]->orderID.'.pdf',
                'mime' => 'application/pdf'
            ]);
            $message->from('info@spicebucket.com', 'Spice Bucket');
        });
        foreach ($vendorWiseDetail as $vendorDetail) {
            Mail::send('mailtemplate.orderinprocessvendorwise', array('vendorDetail' => $vendorDetail, 'orderDetail' => $orderDetails), function ($message) use ($vendorDetail) {
                $message->to($vendorDetail['vendorEmailid'])->subject('New order request generated.')->attach(public_path("/backend/invoices/" .$vendorDetail['invoiceNumber'] . '.pdf' ), [
                    'as' => 'Invoice #' . $vendorDetail['invoiceNumber'].'.pdf',
                    'mime' => 'application/pdf'
                ]);
                $message->from('info@spicebucket.com', 'Spice Bucket');
            });
        }
        return true;
    }
}
