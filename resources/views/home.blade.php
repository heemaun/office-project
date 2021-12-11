@extends('layouts.app')

@section('content')
<div class="container">
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row" style="padding-bottom: 10px">
                <div class="col-md-12">
                    @can('create post')
                    <a href="{{route('posts.create')}}" class="btn btn-info">Create new post</a>
                    @endcan
                    @hasrole('admin')
                    <a href="{{route('assign.role')}}" class="btn btn-info">Go to user control</a>
                    @endhasrole
                    @can('mail')
                    <a href="{{route('mails.create')}}" class="btn btn-info">Send Mail</a>
                    @endcan
                </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Posts</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover text-center">
                      <thead>
                      <tr>
                        <th>Created At</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>View</th>
                        @can('edit post')
                        <th>Edit</th>
                        @endcan
                        @can('delete post')
                        <th>Delete</th>
                        @endcan
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->created_at->format('D, M-d,Y H:i:s')}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>
                                    <a id="view" href="{{route('posts.show',$post->slug)}}" class="btn btn-info">View</a>
                                </td>
                                @can('edit post')
                                <td>
                                    <a id="edit" href="{{route('posts.edit',$post->slug)}}" class="btn btn-success">Edit</a>
                                </td>
                                @endcan
                                @can('delete post')
                                <td>
                                    <form method="POST" action="{{route('posts.destroy',$post->slug)}}">
                                        @method("DELETE")
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('are your sure?')">Delete</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
</div>
@if (Session::has('post_added'))
    <script>
        toastr.success("{!! Session::get('post_added') !!}");
    </script>
    {{Session::forget('post_added')}}
@elseif (Session::has('post_updated'))
    <script>
        toastr.info("{!! Session::get('post_updated') !!}");
    </script>
    {{Session::forget('post_updated')}}
@elseif(Session::has('post_deleted'))
    <script>
        toastr.error("{!! Session::get('post_deleted') !!}");
    </script>
    {{Session::forget('post_deleted')}}
@endif


@endsection


