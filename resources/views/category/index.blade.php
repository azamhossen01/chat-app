@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       

        <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">

           
  
            {{-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> --}}
  
            <h2 class="d-inline-block">Category List</h2>
            <a href="{{ route('category.create') }}" class="btn btn-success float-right">Add New</a>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th width="40%">Title</th>
                    <th width="40%">Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($categories as $key=>$category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->title }}</td>
                        <td><img src="{{ asset('storage/categories/'.$category->image) }}" width="100%" class="img-responsive" alt=""></td>
                        <td>
                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-link text-warning">Edit</a>
                            <a href="{{ route('category.destroy',$category->id) }}" class="btn btn-link text-danger">Delete</a>
                            <form action="{{ route('category.destroy',$category->id) }}" method="post">
                              @csrf 
                              @method('delete')
                            </form>
                            {{-- <a href="{{ route('category.edit',$category->id) }}" class="btn btn-link"></a> --}}
                        </td>
                    </tr>
                  @empty
                      
                  @endforelse
                </tbody>
              </table>
            </div>
            
          </main>
    </div>
</div>
@endsection
