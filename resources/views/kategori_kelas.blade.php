<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LARAVEL CRUD AJAX</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <!--untuk ajax-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <!--untuk jQuery-->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--untuk datatable-->
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script></head>
<body>

<div class="container">
   <i><h2><b>CRUD Ajax DataTable</b></h2></i>
 <a class="btn btn-success" href="javascript:void(0)" id="createNewKategori">+Create Data Kategori</a>
  <a class="btn btn-primary" href="{{url('/barang')}}">barang</a>
 <table id="myTable" class="table table-bordered data-table">
   <thead>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th width="280px">Action</th>
      </tr>
   </thead>
    </tbody>
 </table>
</div>
   
  <!--Modal-->
<div class="modal fade" id="Modalajax" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modelHeading"></h4>
    </div>
      <div class="modal-body">
        <form id="kategori_kelasForm" name="kategori_kelasForm" class="form-horizontal">
      <input type="hidden" name="kategori_kelas_id" id="id_kategori">

      <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
           <div class="col-sm-12">
        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="" maxlength="50" required>
     </div>
     </div>

       <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
         <div class="col-sm-12">
            <textarea id="description" name="description" required="" placeholder="Description" class="form-control" required></textarea>
    </div>
    </div>
      
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
      <button class="btn btn-primary" type="submit" id="saveBtn" value="create">Submit form</button>

  </div>
   </form>
    </div>
       </div> 
 </body>

<script>
$.ajaxSetup({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      
          table = $('#myTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('kategori_kelas.index')}}",
          columns: [
              {data: 'name', name: 'name'},
              {data: 'description', name: 'description'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
      })
       
          $('#createNewKategori').click(function () {
          $('#saveBtn').val("create-kategori");
          $('#id_kategori').val('#id_kategori');
     
          //form
          $('#kategori_kelasForm').trigger("reset");
          $('#modelHeading').html("Create Kategori");
          //modal
          $('#Modalajax').modal('show');
      });
  
          $('#btnClose').click(function () {
          $('#kategori_kelasForm').trigger("reset");
          $('#Modalajax').modal('hide');
  
      });
      
          $('body').on('click', '#edit', function (id) {
           var id_kategori = $(this).data("id");
           console.log(id);
          $.ajax({
            url: ("kategori_kelas/") + id_kategori + "/edit",
            type: "get",
            success: function (data) {
                $('#modelHeading').html("Edit Kategori");
                $('#Modalajax').modal('show');
                $('#id_kategori').val(data.id);
                $('#name').val(data.name);
                $('#description').val(data.description);
           
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
     });
      
          $('#saveBtn').click(function (e) {
            e.preventDefault();
          $(this).html('Submit..');
      
          $.ajax({
            data: $('#kategori_kelasForm').serialize(),
            url: "{{route('kategori_kelas.store')}}",
            type: "post",
            success: function (data) {
              //sweetalert
            Swal.fire(
                     'SELAMAT',
                     'DATA ANDA BERHASIL',
                     'success'
        );

           $('#kategori_kelasForm').trigger("reset");
           $('#Modalajax').modal('hide');
             table.draw();
           
        },

          error: function (data) {
            console.log('Error:', data);
          $('#saveBtn').html('Save Changes');
        }
      });
    });
      
          $('body').on('click', '#hapus', function (id) {
            var kategori_kelas_id = $(this).data("id");
          console.log(kategori_kelas_id); 
        
          Swal.fire({
             title: 'Are you sure?',
             text: "want to delete id=" + kategori_kelas_id + "?",
             icon: 'warning',
             showCancelButton: true,
             cancelButtonText: 'CANCEL',
             confirmButtonText: 'YES, DELETE!'
        }).then((result) => {
            if (result.isConfirmed) {

          $.ajax({
              type: "delete",
              url: ("kategori_kelas/") + kategori_kelas_id,
              dataType:  'JSON',
              data: {"_token" : '{{ csrf_token() }}',},
                //     id: kategori_kelas_id, 
                //    _method:  'delete',
              success: function(data) {
                //sweetalert
          Swal.fire(
               'SELAMAT',
               'DATA ANDA BERHASIL DIHAPUS',
               'success'
        );
                
          $('#myTable').DataTable().ajax.reload();
        },
            error: function (data) {
                console.log('Error:', data);
          }
           })
         }

        });
     });

 </script>
</html>