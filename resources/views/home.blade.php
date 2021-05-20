@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <button class="btn btn-primary mb-3" type="submit" data-toggle="modal" data-target="#modal-lyrics">New Song</button>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Song Lyrics
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Lyrics</th>
                            <th>Artist</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- Modal -->
<div class="modal fade" id="modal-lyrics" tabindex="-1" role="dialog" aria-labelledby="modal-lyrics" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Song lyrics</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="song-frm">
            <div class="form-group">
                <label for="formGroupExampleInput">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Artist</label>
                <input type="text" name="artist"  class="form-control" id="artist" placeholder="Enter artist">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Lyrics</label>
                <textarea class="form-control" name="lyrics" id="lyrics" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')

<script>

var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('song.data') !!}",
        columns: [
            {data: 'title', name: 'title'},
            {data: 'artist', name: 'artist'},
            {data: 'lyrics', name: 'lyrics'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $("#song-frm").submit(function (e) {
        e.preventDefault();

        let data = $(this).serialize();

        $.ajax({
            url: "/song",
            method: "POST",
            dataType: "json",
            data: data,
            success: function (data) {
                console.log(data);
                if (data.success == true) {
                    table.ajax.reload();
                    $("#modal-lyrics").modal("hide");
                    $('#song-frm')[0].reset();
                    
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
</script>

@endsection
