@extends('layouts.layout')

@section('content')
<div class="col-lg-12 margin-tb">
    <div class="pull-left">
        <h1>{{ $title }}</h1>
    </div>
</div>
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
    <a class="btn btn-danger" data-toggle="modal" data-target="#DelChkModal"> Delete Selected</a>
    @include('products.deletechk')
</div>


<table class="table table-bordered">
    <tr>
        <th><input type="checkbox" id="chkCheckAll"/></th>
        <th>Image</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Product Unit</th>
        <th>Price</th>
        <th width="210">Action</th>
    </tr>

    @foreach($products as $item)
    <tr id="ids{{ $item->id }}">
        <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $item->id }}"/></td>
        <td><img src="/asset/image/products/{{ $item->image }}" width="100"></td>

        <td>{{ $item->category['Name'] }}</td>
        <td>{{ $item->supplier['Name'] }}</td>

        <td>{{ $item->Name }}</td>
        <td>{{ $item->Desc }}</td>
        <td>{{ $item->Quantity }}</td>
        <td>{{ $item->Unit }}</td>
        <td>{{ $item->Price }} VND</td>

        <td>
            <form action="{{ route('products.destroy',$item->id) }}" method="POST">

                <a class="btn btn-info" data-toggle="modal" id="myButton" data-target="#myModal" href="{{ route('products.show',$item->id) }}">Show</a>

                <a class="btn btn-primary" data-toggle="modal" id="myButton" data-target="#myModal" href="{{ route('products.edit',$item->id) }}">Edit</a>

                <a class="btn btn-danger" data-toggle="modal" data-target="#delModal{{ $item->id }}">Delete</a>

            </form>
        </td>
        @include('products.delete')
    </tr>
    @endforeach
</table>

<!-- modal for crud -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="myBody">
                <div>
                    <!-- the result to be displayed -->
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    // display modal
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
                $('#myBody').html(result).show();
            },

            complete: function() {
                $('#loader').hide();
            },

            $("#myModal").on('hidden.bs.modal', function(){
                document.location.reload();
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

{{-- Delete checked data --}}
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
                url:"{{ route('products.deleteChecked') }}",
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

@endsection
