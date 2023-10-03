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
   <b><h1>CRUD Ajax DataTable</b></h1>
     <a class="btn btn-success" href="javascript:void(0)" id="createNewBarang">+Create Data Barang</a>
      <table id="myTable" class="table table-bordered data-table">
      <thead>
         <tr>
           <th>Name Barang</th>
           <th>Jumlah Barang</th>
           <th width="280px">Action</th>
         </tr>
      </thead>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="Ajaxmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="modelHeading"></h4>
   </div>
     <div class="modal-body">
       <form id="barangForm" name="barangForm" class="form-horizontal">
     <input type="hidden" name="barang_id" id="id_barang">

  <div class="form-group">
       <label for="name" class="col-sm-2 control-label">Name barang</label>
          <div class="col-sm-12">
       <input type="text" class="form-control" id="name_barang" name="name_barang" placeholder="Name Barang" value="" maxlength="50" required="">
    </div>
    </div>
     
  <div class="form-group">
       <label class="col-sm-2 control-label">Jumlah barang</label>
          <div class="col-sm-12">
       <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="jumlah_barang"  required=""></textarea>
    </div>
    </div>
      
      <div class="col-sm-offset-2 col-sm-10">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClose">Close</button>
         <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Submit</button>

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
      
          var table = $('#myTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('barang.index')}}",
          columns: [
              {data: 'name_barang', name: 'name_barang'},
              {data: 'jumlah_barang', name: 'jumlah_barang'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
       })
       
      $('#createNewBarang').click(function () {
          $('#saveBtn').val("create-barang");
          $('#id_barang').val('#id_barang');

          $('#barangForm').trigger("reset");
          $('#modelHeading').html("Create barang");
          $('#Ajaxmodal').modal('show');
      });
  
      $('#btnClose').click(function () {
          $('#barangForm').trigger("reset");
          $('#Ajaxmodal').modal('hide');
  
      });
      
      $('body').on('click', '#editBarang', function (id) {
        var id_barang = $(this).data("id");
        console.log(id);
      $.ajax({
          url: "barang/" + id_barang + "/edit",
          type: "get",
          success: function (data) {
             $('#modelHeading').html("Edit Kategori");
             $('#Ajaxmodal').modal('show');
             $('#id_barang').val(data.id);
             $('#name_barang').val(data.name_barang);
             $('#jumlah_barang').val(data.jumlah_barang);
           
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
         data: $('#barangForm').serialize(),
         url: "{{route('barang.store')}}",
         type: "post",
         success: function (data) {
      Swal.fire(
            'Good job!',
            'Data Berhasil',
            'success'
    );

      $('#barangForm').trigger("reset");
      $('#Ajaxmodal').modal('hide');
         table.draw();
           
    },

      error: function (data) {
        console.log('Error:', data);
     $('#saveBtn').html('Save Changes');
       }
     });
   });
      
      $('body').on('click', '#hapusBarang', function (id) {
        var barang_id = $(this).data("id");
        console.log(barang_id); 
        
      Swal.fire({
           title: 'Are you sure?',
           text: "want to delete id=" + barang_id + "?",
           icon: 'warning',
           showCancelButton: true,
           cancelButtonText: 'CANCEL',
           confirmButtonText: 'YES, DELETE!'
    }).then((result) => {
        if (result.isConfirmed) {

      $.ajax({
        type: "delete",
        url: "barang/" + barang_id,
        dataType:  'JSON',
        data: {"_token" : '{{ csrf_token() }}',},
        success: function(data) {
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
           
      })
    });
  </script>
  </html>
  