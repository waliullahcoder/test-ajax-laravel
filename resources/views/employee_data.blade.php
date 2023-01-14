<!doctype html>
<html>
   <body>
    https://makitweb.com/fetch-records-from-mysql-with-jquery-ajax-laravel/<br>
    https://makitweb.com/auto-populate-dropdown-with-jquery-ajax-in-laravel-8/ <br>

    <hr><h1>Only Ajax Section</h1>
     <input type='text' id='search' name='search' placeholder='Enter userid 1-27'>
     <input type='button' value='Search' id='but_search'>
     <br/>
   
     <input type='button' value='Fetch all records' id='but_fetchall'>
     <select id='fetchallByPid' name='pid'>
      <option value="0">Select</option>
      <option value="1">ABC</option>
      <option value="2">DFGH</option>
      <option value="3">FFFFF</option>
   </select>
     <select id='select2' name='pid'><option value='0'>select2</option></select>

     <table border='1' id='userTable' style='border-collapse: collapse;'>
       <thead>
        <tr>
          <th>S.no</th>
          <th>Username</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
       </thead>
       <tbody></tbody>
     </table>


     


     <br/>
<hr><h1>Employee show under Department Dropdown Select</h1>
<input type="text" id="box1" value="">
<input type="text" id="box2" value="">

     <!-- Department Dropdown -->
   Department : <select id='sel_depart' name='sel_depart'>
    <option value='0'>-- Select department --</option>

    <!-- Read Departments -->
    @foreach($departments['data'] as $department)
      <option value='{{ $department->id }}'>{{ $department->name }}</option>
    @endforeach

 </select>

 <br><br>
 <!-- Department Employees Dropdown -->
 Employee : <select id='sel_emp' name='sel_emp'>
   <option value='0'>-- Select Employee --</option>
 </select>
 


 <hr><h1>Only Javascript onkeyup</h1>


<h2>Show by Click function Variable Using let</h2>

Value 1: <input type="text" name="dd" id="a"><br>
Value 2: <input type="text" name="gg" id="b"><br>


<br>
Discount % : <input type="text" name="gg" id="dis"><br>


<input type="submit" onclick="cal()" value="Cal"><br>

<b id="dshow"></b><br>
<b id="ss"></b> <br>
<script>

    //Clicking function
    function cal(){
    var x = document.getElementById('a').value;
    var y = document.getElementById('b').value;
    var z= x+y;
    document.getElementById('ss').innerHTML= z;
    
    var ds = document.getElementById('dis').value;
    
    var discount= z*ds/100;
    document.getElementById('dshow').innerHTML= discount;
    
    }
    
    </script>


<hr>
<h2>Auto Show by Keyup function Variable Using let</h2>



<script>
    function mult(value){
    
        var w, s;
        w= 2*value;
        s= 3*value;
    
        document.getElementById('out2').value= w;
        document.getElementById('out3').value= s;
    }
    
    </script>

Value 1: <input type="text" name="" onkeyup="mult(this.value)"><br>

Out 2 x value1: <input type="text" name="" id="out2"><br>
Out 3 x value1: <input type="text" name="" id="out3"><br>


<hr><br><br><br><br><br><br><br><br>



     <!-- Script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
      <!-- jQuery CDN -->
     <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

     <script type='text/javascript'>
     $(document).ready(function(){

      $("input").keydown(function(){
    $("input").css("background-color", "yellow");
  });
  $("input").keyup(function(){
    $("input").css("background-color", "pink");
  });

       // Fetch all records
       $('#but_fetchall').click(function(){
	 fetchRecords(0);
       });

       $('#fetchallByPid').change(function(){
        var pid=$('#fetchallByPid').val();
        console.log($('#fetchallByPid').val());
	 fetchRecordsByPid(pid);
       });

       // Search by userid
       $('#but_search').click(function(){
       // console.log($(this).value());
          var userid = Number($('#search').val().trim());
				console.log(userid);
	  if(userid > 0){
	    fetchRecords(userid);
	  }

       });

//====================================================
// Department Change
$('#sel_depart').change(function(){

// Department id
var id = $(this).val();

// Empty the dropdown
$('#sel_emp').find('option').not(':first').remove();

// AJAX request 
$.ajax({
  url: 'getEmployees/'+id,
  type: 'get',
  dataType: 'json',
  success: function(response){

    var len = 0;
    if(response['data'] != null){
       len = response['data'].length;
    }

    if(len > 0){
      
       // Read data and create <option >
       for(var i=0; i<len; i++){

          var id = response['data'][i].id;
          var name = response['data'][i].name;

          var option = "<option value='"+id+"'>"+name+"</option>";

          $("#sel_emp").append(option); 
          $("#box1").val(id);
          $("#box2").val(name); 
       }
    }

  }
});
});








     });


     function fetchRecordsByPid(pid){
      $('#select2').find('option').not(':first').remove();
       $.ajax({
         url: 'getUserParent/'+pid,
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#userTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }
console.log(len);
           if(len > 1){
            $("#select2").prop('disabled',false);
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var username = response['data'][i].username;
                 var name = response['data'][i].name;
                 var email = response['data'][i].email;
             
                 var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + username + "</td>" +
                   "<td align='center'>" + name + "</td>" +
                   "<td align='center'>" + email + "</td>" +
                 "</tr>";
                 var options = "<option value='"+id+"'>"+email+"</option>"; 
                 $("#select2").append(options);
               
                // $("#select2").append(options);
                 $("#userTable tbody").append(tr_str);
              }
              
           }else{
            $("#select2").prop('disabled',true);
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#userTable tbody").append(tr_str);
           }

         }
       });
     }

     function fetchRecords(id){
       $.ajax({
         url: 'getUsers/'+id,
         type: 'get',
         dataType: 'json',
         success: function(response){

           var len = 0;
           $('#userTable tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
              len = response['data'].length;
           }
console.log(len);
           if(len > 0){
              for(var i=0; i<len; i++){
                 var id = response['data'][i].id;
                 var username = response['data'][i].username;
                 var name = response['data'][i].name;
                 var email = response['data'][i].email;

                 var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + username + "</td>" +
                   "<td align='center'>" + name + "</td>" +
                   "<td align='center'>" + email + "</td>" +
                 "</tr>";

                 $("#userTable tbody").append(tr_str);
              }
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#userTable tbody").append(tr_str);
           }

         }
       });
     }



     </script>
    
  </body>
</html>