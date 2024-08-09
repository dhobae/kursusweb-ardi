 <style>
     /* fix dark on icon sweetalert */
     .swal2-success-circular-line-left,
     .swal2-success-fix,
     .swal2-success-circular-line-right {
         background-color: rgb(255, 255, 255) !important
     }
 </style>

 {{-- @if ($errors->any())
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             Swal.fire({
                 icon: 'error',
                 title: 'Oops...',
                 html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
             });
         });
     </script>
 @endif --}}

 @if (session('notifikasi'))
     <script>
         Swal.fire({
             title: "{{ session('notifikasi.title_alert') }}",
             text: "{{ session('notifikasi.text') }}",
             icon: "{{ session('notifikasi.icon') }}",
         });
     </script>
 @endif
