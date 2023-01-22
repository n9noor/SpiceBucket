<?php

namespace App\Http\Controllers;

use App\Models\ProductVerient;
use App\Models\ProductVerientValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VariantController extends Controller
{
    public function variant_type(Request $request) {
        $result = ProductVerient::where('is_active', true)->select('product_variants.*')->get();
        $html = '';
        $options = '';
        foreach($result as $variant) {
            $html .= '<tr><td>'.($request->session()->get('admin-logged-in') == true ? '<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="javascript:void(0)" onclick="$(\'#variant_type_id\').val(' . $variant->id . ');$(\'#variant_type\').val(\'' . $variant->name . '\');" data-bs-toggle="modal" data-bs-target="#add-variant-type-modal" title="Edit Variant Type" ><i class="btn-icon-wrapper fa fa-user"></i>Edit Variant Type</a>&nbsp;&nbsp;<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" onclick="deleteVariantType('.$variant->id.')"><i class="btn-icon-wrapper fa fa-trash"></i>Delete Variant Type</a>' : '').'</td>'.(($request->session()->get('admin-logged-in') == true) ? '<td><input data-column="is_active" data-type="product_variants" data-id="'.$variant->id.'" type="checkbox"'.($variant->is_active == true ? " checked='checked'" : "") . ' data-toggle="toggle"></td>' : '').'<td>' . $variant->name . '</td></tr>';
            if($variant->is_active == true) {
                $options .= '<option value="' . $variant->id .  '">' . $variant->name . '</option>';
            }
        }
        
        return response()->json([
            'html' => $html,
            'options' => $options
        ], 200);
    }
    
    public function variant_value(Request $request) {
        $result = ProductVerientValue::join('product_variants', 'product_variants.id', '=', 'product_variant_values.variant_id')->where('product_variants.is_active', true)->select('product_variant_values.*', 'product_variants.name AS variant_type_name')->get();
        $html = '';
        foreach($result as $variantvalue) {
            $html .= '<tr><td>'.($request->session()->get('admin-logged-in') == true ? '<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" href="javascript:void(0)" onclick="$(\'#variant_value_id\').val(' . $variantvalue->id . ');$(\'#variant_id\').select2(\'val\', \'' . $variantvalue->variant_id . '\');$(\'#variant_value\').val(\'' . $variantvalue->value . '\');" data-bs-toggle="modal" data-bs-target="#add-variant-value-modal" title="Edit Variant Value"><i class="btn-icon-wrapper fa fa-user"></i>Edit Variant Value</a>&nbsp;&nbsp;<a class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger" onclick="deleteVariantValue('.$variantvalue->id.')"><i class="btn-icon-wrapper fa fa-trash"></i>Delete Variant Value</a>':'').'</td>'.(($request->session()->get('admin-logged-in') == true) ? '<td><input data-column="is_active" data-type="product_variant_values" data-id="'.$variantvalue->id.'" type="checkbox"'. ($variantvalue->is_active == true ? " checked='checked'" : "") . ' data-toggle="toggle"></td>' : '').'<td>' . $variantvalue->variant_type_name . '</td><td>' . $variantvalue->value . '</td></tr>';
        }
        return response()->json([
            'html' => $html
        ], 200);
    }
    
    public function save_variant_type(Request $request){
        $validator = Validator::make($request->all(), [
            'varianttype' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = ProductVerient::where('name', $request->varianttype)->where('vendor_id', $request->session()->get('vendor-loggedin-id'))->first();
        if($request->id != 0){
            $result = ProductVerient::where('name', $request->varianttype)->where('vendor_id', $request->session()->get('vendor-loggedin-id'))->where('id', '<>', $request->id)->first();
        }
        
        if(!is_null($result)){
            return response()->json([
                'status' => false,
                'message' => "Variant Type already available."
            ], 200);
        } else {
            if($request->id == 0) {
                ProductVerient::insert([
                    'name' => $request->varianttype,
                    'vendor_id' => $request->session()->get('vendor-loggedin-id')
                ]);
            } else {
                ProductVerient::where('id', $request->id)->update([
                    'name' => $request->varianttype,
                    'vendor_id' => $request->session()->get('vendor-loggedin-id')
                ]);
            }
            return response()->json([
                'status' => true
            ], 200);
        }
    }
    
    public function save_variant_value(Request $request){
        $validator = Validator::make($request->all(), [
            'variant_id' => 'required',
            'variant_value' => 'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 200);
        }
        $result = ProductVerientValue::where('value', $request->variant_value)->where('variant_id', $request->variant_id)->first();
        if($request->id != 0){
            $result = ProductVerientValue::where('value', $request->variant_value)->where('variant_id', $request->variant_id)->whereNot('id', '<>', $request->id)->first();
        }
        
        if(!is_null($result)){
            return response()->json([
                'status' => false,
                'message' => "Value already available with variant type."
            ], 200);
        } else {
            if($request->id == 0) {
                ProductVerientValue::insert([
                    'value' => $request->variant_value,
                    'variant_id' => $request->variant_id
                ]);
            } else {
                ProductVerientValue::where('id', $request->id)->update([
                    'value' => $request->variant_value,
                    'variant_id' => $request->variant_id
                ]);
            }
            return response()->json([
                'status' => true
            ], 200);
        }
    }
}
