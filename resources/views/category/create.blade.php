@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       

        <main role="main" class="col-md-12 ml-sm-auto col-lg-10 pt-3 px-4">

           
  
            {{-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> --}}
  
            <h2 class="d-inline-block">Create New Category</h2>
            <a href="{{ route('category.index') }}" class="btn btn-success float-right">Back</a>
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
              @csrf 
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Category Title" >
                @error('title')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
                @error('image')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for=""></label>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
            
          </main>
    </div>
</div>
@endsection
