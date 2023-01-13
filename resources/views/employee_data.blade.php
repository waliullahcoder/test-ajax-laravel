<!doctype html>
<html>
   <body>
    https://makitweb.com/fetch-records-from-mysql-with-jquery-ajax-laravel/<br>
    https://makitweb.com/auto-populate-dropdown-with-jquery-ajax-in-laravel-8/ <br>
     <input type='text' id='search' name='search' placeholder='Enter userid 1-27'>
     <input type='button' value='Search' id='but_search'>
     <br/>
     <select id='fetchallByPid' name='pid'>
        <option value="0">Select</option>
        <option value="1">ABC</option>
        <option value="2">DFGH</option>
        <option value="3">FFFFF</option>

     </select>
     <input type='button' value='Fetch all records' id='but_fetchall'>
     
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

     <select id='select2' name='pid'><option value='0'>select2</option></select>






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

     <!-- Script -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
      <!-- jQuery CDN -->
     <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>

     <script type='text/javascript'>
     $(document).ready(function(){

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
       }
    }

  }
});
});








     });


     function fetchRecordsByPid(pid){
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