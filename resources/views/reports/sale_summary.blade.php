@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-cloud-upload icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Sale Summary
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th nowrap>Order Month</th>
                        <th nowrap>Total Orders</th>
                        <th nowrap>Order Amount</th>
                        <th nowrap>Tax Amount</th>
                        <th nowrap>Shipping Amount</th>
                        <th nowrap>Payable Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td nowrap>{{$order->order_month}}</td>
                        <td nowrap>{{$order->total_orders}}</td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->order_amount, 2)}} </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->tax_amount, 2)}} </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->shipping_amount, 2)}} </td>
                        <td nowrap><i class="fa fa-rupee-sign"></i> {{number_format($order->order_amount + $order->tax_amount + $order->shipping_amount, 2)}} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection