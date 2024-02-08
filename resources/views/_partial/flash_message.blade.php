{{-- ///////////////////  UMUM    ////////////////////// --}}
@if (Session::has('flash_message_logingagal'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Not Match','Username / Password Tidak Valid','error')
    </script>
@endif

@if (Session::has('flash_message_akungagal'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Not Match','Akun sedang digunakan','error')
    </script>
@endif

@if (Session::has('flash_message_resetberhasil'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Berhasil','Sesi Berhasil Direset','success')
    </script>
@endif

@if (Session::has('flash_message_resetgagal'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Gagal Reset Sesi','error')
    </script>
@endif

@if (Session::has('flash_message_loginsukses'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Login Berhasil','success')
    </script>
@endif

@if (Session::has('flash_message_usernamegagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Not Match','Username Tidak Ditemukan','error')
    </script>
@endif

@if (Session::has('flash_message_compareberhasil'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Proses Rekapitulasi Data Biller Selesai','success')
    </script>
@endif

@if (Session::has('flash_message_comparegagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Proses Compare Data Biller Gagal','error')
    </script>
@endif

@if (Session::has('flash_message_uploadberhasil'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Berhasil Upload Data','success')
    </script>
@endif

@if (Session::has('flash_message_uploadgagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Gagal Upload Data','error')
    </script>
@endif

@if (Session::has('flash_message_inputberhasil'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Berhasil Menambahkan Data','success')
    </script>
@endif

@if (Session::has('flash_message_inputgagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Gagal Menambahkan Data','error')
    </script>
@endif

@if (Session::has('flash_message_updateberhasil'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Berhasil Mengupdate Data','success')
    </script>
@endif

@if (Session::has('flash_message_updategagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Gagal Mengupdate Data','error')
    </script>
@endif

@if (Session::has('flash_message_printgagal'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Gagal Print Data','error')
    </script>
@endif

@if (Session::has('flash_message_belumlogin'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Gagal','Diperlukan Login','error')
    </script>
@endif
<!-- {{-- ////////////////////////////////////////////////////////////////////////// --}} -->




@if (Session::has('flash_message_pernahkoreksi'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Warning','Koreksi Sudah Pernah Dilakukan','warning')
    </script>
@endif


@if (Session::has('flash_message_topsaldo_mitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Topup Saldo Berhasil','success')
    </script>
@endif

@if (Session::has('flash_message_save_mitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Mitra Baru Berhasil di Tambahkan','success')
    </script>
@endif

@if (Session::has('flash_message_update_mitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Mitra Berhasil di Update','success')
    </script>
@endif

@if (Session::has('flash_message_donenoref_mitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','NOREF Sudah Pernah dilakukan','success')
    </script>
@endif

@if (Session::has('flash_message_deskripsi'))
    <div class="alert alert-success {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         {{ Session::get('flash_message_deskripsi') }}
      </div>
@endif

@if (Session::has('flash_message_save_submitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Sub Mitra Baru Berhasil di Tambahkan','success')
    </script>
@endif

@if (Session::has('flash_message_update_submitra'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Sub Mitra Berhasil di Update','success')
    </script>
@endif


@if (Session::has('flash_message_save_koordinator'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Koordianator Baru Berhasil di Tambahkan','success')
    </script>
@endif

@if (Session::has('flash_message_update_Koordinator'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Koordinator Berhasil di Update','success')
    </script>
@endif

@if (Session::has('flash_message_save_pass'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','User Baru Berhasil di Tambahkan','success')
    </script>
@endif

@if (Session::has('flash_message_change_pass'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Passwrod Berhasil di Ubah','success')
    </script>
@endif

@if (Session::has('flash_message_save_loket'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Loket Baru Berhasil di Tambahkan','success')
    </script>
@endif

@if (Session::has('flash_message_update_loket'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Success','Loket Berhasil di Update','success')
    </script>
@endif
<!-- {{-- ////////////////////////////////////////////////////////////////////////// --}} -->





@if (Session::has('flash_message_umum'))
    <div class="alert alert-success {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_message_umum') }}
    </div>
@endif

@if (Session::has('flash_message_hapus_umum'))
    <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         {{ Session::get('flash_message_hapus_umum') }}
      </div>
@endif

@if (Session::has('flash_message_update_umum'))
    <div class="alert alert-success {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_message_update_umum') }}
    </div>
@endif
{{-- /////////////////////////////////////////////////////////// --}}

@if (Session::has('flash_message_wilayah'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('wilayah','_self')
    </script>
     {{ Session::get('flash_message_wilayah') }}
@endif

@if (Session::has('flash_message_hapus'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('wilayah','_self')
    </script>
     {{ Session::get('flash_message_hapus') }}
@endif

@if (Session::has('flash_message_hapusdata'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','success')
    </script>
@endif

@if (Session::has('flash_message_hapusdatagagal'))
    {{-- <div class="alert alert-danger {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> --}}
    {{--   </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Gagal dihapus','error')
    </script>
@endif

@if (Session::has('flash_message_update'))
    {{-- <div class="alert alert-success {{ Session::has('penting') ? 'alert-important' : '' }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('flash_message_update') }}
    </div> --}}
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Update Success','Data Berhasil diupdate','success')
         window.open('wilayah','_self')
    </script>
     {{ Session::get('flash_message_update') }}
@endif

@if (Session::has('flash_message_hapus_tanya'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
        swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
          buttonsStyling: false
        }).then(function () {
          swal(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          window.open('wilayah','_self')
        }, function (dismiss) {
        
          if (dismiss === 'cancel') {
            swal(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
            window.open('wilayah','_self')
          }
        })
        window.open('wilayah','_self')
     </script>

     {{ Session::get('flash_message_hapus_tanya') }}

@endif
{{-- //////////////////////////////////////////////////////////////////////////// --}}
{{-- ///////////           LOKET DAFTAR            ////////////////////////////// --}}
{{-- //////////////////////////////////////////////////////////////////////////// --}}

@if (Session::has('flash_message_hapus_loket'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('loketdaftar','_self')
    </script>
     {{ Session::get('flash_message_hapus_loket') }}

@endif

@if (Session::has('flash_message_simpan_loket'))
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('loketdaftar','_self')
    </script>
     {{ Session::get('flash_message_simpan_loket') }}
@endif

@if (Session::has('flash_message_update_loket'))
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Update Success','Data Berhasil di Update','success')
         window.open('loketdaftar','_self')
    </script>
     {{ Session::get('flash_message_update_loket') }}
@endif

{{-- ////////////////////////////////////////////////////////////// --}}
@if (Session::has('flash_message_nodata'))
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Tidak Terdaftar','Silahkan Input Wilayah Baru','error')
         window.open('loketdaftar','_self')
    </script>
     {{ Session::get('flash_message_nodata') }}

@endif

{{-- //////////////// MITRA  ///////////////// --}}
@if (Session::has('flash_message_mitra'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('mitra','_self')
    </script>
     {{ Session::get('flash_message_mitra') }}
@endif

@if (Session::has('flash_message_hapus_mitra'))
  
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('mitra','_self')
    </script>
     {{ Session::get('flash_message_hapus_mitra') }}

@endif

@if (Session::has('flash_message_update_mitra'))

    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Update Success','Data Berhasil diupdate','success')
         window.open('mitra','_self')
    </script>
     {{ Session::get('flash_message_update_mitra') }}
@endif

{{-- //////////////// LIBUR  ///////////////// --}}
@if (Session::has('flash_message_libur'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('libur','_self')
    </script>
     {{ Session::get('flash_message_libur') }}
@endif

@if (Session::has('flash_message_hapus_libur'))
  
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('libur','_self')
    </script>
     {{ Session::get('flash_message_hapus_libur') }}

@endif

@if (Session::has('flash_message_update_libur'))

    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Update Success','Data Berhasil diupdate','success')
         window.open('libur','_self')
    </script>
     {{ Session::get('flash_message_update_libur') }}
@endif

{{-- //////////////// STAFF   ///////////////// --}}
@if (Session::has('flash_message_staff'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('staff','_self')
    </script>
     {{ Session::get('flash_message_staff') }}
@endif

@if (Session::has('flash_message_hapus_staff'))
  
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('staff','_self')
    </script>
     {{ Session::get('flash_message_hapus_staff') }}

@endif

@if (Session::has('flash_message_update_staff'))

    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Update Success','Data Berhasil diupdate','success')
         window.open('staff','_self')
    </script>
     {{ Session::get('flash_message_update_staff') }}
@endif

{{-- //////////////// STAFF   ///////////////// --}}
@if (Session::has('flash_message_topupdeposit'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Save Success','Data Berhasil disimpan','success')
         window.open('topupdeposit','_self')
    </script>
     {{ Session::get('flash_message_topupdeposit') }}
@endif

@if (Session::has('flash_message_hapus_topupdeposit'))
  
    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Delete Success','Data Berhasil dihapus','error')
         window.open('topupdeposit','_self')
    </script>
     {{ Session::get('flash_message_hapus_topupdeposit') }}

@endif

@if (Session::has('flash_message_update_topupdeposit'))

    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Update Success','Data Berhasil diupdate','success')
         window.open('topupdeposit','_self')
    </script>
     {{ Session::get('flash_message_update_topupdeposit') }}
@endif

@if (Session::has('flash_message_deponodata'))

    <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
    <script>
         swal('Data Not Found','Kode Merchant Tidak ditemukan','info')
         window.open('topupdeposit','_self')
    </script>
     {{ Session::get('flash_message_deponodata') }}
@endif

{{-- //////////////////////////////////////////////////////////////////////////// --}}
{{-- ///////////                                   ////////////////////////////// --}}
{{-- //////////////////      IRP INTERSKALA   /////////////////////////////////// --}}
{{-- //////////////////////////////////////////////////////////////////////////// --}}
{{-- ///////////                                   ////////////////////////////// --}}
{{-- //////////////////////////////////////////////////////////////////////////// --}}
{{-- //////////////////////////////////////////////////////////////////////////// --}}
{{-- ///////////                                   ////////////////////////////// --}}
{{-- //////////////////////////////////////////////////////////////////////////// --}}


@if (Session::has('flash_message_statustracking'))
   
     <script type="text/javascript" src="{{URL::asset('public/js/monsweet/sweetalert2.js')}}"></script>
     <script>
         swal('Success','Status Berhasil di Update','success')
     </script>
     {{ Session::get('flash_message_statustracking') }}
@endif