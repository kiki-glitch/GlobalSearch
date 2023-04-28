<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Ticket; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TablesController extends Controller
{
    public function index() {

        $users =User::query()
        ->when(request('query'), function($query, $searchQuery){
            $query->where('name', 'like', "%{$searchQuery}%");
        })
        ->latest()
        ->paginate(5);
        // return response()->json($users);

        // $users = User::latest()->paginate(6);
        return $users;
    }

    public function search(Request $request)
{
    $query = $request->get('q');

    if (empty($query)) {
        return response()->json(['message' => 'Search query is required'], 400);
    }

    $customers = Customer::select('id', 'first_name', 'last_name', 'username')
        ->where('first_name', 'like', "%$query%")
        ->orWhere('last_name', 'like', "%$query%")
        ->orWhere('username', 'like',"%$query%")
        ->get();

    $customerIds = $customers->pluck('id');

    $tickets = Ticket::select('tickets.id', 'tickets.title', 'tickets.description', 'tickets.scheduled_date', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name','customers.username as customer_username')
        ->leftJoin('customers', 'tickets.customer_id', '=', 'customers.id')
        ->whereIn('tickets.customer_id', $customerIds)
        ->orWhere('tickets.title', 'like', "%$query%")
        ->orWhere('tickets.description', 'like', "%$query%")
        ->get();

    // $payments = Payment::select('payments.id', 'payments.transaction_code','payments.account_number', 'payments.amount', 'payments.transaction_date', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name', 'customers.username as customer_username')
    //     ->leftJoin('customers', 'payments.customer_id', '=', 'customers.id')
    //     ->whereIn('payments.customer_id', $customerIds)
    //     ->orWhere('payments.transaction_code', 'like', "%$query%")
    //     ->orWhere('payments.account_number', 'like', "%$query%")
    //     ->orWhere('payments.last_name', 'like', "%$query%")
    //     ->orWhere('payments.first_name', 'like',"%$query%")
    //     ->get();

    $payments = Payment::select('payments.id','payments.transaction_code','payments.account_number', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name')
            ->leftJoin('customers', 'payments.customer_id', '=', 'customers.id')
            ->where('payments.transaction_code', 'like', "%$query%")
            ->orWhere('payments.account_number', 'like', "%$query%")
            ->orWhere('payments.last_name', 'like', "%$query%")
            ->orWhere('payments.first_name', 'like',"%$query%")
            ->get();

    $results = $customers->merge($tickets)->merge($payments);

    // Return the search results as JSON
    return response()->json($results);
}

    /**Best one yet */
    // public function search(Request $request) {

    //     $query = $request->get('q');
        
    //     if (empty($query)) {
    //         return response()->json(['message' => 'Search query is required'], 400);
    //     }
        
    //     $customers = Customer::where('first_name', 'like', "%$query%")
    //         ->orWhere('last_name', 'like', "%$query%")
    //         ->orWhere('username', 'like',"%$query%")
    //         ->get();
        
    //     $tickets = Ticket::select('tickets.description', 'tickets.title', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name','customers.username as customer_username' )
    //         ->leftJoin('customers', 'tickets.customer_id', '=', 'customers.id')
    //         ->where('tickets.title', 'like', "%$query%")
    //         ->orWhere('tickets.description', 'like', "%$query%")
    //         ->get();
        
    //     $payments = Payment::select('payments.transaction_code','payments.account_number', 'customers.first_name as customer_first_name', 'customers.last_name as customer_last_name')
    //         ->leftJoin('customers', 'payments.customer_id', '=', 'customers.id')
    //         ->where('payments.transaction_code', 'like', "%$query%")
    //         ->orWhere('payments.account_number', 'like', "%$query%")
    //         ->orWhere('payments.last_name', 'like', "%$query%")
    //         ->orWhere('payments.first_name', 'like',"%$query%")
    //         ->get();
        
    //     // $results = $customers->concat($tickets)->concat($payments);
    //     $results = $tickets->concat($payments);
    //     // Return the search results as JSON
    //     return response()->json($results);
    // }

    // public function search(Request $request) {
        
    //     $query = $request->get('query');
    
    //         if (empty($query)) {
    //             return response()->json(['message' => 'Search query is required'], 400);
    //         }
            
    //         $customers = Customer::where('first_name', 'like', "%$query%")
    //             ->orWhere('last_name', 'like', "%$query%")
    //             ->get();
            
    //         // Perform similar search queries on tickets and payments tables
    //         // get IDs of matching customers
    //     $customerIds = $customers->pluck('id');
    
    //     // search for matching tickets and payments based on customer IDs
    //     $tickets = Ticket::whereIn('customer_id', $customerIds)
    //                      ->where(function($search_query) use ($query) {
    //                         $search_query->where('title', 'LIKE', '%'.$query.'%')
    //                               ->orWhere('description', 'LIKE', '%'.$query.'%');
    //                      })
    //                      ->get();
    
    //     $payments = Payment::whereIn('customer_id', $customerIds)
    //                        ->where('transaction_code', 'LIKE', '%'.$query.'%')
    //                        ->get();

    //     // Return the search results as JSON
    //     return response()->json([
    //         'customers' => $customers,
    //         'tickets' => $tickets,
    //         'payments' => $payments,
    //     ]);
            
            
    //         // return response()->json([
    //         //     'customers' => $customers,

    //         //     // Add the search results from tickets and payments tables
    //         // ]);
    //     // $query = $request->get('query');
        
    //     // dd($query);

    //     // // search for matching customers
    //     // $customers = Customer::where('first_name', 'LIKE', '%'.$query.'%')
    //     //                       ->orWhere('last_name', 'LIKE', '%'.$query.'%')
    //     //                       ->get();
    
    //     // // get IDs of matching customers
    //     // $customerIds = $customers->pluck('id');
    
    //     // // search for matching tickets and payments based on customer IDs
    //     // $tickets = Ticket::whereIn('customer_id', $customerIds)
    //     //                  ->where(function($search_query) use ($query) {
    //     //                     $search_query->where('title', 'LIKE', '%'.$query.'%')
    //     //                           ->orWhere('description', 'LIKE', '%'.$query.'%');
    //     //                  })
    //     //                  ->get();
    
    //     // $payments = Payment::whereIn('customer_id', $customerIds)
    //     //                    ->where('transaction_code', 'LIKE', '%'.$query.'%')
    //     //                    ->get();
    
    //     // return response()->json([
    //     //     'customers' => $customers,
    //     //     'tickets' => $tickets,
    //     //     'payments' => $payments,
    //     // ]);
    // }
    // public function search(Request $request) {

    //     $query = $request->get('query');
    
    //     // search for matching customers
    //     $customers = Customer::where('first_name', 'LIKE', '%'.$query.'%')
    //                           ->orWhere('last_name', 'LIKE', '%'.$query.'%')
    //                           ->get();
    
    //     // get IDs of matching customers
    //     $customerIds = $customers->pluck('id');
    
    //     // search for matching tickets and payments based on customer IDs
    //     $tickets = Ticket::whereIn('customer_id', $customerIds)
    //                      ->where(function($search_query) use ($query) {
    //                         $search_query->where('title', 'LIKE', '%'.$query.'%')
    //                               ->orWhere('description', 'LIKE', '%'.$query.'%');
    //                      })
    //                      ->get();
    
    //     $payments = Payment::whereIn('customer_id', $customerIds)
    //                        ->where('transaction_code', 'LIKE', '%'.$query.'%')
    //                        ->get();
    
    //     return response()->json([
    //         'customers' => $customers,
    //         'tickets' => $tickets,
    //         'payments' => $payments,
    //     ]);
    // }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' =>Hash::make($request->password),

        ]);
    }

    public function update(User $user)
    {   
        request() -> validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$user->id,
            'password' => 'sometimes|min:8',
        ]);
        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password') ? Hash::make(request('password')) : $user->password,
        ]);

        return $user;
    }
    public function destroy(User $user){

        $user->delete();

        return response()->noContent();
    }

    // public function search(Request $request) {

    // $query = $request->input('query');
    
    // $results = DB::table('tickets')
    //     ->join('customers', 'tickets.customer_id', '=', 'customers.id')
    //     ->join('payments', 'customers.id', '=', 'payments.customer_id')
    //     ->select('tickets.*', 'customers.first_name', 'customers.last_name', 'payments.transaction_code')
    //     ->where('tickets.title', 'like', '%' . $query . '%')
    //     ->orWhere('tickets.description', 'like', '%' . $query . '%')
    //     ->orWhere('customers.first_name', 'like', '%' . $query . '%')
    //     ->orWhere('customers.last_name', 'like', '%' . $query . '%')
    //     ->orWhere('payments.transaction_code', 'like', '%' . $query . '%')
    //     ->get();

    // return response()->json($results);
    // }



}
