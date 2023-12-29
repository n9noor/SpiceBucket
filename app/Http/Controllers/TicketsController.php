<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\TicketNote;
use App\Models\User;
use App\Models\VendorTicket;
use App\Models\VendorTicketNote;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
	public function ticketlist()
	{
		$ticketcount = Ticket::select(DB::raw("COUNT(*) AS totalTickets"), DB::raw("SUM(CASE WHEN status=0 THEN 1 ELSE 0 END) AS openedTicket"), DB::raw("SUM(CASE WHEN status=1 THEN 1 ELSE 0 END) AS inprogressTicket"), DB::raw("SUM(CASE WHEN status=3 THEN 1 ELSE 0 END) AS closedTicket"))->first();
		$tickets = Ticket::leftjoin('users AS u1', 'u1.id', '=', 'tickets.agent')->leftjoin('users AS u2', 'u2.id', '=', 'tickets.created_by')->select('tickets.*', DB::raw('CONCAT(u1.firstname, " ", IF(u1.lastname IS NOT NULL, u1.lastname, "")) AS agent'), DB::raw('CONCAT(u2.firstname, " ", IF(u2.lastname IS NOT NULL, u2.lastname, "")) AS created_by'))->where('tickets.agent', Session::get('admin-loggedin-id'))->orWhere('tickets.created_by', Session::get('admin-loggedin-id'))->get();
		return view('ticket.list', ['title' => 'Ticket List | SpiceBucket', 'tickets' => $tickets, 'ticketcount' => $ticketcount]);
	}

	public function add()
	{
		$department = Role::where('is_active', 1)->get();
		return view('ticket.add', ['title' => 'Ticket Add | SpiceBucket', 'departments' => $department]);
	}

	public function getDepartmentUser(Request $request)
	{
		$roleid = $request->id;
		$users = User::where('is_active', true)->where('role_id', $roleid)->get();
		return response()->json([
			'users' => $users
		], 200);
	}

	public function save(Request $request)
	{
		$this->validate($request, [
			'department' => 'required|numeric',
			'agent' => 'required|numeric',
			'title' => 'required',
			'description' => 'required',
		]);
		$ticket = new Ticket();
		$ticket->title = $request->title;
		$ticket->description = $request->description;
		$ticket->department = $request->department;
		$ticket->agent = $request->agent;
		$ticket->status = 0;
		$ticket->created_by = Session::get('admin-loggedin-id');

		if ($request->hasFile('images')) {
			$counter = 1;
			$images = array();
			foreach ($request->images as $image) {
				$imageName = 't' . $counter . '-' . time() . '.' . $image->extension();
				$image->move(public_path('images/tickets'), $imageName);
				array_push($images, $imageName);
				$counter++;
			}
			$ticket->images = implode(",", $images);
		}
		$ticket->save();
		$ticketid = $ticket->id;

		Ticket::where('id', $ticketid)->update(['ticketno' => 'SR-' . date('y') . str_pad($ticketid, 6, "0", STR_PAD_LEFT)]);

		return redirect('/ticket')->with('message', 'Ticket Added Successfully.');
	}

	public function detail($id)
	{
		$ticket = Ticket::leftjoin('users AS u2', 'u2.id', '=', 'tickets.created_by')->select('tickets.*', DB::raw('CONCAT(u2.firstname, " ", IF(u2.lastname IS NOT NULL, u2.lastname, "")) AS created_by'))->where('tickets.id', $id)->first();
		if ($ticket == null) {
			return redirect('/ticket')->with('message', 'Ticket Not found.');
		}
		$ticketreplies = TicketNote::leftjoin('users', 'users.id', '=', 'ticket_notes.created_by')->where('ticketid', $id)->select('ticket_notes.*', DB::raw('CONCAT(users.firstname, "", IF(users.lastname IS NOT NULL, users.lastname, "")) AS created_by'))->get();
		$departments = Role::where('is_active', 1)->get();
		return view('ticket.edit', ['title' => 'Ticket Detail | Spicebucket', 'ticket' => $ticket, 'ticketreplies' => $ticketreplies, 'departments' => $departments]);
	}

	public function update_status(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'status' => 'required|numeric',
			'department' => 'required|numeric',
			'agent' => 'required|numeric',
		]);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'message' => implode(",", $validator->messages()->all())
			], 200);
		}
		$ticket = Ticket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}
		try {
			$ticket->status = $request->status;
			$ticket->department = $request->department;
			$ticket->agent = $request->agent;
			$ticket->updated_at = Carbon::now();
			$ticket->save();
			return response()->json([
				'status' => true
			], 200);
		} catch (Exception $ex) {
			return response()->json([
				'status' => false,
				'message' => $ex->getMessage()
			], 200);
		}
	}

	public function update_comment(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'comment' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'message' => implode(",", $validator->messages()->all())
			], 200);
		}
		$ticket = Ticket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}
		try {
			$ticketnotes = new TicketNote();
			if ($request->hasFile('images')) {
				$counter = 1;
				$images = array();
				foreach ($request->images as $image) {
					$imageName = 't' . $counter . '-' . time() . '.' . $image->extension();
					$image->move(public_path('images/tickets'), $imageName);
					array_push($images, $imageName);
					$counter++;
				}
				$ticketnotes->images = implode(",", $images);
			}
			$ticketnotes->ticketid = $id;
			$ticketnotes->remarks = $request->comment;
			$ticketnotes->created_by = Session::get('admin-loggedin-id');
			$ticketnotes->save();
			return response()->json([
				'status' => true
			], 200);
		} catch (Exception $ex) {
			return response()->json([
				'status' => false,
				'message' => $ex->getMessage()
			], 200);
		}
	}

	public function get_notes($id)
	{
		$ticket = Ticket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}

		$notes = TicketNote::leftjoin('users', 'users.id', '=', 'ticket_notes.created_by')->where('ticketid', $id)->select('ticket_notes.*', DB::raw('CONCAT(users.firstname, "", IF(users.lastname IS NOT NULL, users.lastname, "")) AS created_by'))->get();
		$noteshtml = '';
		foreach ($notes as $note) {
			$noteshtml .= '<li class="d-flex align-items-start"><img class="me-3 rounded" src="/backend/images/avatars/1.jpg" width="60" alt="User"><div class="media-body"><h5 class="mt-0 mb-1">' . ucwords($note->created_by) . '</h5>' . $note->remarks . '</div></li><hr>';
		}
		return response()->json([
			'status' => true,
			'noteshtml' => $noteshtml
		], 200);
	}

	public function vendor_ticketlist()
	{
		$ticketcount = VendorTicket::select(DB::raw("COUNT(*) AS totalTickets"), DB::raw("SUM(CASE WHEN status=0 THEN 1 ELSE 0 END) AS openedTicket"), DB::raw("SUM(CASE WHEN status=1 THEN 1 ELSE 0 END) AS inprogressTicket"), DB::raw("SUM(CASE WHEN status=3 THEN 1 ELSE 0 END) AS closedTicket"))->when(Session::get('vendor-logged-in') == true, function ($query) {
			return $query->where('vendor_id', Session::get('vendor-loggedin-id'));
		})->when(Session::get('admin-logged-in') == true, function ($query) {
			return $query->where('agent', Session::get('admin-loggedin-id'));
		})->first();
		$tickets = VendorTicket::leftjoin('vendors AS u1', 'u1.id', '=', 'vendor_tickets.vendor_id')->leftjoin('users AS u2', 'u2.id', '=', 'vendor_tickets.agent')->select('vendor_tickets.*', DB::raw('u1.vendor_alias AS created_by'), DB::raw('CONCAT(u2.firstname, " ", IF(u2.lastname IS NOT NULL, u2.lastname, "")) AS agent'))->when(Session::get('vendor-logged-in') == true, function ($query) {
			return $query->where('vendor_tickets.vendor_id', Session::get('vendor-loggedin-id'));
		})->when(Session::get('admin-logged-in') == true, function ($query) {
			return $query->where('vendor_tickets.agent', Session::get('admin-loggedin-id'));
		})->get();
		return view('vendorticket.list', ['title' => 'Ticket List | SpiceBucket', 'tickets' => $tickets, 'ticketcount' => $ticketcount]);
	}

	public function vendor_add()
	{
		if (Session::get('vendor-logged-in') == false) {
			return redirect('/sellers/ticket');
		}
		return view('vendorticket.add', ['title' => 'Ticket Add | SpiceBucket']);
	}

	public function vendor_save(Request $request)
	{
		if (Session::get('vendor-logged-in') == false) {
			return redirect('/sellers/ticket');
		}
		$this->validate($request, [
			'agent' => 'required|numeric',
			'title' => 'required',
			'description' => 'required',
		]);
		$ticket = new VendorTicket();
		$ticket->title = $request->title;
		$ticket->description = $request->description;
		$ticket->agent = $request->agent;
		$ticket->vendor_id = Session::get('vendor-loggedin-id');
		$ticket->status = 0;
		$ticket->created_by = Session::get('vendor-loggedin-id');

		if ($request->hasFile('images')) {
			$counter = 1;
			$images = array();
			foreach ($request->images as $image) {
				$imageName = 't' . $counter . '-' . time() . '.' . $image->extension();
				$image->move(public_path('images/tickets'), $imageName);
				array_push($images, $imageName);
				$counter++;
			}
			$ticket->images = implode(",", $images);
		}
		$ticket->save();
		$ticketid = $ticket->id;

		VendorTicket::where('id', $ticketid)->update(['ticketno' => 'SR-' . date('y') . str_pad($ticketid, 6, "0", STR_PAD_LEFT)]);

		return redirect('/sellers/ticket')->with('message', 'Ticket Added Successfully.');
	}

	public function vendor_detail($id)
	{
		$ticket = VendorTicket::leftjoin('users AS u2', 'u2.id', '=', 'vendor_tickets.agent')->select('vendor_tickets.*', DB::raw('CONCAT(u2.firstname, " ", IF(u2.lastname IS NOT NULL, u2.lastname, "")) AS agent'))->where('vendor_tickets.id', $id)->first();
		if ($ticket == null) {
			return redirect('/sellers/ticket')->with('message', 'Ticket Not found.');
		}
		$ticketreplies = VendorTicketNote::leftjoin('users', 'users.id', '=', 'vendor_ticket_notes.created_by')->where('ticketid', $id)->select('ticket_notes.*', DB::raw('CONCAT(users.firstname, "", IF(users.lastname IS NOT NULL, users.lastname, "")) AS created_by'))->get();
		return view('vendorticket.edit', ['title' => 'Ticket Detail | Spicebucket', 'ticket' => $ticket, 'ticketreplies' => $ticketreplies]);
	}

	public function vendor_update_status(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'status' => 'required|numeric',
			'department' => 'required|numeric',
			'agent' => 'required|numeric',
		]);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'message' => implode(",", $validator->messages()->all())
			], 200);
		}
		$ticket = VendorTicket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}
		try {
			$ticket->status = $request->status;
			$ticket->agent = $request->agent;
			$ticket->updated_at = Carbon::now();
			$ticket->save();
			return response()->json([
				'status' => true
			], 200);
		} catch (Exception $ex) {
			return response()->json([
				'status' => false,
				'message' => $ex->getMessage()
			], 200);
		}
	}

	public function vendor_update_comment(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'comment' => 'required'
		]);
		if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'message' => implode(",", $validator->messages()->all())
			], 200);
		}
		$ticket = VendorTicket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}
		try {
			$ticketnotes = new VendorTicketNote();
			if ($request->hasFile('images')) {
				$counter = 1;
				$images = array();
				foreach ($request->images as $image) {
					$imageName = 't' . $counter . '-' . time() . '.' . $image->extension();
					$image->move(public_path('images/tickets'), $imageName);
					array_push($images, $imageName);
					$counter++;
				}
				$ticketnotes->images = implode(",", $images);
			}
			$ticketnotes->ticketid = $id;
			$ticketnotes->remarks = $request->comment;
			$ticketnotes->created_by = Session::get('admin-logged-in') == true ? Session::get('admin-loggedin-id') : Session::get('vendor-loggedin-id');
			$ticketnotes->save();
			return response()->json([
				'status' => true
			], 200);
		} catch (Exception $ex) {
			return response()->json([
				'status' => false,
				'message' => $ex->getMessage()
			], 200);
		}
	}

	public function vendor_get_notes($id)
	{
		$ticket = VendorTicket::Find($id);
		if ($ticket == null) {
			return response()->json([
				'status' => false,
				'message' => 'No ticket available.'
			], 200);
		}

		$notes = VendorTicketNote::leftjoin('users', 'users.id', '=', 'ticket_notes.created_by')->where('ticketid', $id)->select('ticket_notes.*', DB::raw('CONCAT(users.firstname, "", IF(users.lastname IS NOT NULL, users.lastname, "")) AS created_by'))->get();
		$noteshtml = '';
		foreach ($notes as $note) {
			$noteshtml .= '<li class="d-flex align-items-start"><img class="me-3 rounded" src="/backend/images/avatars/1.jpg" width="60" alt="User"><div class="media-body"><h5 class="mt-0 mb-1">' . ucwords($note->created_by) . '</h5>' . $note->remarks . '</div></li><hr>';
		}
		return response()->json([
			'status' => true,
			'noteshtml' => $noteshtml
		], 200);
	}
}
