<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoices;

class InvoicesController extends Controller
{

/**
* @OA\GET(
*     path="/api/invoices",
*     operationId="getInvoices",
*     summary="Obtener facturas",
*     tags={"Invoices"},
* @OA\Response(
*          response=200,
*          description="Successful operation",
*          @OA\MediaType(
*           mediaType="application/json",
*          )
*      ),
* @OA\Response(
*         response=401,
*         description="Unauthenticated",
*      ),
* @OA\Response(
*         response=403,
*         description="Forbidden"
*      ),
* @OA\Response(
*         response=400,
*         description="Bad Request"
*      ),
* @OA\Response(
*          response=404,
*          description="Not found"
*   ),
* security={
*       {"bearerAuth": {}}
*     }
* )
*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $invoices = Invoices::all();
            return $invoices;

        }catch(Exception $e){

            return response()->json([
                'success'  => false,
                'message'  => $e
            ]);
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $invoice = Invoices::create($request->all());
            return $invoice;

        }catch(Exception $e){

            return response()->json([
                'success'  => false,
                'message'  => $e
            ]);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{

            $invoice = Invoices::find($id);
            return $invoice;

        }catch(Exception $e){

            return response()->json([
                'success'  => false,
                'message'  => $e
            ]);
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $invoice = Invoices::find($id);
            $invoice->fill($request->all())->save();
            return $invoice;

        }catch(Exception $e){

            return response()->json([
                'success'  => false,
                'message'  => $e
            ]);
            
        }
    }

    public function getDetails($id)
    {
        try{

            $invoice = Invoices::find($id);
            $details = $invoice->details();

            return $details;

        }catch(Exception $e){

            return response()->json([
                'success'  => false,
                'message'  => $e
            ]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $invoice = Invoices::findOrFail($id);
            $invoice->delete();
            
            return [
                'success'   => true,
                'message'   => "Factura eliminada con exito",
            ];
    
        }catch(Exception $e){
            return [
                'success'   => false,
                'message'   => $e,
            ];
        }
    }

    public function restore($id)
    {
        try{
            $invoice = Invoices::onlyTrashed()->find($id);
            $invoice->restore();
            return [
                'success'   => true,
                'message'   => "Factura restaurada con exito",
            ];
        }catch(Exception $e){
            return [
                'success'   => false,
                'message'   => $e,
            ];
        }
    }

    public function executeRobot()
    {
        try{
            
            system('cmd.exe /c C:\CASSA.bat');            
            
            $invoices = Invoices::all();
            return $invoices;

        }catch(Exception $e){
            return [
                'success'   => false,
                'message'   => $e,
            ];
        }
    }
}
