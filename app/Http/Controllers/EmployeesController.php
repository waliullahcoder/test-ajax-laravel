<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;

class EmployeesController extends Controller{

  public function index(){
     return view('employee_data');
  }

  public function getUsers($id = 0){

     if($id==0){ 
        $employees = Employees::orderby('id','asc')->select('*')->get(); 
     }else{   
        $employees = Employees::select('*')->where('id', $id)->get(); 
     }
     // Fetch all records
     $userData['data'] = $employees;

     echo json_encode($userData);
     exit;
  }


  
  public function getUsersPid($pid){

      $employees = Employees::select('*')->where('pid', $pid)->get(); 
   
   // Fetch all records
   $userData['data'] = $employees;

   echo json_encode($userData);
   exit;
}















}