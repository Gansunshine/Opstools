@extends('layouts.master')
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::asset('public/js/monsweet/sweetalert2.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>

    </style>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Get WEB</h2>
                </div>
            </div>
        </div>
    </div>
    </div>

<div class="col-md-12">
    <div class="table-responsive-sm">
        <table class="table table-bordered table-hover table-striped" id="myTable">
            <thead class="bg-maroon">
                <tr>
 
                    <th scope="col">status</th>
                    <th scope="col">pesan</th>
                </tr>
            </thead>
            <tbody>

            
                    <tr>
                 
                        <td><?php echo ($parsed_json == 'status') ?> </td>
                       
                    </tr>
                
            </tbody>
        </table>
    </div>
</div>
@endsection