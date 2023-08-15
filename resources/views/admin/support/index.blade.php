@extends('admin.layout.main')
@section('content')

<section class="content-header">
	<div class="row">
	   <div class="col-md-6 text-dark">DashBoard > <b>Tickets List</b>
	   </div>
	   <div class="col-md-6 text-right">
		   <a class="btn btn-primary" href="{{route('admin.support.add')}}">Add Ticket</a>
		</div>
    </div>
</section>
	<!-- Main content -->
<section class="content card">
	<div class="table-responsive mt-2">
		<table class="table table-bordered"  id="dataTable" style="width:100%;">
			<thead class="btn-primary text-dark">
				<tr>
					<th scope="col">Created Date</th>
					<th scope="col">Title</th>
					<th scope="col">Created By</th>
					<th scope="col">AssignedTo</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</section>
@endsection

@section('js')
<script type="text/javascript">
	"use strict";
	$(function() {
		var table=$('#dataTable').DataTable({
            lengthMenu: [[10,50,100,500, -1],[10,50,100,500, 'All']],
            ordering: true,
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
              url: "{{route('admin.support.list')}}?"+$('#form_submit').serialize(),
           },
            columns: [
                {data: 'created_at',name: 'created_at',searchable:false,orderable: true,'width':'60px'},
                {data: 'title',name: 'title',searchable: true,orderable: false},
                {data: 'created_by',name: 'created_by',searchable: true,orderable: false,'width':'100px'},
                {data: 'assigned_to',searchable:false,orderable: false,'width':'100px'},
                {data: 'status',name: 'status',searchable: false,orderable: true,'width':'80px'},
                {data: 'action',searchable: false,orderable: false,'width':'60px'}
            ],
            //for export btns
            dom: 'Blfrtip',
        });
	   



	   $(document).on("click",'.statusChange',function(e) {
	   	  e.preventDefault(); 
	    	var _this=$(this);
	        var id=$(this).attr('data-id');
	        $.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type : "POST",
				url : '{{ route('admin.support.statusChange') }}',
				data : {'id': id},
				dataType : 'json',
				success : function(obj){ 
					if(obj.status){
						$(_this).toggleClass("btn-success btn-danger")
						if($(_this).html()=="Closed")
					    $(_this).html("Open")
					  else
					    $(_this).html("Closed")

            PupoMsg('Success',obj.msg,'success','reload-no');
					}else{
            PupoMsg('Error!',obj.msg,'error','reload-no');
					}
				}
			});
	   });
	});
</script>
@endsection
