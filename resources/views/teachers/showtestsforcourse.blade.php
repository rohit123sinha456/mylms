@extends('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('teachers.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
                
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    
                    <div class="card">
                        
                      <div class="card-body">
                        <h4 class="card-title">Search Course Lessons</h4>
                        <p class="card-description">
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#defaultModal">Create Test</button>
                         
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>
                                    Course Name
                                  </th>
                                  <th>
                                    Questions
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($tests as $item)
                                <tr>
                                  <td>
                                   {{$item['name']}}
                                  </td>
                                  
                                  <td>
                                      <input type="hidden" name="testid" id="testid" value={{$item['id']}}>
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="/teacher/test/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                        <form action="/teacher/test/{{$item['id']}}/edit" method="GET"> @csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button> </form>
                                        <form action="/teacher/test/{{$item['id']}}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button> </form>
                                        <form action="/teacher/test/{{$item['id']}}/publish" method="POST">@csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Publish</button> </form>    
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                      </tbody>
                    </table>
                  




                    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Test for  {{$coursename}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <form class="forms-sample" action="/teacher/test" method="POST">
                                    @csrf
                                  <div class="form-group">
                                    <label for="exampleInputName1">Title</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                  </div>
                                  <input type="hidden" class="form-control" id="courseid" name="courseid" value={{$courseid}}>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button> 
                             </div>
                        </form>
                            </div>
                          </div>
                        </div>
                     




                  </div>
                      </div>
                    </div>
                  </div>
                
                <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>






      
    