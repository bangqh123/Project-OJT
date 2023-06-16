@extends('layouts.layout')

@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>{{ $title }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('supplier.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Data</button>
                <a class="btn btn-warning" href="{{ route('supplier.export') }}">Export Data</a>
            </form>
        </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" data-toggle="modal" id="myButton" data-target="#myModal" href="{{ route('supplier.create') }}"> Create New</a>
        <a class="btn btn-danger" data-toggle="modal" data-target="#DelChkModal"> Delete Selected</a>
        @include('supplier.deletechk')
    </div>

    <table class="table table-bordered">
        <tr>
            <th><input type="checkbox" id="chkCheckAll"/></th>
            <th>No.</th>
            <th>Image</th>
            <th>Supplier Name</th>
            <th>Address</th>
            <th>Numbers</th>
            <th width="210">Action</th>
        </tr>

        @foreach($supplier as $item)
        <tr id="ids{{ $item->id }}">
            <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $item->id }}"/></td>
            <td>{{ ++$i }}</td>
            <td><img src="/asset/image/suppliers/{{ $item->image }}" width="100"></td>
            <td>{{ $item->Name }}</td>
            <td>{{ $item->Address }}</td>
            <td>{{ $item->Numbers }}</td>

            <td>
                <form action="{{ route('supplier.destroy',$item->id) }}" method="POST">

                    <a class="btn btn-info" data-toggle="modal" id="myButton" data-target="#myModal" href="{{ route('supplier.show',$item->id) }}">Show</a>

                    <a class="btn btn-primary" data-toggle="modal" id="myButton" data-target="#myModal" href="{{ route('supplier.edit',$item->id) }}">Edit</a>

                    <a class="btn btn-danger" data-toggle="modal" data-target="#delModal{{ $item->id }}">Delete</a>
                </form>
            </td>
            @include('supplier.delete')
        </tr>
        @endforeach
    </table>
    {{-- render the links to the rest of the pages --}}
    {!! $supplier->links() !!}

    <script>
        $(function(e){
            $("#chkCheckAll").click(function(){
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });

            $("#Delmul").click(function(e){
                e.preventDefault();
                var allids = [];
                $("input:checkbox[name=ids]:checked").each(function(){
                    allids.push($(this).val());
                });
                location.reload();
                $.ajax({
                    url:"{{ route('supplier.deleteChecked') }}",
                    type:"DELETE",
                    data:{
                        _token:$("input[name=_token]").val(),
                        ids:allids
                    },
                    success:function(response){
                        $.each(allids, function(key,val){
                            $("#ids" +val).remove();
                        })
                    }

                });

            })
        })
    </script>
    <!-- modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <div>
                        <!-- the result to be displayed -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // display a modal
        $(document).on('click', '#myButton', function(event) {

            event.preventDefault();
            let href = $(this).attr('data-attr');

            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {

                    $('#myModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                $("#myModal").on('hidden', function(){
                    window.location.reload();
                }),

                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
@endsection
