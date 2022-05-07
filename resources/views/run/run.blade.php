<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Table of Run</h2>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>lat_long</th>
                <th>time</th>
                <th>km</th>
                <th>user_id</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form id='userForm'>
            <div class="modal-header">
            <h5 class="modal-title" id="modelHeading">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <input type="text" id="user_id" name="user_id">
            <input type="text" id="name" name="name">
            <input type="text" id="email" name="email">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
            </div>
         </form>
      </div>
    </div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('run.run') }}",
        columns: [
            {data: 'lat_long', name: 'lat_long'},
            {data: 'time', name: 'time'},
            {data: 'km', name: 'km'},
            {data: 'user_id', name: 'user_id'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
        });
        $('body').on('click', '.edit', function(){
            var user_id = $(this).data('id');
            $.get("{{ url('run')}}" + '/' + user_id, function(data){
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("edit-user");
                $('#exampleModal').modal("show");
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
            })
        });

        $('body').on('click', '.delete', function(){
            var user_id = $(this).data('id');
            $.ajax({
                url: "{{ url('run/delete')}}"+'/'+ user_id,
                type: 'POST',
                success : function(data){
                    table.draw();
                },
            })
        });

        $('#saveBtn').on('click', function(e){
            e.preventDefault();
            $(this).html('Changement...');
            $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ url('run/edit') }}",
                type: 'POST',
                success : function(data){
                    $('#userForm').trigger("reset");
                    $('exampleModal').modal('hide');
                    table.draw();
                },
                error: function (data){
                    console.log('Erreur : ', data);
                    $('#saveBtn').html('Save Changes');
                }
            })
        })
    });
</script>